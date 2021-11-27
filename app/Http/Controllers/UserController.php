<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use URL;
use UxWeb\SweetAlert\SweetAlert;
use PragmaRX\Countries\Package\Countries;

class UserController extends Controller
{
    protected $user;
    protected $role;
    protected $countries;
    protected $activity;

    public function __construct(User $user, Role $role, Countries $country, Activity $activity)
    {
        $this->user = $user;
        $this->role = $role;
        $this->countries = $country->all()->sortBy('name.common')->pluck('name.common');
        $this->activity = $activity;
    }

    /**
     * View all users
     * @return Model User model
     */
    public function index()
    {
        if (!\Gate::check('Просмотр-пользователей'))
            abort(403);

        $users = User::all();
        //$users = $this->fetchUsers(15, request()->input('search'));

        return view("users.admin.index", ['users'=>$users]);
    }

    /**
     * Create user form
     * @return string
     */
    public function create()
    {
        if (!\Gate::check('Операции-с-пользователями'))
            abort(403);

        $roles = $this->role->all();
        $counties = $this->countries;
        return view("users.admin.create", [
              'roles' => $roles,
              'countries' => $counties,
            ]);
    }

    /**
     * Save user details
     * @param  Request $request
     * @return string
     */
    public function store(Request $request)
    {
        if (!\Gate::check('Операции-с-пользователями'))
            abort(403);

        $this->validate($request, [
                'fullname' => 'required|regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,() ]+$/u|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'username' => 'nullable|string|max:50|unique:users|regex:([a-zA-Z0-9_@]+)|',
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required|string|min:8|same:password',
                'birthday' => 'nullable|date|date_format:Y-m-d',
                'phone' => ['nullable','regex:/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/'],
                'address' => ['nullable','regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,() ]+$/u','max:255'],
                'country' => 'nullable|string|max:255',
            ],[
              'fullname.regex' => 'Имя содержит недопустимые символы.',
              'address.regex' => 'Адрес содержит недопустимые символы.',
              'phone.regex' => 'Телефон не соответствует формату.'
            ]);
            
            $username = $request->username;
            if ($username == '') {
                $username = explode('@', $request->email)[0];
            } 

        $user = $this->user->create([
                'fullname' => $request->fullname,
                'username' => $username,
                'email' => $request->email,
                'password'=> bcrypt($request->password),
                'birthday'=> $request->birthday,
                'phone'=> $request->phone,
                'address' =>$request->address,
                'country' =>$request->country,
                'avatar' => "/uploads/avatar/avatar.png",
            ]);

        if ($user) {
            $user->assignRole($request->role);
            // Logging activity for created role
            activity()->performedOn($user)->withProperties(['name'=>($username)?$username:$request->email,'by'=>Auth::user()->username])->causedBy(Auth::user())->log('Пользователь был создан.');
            return redirect()->back()->with('success', 'Пользователь успешно создан');
        } else {
            return redirect()->back()->with('error', 'Произошла ошибка! Пожалуйста, проверьте форму');
        }
    }

    /**
     * Edit user
     * @param  string $id User id
     * @return string
     */
    public function edit($id)
    {
        if (!\Gate::check('Операции-с-пользователями'))
            abort(403);

        $user = $this->user->find($id);
        $roles = $this->role->all();
        $user_role = $user->roles->first();
        $activities = $this->activity->whereCauserId($id)->orderByDesc('created_at')->take(10)->get();
        return view('users.admin.edit', [
              'user' => $user,
              'roles' => $roles,
              'user_role' => $user_role,
              'countries' => $this->countries,
              'activities' => $activities,
            ]);
    }

    /**
     * Update user's details
     * @param  Request $request
     * @param  string  $id      User id
     * @return string
     */
    public function show($id) {
        if (!\Gate::check('Просмотр-пользователей'))
            abort(403);

        $user = $this->user->find($id);
        $roles = $this->role->all();
        $user_role = $user->roles->first();
        $activities = $this->activity->whereCauserId($id)->orderByDesc('created_at')->take(10)->get();
        return view('users.admin.show', [
            'user' => $user,
            'roles' => $roles,
            'user_role' => $user_role,
            'countries' => $this->countries,
            'activities' => $activities,
        ]);
    }

    public function update(Request $request, $id)
    {
        if (!\Gate::check('Операции-с-пользователями'))
            abort(403);

        $user = $this->user->find($id);
        $this->validate($request, [
                  'fullname' => 'nullable|max:255|regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,() ]+$/u',
                  'phone' => ['nullable','regex:/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/'],
                  'birthday' => 'nullable|date|date_format:Y-m-d',
                  'address' => 'nullable|regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,() ]+$/u|max:255',
                  'country' => 'nullable|string',
                  'role' => 'required|string',
                  'status' => 'required|string',
              ],[
                'fullname.regex' => 'Имя содержит недопустимые символы.',
                'address.regex' => 'Адрес содержит недопустимые символы.',
                'phone.regex' => 'Телефон не соответствует формату.'
              ]);

        // Logging activity for created role
        $user->fullname = $request->fullname;
        $user->phone= $request->phone;
        $user->birthday= $request->birthday;
        $user->country= $request->country;
        $user->address= $request->address;
        $user->status= $request->status;
        $user->save();

        // Re-assigining role
        $this->reassignRole($id, $request->role);


        activity()->performedOn($user)->withProperties(['name'=>$user->username,'by'=>Auth::user()->username])->causedBy(Auth::user())->log('Профиль пользователя обновлён.');
        return redirect()->back()->with('success', 'Пользователь успешно обновлён');
    }

