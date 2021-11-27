<?php

namespace App\Http\Controllers;

use \App\Models\File;
use \App\Models\Folder;
use Illuminate\Http\Request;
use \App\User;
use Str;
use \App\Models\BusinessCase;
use Illuminate\Support\Facades\Storage;
use \App\Http\Traits\DirValidationTrait;

class FileController extends Controller
{
    public function create($slug, $path = '') {
        $folder = Folder::where('slug', $slug)->first();
        if (!$folder) abort(404);

        $pathFull = \App\Http\Traits\DirValidationTrait::validate($folder, $path);
        if (!$pathFull)
            abort(404);

        $subfolders = explode('/', $path);
        $subfolders = array_filter($subfolders, 'strlen');
        foreach ($subfolders as $key => $sub) {
            $subfolders[$key] = File::where('id', $sub)->first();
        }

        return view('file.create', ['folder' => $folder, 'subfolders' => $subfolders]);
    }

    public function store(Request $request, $slug, $path = null) {
        //  Check if request is correct
        $folder = Folder::where('slug', $slug)->first();
        if (!$folder) abort(404);
        if ($request->type != 'file' && $request->type != 'folder')
            return redirect()->back()->with('errors', 'Формат формы нарушен!');

        $pathFull = DirValidationTrait::validate($folder, $path);
        if (!$pathFull)
            return redirect()->back()->with('errors', 'Путь к папке не найден. Возможно она была удалена. ');

        $path =  explode('/', $path);
        $path = array_filter($path, 'strlen');
        $path = implode('/', $path);

        $files = '';
        if ($request->type == 'folder') {
            $this->validate($request, [
                'title' => ['required', 'regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,()№\-;\'— ]+$/u'],
            ], [
                'title.required' => 'Название папки - необходимое поле!',
                'title.regex' => 'Название папки может содержать только буквы, цифры, пробелы и специальные знаки (_ ( ) . , № - ; \' " —).',
            ]);

            $fileVar = File::create([
                'title' => trim($request->title),
                'dir' => '/' . $path,
                'type' => 'folder',
                'isArchived' => '0'
            ]);

            if(!Storage::disk('userUploads')->has('folders/' . $pathFull . $fileVar->id))
                Storage::disk('userUploads')->makeDirectory('folders/' . $pathFull . $fileVar->id);
            $fileVar->folder()->associate($folder);
            $fileVar->save();
        } else {
            $files = $request->file('file');
            if (!$files) return redirect()->back()->with('errors', 'Ни одного файла не было загружено.');

            $this->validate($request, [
                'filename.*' => ['regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,()№\-;\'— ]+$/u', 'nullable', 'distinct'],
            ], [
                'filename.*.regex' => 'Название файла может содержать только буквы, цифры, пробелы и специальные знаки (_ ( ) . , № - ; \' " —).',
                'filename.*.distinct' => 'Файлы должны иметь разные названия.',
            ]);

            foreach ($files as $key => $file) {
                if ($file->getSize() > 209715200)
                    return redirect()->back()->with('errors', 'Размер файлов не может превышать 200MB!');
                $allowedExtensions = [
                    'jpg', 'jpeg', 'tiff', 'bmp', 'png', 'gif', 'webp', 'txt', 'doc', 'docx', 'docm',
                    'odt', 'rtf', 'wps', 'xps', 'csv', 'odt', 'ogg', 'mpa', 'wma', 'xlsx', 'xslm', 'xlsb',
                    'xls', 'xml', 'xlw', 'xlr', 'pptx', 'pptm', 'ppt', 'pdf', 'xps', 'mp4', 'mp3', 'wmv',
                    'htm', 'html', '7z', 'rar', 'z', 'zip', 'tif', 'pps', 'ods', 'avi', 'mpg', 'mpeg', 'mov',
                    'numbers', 'pages', 'dwg', 'dgr'
                ];

                if (!in_array($file->extension(), $allowedExtensions))
                    return redirect()->back()->with('errors', 'Разрешённые форматы файлов: jpg, jpeg, tiff, bmp, png,
                    gif, webp, txt, doc, docx, docm, odt, rtf, wps, xps, csv, odt, ogg, mpa, wma, xlsx, xslm, xlsb,
                    xls, xml, xlw, xlr, pptx, pptm, ppt, pdf, xps, mp4, mp3, wmv, htm, html, 7z, rar, z, zip, tif,
                    pps, ods, avi, mpg, mpeg, mov, numbers, pages, dwg, dgr');

                $existingFile = File::where([
                    ['dir', '/' . $path],
                    ['title', trim($request->filename[$key])]
                ])->first();
                if ($existingFile)
                    return redirect()->back()->with('errors', 'Файл ' . trim($request->filename[$key]) . ' уже существует в папке. Файлы не были загружены.');
            }

            foreach ($files as $key => $file) {
                $filename = str_replace('.', '_', microtime(true)). '.' .$file->extension();
                $fileVar = File::create([
                    'title' => $request->filename[$key],
                    'filename' => $filename,
                    'extension' => '.' . $file->extension(),
                    'dir' => '/' . $path,
                    'type' => 'file',
                    'isArchived' => '0'
                ]);
                $file->storeAs('folders/' . $pathFull, $filename, 'userUploads');
                $fileVar->folder()->associate($folder);
                $fileVar->save();
            }
        }
        return redirect()->back()->with('success', 'Успешно!');
    }

    public function show($slug, $path) {
        $access = false;
        $folder = Folder::where('slug', $slug)->first();
        if (!$folder) abort(404);

        if ($folder->business_case_id != null) {
            $users = $folder->business_case->users()->get();
            foreach ($users as $user)
                if ($user->id == \Auth::user()->id) $access = true;
        }
        else
            if (\Gate::check('Операции-с-папками'))
                $access = true;

        if (!$access) abort(403);

        return response()->file(\Illuminate\Support\Facades\Storage::disk('userUploads')->path('folders' . $path));
    }

    public function remove($slug, $path) {
        $folder = Folder::where('slug', $slug)->first();
        if (!$folder) abort(404);

        $fullpath = DirValidationTrait::validate($folder, $path);
        if (!$fullpath) abort(404);

        $pathArray = array_filter(explode('/', $path), 'strlen');
        $fileID = end($pathArray);
        $file = File::where([['id', $fileID], ['isArchived', '0']])->first();
        if (!$file) abort(404);

        $file->isArchived = '1';
        $file->save();

        return redirect()->back()->with('success', 'Удаление успешно!');
    }

    public function restore($slug, $path) {
        $folder = Folder::where('slug', $slug)->first();
        if (!$folder) abort(404);

        $fullpath = DirValidationTrait::validate($folder, $path);
        if (!$fullpath) abort(404);

        $pathArray = array_filter(explode('/', $path), 'strlen');
        $fileID = end($pathArray);
        $file = File::where('id', $fileID)->first();
        if (!$file) abort(404);

        $file->isArchived = '0';
        $file->save();

        return redirect()->back()->with('success', 'Восстановление успешно!');
    }

    public function delete($slug, $path) {
        $folder = Folder::where('slug', $slug)->first();
        if (!$folder) abort(404);

        $fullpath = DirValidationTrait::validate($folder, $path);
        if (!$fullpath) abort(404);

        $pathArray = array_filter(explode('/', $path), 'strlen');
        $fileID = end($pathArray);
        $file = File::where('id', $fileID)->first();
        if (!$file) abort(404);


        if ($file->type == 'folder') {
            Storage::disk('userUploads')->deleteDirectory('folders' . $fullpath);
            $subfiles = File::where('dir', 'like', '/' . implode('/', $pathArray) . '%')->get();
            if ($subfiles) {
                foreach ($subfiles as $subfile) {
                    $subfile->delete();
                }
            }
        } else {
            Storage::disk('userUploads')->delete('folders' . $fullpath);
        }
        $file->delete();

        return redirect()->back()->with('success', 'Удаление успешно!');
    }
    
    //  May delete commented functions

    /*public function checkFiles() {
        $files = \DB::table('tempfiles')->get();
        $notPresent = array();
        foreach ($files as $file) {
            $fileOnDisk = Storage::disk('userUploads')->has('tempfiles/' . $file->localfile_title);
            if (!$fileOnDisk) $notPresent[] = $file->id; //\DB::table('tempfiles')->where('id', $file->id)->delete();
        }
        \Log::info(count($notPresent));
        afsdlkjahsdf;
    }*/

    /*public function checkEntries() {
        $files = Storage::disk('userUploads')->files('tempfiles');
        $entryIDs = array();
        $amountDecoupled = 0;
        foreach ($files as $file) {
            $fileName = str_replace('tempfiles/', '', $file);
            $entry = \DB::table('tempfiles')->where('localfile_title')->get();
            if (!$entry) $amountDecoupled++;
            if (count($entry) > 1) {
                foreach ($entry as $ent) {
                    $entryIDs[$fileName][] = $ent->id;
                }
            }
        }
        \Log::info($amountDecoupled);
        \Log::info(print_r($entryIDs, true));
        afsdlkjahsdf;
    }*/

    /*public function fillTranslation() {
        $translation = array(
            779 => 27, 1803 => 37, 1804 => 38, 279 => 8, 33 => 1,
            2082 => 41, 804 => 28, 551 => 18, 807 => 29, 1834 => 39,
            1841 => 40, 310 => 9, 323 => 10, 328 => 11, 845 => 30,
            336 => 12, 870 => 31, 103 => 2, 363 => 13, 118 => 3,
            1158 => 33, 135 => 4, 649 => 19, 138 => 5, 394 => 14,
            397 => 15, 1168 => 34, 1431 => 35, 1433 => 36, 156 => 6,
            158 => 7, 430 => 16, 692 => 20, 451 => 17, 713 => 21,
            978 => 32, 727 => 22, 737 => 23, 739 => 24, 747 => 25,
            763 => 26
        );
        $newArray = array();
        foreach ($translation as $old => $new) {
            $newArray[] = ['old' => $old, 'new' => $new];
        }
        \DB::table('translation')->insert($newArray);

        return redirect()->back()->with('success', 'Успешно!');
    }*/

    /*public function setSubDirs() {
        set_time_limit(0);
        $translation = array(
            779 => 3, 1803 => 3, 1804 => 5, 279 => 6, 33 => 7,
            2082 => 8, 804 => 9, 551 => 10, 807 => 11, 1834 => 12,
            1841 => 13, 310 => 14, 323 => 15, 328 => 16, 845 => 17,
            336 => 18, 870 => 19, 103 => 20, 363 => 21, 118 => 22,
            1158 => 23, 135 => 24, 649 => 25, 138 => 26, 394 => 27,
            397 => 28, 1168 => 29, 1431 => 30, 1433 => 31, 156 => 32,
            158 => 33, 430 => 34, 692 => 35, 451 => 36, 713 => 37,
            978 => 38, 727 => 39, 737 => 40, 739 => 41, 747 => 42,
            763 => 43
        );
        $folders = \DB::table('tempfolders')->where('parent_folderid', '0')->get();
        $folderTree = array();
        $newTree = array();
        $pathArray = array();
        function buildBranch($explosive, $path, $folderID) {
            $branch[$explosive->id]['folder'] = $explosive;

            if (strlen($explosive->title_folder) > 191) {
                $title = trim($explosive->title_folder);
                $title = mb_substr($title,0,191);
            } else {
                $title = trim($explosive->title_folder);
            }

            $branch[$explosive->id]['new_folder'] = File::create([
                'title' => $title,
                'dir' => '/' . implode('/', $path),
                'type' => 'folder',
                'isArchived' => $explosive->removed
            ]);
            \DB::table('translation')->insert(['old' => $explosive->id, 'new' => $branch[$explosive->id]['new_folder']->id]);
            $branch[$explosive->id]['new_folder']->folder()->associate($folderID);
            $branch[$explosive->id]['new_folder']->save();
            $path[] = $branch[$explosive->id]['new_folder']->id;
            $subFolders = \DB::table('tempfolders')->where('parent_folderid', $explosive->id)->get();
            if ($subFolders) {
                foreach ($subFolders as $subFolder) {
                    $branch[$explosive->id] = $branch[$explosive->id] + buildBranch($subFolder, $path, $folderID);
                }
            }
            array_pop($path);
            return $branch;
        }
        foreach ($folders as $folder) {
            $pathArray = array();
            $folderTree[$folder->id]['folder'] = $folder;
            $folderTree[$folder->id]['new_folder'] = Folder::where('id', $translation[$folder->id])->first();
            $subFolders = \DB::table('tempfolders')->where('parent_folderid', $folder->id)->get();
            if ($subFolders) {
                foreach ($subFolders as $subFolder) {
                    $folderTree[$folder->id] = $folderTree[$folder->id] + buildBranch($subFolder, $pathArray, $translation[$folder->id]);
                }
            }
        }

        $files = \DB::table('tempfiles')->get();
        $missingFiles = array();

        foreach ($files as $forFile) {
            $lastFolder = \DB::table('translation')->where('old', $forFile->folder_id)->first();
            $folderID = 1;
            if (!$lastFolder) {
                if (!array_key_exists($forFile->folder_id, $translation)) {
                    $missingFiles[] = 'translation - ' . $forFile->id;
                    continue;
                } else {
                    $folderID = $translation[$forFile->folder_id];
                }
            } else {
                $folderID = $lastFolder->new;
            }
            $fileFolder = File::where('dir', 'like', '%/' . $folderID)->first();
            if (!$fileFolder) {
                $folder = Folder::where('id', $folderID)->first();
                if (!$folder) {
                    $missingFiles[] = 'no folder1 - ' . $forFile->id;
                } else {
                    $title = trim($forFile->real_title);
                    $title = substr($title, 0, 191);
                    $filename = str_replace('.', '_', microtime(true)) . '.' . $forFile->extension;
                    $newFile = File::create([
                        'title' => $title,
                        'filename' => $filename,
                        'extension' => '.' . $forFile->extension,
                        'dir' => '/',
                        'type' => 'file',
                        'isArchived' => $forFile->removed
                    ]);
                    $newFile->folder()->associate($folder);
                    $newFile->save();
                    Storage::disk('userUploads')->copy(
                        'tempfiles/' . $forFile->localfile_title,
                        'folders/' . $folder->id . '/' . $filename);
                }
            } else {
                $folder = Folder::where('id', $fileFolder->folder_id)->first();
                if (!$folder) {
                    $missingFiles[] = 'no folder2 - ' . $forFile->id;
                    continue;
                }
                $dir = $fileFolder->dir . '/' . $fileFolder->id;
                $path = $folder->id . '/' . $dir;

                $title = trim($forFile->real_title);
                $title = substr($title, 0, 191);
                $filename = str_replace('.', '_', microtime(true)) . '.' . $forFile->extension;
                try {
                    $newFile = File::create([
                        'title' => $title,
                        'filename' => $filename,
                        'extension' => '.' . $forFile->extension,
                        'dir' => $dir,
                        'type' => 'file',
                        'isArchived' => $forFile->removed
                    ]);
                } catch (\Illuminate\Database\QueryException $ex) {
                    \Log::info('File ID: ' . $forFile->id);
                }

                $newFile->folder()->associate($folder);
                $newFile->save();

                if (!Storage::disk('userUploads')->has('folders/' . $path))
                    Storage::disk('userUploads')->makeDirectory('folders/' . $path);
                Storage::disk('userUploads')->copy(
                    'tempfiles/' . $forFile->localfile_title,
                    'folders/' . $path . $filename);
            }
        }

        \Log::info(implode(',', $missingFiles));
        kljadsfkjasdfdfgsd;

        return redirect()->back()->with('success', 'Перенос папок успешно завершён!');
    }
     
    public function replaceIcons() {
        $users = User::all();
        foreach($users as $user) {
            $user->avatar = str_replace('http://127.0.0.1:8000', '', $user->avatar);
            $user->save();
        }
    }

    public function removeSubFolders() {
        $folders = Storage::disk('userUploads')->directories('folders/');
        foreach ($folders as $folder) {
            $dirs = Storage::disk('userUploads')->directories($folder);
            foreach ($dirs as $dir) {
                Storage::disk('userUploads')->deleteDirectory($dir);
            }
            $files = Storage::disk('userUploads')->allFiles($folder);
            foreach ($files as $file) {
                Storage::disk('userUploads')->delete($file);
            }
        }
        $files = Storage::disk('userUploads')->allFiles('folders/');
        \Log::info(print_r($files, true));
        kljhasdfkjh;
    }


    public function renameDuplicates() {
        $files = \DB::table('tempfiles')->get();
        $rowCounter = array();
        foreach ($files as $file) {
            $rowCounter[$file->real_title][] = $file;
        }
        foreach ($rowCounter as $key => $row) {
            if (count($row) == 1) unset($rowCounter[$key]);
        }
        foreach ($rowCounter as $title => $files) {
            $i = 0;
            foreach ($files as $file) {
                \Log::info($file->real_title);
                if ($i == 0) {
                    $i++;
                    continue;
                }
                \DB::table('tempfiles')->where('id', $file->id)->update(['real_title' => $title . ' - ' . $i]);
                $i++;
            }
        }
        return redirect()->back()->with('success', 'Переименование успешно!');
    }*/
}
