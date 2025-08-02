<?php
namespace App\Services;

use App\RemoteModel\MobileAppUser;
use App\RemoteModel\MobileAppActivity;
use Illuminate\Support\Facades\Log;
use DateTime;
use DateInterval;

class UserActivityStatsService
{
    public function calculateUserStats(array $user): array
    {
        Log::info($user["activities"]);
        
        $activities = $user["activities"] ?? [];
        
        // Get current date and time
        $now = new DateTime();
        
        // Calculate time boundaries
        $last24Hours = clone $now;
        $last24Hours->sub(new DateInterval('P1D')); // 1 day ago
        
        $lastWeek = clone $now;
        $lastWeek->sub(new DateInterval('P7D')); // 7 days ago
        
        $lastMonth = clone $now;
        $lastMonth->sub(new DateInterval('P30D')); // 30 days ago
        
        // Initialize counters
        $allTimeActivity = 0;
        $lastMonthActivity = 0;
        $lastWeekActivity = 0;
        $last24hActivity = 0;
        
        // Process each activity
        foreach ($activities as $activity) {
            // Count all activities
            $allTimeActivity++;
            
            // Create DateTime object for this activity
            $activityDateTime = DateTime::createFromFormat('Y-m-d H', $activity['date'] . ' ' . $activity['hour']);
            
            // Skip if invalid date format
            if (!$activityDateTime) {
                continue;
            }
            
            // Check if activity falls within last month
            if ($activityDateTime >= $lastMonth) {
                $lastMonthActivity++;
            }
            
            // Check if activity falls within last week
            if ($activityDateTime >= $lastWeek) {
                $lastWeekActivity++;
            }
            
            // Check if activity falls within last 24 hours
            if ($activityDateTime >= $last24Hours) {
                $last24hActivity++;
            }
        }
        
        $activityStats = [
            'allTimeActivity' => $allTimeActivity,
            'lastMonthActivity' => $lastMonthActivity,
            'lastWeekActivity' => $lastWeekActivity,
            'last24hActivity' => $last24hActivity,
        ];
        
        return $activityStats;
    }
}