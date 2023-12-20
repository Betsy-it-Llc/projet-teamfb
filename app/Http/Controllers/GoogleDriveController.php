<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Client as GoogleClient;
use Google\Service\Drive;
use Google\Service\Drive\Drive as DriveService;

class GoogleDriveController extends Controller
{
    public function redirectToDrive()
    {
        $client = new GoogleClient();
        // $client->setClientId(env('GOOGLE_DRIVE_CLIENT_ID'));
        // $client->setClientSecret(env('GOOGLE_DRIVE_CLIENT_SECRET'));
        $client->setApplicationName('Laravel');
        $client->setAuthConfig(__DIR__ . '/../../Google/google_credentials.json');
        // $client->setRedirectUri(route('drive.callback'));
        $redirect_uri = "http://localhost:8000/drive.callback";
        $client->setRedirectUri($redirect_uri);
        $client->setAccessType('offline');
        $client->setScopes([Drive::DRIVE]);

        $authUrl = $client->createAuthUrl();

        return redirect()->to($authUrl);
    }

    public function handleDriveCallback(Request $request)
    {
        $code = $request->input('code');

        $client = new GoogleClient();
        // $client->setClientId(env('GOOGLE_DRIVE_CLIENT_ID'));
        // $client->setClientSecret(env('GOOGLE_DRIVE_CLIENT_SECRET'));
        $client->setApplicationName('Laravel');
        $client->setAuthConfig(__DIR__ . '/../../Google/google_credentials.json');
        // $client->setRedirectUri(route('drive.callback'));
        // $client->setRedirectUri(route('drive.callback'));
        $redirect_uri = "http://localhost:8000/drive.callback";
        $client->setRedirectUri($redirect_uri);
        $client->setAccessType('offline');
        $client->setScopes([Drive::DRIVE]);

        $accessToken = $client->fetchAccessTokenWithAuthCode($code);

        $tokenData = json_encode($accessToken);

        //$token = json_encode($$accessToken);
        file_put_contents(__DIR__ . '/../../Google/google_access_token.json', $tokenData);

        $client->setAccessToken($accessToken);

        $driveService = new DriveService($client);

        // Vous pouvez maintenant utiliser $driveService pour interagir avec Google Drive

        return "Authentification réussie !";
    }

    
}
?>