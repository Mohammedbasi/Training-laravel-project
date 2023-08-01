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
        DB::table('user_auth_logs')
            ->insert([
                'user_id'=>$event->user_id,
                'logged_at'=>$event->logged_at,
            ]);
    }
}
