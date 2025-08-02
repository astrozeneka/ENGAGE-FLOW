<?php

use Google\Service\Docs\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/google/callback', function (Request $request) {
    // Return simple HW
    return response()->json([
        'message' => 'Google authentication callback received',
        'user' => $request->user(),
    ]);
});


Route::get('/signup', function () {
    Log::info("Accessing Angular application route");
    return view('angular');
});
Route::get('/dashboard', function () {
    Log::info("Accessing Angular application route");
    return view('angular');
});
