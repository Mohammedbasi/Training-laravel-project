<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ExportUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // define the name of the log file
        $logFile = storage_path('logs/database.log');

        // open the file to append data
        $openedFile = fopen($logFile, 'a');

        // get the users
        $users = DB::table('users')
            ->select('id', 'name', 'email')
            ->orderBy('id')
            ->chunk(50, function ($records) use ($openedFile) {
                foreach ($records as $record) {
                    $logData = "Id: $record->id, Name: $record->name, Email: $record->email";
                    // PHP_EOL for new line (\n)
                    fwrite($openedFile, $logData . PHP_EOL);
                }
            });
        fclose($openedFile);
        // store the users in a log file
         Log::channel('database')->info('Exporting Users Completed Successfully');
    }
}
