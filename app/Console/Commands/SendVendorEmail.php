<?php

namespace App\Console\Commands;

use App\Helpers\VendorEmailHelper;
use App\Mail\RequestNewQuantity;
use App\Models\Vendor;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendVendorEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:vendor {--email= : vendorEmail} {--body= : The email body}';
//    {--subject= : The email subject}
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to a specific vendor to request a new quantity';

    /**
     * Execute the console command.
     */
    public function handle(VendorEmailHelper $emailHelper)
    {
        $vendor_email = $this->option('email');
        $body = $this->option('body');
        $emailHelper->send($vendor_email,$body);
        $this->info("Email sent to $vendor_email successfully!");
    }
}
