<?php
// app/Http/Controllers/MauticController.php

namespace App\Http\Controllers;

use App\Services\MauticService;
use Illuminate\Http\Request;

class MauticController extends Controller
{
    protected $mauticService;

    public function __construct()
    {
        $this->mauticService = new MauticService;
    }

    public function createContact(Request $request)
    {
        // Exemple d'appel à l'API Mautic pour créer un contact
        $endpoint = "contacts/new";
        $data = [
            'firstname' => $request->prenom,
            'lastname' => $request->nom,
            'email' => $request->email,
        ];

        $response = $this->mauticService->makeRequest('POST', $endpoint, $data);

        // Traitez la réponse de l'API Mautic ici

        return response()->json($response);
    }

    public function getContactByEmail($email)
    {
        // Exemple d'appel à l'API Mautic pour récupérer un contact par e-mail
        $endpoint = "contacts";
        $response = $this->mauticService->makeRequest('GET', $endpoint, [
            'search' => [
                'email'=>$email, // E-mail à rechercher
                ]
        ]);

        // Traitez la réponse de l'API Mautic ici

        return response()->json($response);
    }

    public function updateContactSegment($contactId, $segmentId)
    {
        // Exemple d'appel à l'API Mautic pour mettre à jour le segment d'un contact
        $endpoint = "segments/{$segmentId}/contact/{$contactId}/add";
        $response = $this->mauticService->makeRequest('POST', $endpoint);

        // Traitez la réponse de l'API Mautic ici

        return response()->json($response);
    }

    public function removeContactFromSegment(Request $request, $contactId, $segmentId)
    {
        // Exemple d'appel à l'API Mautic pour supprimer un contact d'un segment
        $endpoint = "segments/{$segmentId}/contact/remove/{$contactId}";
        $response = $this->mauticService->makeRequest('DELETE', $endpoint);

        // Traitez la réponse de l'API Mautic ici

        return response()->json($response);
    }
}
