<?php

namespace App\Http\Controllers;

use App\Http\Traits\BusinessCaseTrait;
use Illuminate\Support\Facades\Auth;
use App\Role;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Static_;
use phpDocumentor\Reflection\Types\This;
use Purifier;
use Str;
use URL;
use function PHPUnit\Framework\isNull;
use App\Models\BusinessCase;
use App\User;
use App\Models\Dialog;
use App\Models\Folder;

class BusinessCaseController extends Controller
{
    protected $businessCase;
    public function __construct(BusinessCase $businessCase)
    {
        $this->businessCase = $businessCase;
    }
    public function index() {
        if (\Gate::check('Операции-с-делами')) {
            $result = BusinessCase::with('users')->with('guests')->where('isArchived', 0)->get();
        } else {
            $value = \Auth::user()->id;
            $businessCases = BusinessCase::with('users')->with('guests')
                ->whereHas('users', function($q) use($value) {
                    $q->where('user_id', '=', $value);
                })
                ->where('isArchived', 0)
                ->get();
            $businessCasesGuest = BusinessCase::with('users')->with('guests')
                ->whereHas('guests', function($q) use($value) {
                    $q->where('user_id', '=', $value);
                })
                ->where('isArchived', 0)
                ->get();
            $merged = $businessCases->merge($businessCasesGuest);
            $result = $merged->all();
        }
        
        return view('business-case.index', [
            'businessCases' => $result,
        ]);
    }

    public function show($slug) {
        $businessCase = BusinessCase::with('users')->with('guests')->where('slug', '=', $slug)->first();
        if (!$businessCase) abort(404);
        $publicDialogs = Dialog::with('users')->where([
            ['business_case_id', '=', $businessCase->id],
            ['tetatet', '=', '0'],
            ['isArchived', '0']
        ])->orderBy('pinned', 'DESC')
            ->orderBy('title', 'ASC')
            ->get();
        $tetatetDialogs = Dialog::with('users')->where([
            ['business_case_id', '=', $businessCase->id],
            ['tetatet', '=', '1'],
            ['isArchived', '0']
        ])->orderBy('pinned', 'DESC')
            ->orderBy('title', 'ASC')
            ->get();

        if ($businessCase->isArchived == '1' && !\Gate::check('Операции-с-архивом')) {
            return redirect()->to('/cases')->with('errors', 'Дело удалено!');
        }

        $businessCaseUsers = $businessCase->users()->get();
        $businessCaseGuests = $businessCase->guests()->get();
        $access = false;
        foreach ($businessCaseUsers as $user) {
            if ($user->id == \Auth::user()->id) $access = true;
        }
        foreach ($businessCaseGuests as $guest) {
            if ($guest->id == \Auth::user()->id) $access = true;
        }
        if (\Gate::check('Операции-с-делами')) $access = true;
        if (!$access) return redirect()->to('/cases')->with('errors', 'У Вас нет доступа к этому делу!');

        return view('business-case.show', [
            'businessCase' => $businessCase,
            'publicDialogs' => $publicDialogs,
            'tetatetDialogs' => $tetatetDialogs,
            'businessCaseUsers' => $businessCaseUsers
        ]);
    }

    public function create() {
        if (!\Gate::check('Операции-с-делами'))
            abort(403);

        $users = User::all();
        $folders = Folder::where([['business_case_id', null], ['isArchived', '0']])->get();
        $roles = Role::all();
        //$groupsArray = DB::table('model_has_roles')->where('')->get();
        $groups = array();
        $groupsArray = \App\Models\Group::all();
        foreach ($groupsArray as $group) {
            foreach ($group->users as $user) {
                $groups[$group->title][] = strval($user->id);
            }
        }
        return view('business-case.create', ['users' => $users, 'folders' => $folders, 'groups' => $groups]);
    }

