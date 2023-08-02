<?php

namespace App\Listeners;

use App\Events\UserLoggedIn;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class LogUserLogin implements ShouldQueue
{
    public $queue = 'listeners';
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserLoggedIn $event): void
    {
        DB::table('login_history')
            ->insert([
                'name'=>$event->name,
                'email'=>$event->email,
                'created_at'=>$event->created_at
            ]);
    }
}
