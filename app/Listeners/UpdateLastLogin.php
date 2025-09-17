<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\EmployeeLoginLog;

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
            
            // Track employee login if user is an employee
            if ($event->user->isEmployee()) {
                EmployeeLoginLog::create([
                    'user_id' => $event->user->id,
                    'login_at' => now(),
                    'ip_address' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                    'session_id' => session()->getId(),
                    'status' => 'active',
                ]);
            }
            
            // Log for debugging (remove in production)
            \Log::info('User last login updated: ' . $event->user->email);
        }
    }
}