    public function store(Request $request) {
        if (!\Gate::check('Операции-с-делами'))
            abort(403);

        $this->validate($request, [
            'title' => 'required|regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,()№\/\\-:;\'"— ]+$/u',
            'image' => 'nullable|regex:/^data:image\/([a-zA-Z]*);base64,([^\"]*)/',
            'folder' => 'required|integer',
            'users' => 'required|regex:/^[1-9][0-9]*(,[1-9][0-9]*)*$/'
        ],[
            'title.required' => 'Название дела - необходимое поле.',
            'title.regex' => 'Название дела может содержать только буквы, цифры, пробелы и специальные знаки (_ ( ) . , № \ / : ; \' " —).',
            'image.regex' => 'Разрешенные форматы изображения: jpg, jpeg, png, bmp, gif, svg, webp.',
            'folder.required' => 'Формат формы нарушен!',
            'folder.integer'=> 'Формат формы нарушен!',
            'users.required' => 'Невозможно содзать дело без участников.',
            'users.regex' => 'Принимаются только значения, предусмотренные формой по умолчанию.'
        ]);

        $folder = null;
        if ($request->folder != '0') {
            $folder = Folder::where([['id', $request->folder], ['isArchived', '0'], ['business_case_id', null]])->first();
            if (!$folder)
                return redirect()->back()->with('errors', 'Папка не найдена, архивирована или уже занята!');
        }

        // Processing an image
        $imageDBPath = 'uploads/avatar/businessCase.png';
        if ($request->image != '') {
            $folderPath = public_path('uploads/businessCaseImages/');
            $image_parts = explode(";base64,", $request->image);
            $image_base64 = base64_decode($image_parts[1]);
            $imageName = uniqid() . '.png';
            $imageFullPath = $folderPath.$imageName;
            $imageDBPath = 'uploads/businessCaseImages/' . $imageName;
        }

        $users = explode(',', $request->users);

        $businessCase = BusinessCase::create([
            'title' => $request->title,
            'image' => $imageDBPath,
            'slug' => $this->newSlug(),
            'isArchived' => '0'
        ]);
        foreach ($users as $user) {
            $businessCase->users()->attach($user, ['is_guest' => 0]);
        }
        $businessCase->save();

        if ($folder) {
            $folder->business_case()->associate($businessCase->id);
            $folder->save();
        }

        return redirect()->to('/cases')->with('success', 'Дело успешно создано!');
    }

    public function edit($slug) {
        if (!\Gate::check('Операции-с-делами'))
            abort(403);

        $users = User::all();
        $businessCase = BusinessCase::with('users')->where('slug', '=', $slug)->first();
        if (!$businessCase) abort(404);
        $userIDs = Array();
        foreach ($businessCase->users as $user) array_push($userIDs, $user->id);
        $userIDs =  implode(', ', $userIDs);
        $folders = Folder::where([['business_case_id', null], ['isArchived', '0']])->orWhere('business_case_id', $businessCase->id)->get();
        $folder = Folder::where('business_case_id', $businessCase->id)->first();
        return view('business-case.edit', [
            'users' => $users,
            'businessCase' => $businessCase,
            'userIDs' => $userIDs,
            'folders' => $folders,
            'folder' => $folder
        ]);
    }

