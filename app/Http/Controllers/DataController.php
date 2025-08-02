<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RemoteModel\MobileAppUser;
use App\Services\RemoteDataService;

class DataController extends Controller
{

    // 
    public function getFullData(){
        $users = app(RemoteDataService::class)->fetchData();

        return response()->json($users, 200);
    }

    public function getUserList() {
        $users = app(RemoteDataService::class)->fetchData();

        // TODO later, the endpoint can be optimized to return only the user list
        // For later

        return response()->json($users, 200);
    }
}
