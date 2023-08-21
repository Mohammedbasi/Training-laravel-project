<?php

namespace App\Helpers;

use App\Contracts\EmailServiceContract;
use App\Mail\VendorWelcomeEmail;
use Illuminate\Support\Facades\Mail;

class EmailService implements EmailServiceContract
{
    public function sendEmail($vendor)
    {
        Mail::to($vendor->email)->send(new VendorWelcomeEmail($vendor));
    }
}
