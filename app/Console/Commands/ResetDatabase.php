<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ResetDatabase extends Command
{
    protected $signature = 'app:reset-database';

    protected $description = 'Resets the database';

    public function handle()
    {
        $this->call('migrate:fresh', ['--seed' => true, '--force' => true]);

        $this->info('Database refreshed successfully.');

        return 0;
    }
}
