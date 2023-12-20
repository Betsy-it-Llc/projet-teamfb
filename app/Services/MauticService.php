<?php // app/Services/MauticService.php

namespace App\Services;

use GuzzleHttp\Client;

class MauticService
{
    protected $apiUrl;
    protected $username;
    protected $password;
    protected $httpClient;

    public function __construct()
    {
        $this->apiUrl = config(getenv('MAUTIC_API_URL'));
        $this->username = config(getenv('MAUTIC_API_USERNAME'));
        $this->password = config(getenv('MAUTIC_API_PASSWORD'));
        $this->httpClient = new Client();
    }

    public function makeRequest($method, $endpoint, $data = [])
    {
        $response = $this->httpClient->request($method, "{$this->apiUrl}/{$endpoint}", [
            'auth' => [$this->username, $this->password],
            'json' => $data,
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
