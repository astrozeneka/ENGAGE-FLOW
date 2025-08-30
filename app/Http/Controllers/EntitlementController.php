<?php

namespace App\Http\Controllers;

use App\Models\AppleNotificationRawData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EntitlementController extends Controller
{
    /*public function index(Request $request)
    {
        Log::info($request->all());
        /*[2025-08-30 04:51:49] local.INFO: array (
        'user_id' => '16',
        'date_start' => '2025-01-01',
        'date_end' => '2025-01-31',
        )  *
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'date_start' => 'required|date',
            'date_end' => 'required|date|after_or_equal:date_start',
        ]);

        // Fetch entitlements based on validated data
        // Will be modified later to handle both apple and googls
        $entitlements = AppleNotificationRawData::where('user_id', $request->input('user_id'))
            ->whereBetween('date', [$request->input('date_start'), $request->input('date_end')])
            ->get();

        return response()->json($entitlements);
    }*/
}
