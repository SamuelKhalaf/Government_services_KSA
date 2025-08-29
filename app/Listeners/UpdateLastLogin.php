<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateLastLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        // Update the user's last login timestamp
        if ($event->user) {
            $event->user->updateLastLogin();
            // Log for debugging (remove in production)
            \Log::info('User last login updated: ' . $event->user->email);
        }
    }
}
