<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use UserModule\App\Http\Requests\UserRequest;
use UserModule\App\Models\User;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(UserRequest $request): RedirectResponse
    {
        $password = Hash::make($request->post('password'));
        $request->merge([
            'password' => $password,
        ]);
        $user = User::create($request->all())->save();

        event(new Registered($user));

//        Auth::login($user);

        return redirect()->route('login');
    }
}
