<?php

namespace App\Http\Controllers;

use \App\Models\Connection;
use Illuminate\Http\Request;
use \App\Http\Traits\ConnectionVerificationTrait as ConnectionTrait;
use \App\User;
use Str;
use Illuminate\Support\Facades\Storage;

class ConnectionController extends Controller
{
    public function hub() {
        return view('connection.index');
    }

    public function index($type) {
        if ($type != 'prospector' & $type != 'customer' & $type != 'programmer')
            abort(404);

        $connections = Connection::where('type', $type)->get();
        return view('connection.index-' . $type, [
            'connections' => $connections
        ]);
    }

    public function show($id) {
        $connection = Connection::find($id);
        if (!$connection) abort(404);
        return view('connection.show', [
            'connection' => $connection,
        ]);
    }

    public function create($type) {
        if ($type != 'prospector' & $type != 'customer' & $type != 'programmer')
            abort(404);

        return view('connection.create', [
            'type' => $type
        ]);
    }

    public function store($type, Request $request) {
        if ($type != 'prospector' & $type != 'customer' & $type != 'programmer')
            abort(404);

        $typeRus = '';
        if ($type == 'prospector')
            $typeRus = 'Изыскатель';
        elseif ($type == 'customer')
            $typeRus = 'Клиент';
        else
            $typeRus = 'Программист';

        ConnectionTrait::verify($type, $request, $this);

        $path = '';
        if ($request->file('doc') != '') {
            $file = $request->file('doc');
            $fileName = 'connection-doc-'.time().'.'.$file->getClientOriginalExtension();
            $path = '/' . $file->storeAs('docs', $fileName, 'userUploads');
        }

        Connection::create([
            'type' => $type,
            'fullname' => $request->fullname,
            'email' => $request->email,
            'phone' => $request->phone,
            'experience' => $request->experience,
            'age' => $request->age,
            'contract_date' => $request->contract_date,
            'price' => $request->price,
            'region' => $request->region,
            'address' => $request->address,
            'position' => $request->position,
            'description' => $request->description,
            'doc' => $path,
        ]);
        return redirect()->to('/connections/' . $type .'/create')->with('success', $typeRus . ' успешно вснесён в базу данных!');
    }

    public function edit($type, $id) {
        $connection = Connection::where([['id', $id], ['type', $type]])->first();
        if (!$connection) abort(404);

        return view('connection.edit', [
            'connection' => $connection,
            'type' => $type
        ]);
    }

    public function update($type, $id, Request $request) {
        if ($type != 'prospector' & $type != 'customer' & $type != 'programmer')
            abort(404);
        $connection = Connection::find($id);
        if (!$connection) abort(404);

        $typeRus = '';
        if ($type == 'prospector')
            $typeRus = 'Изыскатель';
        elseif ($type == 'customer')
            $typeRus = 'Клиент';
        else
            $typeRus = 'Программист';

        ConnectionTrait::verify($type, $request, $this);

        $connection->type = $type;
        $connection->fullname = $request->fullname;
        $connection->email = $request->email;
        $connection->phone = $request->phone;
        $connection->experience = $request->experience;
        $connection->age = $request->age;
        $connection->contract_date = $request->contract_date;
        $connection->price = $request->price;
        $connection->region = $request->region;
        $connection->address = $request->address;
        $connection->position = $request->position;
        $connection->description = $request->description;

        $path = '';
        if ($request->file('doc') != '' && $request->changedoc == '1') {
            $file = $request->file('doc');
            $fileName = 'connection-doc-'.str_replace('.', '_', microtime(true)).'.'.$file->getClientOriginalExtension();
            $path = '/' . $file->storeAs('docs', $fileName, 'userUploads');
            if ($connection->doc != '') Storage::disk('userUploads')->delete($connection->doc);
            $connection->doc = $path;
        } elseif ($request->changedoc == '1' && $request->file('doc') == '') {
            if ($connection->doc != '') Storage::disk('userUploads')->delete($connection->doc);
            $connection->doc = '';
        }

        $connection->save();

        return redirect()->to('/connections/' . $type)->with('success', $typeRus . ' успешно изменён!');
    }

    public function remove($type, $id) {
        if ($type != 'prospector' & $type != 'customer' & $type != 'programmer')
            abort(404);
        $connection = Connection::where([['id', $id], ['type', $type]])->first();
        if (!$connection) abort(404);

        if ($connection->doc != '')
            Storage::disk('userUploads')->delete($connection->doc);

        $connection->delete();
        return redirect()->to('/connections/'. $type)->with('success', 'Запись успешно удалена!');
    }
}
