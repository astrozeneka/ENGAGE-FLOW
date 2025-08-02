<?php

namespace App\Services;

use App\RemoteModel\MobileAppUser;

class RemoteDataService
{
    protected string $remoteDataUrl = 'https://training-day-be.codecrane.me/api/user-mobile-app-activity';

    public function fetchData(): ?array
    {
        $response = file_get_contents($this->remoteDataUrl);
        if ($response === false) {
            return null; // Handle error appropriately
        }

        // Decode the JSON response
        $decoded = json_decode($response, true);
        $users = [];
        foreach ($decoded as $userData) {
            // Create a new MobileAppUser instance from the decoded data
            $users[] = MobileAppUser::fromJson($userData)->toArray();
        }

        return $users;
    }
}