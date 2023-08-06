<?php

namespace App\Helpers;

use App\Mail\RequestNewQuantity;
use App\Models\Item;
use App\Models\Vendor;
use Illuminate\Support\Facades\Mail;

class VendorEmailHelper
{

    public function __construct()
    {

    }

    public function send($vendor_email, $item_name, $body)
    {
        if ($vendor_email) {
            $vendor = Vendor::where('email', '=', $vendor_email)->first();
            if ($vendor) {
                $this->sendMessage($vendor, $body);
            }
        }
        if ($item_name) {
            $vendors = $this->getVendors($item_name);
            if ($vendors) {
                foreach ($vendors as $vendor) {
                    $this->sendMessage($vendor, $body);
                }
            }
        }
    }

    protected function getVendors($item_name)
    {
        $item = Item::where('name', '=', $item_name)->first();
        if ($item) {
            $vendors = $item->vendors;
        }
        return $vendors ?? '';
    }

    protected function sendMessage($vendor, $body)
    {
        $vendor_name = 'Dear' . ' ' . $vendor->first_name . ' ' . $vendor->last_name;
        $message = (new RequestNewQuantity($vendor_name, $body))->onQueue('emails');
        Mail::to($vendor->email)->queue($message);
    }
}
