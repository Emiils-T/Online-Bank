<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('app:fetch-fiat')->everyFiveMinutes();
Schedule::command('app:fetch-crypto')->everyFiveMinutes();
Schedule::command('app:update-crypto-wallets')->everyFiveMinutes();
Schedule::command('app:add-coin-logo')->everyFiveMinutes();
