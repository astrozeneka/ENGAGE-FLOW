<?php

namespace App\Services;

class RemoteEntitlementDataService
{
    protected $remoteDataUrl = 'https://training-day-be.codecrane.me/api/user-mobile-app-entitlements'; // user_id will be appended

    public function fetchData(int $userId): ?array
    {
        $url = $this->remoteDataUrl . '?user_id=' . $userId;
        $response = file_get_contents($url);
        return json_decode($response, true);
    }
}