<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RemoteModel\MobileAppUser;
use App\Services\RemoteDataService;
use App\Services\UserActivityStatsService;
use App\Services\RemoteEntitlementDataService;
use Illuminate\Support\Facades\Log;

class DataController extends Controller
{

    // 
    public function getFullData(){
        $users = app(RemoteDataService::class)->fetchData();

        return response()->json($users, 200);
    }

    public function getUserList() {
        $users = app(RemoteDataService::class)->fetchData();

        // Append the stats to the user data
        foreach ($users as &$user) {
            $user['stats'] = app(UserActivityStatsService::class)->calculateUserStats($user);
        }

        // TODO later, the endpoint can be optimized to return only the user list
        // For later

        return response()->json($users, 200);
    }

    public function getUserEntitlements(Request $request)
    {
        Log::info($request->all());
        $request->validate([
            'user_id' => 'required',
        ]);

        $entitlements = app(RemoteEntitlementDataService::class)->fetchData($request->input('user_id'));

        return response()->json($entitlements, 200);
    }
}
