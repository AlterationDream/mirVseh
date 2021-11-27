<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use UxWeb\SweetAlert\SweetAlert;
use Auth;

class RoleController extends Controller
{
    private $role;

    public function __construct()
    {
        if (setting('email_verification')) {
            $this->middleware(['verified']);
        }
        $this->middleware(['permission:Операции-с-ролями-и-разрешениями','web','auth','2fa']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('roles.index')->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $this->validate($request, [
            'name' => 'required|min:4|max:20|regex:/^[A-Za-zа-яёА-ЯЁ0-9\- _\.]+$/u',
        ],[
          'regex' => 'Название может состоять только из букв, подчёркиваний, дефисов и цифр',
        ]);
        
        if (Role::where('name', $request->name)->first()) {
            alert()->error('Роль с таким названием уже существует!')->persistent('Закрыть');
            return redirect()->back();
        }

        try {
            $this->role =  Role::create([
                'name' => str_replace(' ', '-', $request->name)
            ]);

            $this->role->save();
        } catch (\Illuminate\Database\QueryException $e) {
            \Log::info(print_r($e->errorInfo,true));
            \Log::info(str_replace(' ', '-', $request->name));
        }


        // Logging activity for created role
        activity()
                ->performedOn($this->role)
                ->withProperties(['name'=>$this->role->name,'by'=>Auth::user()->username])
                ->causedBy(Auth::user())
                ->log('Роль была создана');

        return redirect()->back()->with('success', 'Роль успешно создана');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $permissions = $role->permissions()->get();
        $allpermissions = Permission::all();
        return view('roles.show')
                    ->with('role', $role)
                    ->with('permissions', $permissions)
                    ->with('allpermissions', $allpermissions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        return view('roles.edit')->with('role', $role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $this->role = Role::find($id);

        $this->validate($request, [
            'name' => 'required|regex:/^[A-Za-zа-яёА-ЯЁ0-9\-_\.]+$/u|min:3|max:20|unique:roles,name,'.$this->role->id
        ],[
          'regex' => 'Название может состоять только из букв, подчёркиваний, дефисов и цифр',
        ]);
        
        if (Role::where('name', $request->name)->first()) {
            alert()->error('Роль с таким названием уже существует!')->persistent('Закрыть');
            return redirect()->back();
        }

        $this->role->name = str_replace(' ', '-', $request->name);
        $this->role->save();

        // Logging activity for created role
        activity()
                ->performedOn($this->role)
                ->withProperties(['name'=>$this->role->name,'by'=>Auth::user()->username])
                ->causedBy(Auth::user())
                ->log('Роль была обновлена');

        return redirect()->back()->with('success', 'Роль успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $this->role = Role::find($id);

        //Default role cannot be deleted
        if (!$this->role->removable) {
            alert()->error('Эта роль не может быть удалена')->persistent('Закрыть');
            return redirect()->back();
        }
        
        $pivotTable = \DB::table('model_has_roles')->where('role_id', $this->role->id)->get();
        $movedUsers = array();
        foreach ($pivotTable as $row) {
            $roleUser = \App\User::where('id', $row->model_id)->first();
            $movedUsers[] = $roleUser->fullname;
            $roleUser->removeRole($this->role->name);
            $roleUser->assignRole('Пользователь');
        }

        // Logging activity for created role
        activity()
                    ->performedOn($this->role)
                    ->withProperties(['name'=>$this->role->name,'by'=>Auth::user()->username])
                    ->causedBy(Auth::user())
                    ->log('Роль была удалена');

        $this->role->delete();
        return redirect()->back()->with('success', 'Роль успешно удалена! Аккаунтам ' . implode(', ', $movedUsers) . ' была присвоена роль Пользователь.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function assignPermission(Request $request, $id)
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $role = Role::find($id);
        $permissions = $role->permissions()->get();
        $role->revokePermissionTo($permissions);

        // Logging activity for created role
        activity()
                    ->performedOn($role)
                    ->withProperties(['name'=>$role->name,'by'=>Auth::user()->username])
                    ->causedBy(Auth::user())
                    ->log('Разрешение было присвоено роли');

        $role->givePermissionTo($request->permissions);
        return redirect()->back()->with('success', 'Разрешение успешно присвоено роли');
    }
}
