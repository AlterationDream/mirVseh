<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use Str;
use \App\Models\Group;

class GroupController extends Controller
{
    public function index() {
        $groups = Group::all();
        return view('group.index', ['groups' => $groups]);
    }

    public function create() {
        $users = User::all();
        return view('group.create', ['users' => $users]);
    }

    public function edit($id) {
        $group = Group::find($id);
        if (!$group) abort(404);
        $users = User::all();

        return view('group.edit', ['group' => $group ,'users' => $users]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'title' => 'required|regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,()№\/\\-:;\'"— !@#$%^&*]+$/u',
            'users' => ['required', 'regex:/^[1-9][0-9]*(,[1-9][0-9]*)*$/'],
        ], [
            'title.required' => 'Название группы - необходимое поле.',
            'title.regex' => 'Название группы может содержать только буквы, цифры, пробелы и специальные знаки (_ ( ) . , № \ / : ; \' " — ! @ # $ % ^ & *).',
            'users.regex' => 'Принимаются только значения, предусмотренные формой по умолчанию.',
            'users.required' => 'Группа должна включать хотя бы одного пользователя.',
        ]);

        $usersArray = explode(',', $request->users);
        foreach ($usersArray as $user) {
            $checkUser = User::find($user);
            if (!$checkUser) return redirect()->back()->with('errors', 'Некоторые пользователи не были найдены! Пожалуйста, попробуйте снова.');
        }

        $group = Group::create([
            'title' => trim($request->title),
        ]);

        $group->users()->sync($usersArray);
        $group->save();

        return redirect()->back()->with('success', 'Группа успешно создана!');
    }

    /*
    public function show($id) {
        $group = Group::find($id);
        $users = User::all();
        return view('group.show', ['group' => $group, 'users' => $users]);
    }*/

    public function update(Request $request, $id) {
        $group = Group::find($id);
        if (!$group) abort(404);

        $this->validate($request, [
            'title' => 'required|regex:/^[A-Za-zа-яёА-ЯЁ0-9_.,()№\/\\-:;\'"— !@#$%^&*]+$/u',
            'users' => ['required', 'regex:/^[1-9][0-9]*(,[1-9][0-9]*)*$/'],
        ], [
            'title.required' => 'Название группы - необходимое поле.',
            'title.regex' => 'Название группы может содержать только буквы, цифры, пробелы и специальные знаки (_ ( ) . , № \ / : ; \' " — ! @ # $ % ^ & *).',
            'users.regex' => 'Принимаются только значения, предусмотренные формой по умолчанию.',
            'users.required' => 'Группа должна включать хотя бы одного пользователя.',
        ]);

        $usersArray = explode(',', $request->users);
        foreach ($usersArray as $user) {
            $checkUser = User::find($user);
            if (!$checkUser) return redirect()->back()->with('errors', 'Некоторые пользователи не были найдены! Пожалуйста, попробуйте снова.');
        }

        $group->title = trim($request->title);
        $group->users()->sync($usersArray);
        $group->save();

        return redirect()->back()->with('success', 'Группа успешно редактирована!');
    }

    public function remove($id) {
        $group = Group::find($id);
        if (!$group) abort(404);

        $group->delete();
        return redirect()->back()->with('success', 'Группа успешно удалена!');
    }
}
