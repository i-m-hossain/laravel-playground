<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendEmailsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send {name} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends emails to the specified user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Logic to send emails would go here.
        // For now, we will just simulate sending an email.
        $name = $this->argument('name');
        $force = $this->option('force');

        if ($force) {
            echo "Forcing email to be sent to {$name}.\n";
        } else {
            echo "Sending email to {$name}.\n";
        }

        // Simulate success
        return 0; // Return 0 for success
    }
}
