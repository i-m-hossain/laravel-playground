<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class Heartbeat implements ShouldQueue
{
    use Queueable;

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
        // Logic for the heartbeat job can be added here.
        // For now, we will just simulate a heartbeat.
        echo "Heartbeat job executed successfully.\n";
    }
}
