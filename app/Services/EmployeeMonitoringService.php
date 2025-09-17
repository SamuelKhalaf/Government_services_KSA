<?php

namespace App\Services;

use App\Models\User;
use App\Models\EmployeeLoginLog;
use App\Models\EmployeeActiveScreenTime;
use App\Models\EmployeeClickTracking;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EmployeeMonitoringService
{
    /**
     * Start a new screen time session for an employee
     */
    public function startScreenTimeSession(User $user): EmployeeActiveScreenTime
    {
        // Check if there's already an active session for today
        $existingSession = EmployeeActiveScreenTime::where('user_id', $user->id)
            ->where('date', today())
            ->whereNull('session_end')
            ->first();

        if ($existingSession) {
            return $existingSession;
        }

        // Create new session
        return EmployeeActiveScreenTime::create([
            'user_id' => $user->id,
            'date' => today(),
            'session_start' => now(),
            'total_seconds' => 0,
            'idle_seconds' => 0,
            'click_count' => 0,
            'keypress_count' => 0,
            'scroll_count' => 0,
        ]);
    }

    /**
     * Update screen time session with activity data
     */
    public function updateScreenTimeSession(User $user, array $activityData): void
    {
        $session = EmployeeActiveScreenTime::where('user_id', $user->id)
            ->where('date', today())
            ->whereNull('session_end')
            ->first();

        if (!$session) {
            $session = $this->startScreenTimeSession($user);
        }

        // Update session with new activity data
        $session->increment('total_seconds', $activityData['active_seconds'] ?? 0);
        $session->increment('idle_seconds', $activityData['idle_seconds'] ?? 0);
        $session->increment('click_count', $activityData['clicks'] ?? 0);
        $session->increment('keypress_count', $activityData['keypresses'] ?? 0);
        $session->increment('scroll_count', $activityData['scrolls'] ?? 0);

        // Update activity breaks if provided
        if (isset($activityData['breaks'])) {
            $breaks = $session->activity_breaks ?? [];
            $breaks[] = $activityData['breaks'];
            $session->update(['activity_breaks' => $breaks]);
        }
    }

    /**
     * End screen time session
     */
    public function endScreenTimeSession(User $user): void
    {
        $session = EmployeeActiveScreenTime::where('user_id', $user->id)
            ->where('date', today())
            ->whereNull('session_end')
            ->first();

        if ($session) {
            $session->update([
                'session_end' => now(),
            ]);
        }
    }

    /**
     * Track click activity
     */
    public function trackClick(User $user, array $clickData): void
    {
        EmployeeClickTracking::create([
            'user_id' => $user->id,
            'element_type' => $clickData['element_type'] ?? 'unknown',
            'element_id' => $clickData['element_id'] ?? null,
            'element_class' => $clickData['element_class'] ?? null,
            'element_text' => $clickData['element_text'] ?? null,
            'page_url' => $clickData['page_url'] ?? request()->fullUrl(),
            'x_position' => $clickData['x_position'] ?? null,
            'y_position' => $clickData['y_position'] ?? null,
            'clicked_at' => now(),
        ]);
    }

    /**
     * Get employee productivity metrics
     */
    public function getProductivityMetrics(User $user, int $days = 30): array
    {
        $startDate = now()->subDays($days);
        
        $screenTime = EmployeeActiveScreenTime::where('user_id', $user->id)
            ->where('date', '>=', $startDate)
            ->get();

        $totalActiveTime = $screenTime->sum('total_seconds');
        $totalIdleTime = $screenTime->sum('idle_seconds');
        $totalClicks = $screenTime->sum('click_count');
        $totalKeypresses = $screenTime->sum('keypress_count');
        $totalScrolls = $screenTime->sum('scroll_count');

        $productivityPercentage = 0;
        if (($totalActiveTime + $totalIdleTime) > 0) {
            $productivityPercentage = ($totalActiveTime / ($totalActiveTime + $totalIdleTime)) * 100;
        }

        return [
            'total_active_hours' => round($totalActiveTime / 3600, 2),
            'total_idle_hours' => round($totalIdleTime / 3600, 2),
            'productivity_percentage' => round($productivityPercentage, 2),
            'total_clicks' => $totalClicks,
            'total_keypresses' => $totalKeypresses,
            'total_scrolls' => $totalScrolls,
            'average_clicks_per_hour' => $totalActiveTime > 0 ? round(($totalClicks / ($totalActiveTime / 3600)), 2) : 0,
            'average_keypresses_per_hour' => $totalActiveTime > 0 ? round(($totalKeypresses / ($totalActiveTime / 3600)), 2) : 0,
        ];
    }

    /**
     * Get daily activity summary
     */
    public function getDailyActivitySummary(User $user, Carbon $date): array
    {
        $screenTime = EmployeeActiveScreenTime::where('user_id', $user->id)
            ->where('date', $date)
            ->first();

        $clickCount = EmployeeClickTracking::where('user_id', $user->id)
            ->whereDate('clicked_at', $date)
            ->count();

        $loginLog = EmployeeLoginLog::where('user_id', $user->id)
            ->whereDate('login_at', $date)
            ->first();

        return [
            'date' => $date->format('Y-m-d'),
            'active_hours' => $screenTime ? round($screenTime->total_seconds / 3600, 2) : 0,
            'idle_hours' => $screenTime ? round($screenTime->idle_seconds / 3600, 2) : 0,
            'productivity_percentage' => $screenTime ? $screenTime->productivity_percentage : 0,
            'click_count' => $clickCount,
            'login_time' => $loginLog ? $loginLog->login_at->format('H:i:s') : null,
            'logout_time' => $loginLog ? $loginLog->logout_at?->format('H:i:s') : null,
            'session_duration' => $loginLog ? $loginLog->duration_minutes : null,
        ];
    }

    /**
     * Get team productivity comparison
     */
    public function getTeamProductivityComparison(int $days = 7): array
    {
        $startDate = now()->subDays($days);
        
        $employees = User::employees()->with(['activeScreenTime' => function ($query) use ($startDate) {
            $query->where('date', '>=', $startDate);
        }])->get();

        $teamData = $employees->map(function ($employee) {
            $screenTime = $employee->activeScreenTime;
            $totalActiveTime = $screenTime->sum('total_seconds');
            $totalIdleTime = $screenTime->sum('idle_seconds');
            $totalTime = $totalActiveTime + $totalIdleTime;
            
            $productivityPercentage = 0;
            if ($totalTime > 0) {
                $productivityPercentage = ($totalActiveTime / $totalTime) * 100;
            }

            return [
                'employee_id' => $employee->id,
                'employee_name' => $employee->name,
                'active_hours' => round($totalActiveTime / 3600, 2),
                'idle_hours' => round($totalIdleTime / 3600, 2),
                'productivity_percentage' => round($productivityPercentage, 2),
                'total_clicks' => $screenTime->sum('click_count'),
                'total_keypresses' => $screenTime->sum('keypress_count'),
            ];
        })->sortByDesc('productivity_percentage');

        return [
            'team_average_productivity' => $teamData->avg('productivity_percentage'),
            'most_productive' => $teamData->first(),
            'least_productive' => $teamData->last(),
            'employees' => $teamData->values(),
        ];
    }

    /**
     * Get activity trends over time
     */
    public function getActivityTrends(int $days = 30): array
    {
        $startDate = now()->subDays($days);
        
        $trends = EmployeeActiveScreenTime::select(
            'date',
            DB::raw('AVG(total_seconds) as avg_active_seconds'),
            DB::raw('AVG(idle_seconds) as avg_idle_seconds'),
            DB::raw('AVG(click_count) as avg_clicks'),
            DB::raw('COUNT(DISTINCT user_id) as active_employees')
        )
        ->where('date', '>=', $startDate)
        ->groupBy('date')
        ->orderBy('date')
        ->get()
        ->map(function ($trend) {
            $totalTime = $trend->avg_active_seconds + $trend->avg_idle_seconds;
            $productivityPercentage = 0;
            if ($totalTime > 0) {
                $productivityPercentage = ($trend->avg_active_seconds / $totalTime) * 100;
            }

            return [
                'date' => $trend->date->format('Y-m-d'),
                'avg_active_hours' => round($trend->avg_active_seconds / 3600, 2),
                'avg_idle_hours' => round($trend->avg_idle_seconds / 3600, 2),
                'avg_productivity_percentage' => round($productivityPercentage, 2),
                'avg_clicks' => round($trend->avg_clicks, 2),
                'active_employees' => $trend->active_employees,
            ];
        });

        return $trends->toArray();
    }
}
