<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ExportUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:export-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $job = new \App\Jobs\ExportUsers();
        $job->onQueue('export');
        dispatch($job);
    }
}
