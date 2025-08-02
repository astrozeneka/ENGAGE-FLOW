<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Services\NotificationService;

class PushNotificationController extends Controller
{
    // Trigger
    public function triggerNotification(Request $request)
    {
        // Validate the request data
        /* 
            {
            "notificationTitle": "sdfsdf",
            "notificationSubtitle": "",
            "notificationContent": "fffffff",
            "deeplink": "",
            "devices": [
                {
                "ios_token": "BAC4E6E25E2CAD64F86C90B52CFACCB1626E44FE5999F5D6B90D80BCC04581F0"
                },
                {
                "ios_token": "165533A770C47F4263A93516532B801ADF55D72F36066DF062FC5481874BAEAE"
                }
            ]
            }
        */
        // For now, we hardcode everything
        $notificationTitle = $request->input('notificationTitle', 'Default Title');
        $notificationSubtitle = $request->input('notificationSubtitle', 'Default Subtitle');
        $notificationContent = $request->input('notificationContent', 'Default Content');
        $deeplink = $request->input('deeplink', null);

        // Example values for testing
        $badgeCount = 1; // Example badge count
        $sandbox = false; // Set to true for development, false for production

        // Test to send a notification to a specific device token
        $notificationSent = 0;
        $devices = $request->input('devices', []);
        if (empty($devices)) {
            return response()->json(['error' => 'No devices provided'], 400);
        }
        foreach ($devices as $device) {
            if (isset($device['ios_token'])) {
                $deviceToken = $device['ios_token'];
                try {
                    app(NotificationService::class)->sendIOSNotification(
                        $deviceToken,
                        $notificationTitle,
                        $notificationSubtitle,
                        $notificationContent,
                        $deeplink,
                        $badgeCount,
                        $sandbox
                    );
                    $notificationSent++;
                } catch (\Exception $e) {
                    Log::error('Failed to send notification', [
                        'deviceToken' => $deviceToken,
                        'error' => $e->getMessage()
                    ]);
                }
            }
        }

        return response()->json([
            'message' => 'Notification sent successfully',
            'notificationSent' => $notificationSent,
            'totalDevices' => count($devices)
        ])->setStatusCode($notificationSent > 0 ? 200 : 500);
    }
                    
}
