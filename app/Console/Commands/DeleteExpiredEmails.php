<?php

namespace App\Console\Commands;

use App\Models\TemporaryEmail;
use Illuminate\Console\Command;

class DeleteExpiredEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-expired-emails';

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
        $deleted = TemporaryEmail::where('expires_at', '<=', now())->delete();

        $this->info("Deleted {$deleted} expired emails.");
    }
}
