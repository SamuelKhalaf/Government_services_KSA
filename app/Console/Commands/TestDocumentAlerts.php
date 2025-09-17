<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Console\Commands\CheckDocumentExpirationAlerts;

class TestDocumentAlerts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'documents:test-alerts {--user-id= : Test for specific user ID} {--dry-run : Show what would be sent without actually sending}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test the document expiration alert system';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Testing document expiration alert system...');

        if ($this->option('dry-run')) {
            $this->info('DRY RUN MODE - No notifications will be sent');
        }

        // Run the actual alert check command
        $this->call('documents:check-expiration-alerts');

        $this->info('Test completed!');
    }
}
