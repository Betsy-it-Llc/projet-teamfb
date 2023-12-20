<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\experienceApp\Contact;
use Illuminate\Http\Request;

class ParametreController extends Controller
{
    public function updateNotificationPage(Request $request)
    {
        $notification_contributed_enabled = $request->input('notification_contributed_enabled');
        $notification_contribution_enabled = $request->input('notification_contribution_enabled');
        $id_contact =  $request->input('id_contact');
        $contact = Contact::find($id_contact);
        if ($notification_contributed_enabled === 'on') {
            $contact->notification_contributed_enabled = 1;
        } else {
            $contact->notification_contributed_enabled = 0;
        }

        $contact->save();
        // dd($notification_contribution_enabled);
        if ($notification_contribution_enabled === 'on') {
            $contact->notification_contribution_enabled = 1;
        } else {
            $contact->notification_contribution_enabled = 0;
        }

        $contact->save();
        // dd($contact);
        return view('utilisateurcontribution.compteutilisateur.parametre.notif', ['contact' => $contact])
            ->with('success', 'Les paramètres de notifications ont bien été mis à jour');
    }
}