    public function update(Request $request, $slug) {
        if (!\Gate::check('Операции-с-делами'))
            abort(403);

        $businessCase = BusinessCase::with('users')->with('dialogs')->where('slug', '=', $slug)->first();
        if (!$businessCase) abort(404);

        $this->validate($request, [
            'title' => 'required|regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,()№\/\\-:;\'"— ]+$/u',
            'image' => 'nullable|regex:/^data:image\/([a-zA-Z]*);base64,([^\"]*)/',
            'folder' => 'required|integer',
            'users' => 'required|regex:/^[1-9][0-9]*(,[1-9][0-9]*)*$/',
            'image_changed' => 'regex:/^[01]$/',
        ],[
            'title.required' => 'Название дела - необходимое поле.',
            'title.regex' => 'Название дела может содержать только буквы, цифры, пробелы и специальные знаки (_ ( ) . , № \ / : ; \' " —).',
            'image.regex' => 'Разрешенные форматы изображения: jpg, jpeg, png, bmp, gif, svg, webp.',
            'folder.required'=> 'Формат формы нарушен.',
            'folder.integer'=> 'Формат формы нарушен.',
            'users.required' => 'Невозможно содзать дело без участников.',
            'users.regex' => 'Принимаются только значения, предусмотренные формой по умолчанию.',
            "image-changed" => 'Принимаются только значения, предусмотренные формой по умолчанию.',
        ]);

        if ($request->folder != '0') {
            $folder = Folder::where([['id', $request->folder], ['isArchived', 0], ['business_case_id', null]])
                ->orWhere([['id', $request->folder], ['isArchived', 0], ['business_case_id', $businessCase->id]])
                ->first();
                
            if (!$folder || ($folder->business_case && ($folder->business_case->id != $businessCase->id)))
                return redirect()->back()->with('errors', 'Папка не найдена, архивирована или уже занята!');
            else {
                $folder->business_case()->associate($businessCase);
                $folder->save();
            }
        } else {
            $folder = Folder::where('business_case_id', $businessCase->id)->first();
            if ($folder) {
                $folder->business_case()->dissociate();
                $folder->save();
            }
        }

        // Processing an image
        if ($request->image_changed == 1) {
            $imageDBPath = 'uploads/avatar/businessCase.png';
            if ($request->image != '') {
                $folderPath = public_path('uploads/businessCaseImages/');
                $image_parts = explode(";base64,", $request->image);
                $image_base64 = base64_decode($image_parts[1]);
                $imageName = uniqid() . '.png';
                $imageFullPath = $folderPath.$imageName;
                file_put_contents($imageFullPath, $image_base64);
                $imageDBPath = 'uploads/businessCaseImages/' . $imageName;
            }
        } else {
            $imageDBPath = $businessCase->image;
        }

        $users = explode(',', $request->users);

        // Update business case info
        $businessCase->title = $request->title;
        $businessCase->image = $imageDBPath;
        $businessCase->users()->sync($users);
        foreach ($users as $user) {
            $businessCase->guests()->detach($user);
        }
        $guestUsers = BusinessCaseTrait::countDialogGuests($businessCase);
        foreach ($guestUsers as $guest) {
            $businessCase->guests()->syncWithoutDetaching([$guest => ['is_guest' => 1]]);
        }

        $businessCase->save();
        return redirect()->to('/cases')->with('success', 'Дело успешно редактировано!');
    }

    public function archive($businessCaseSlug) {
        if (!\Gate::check('Операции-с-делами'))
            abort(403);

        $businessCase = BusinessCase::where([['slug', '=', $businessCaseSlug], ['isArchived', '0']])->first();
        if (!$businessCase) abort(404);
        $businessCase->isArchived = '1';
        $businessCase->deleted_at = date_format(now(),"Y-m-d H:i:s");
        $businessCase->save();
        return redirect()->to('/cases')->with('success', 'Дело успешно архивировано');
    }

    public function newSlug() {
        $slugStr = strtolower(Str::random(6));
        $case = BusinessCase::where('slug', '=', 'case-'.$slugStr)->first();
        if ($case)
            return $this->newSlug();
        else
            return "case-".$slugStr;
    }

    public function archiveList() {
        if (!\Gate::check('Операции-с-архивом'))
            abort(403);

        $buinessCases = BusinessCase::with('users')
            ->where('isArchived', '1')
            ->orderBy('deleted_at', 'DESC')
            ->get();
        return view('business-case.archive', ['businessCases' => $buinessCases]);
    }

    public function restore($businessCaseSlug) {
        if (!\Gate::check('Операции-с-архивом'))
            abort(403);

        $businessCase = BusinessCase::where([['slug', $businessCaseSlug], ['isArchived', '1']])->first();
        if (!$businessCase) abort(404);
        $businessCase->isArchived = '0';
        $businessCase->save();
        return redirect()->back()->with('success', 'Дело успешно восстановлено!');
    }
}
