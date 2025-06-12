<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Otp;

class DeleteExpiredOtps extends Command
{
    protected $signature = 'app:delete-expired-otps';

    protected $description = 'Delete expired OTP records from database';

    public function handle()
    {
        $deleted = Otp::where('expires_at', '<', now())->delete();
        $this->info("Deleted {$deleted} expired OTP records.");
    }
}
