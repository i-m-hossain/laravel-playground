<?php


use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Foundation\Inspiring;
use App\Test;
use App\Console\Commands\SendEmailsCommand;
use App\Jobs\Heartbeat;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose(description: 'Display an inspiring quote');


Schedule::call(function () {
    echo 'hello world';
})->everyMinute()
    ->name(description: 'hello-world')
    ->withoutOverlapping();


Schedule::call(new Test)
    ->everyMinute()
    ->name('test-invocation')
    ->withoutOverlapping()
    ->onSuccess(function () {
        echo "Test class invoked successfully.\n" ;
    })
    ->onFailure(function () {
        echo "Failed to invoke Test class.\n";
    });

Schedule::command('inspire')
    ->everyFiveMinutes()
    ->name('inspire-quote')
    ->withoutOverlapping()
    ->onSuccess(function () {
        echo "Inspiring quote command executed successfully.\n";
    })
    ->onFailure(function () {
        echo "Failed to execute inspiring quote command.\n";
    });

Schedule::command('emails:send Taylor --force')->daily();
Schedule::command(SendEmailsCommand::class, ['Taylor', '--force'])->daily();

Schedule::job(new Heartbeat)->everyMinute()
    ->name('heartbeat-job')
    ->withoutOverlapping()
    ->onSuccess(function () {
        echo "Heartbeat job executed successfully.\n";
    })
    ->onFailure(function () {
        echo "Failed to execute heartbeat job.\n";
    });
