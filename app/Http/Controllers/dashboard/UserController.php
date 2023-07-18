<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $request = request();
        $users = User::with('address')->filter($request->query())->paginate(10);
        return view('dashboard.users.index', compact('users'));
    }

    public function create()
    {
        return view('dashboard.users.create');
    }

    public function store(UserRequest $request)
    {

        $password = Hash::make($request->post('password'));
        $request->merge([
            'password' => $password,
        ]);
        $user = User::create($request->all())->save();
        return redirect()->route('user.index')->with('success', 'User Created');
    }

    public function edit(string $id)
    {
        try {
            $user = User::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->route('user.index')->with('info', 'Page not found . . .');
        }
        return view('dashboard.users.edit', compact('user'));
    }

    public function update(UserEditRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('user.index')->with('success', 'User Updated . . .');
    }

    public function delete(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User Deleted . . .');
    }

    public function trash()
    {
        $users = User::onlyTrashed()->paginate(10);
        return view('dashboard.users.softDelete', compact('users'));
    }

    public function restore(string $id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->route('user.trash')->with('success', 'User restored!');
    }

    public function forceDelete(string $id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();
        return redirect()->route('user.trash')->with('success', 'User deleted forever!');
    }
}
