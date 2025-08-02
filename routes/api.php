<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/data/full-data', [App\Http\Controllers\DataController::class, 'getFullData']);
Route::get('/data/user-list', [App\Http\Controllers\DataController::class, 'getUserList']);
Route::post('/push-notification/trigger', [App\Http\Controllers\PushNotificationController::class, 'triggerNotification']);

// Update later
Route::get('/test-payment', function(Request $request) {
    \Stripe\Stripe::setApiKey('sk_test_xxx');
    $checkout_session = \Stripe\Checkout\Session::create([
        'line_items' => [[
            'price' => 'price_1O6420Ktmo6Q8OMg7qQefNYZ',
            'quantity' => 1
        ]],
        'mode' => 'payment',
        'success_url' => 'https://dd25-223-24-153-108.ngrok-free.app/api/test-payment-success?XDEBUG_SESSION_START=1',
        'cancel_url' => 'https://dd25-223-24-153-108.ngrok-free.app/api/test-payment-cancel?XDEBUG_SESSION_START=1'
    ]);
    return Redirect::to($checkout_session->url, 303);
});

Route::get('/test-payment-success', function(Request $request) {
    return response()->json(['message' => 'GET payment success']);
});

Route::post('/test-payment-success', function(Request $request) {
    return response()->json(['message' => 'POST payment success']);
});

Route::get('/test-payment-cancel', function(Request $request) {
    return response()->json(['message' => 'GET payment error']);
});

Route::post('/test-payment-cancel', function(Request $request) {
    return response()->json(['message' => 'POST payment error']);
});
