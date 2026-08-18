<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CleanExpiredOtp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'otp:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Membersihkan data OTP Lupa Password Admin yang sudah kedaluwarsa dari database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        $deleted = DB::table('admin_password_otps')
            ->where('expires_at', '<', $now)
            ->delete();

        $this->info("Berhasil membersihkan {$deleted} data OTP yang sudah kedaluwarsa (sebelum {$now->toDateTimeString()}).");

        return Command::SUCCESS;
    }
}
