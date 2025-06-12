<?php


use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Schedule::command('app:delete-expired-emails')
    ->dailyAt('00:00')
    ->timezone('Asia/Ho_Chi_Minh')
    ->before(function () {
        Log::channel('crons')->info('Delete expired emails Scheduler is running at: ' . now());
    })
    ->after(function () {

        Log::channel('crons')->info('Delete expired emails Scheduler finisheded at: ' . now());
    });

Schedule::command('app:delete-expired-otps')
    ->dailyAt('00:00')
    ->timezone('Asia/Ho_Chi_Minh')
    ->before(function () {
        Log::channel('crons')->info('Delete expired otps Scheduler is running at: ' . now());
    })
    ->after(function () {

        Log::channel('crons')->info('Delete expired otps Scheduler finisheded at: ' . now());
    });
