<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\Compte;
use App\Models\Cagnotte;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\ContactCompte;
use App\Models\ContactProjet;
use App\Models\experienceApp\Contact;

class UtilisateurTransfereController extends Controller
{
    public function choixcagnotte()
    {
        // Récupérez le contact actuellement connecté (supposons que vous utilisez l'authentification)
        $contact = Contact::where('email', auth()->user()->email)->get()->first();

        //$contact = Contact::find(139);

        if (!$contact) {
            return "Contact non trouvé";
        }

        // Récupérez tous les projets associés à ce contact via la table pivot contact_projets
        $projetsDuContact = $contact->projets;

        // Ensuite, obtenez toutes les cagnottes associées à ces projets
        $cagnottes = collect();

        foreach ($projetsDuContact as $projet) {
            $cagnottes = $cagnottes->merge($projet->cagnottes);
        }

        // Calculez le montant total des cagnottes
        $montantTotalCagnottes = $cagnottes->sum('montant_actuel');

        // Calculez le montant total des contributions de toutes les cagnottes
        $montantTotalContributions = $cagnottes->sum(function ($cagnotte) {
            return $cagnotte->contributions->sum('montant');
        });

        // Triez les cagnottes par date de création du projet (supposez que le champ de date soit nommé 'date_creation' dans le modèle de projet)
        $cagnottes = $cagnottes->sortByDesc(function ($cagnotte) {
            return $cagnotte->projet->date_creation;
        });

        return view('utilisateurcontribution.transfere.choixcagnotte', [
            'cagnottes' => $cagnottes,
            'montantTotalCagnottes' => $montantTotalCagnottes,
            'montantTotalContributions' => $montantTotalContributions,
        ]);
    }


    public function validationtransfere(Request $request)
    {
        // Récupérez le contact actuellement authentifié
        $contact = Contact::where('email', auth()->user()->email)->first();

        if (!$contact) {
            return "Contact non trouvé";
        }

        // Récupérez les IDs des cagnottes transférées
        $cagnottesIds = (array) $request->input('cagnottes_ids');

        // Récupérez les informations de chaque cagnotte transférée
        $cagnottes = Cagnotte::whereIn('id_cagnotte', $cagnottesIds)->get();

        // Vérifiez la propriété des cagnottes si nécessaire
        foreach ($cagnottes as $cagnotte) {
            if (!$this->verifyCagnotteOwnership($cagnotte)) {
                // Gérez l'erreur comme vous le souhaitez
                continue;
            }
        }

        // Calculez le montant total des cagnottes sélectionnées
        $montantTotalCagnottes = $cagnottes->sum('montant_actuel');

        // Récupérez le solde du contact
        $soldeContact = $this->getContactAndSolde($contact->id_contact);

        return view('utilisateurcontribution.transfere.validationtransfere', [
            'contact' => $contact,
            'soldeContact' => $soldeContact,
            'cagnottes' => $cagnottes,
            'montantTotalCagnottes' => $montantTotalCagnottes,
        ]);
    }



    public function choixcagnotteid(Request $request)
    {
        // Validez les données du formulaire si nécessaire
        $cagnottesSelectionnees = $request->input('cagnotte_ids');

        // Redirigez l'utilisateur vers la vue suivante avec les données nécessaires
        return redirect()->route('utilisateur.transfere', ['cagnottes' => $cagnottesSelectionnees]);
    }


    public function showtransfere(Request $request)
    {
        // Récupérez les IDs des cagnottes sélectionnées
        $cagnottesSelectionnees = $request->input('cagnottes');

        // Récupérez les informations sur les cagnottes sélectionnées
        $cagnottes = Cagnotte::whereIn('id_cagnotte', $cagnottesSelectionnees)->get();

        // Calculez le montant cumulé
        $montantCumule = $cagnottes->sum('montant_actuel');

        // Récupérez le contact actuellement authentifié
        $contact = Contact::where('email', auth()->user()->email)->first();

        if (!$contact) {
            return "Contact non trouvé";
        }

        $soldeContact = $this->getContactAndSolde($contact);

        if ($soldeContact === null) {
            return "Solde non trouvé";
        }

        return view('utilisateurcontribution.transfere.transfere', [
            'soldeContact' => $soldeContact,
            'cagnottes' => $cagnottes,
            'montantCumule' => $montantCumule,
            'cagnottesIds' => $cagnottesSelectionnees, // Utilisez directement les IDs sélectionnées
        ]);
    }




    public function transfere(Request $request)
    {

        // Récupérez les IDs des cagnottes sélectionnées
        $cagnottesIdsString = $request->input('cagnottes_ids')[0]; // Assurez-vous que c'est la première valeur du tableau
        $cagnottesIds = explode(',', $cagnottesIdsString);

        // Récupérez les informations sur les cagnottes sélectionnées
        $cagnottes = Cagnotte::whereIn('id_cagnotte', $cagnottesIds)->get();

        // Récupérez le contact actuellement authentifié
        $contact = Contact::where('email', auth()->user()->email)->first();

        if (!$contact) {
            return "Contact non trouvé";
        }

        // Récupérez le compte destinataire (peut-être à partir de la relation entre contact et compte)
        $compteDestinataire = $contact->comptes()->first();

        // Effectuez le transfert pour chaque cagnotte sélectionnée
        foreach ($cagnottes as $cagnotte) {
            // Vérifiez la propriété de la cagnotte si nécessaire
            if (!$this->verifyCagnotteOwnership($cagnotte)) {
                // Gérez l'erreur comme vous le souhaitez
                continue;
            }

            // Récupérez le montant à transférer (peut être le montant actuel de la cagnotte)
            $somme = $cagnotte->montant_actuel;

            // Effectuez le transfert
            $cagnotte->decrement('montant_actuel', $somme);
            $compteDestinataire->increment('solde', $somme);
            $transaction = Transaction::create([
                'montant' => $somme,
                'type' => 'transfert',
                'id_cagnotte' => $cagnotte->id_cagnotte,
                'id_compte_destinataire' => $compteDestinataire->id_compte,
                'id_contact' => $contact->id_contact,
                'date_transaction' => now(),
            ]);
        }

        // Faites quelque chose avec le message (par exemple, redirigez l'utilisateur avec un message de succès)
        return redirect()->route('utilisateur.validationtransfere')->with('success', 'Transfert réussi !');
    }


    // Méthode pour récupérer le contact et son solde
    private function getContactAndSolde()
    {
        // Récupérez le contact actuellement authentifié
        $contact = Contact::where('email', auth()->user()->email)->first();

        if (!$contact) {
            return null; // Ou gérez l'erreur de la manière qui vous convient
        }

        $comptes = $contact->comptes;
        $soldeContact = $comptes->first()->solde;

        return $soldeContact;
    }

    private function verifyCagnotteOwnership($cagnotte)
    {
        $user = Contact::where('email', auth()->user()->email)->first();

        if (!$user) {
            return false;
        }

        // Récupérez l'ID du projet associé à la cagnotte
        $idProjet = $cagnotte->id_projet;

        // Vérifiez si l'utilisateur a accès au projet
        $hasAccessToProjet = ContactProjet::where('id_projet', $idProjet)
            ->where('id_contact', $user->id_contact)
            ->exists();

        if ($hasAccessToProjet) {
            return true;
        }

        return false;
    }
}
