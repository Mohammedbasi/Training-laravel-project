<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(UserRequest $request)
    {

        $password = Hash::make($request->post('password'));
        $request->merge([
            'password' => $password,
        ]);
        $user = User::create($request->all())->save();
        return redirect()->route('index')->with('success', 'User Created');
    }

    public function edit(string $id)
    {
        try {
            $user = User::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->route('index')->with('info', 'Page not found . . .');
        }
        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('index')->with('success', 'User Updated . . .');
    }

    public function delete(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('index')->with('success', 'User Deleted . . .');
    }

    public function trash()
    {
        $users = User::onlyTrashed()->paginate(10);
        return view('users.softDelete', compact('users'));
    }

    public function restore(string $id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->route('trash')->with('success', 'User restored!');
    }

    public function forceDelete(string $id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();
        return redirect()->route('trash')->with('success', 'User deleted forever!');
    }
}
