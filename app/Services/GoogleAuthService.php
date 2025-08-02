<?php

namespace App\Services;

use Google_Client;

class GoogleAuthService
{
    private $client;

    public function __construct() {
        $this->client = new Google_Client();
        $this->client->setClientId(env('GOOGLE_CLIENT_ID'));
        $this->client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $this->client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        $this->client->addScope('email');
        $this->client->addScope('profile');
    }
}