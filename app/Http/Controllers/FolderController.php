<?php

namespace App\Http\Controllers;

use \App\Models\Folder;
use \App\Models\File;
use Illuminate\Http\Request;
use \App\User;
use Str;
use \App\Models\BusinessCase;
use Illuminate\Support\Facades\Storage;
use \App\Http\Traits\DirValidationTrait;

class FolderController extends Controller
{
    public function index() {
        $this->middleware(['auth','permission:Операции-с-папками']);
        $folders = Folder::with('business_case')->where('isArchived', '0')->get();
        return view('folder.index', ['folders' => $folders]);
    }

    public function archiveIndex() {
        $this->middleware(['auth','permission:Операции-с-архивом']);
        $folders = Folder::with('business_case')->where('isArchived', '1')->get();
        return view('folder.archive', ['folders' => $folders]);
    }

    public function create() {
        $this->middleware(['auth','permission:Операции-с-папками']);
        $folders = Folder::where('isArchived', '0')->get();
        $IDs = array();
        foreach ($folders as $folder) {
            $IDs[] = $folder->business_case_id;
        }
        $IDs = array_filter($IDs, 'strlen');
        $businessCases = BusinessCase::where('isArchived', '0')->whereNotIn('id', $IDs)->get();
        return view('folder.create', ['businessCases' => $businessCases]);
    }

    public function edit($slug) {
        $this->middleware(['auth','permission:Операции-с-папками']);
        $folder = Folder::where('slug', $slug)->with('business_case')->first();
        $folders = Folder::where('isArchived', '0')->get();
        $IDs = array();
        foreach ($folders as $fol) {
            $IDs[] = $fol->business_case_id;
        }
        $IDs = array_filter($IDs, 'strlen');
        $businessCases = BusinessCase::where('isArchived', 0)->whereNotIn('id', $IDs)->get();
        $businessCase = BusinessCase::where('id', $folder->business_case_id)->first();

        return view('folder.edit', [
            'folder' => $folder,
            'businessCases' => $businessCases,
            'businessCase' => $businessCase
        ]);
    }

    public function update($slug, Request $request) {
        $this->middleware(['auth','permission:Операции-с-папками']);
        $this->validate($request, [
            'title' => 'required|regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,()№\/\\-:;\'"— ]+$/u',
            'businessCase' => 'required|integer'
        ],[
            'title.required' => 'Название папки - необходимое поле.',
            'title.regex' => 'Название дела может содержать только буквы, цифры, пробелы и специальные знаки (_ ( ) . , № \ / : ; \' " —).',
            'businessCase.integer' => 'Значение поля "Привязанное дело" не соответствует формату',
            'businessCase.required' => 'Значение поля "Привязанное дело" не соответствует формату'
        ]);

        $folder = Folder::where('slug', $slug)->first();
        if (!$folder)
            return redirect()->back()->with('errors', 'Папка не найдена!');

        if (trim($request->title) != $folder->title && Folder::where('title', trim($request->title))->first())
            return redirect()->back()->with('errors', 'Папка с таким названием уже существует!');

        $folder->title = trim($request->title);

        if ($request->businessCase != '0') {
            $businessCase = BusinessCase::where('id', $request->businessCase)->first();
            if (!$businessCase)
                return redirect()->back()->with('errors', 'Дело не найдено!');
            $folder->business_case()->associate($businessCase);
        } else {
            $folder->business_case()->dissociate();
        }

        $folder->save();
        return redirect()->to('/folders')->with('success', 'Папка успешно обновлена!');
    }

    public function store(Request $request) {
        $this->middleware(['auth','permission:Операции-с-папками']);
        $this->validate($request, [
            'title' => 'required|regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,()№\/\\-:;\'"— ]+$/u',
            'businessCase' => 'required|integer'
        ],[
            'title.required' => 'Название папки - необходимое поле.',
            'title.regex' => 'Название дела может содержать только буквы, цифры, пробелы и специальные знаки (_ ( ) . , № \ / : ; \' " —).',
            'businessCase.integer' => 'Значение поля "Привязанное дело" не соответствует формату',
            'businessCase.required' => 'Значение поля "Привязанное дело" не соответствует формату'
        ]);

        $businessCase = '';
        if ($request->businessCase != '0') {
            $businessCase = BusinessCase::where('id', $request->businessCase)->first();
            if (!$businessCase)
                return redirect()->back()->with('errors', 'Дело не найдено!');
        }

        $title = trim($request->title);
        if ( Folder::where('title', $title)->first() )
            return redirect()->back()->with('errors', 'Папка с таким названием уже существует!');

        $folder = Folder::create([
            'title' => $title,
            'slug' => $this->newSlug(),
            'isArchived' => '0'
        ]);

        Storage::disk('userUploads')->makeDirectory('folders/'.$folder->id);

        if ($businessCase)
            $folder->business_case()->associate($request->businessCase);

        $folder->save();
        return redirect()->to('/folders')->with('success', 'Папка успешно создана!');
    }