    /**
     * Delete user
     * @param  string $id user id
     * @return string     [description]
     */
    public function destroy($id)
    {
        if (!\Gate::check('Операции-с-пользователями'))
            abort(403);

        $this->user = $this->user->find($id);

        if ($this->isAdmin($this->user->username)) {
            alert()->error('Аккаунт администратора не может быть удалён')->persistent('Закрыть');
            return redirect()->back();
        }
        // Logging Activity for created user
        $this->user->business_cases()->detach();
        $this->user->dialogs()->detach();
        $this->user->delete();
        activity()->performedOn($this->user)->withProperties(['name'=>$this->user->username,'by'=>Auth::user()->username])->causedBy(Auth::user())->log('Пользователь был удалён.');
        return redirect()->back()->with('success', 'Аккаунт пользователя удалён');
    }

    private function fetchUsers($pagination, $search = null)
    {
        if (!\Gate::check('Просмотр-пользователей'))
            abort(403);

        $query = $this->user->query();

        if ($search) {
            $query->where(function ($value) use ($search) {
                $value->where('fullname', 'like', "%{$search}%");
                $value->orWhere('username', 'like', "%{$search}%");
                $value->orWhere('email', 'like', "%{$search}%");
            });
        }

        $query_output = $query->orderByDesc('id')->paginate($pagination);

        if ($search) {
            $query_output->appends(['search' => $search]);
        }

        return $query_output;
    }

    /**
     * Check for user type if admin or not
     * @param  string $username User username
     * @return boolean           true|false
     */
    public function isAdmin($username)
    {
        if ($username == 'admin' || $username == 'Admin') {
            return true;
        }
        return false;
    }


    /**
     * Function remove old role and assign new role to user
     * @param  string $id       user id
     * @param  string $new_role new role to be assigned
     * @return boolean           true|false
     */
    private function reassignRole($id, $new_role)
    {
        if (!\Gate::check('Операции-с-пользователями'))
            abort(403);

        $user = $this->user->find($id);
        // Get user's previous role
        $role = $user->roles->first();

        // Remove role previously assigned to user if exist
        if ($role) {
            $user->removeRole($role->name);
        }
        // Assign new role to user
        $state = $user->assignRole($new_role);

        if ($state) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * Updating login details
     * @param  Request $request
     * @param  string  $id      user id
     * @return string
     */
    public function userLogin(Request $request, $id)
    {
        $user = $this->user->find($id);

        $this->validate($request, [
                  'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
                  'username' => 'required|string|max:50|regex:([a-zA-Z0-9_@]+)|unique:users,username,'.$user->id,
                  'password' => 'nullable|min:8|string|confirmed',
                  'password_confirmation' => 'nullable|same:password',
              ]);

        // Logging activity for created role
        activity()->performedOn($user)->withProperties(['name'=>$user->username,'by'=>Auth::user()->username])->causedBy(Auth::user())->log('Настройки аккаунта пользователя были обновлены.');
        $user->email = $request->email;
        $user->username = $request->username;
        if (!is_null($request->password)) {
            $user->password = bcrypt($request->password);
        }

        $user->save();
        return redirect()->back()->with('success', 'Пользователь успешно обновлён');
    }

    public function userActivityLog($id)
    {
        if (!\Gate::check('Просмотр-истории-активности'))
            abort(403);

        $user = $this->user->find($id);
        $activities = $this->activity->whereCauserId($id)->orderByDesc('created_at')->get();
        return view('users.admin.userLog', [
            'user' => $user,
            'activities' => $activities,
          ]);
    }
    
    //  May Delete
    
    /*public function transferDB() {
        $newUsers = \DB::table('tempusers')->get();
        foreach ($newUsers as $newUser) {
            $username = explode('@', $newUser->email);
            $user = User::create([
                'fullname' => $newUser->fio,
                'username' => $username[0],
                'email' => $newUser->email,
                'password'=> bcrypt($newUser->password),
                'phone'=> $newUser->telephone,
                'avatar' => URL::to('/')."/uploads/avatar/avatar.png",
                'created_at' => $newUser->date_reg
            ]);
            $user->assignRole('Пользователь');
            // Logging activity for created role
            activity()->performedOn($user)->withProperties(['name'=>($username[0])?$username[0]:$newUser->email,'by'=>Auth::user()->username])->causedBy(Auth::user())->log('Пользователь был перенесён.');

            if (!$user) {
                \Log::info($newUser->id);
                lkjsdfal;
            }
        }

        return redirect()->back()->with('success', 'Пользователи успешно перенесены!');
    }*/
    
    /*public function setRoles() {
        $users = User::all();
        foreach ($users as $user) {
            if (!$user->roles->first()) {
                $user->assignRole('Пользователь');
                $user->save();
            }
        }
        
        return redirect()->back()->with('success', "Успешно!");
    }*/
}
