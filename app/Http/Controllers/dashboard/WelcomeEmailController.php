<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class WelcomeEmailController extends Controller
{
    public function create()
    {
        return view('dashboard.welcome');
    }

    public function send(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);
        $user = User::where('email', '=', $request->email)->first();
        if (!$user) {
            return redirect()
                ->route('welcome.create')
                ->with('info', 'The email is in-valid');
        }
        sentWelcomeMessage($user);
        return redirect()->route('welcome.create')
            ->with('success', 'Welcome message sent successfully');
    }
}
