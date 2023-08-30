<?php

namespace UserModule\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use UserModule\App\Models\User;

class SocialiteController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function callback()
    {
        $githubUser = Socialite::driver('github')->user();

        $user = User::updateOrCreate([
            'username' => $githubUser->getNickname(),
            'first_name' => $githubUser->getName(),
            'last_name' => $githubUser->getName(),
            'email' => $githubUser->getEmail(),
        ]);
        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
