<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Jadwal Pembersihan Otomatis Data OTP Kedaluwarsa Setiap 15 Menit
Schedule::command('otp:clean')->everyFifteenMinutes();