    public function show($slug, $path = '') {
        $folder = Folder::with('business_case')->where('slug', $slug)->with(['files' => function ($q) use ($path){
            $q->where([['files.dir', '=', '/' . $path], ['files.isArchived', '=', '0']]);
        }])->first();
        if (!$folder) abort(404);

        // Check if user has access
        $access = false;
        if ($folder->business_case_id != null) {
            $users = $folder->business_case->users()->get();
            foreach ($users as $user)
                if ($user->id == \Auth::user()->id) $access = true;
        }
        else
            if (\Gate::check('Операции-с-папками'))
                $access = true;
        if (!$access) abort(403);

        $subfolders = '';
        $folders = explode('/', $path);
        if ($path != '') {
            $subfolders = Array();
            foreach ($folders as $folderElem) {
                $subfolders[] = File::where('id', $folderElem)->first();
            }
        }
        return view('folder.show', ['folder' => $folder, 'subfolders' => $subfolders, 'isArchive' => false]);
    }

    public function archive($slug, $path = '') {
        $folders = array_filter(explode('/', $path));
        $path = implode('/', $folders);
        $path = '/' . $path;
        $folder = Folder::with('business_case')->where('slug', $slug)->with(['files' => function ($q) use ($path){
            $q->where([['files.dir', '=', $path], ['files.isArchived', '=', '1']]);
        }])->first();

        $subfolders = '';
        if ($path != '/') {
            $subfolders = Array();
            foreach ($folders as $folderElem) {
                $subfolders[] = File::where('id', $folderElem)->first();
            }
        }

        $folder->business_case()->dissociate();
        $folder->save();

        return view('folder.show', ['folder' => $folder, 'subfolders' => $subfolders, 'isArchive' => true]);
    }

    public function remove($slug) {
        $folder = Folder::with('business_case')->where([['slug', $slug], ['isArchived', '0']])->first();
        if (!$folder) abort(404);

        if ($folder->business_case)
            $folder->business_case()->dissociate();
        $folder->isArchived = '1';
        $folder->save();

        return redirect()->back()->with('success', 'Папка успешно перемещена в архив!');
    }

    public function restore($slug) {
        $folder = Folder::with('business_case')->where([['slug', $slug], ['isArchived', '1']])->first();
        if (!$folder) abort(404);

        $folder->isArchived = '0';
        $folder->save();

        return redirect()->to('/folders/'.$folder->slug)->with('success', 'Папка успешно восстановлена!');
    }

    public function delete($slug) {
        $folder = Folder::with('business_case')->where('slug', $slug)->first();
        if (!$folder) abort(404);

        Storage::disk('userUploads')->deleteDirectory('folders/'.$folder->id);
        $files = File::where('folder_id', $folder->id)->get();
        foreach ($files as $file) {
            $file->delete();
        }
        $folder->delete();

        return redirect()->back()->with('success', 'Папка и все файлы успешно удалены!');
    }

    public function newSlug() {
        $slugStr = strtolower(Str::random(6));
        $folder = Folder::where('slug', '=', 'folder-'.$slugStr)->first();
        if ($folder)
            return $this->newSlug();
        else
            return "folder-".$slugStr;
    }

    public function setRootFolders() {
        $folders = \DB::table('tempfolders')->where('parent_folderid', '0')->get();
        foreach ($folders as $folder) {
            if(!Storage::disk('userUploads')->has('folders/'.$folder->title_folder))
                Storage::disk('userUploads')->makeDirectory('folders/'.$folder->title_folder);
            else
                return redirect()->back()->with('errors', 'Папка с таким названием уже существует!');

            $folder = Folder::create([
                'title' => $folder->title_folder,
                'slug' => $this->newSlug(),
                'isArchived' => $folder->removed
            ]);
            if (!$folder) {
                ljahksjdf;
                \Log::info($folder->id);
            }
        }
        return redirect()->back()->with('success', 'Папки успешно созданы!');
    }

    public function folderTree() {
        $folders = Folder::with('business_case')->get();
        /*$subfolders = File::where('type', 'folder')->get();
        $files = File::where('type', 'file')->get();*/
        return view('folder-tree.index', ['folders' => $folders/*, 'subfolders' => $subfolders, 'files' => $files*/]);
    }

    public function getSub(Request $request) {
        $folderID = $request->id;
        $dir = ($request->dir) ? $request->dir : '/';
        $order = ($request->title) ? $request->title : 'title';

        if ($order != 'title' && $order != 'created_at')
        {
            $response['status'] = '404';
            return json_encode($response);
        }

        $response = array();
        $files = File::where([['folder_id', $folderID], ['dir', $dir]])->orderBy('type', 'desc')->orderBy($order, 'asc')->get();
        $response['files'] = $files;
        /*foreach ($files as $file) {
            $response['files'][$file->id] = $file;
        }*/
        $response['count'] = count($files);
        $response['status'] = 'success';
        return json_encode($response);
    }
}
