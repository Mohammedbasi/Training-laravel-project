<?php

namespace App\Http\Controllers\dashboard;

use App\Contracts\EmailServiceContract;
use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use UserModule\App\Models\User;

class WelcomeEmailController extends Controller
{

    public $email_service;

    public function __construct(EmailServiceContract $email_service)
    {
        $this->email_service = $email_service;
    }

    public function create()
    {
        return view('dashboard.welcome');
    }

    public function createVendor()
    {
        return view('dashboard.vendor-welcome');
    }

    public function sendUser(Request $request)
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

    public function sendVendor(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:vendors,email'],
        ]);

        $vendor = Vendor::where('email', '=', $request->email)->first();
        if (!$vendor) {
            return redirect()
                ->route('vendor.welcome.create')
                ->with('info', 'The email is in-valid');
        }
        $this->email_service->sendEmail($vendor);
        return redirect()->route('vendor.welcome.create')
            ->with('success', 'Welcome message sent successfully');
    }
}
