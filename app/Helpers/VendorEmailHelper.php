<?php

namespace App\Helpers;

use App\Mail\RequestNewQuantity;
use App\Models\Vendor;
use Illuminate\Support\Facades\Mail;

class VendorEmailHelper
{

    public function __construct()
    {

    }

    public function send($vendor_email, $body)
    {
        if ($vendor_email) {
            $vendor = Vendor::where('email', '=', $vendor_email)->first();
            if ($vendor) {
                $vendor_name = 'Dear' . ' ' . $vendor->first_name . ' ' . $vendor->last_name;
                $message = (new RequestNewQuantity($vendor_name, $body))->onQueue('emails');
                Mail::to($vendor_email)->queue($message);
            }
        } else {
            $vendors = Vendor::all();
            foreach ($vendors as $vendor) {
                $vendor_name = 'Dear' . ' ' . $vendor->first_name . ' ' . $vendor->last_name;
                $message = (new RequestNewQuantity($vendor_name, $body))->onQueue('emails');
                Mail::to($vendor->email)->queue($message);
            }
        }


    }
}
