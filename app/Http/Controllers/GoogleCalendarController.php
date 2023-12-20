<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Google\Client as GoogleClient;
use Google\Service\Calendar as GoogleCalendar;
use Symfony\Component\HttpFoundation\Response;
use DateTime;

class GoogleCalendarController extends Controller
{
    public function auth()
    {
        $client = new GoogleClient();
        $client->setApplicationName('Laravel');
        $authConfig = file_get_contents(__DIR__ . '/../../Google/google_credentials.json');
        $client->setAuthConfig(json_decode($authConfig, true));
        //$client->setAuthConfig(__DIR__ . '/../../Google/google_credentials.json');
        $client->addScope(GoogleCalendar::CALENDAR_EVENTS);
        $client->setAccessType("offline");
        // $redirect_uri = "http://localhost:8000/contacts.create";
        // $client->setRedirectUri($redirect_uri);
        // dd($client);
        $authUrl = $client->createAuthUrl();
        return redirect()->away($authUrl);
    }

    public function callback(Request $request)
    {
        $client = new GoogleClient();
        $client->setAuthConfig(__DIR__ . '/../../Google/google_credentials.json');
        $client->addScope(GoogleCalendar::CALENDAR_EVENTS);

        $client->authenticate($request->get('code'));
        $accessToken = $client->getAccessToken();
        $tokenData = json_encode($accessToken);
        $file = storage_path('../app/Google/calendar_access_token.json');

        file_put_contents($file, $tokenData);

        // Sauvegarde de l'access token pour une utilisation ultérieure

        return redirect()->route('home');
    }

    public static function createEvent($summary, $location, $start, $end, $calendarId)
    {
        $client = new GoogleClient();
        $client->setAuthConfig(__DIR__.'/../../Google/google_credentials.json');
        $client->addScope(GoogleCalendar::CALENDAR_EVENTS);

        $file = storage_path('../app/Google/calendar_access_token.json');

        $tokenData = file_get_contents($file); // Lire le contenu du fichier

        $accessToken = json_decode($tokenData, true); // Décoder le JSON en tableau associatif

        // $accessToken = 'ACCESS_TOKEN_SAUVEGARDE'; // Récupérez l'access token sauvegardé

        $client->setAccessToken($accessToken);
        if ($client->isAccessTokenExpired()) {
            $client->fetchAccessTokenWithRefreshToken();
            $accessToken = $client->getAccessToken();
            // Sauvegarde du nouvel access token
        }

        $service = new GoogleCalendar($client);
        $event = new \Google_Service_Calendar_Event([
            'summary' => $summary,
            'location' => $location,
            'start' => [
                'dateTime' => $start,
                'timeZone' => 'Europe/Paris',
            ],
            'end' => [
                'dateTime' => $end,
                'timeZone' => 'Europe/Paris',
            ],   
        ]);

        $calendarId = $calendarId; // ID du calendrier Google Calendar

        $event = $service->events->insert($calendarId, $event);

        $eventJson = json_encode($event);

        // Créer une nouvelle instance de la réponse HTTP
        $response = new Response();

        // Définir le contenu de la réponse en tant que JSON de l'événement
        $response->setContent($eventJson);

        // Définir l'en-tête Content-Type pour indiquer que le contenu est JSON
        $response->headers->set('Content-Type', 'application/json');

        // Retourner la réponse HTTP
        return $response;
    }

    public function testCreateEvent(){
        $summary = 'Test de creation event';
        $location = 'Toulouse LalaChante';
        $start = '2023-06-26T00:00:00';
        $end =  '2023-06-26T23:59:00';
        $calendarId = 'cloud.lalachante@gmail.com';
        $event = $this->createEvent($summary, $location, $start, $end, $calendarId);
        // $event = $this->createEvent('Test de creation event', 'Toulouse LalaChante', '2023-06-26T00:00:00', '2023-06-26T23:59:00', 'cloud.lalachante@gmail.com');
        return ('Creation event OK');
    }
}

?>