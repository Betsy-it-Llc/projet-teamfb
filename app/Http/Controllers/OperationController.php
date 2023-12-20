<?php

namespace App\Http\Controllers;

use App\Models\Cagnotte;
use App\Models\Compte;
use App\Models\experienceApp\Contact;
use App\Models\Transaction;

class UtilisateurAchatExperienceController extends Controller
{
    /**
     * Summary of transfertTo
     * @param Compte $source
     * @param Compte $destinataire
     * @param mixed $somme
     * @return void
     */
    public function comptetToCompte(Compte $source, Compte $destinataire, Contact $contact, $somme)
    {
        $source->decrement('solde', $somme);
        $destinataire->increment('solde', $somme);
        $transaction = Transaction::create([
            'montant' => $somme,
            'type' => 'transfert',
            'id_compte_source' => $source->id_compte,
            'id_compte_destinataire' => $destinataire->id_compte,
            'id_contact' => $contact->id_contact,
            'date_transaction' => now(),
        ]);
    }

    public function cagnotteToCompte(Cagnotte $cagnotte, Compte $destinataire, Contact $contact, $somme)
    {
        $cagnotte->decrement('montant_actuel', $somme);
        $destinataire->increment('solde', $somme);
        $transaction = Transaction::create([
            'montant' => $somme,
            'type' => 'transfert',
            'id_cagnotte' => $cagnotte->id_cagnotte,
            'id_compte_destinataire' => $destinataire->id_compte,
            'id_contact' => $contact->id_contact,
            'date_transaction' => now(),
        ]);
    }
}
