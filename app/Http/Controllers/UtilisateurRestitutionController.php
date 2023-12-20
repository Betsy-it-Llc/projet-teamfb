<?php

namespace App\Http\Controllers;

use App\Models\Cagnotte;
use Illuminate\Http\Request;
use App\Models\ContactProjet;
use App\Models\experienceApp\Contact;

class UtilisateurRestitutionController extends Controller
{
    public function restitution()
    {
        $contact = Contact::where('email', auth()->user()->email)->get()->first();
        // Récupérez le contact avec l'ID 139
        //$contact = Contact::find(139);

        // Initialisez une variable pour stocker le montant total des cagnottes
        $montantTotal = 0;

        // Parcourez les projets du contact
        foreach ($contact->projets as $projet) {
            // Ajoutez le montant total des cagnottes du projet à la variable
            $montantTotal += $projet->cagnottes->sum('montant_actuel');
        }

        return view('utilisateurcontribution.restitution.restitution', ['montantTotal' => $montantTotal]);
    }


    public function validation()
    {

        // Récupérez l'utilisateur actuellement connecté (contact)
        $contact = Contact::where('email', auth()->user()->email)->get()->first();

        // Récupérez le contact en fonction de son ID (139 dans votre cas)
        //$contact = Contact::find(139);

        if (!$contact) {
            return "Contact non trouvé";
        }

        //$contact = Contact::find(139);
        $comptes = $contact->comptes; // Récupérez les comptes du contact
        $soldeContact = $comptes->first()->solde;

        // Récupérez tous les projets associés à ce contact
        $projetsContact = $contact->projets;

        // Initialisez une variable pour stocker le montant total
        $montantTotalCagnottes = 0;

        // Parcourez tous les projets pour obtenir les cagnottes et les ajouter au montant total
        foreach ($projetsContact as $projet) {
            $cagnottesProjet = $projet->cagnottes;
            $montantTotalCagnottes += $cagnottesProjet->sum('montant_actuel');
        }

        return view('utilisateurcontribution.restitution.validation', [
            'soldeContact' => $soldeContact,
            'montantTotalCagnottes' => $montantTotalCagnottes
        ]);
    }

    public function recuperation()
    {


        return view('utilisateurcontribution.restitution.recuperation');
    }


    public function suivi()
    {
        // Récupérez le contact actuellement authentifié
        $contact = Contact::where('email', auth()->user()->email)->first();

        // Assurez-vous que le contact a été trouvé
        if (!$contact) {
            // Gérez le cas où le contact n'a pas été trouvé (par exemple, redirigez vers une page d'erreur).
        }

        // Récupérez tous les projets appartenant à ce contact
        $projets = $contact->projets;

        // Initialisez un tableau pour stocker toutes les contributions
        $contributions = [];

        // Parcourez les projets
        foreach ($projets as $projet) {
            // Récupérez toutes les cagnottes associées à ce projet
            $cagnottes = $projet->cagnottes;

            // Parcourez les cagnottes et récupérez les contributions de chacune
            foreach ($cagnottes as $cagnotte) {
                $contributionsCagnotte = $cagnotte->contributions;
                $contributions = array_merge($contributions, $contributionsCagnotte->all());
            }
        }

        // Calculez le montant total des contributions
        $montantTotal = array_sum(array_column($contributions, 'montant'));

        // Calculez le nombre total de contributions
        $nombreTotalContributions = count($contributions);

        return view('utilisateurcontribution.restitution.suivipaiement', [
            'contact' => $contact,
            'contributions' => $contributions,
            'montantTotal' => $montantTotal,
            'nombreTotalContributions' => $nombreTotalContributions,
        ]);
    }


    public function contributeur()
    {
        // Récupérez le contact actuellement authentifié
        $contact = Contact::where('email', auth()->user()->email)->first();

        // Assurez-vous que le contact a été trouvé
        if (!$contact) {
            // Gérez le cas où le contact n'a pas été trouvé (par exemple, redirigez vers une page d'erreur).
        }

        // Récupérez tous les projets appartenant à ce contact
        $projets = $contact->projets;

        // Initialisez un tableau pour stocker les données des contributeurs
        $donneesContributeurs = [];

        $montantTotal = 0; // Initialisez le montant total à zéro

        foreach ($projets as $projet) {
            // Récupérez toutes les cagnottes associées à ce projet
            $cagnottes = $projet->cagnottes;

            foreach ($cagnottes as $cagnotte) {
                $contributionsCagnotte = $cagnotte->contributions;

                foreach ($contributionsCagnotte as $contribution) {
                    $contributeurId = $contribution->id_contact;
                    $montant = $contribution->montant;

                    // Ajoutez le montant de cette contribution au montant total
                    $montantTotal += $montant;

                    // Initialisez ou mettez à jour les données du contributeur
                    if (isset($donneesContributeurs[$contributeurId])) {
                        $donneesContributeurs[$contributeurId]['nrbContributions']++;
                        $donneesContributeurs[$contributeurId]['montantTotal'] += $montant;
                    } else {
                        $donneesContributeurs[$contributeurId] = [
                            'nom' => $contribution->contact->nom . ' ' . $contribution->contact->prenom,
                            'nrbContributions' => 1,
                            'montantTotal' => $montant,
                        ];
                    }
                }
            }
        }

        // Comptez le nombre total de contributeurs uniques
        $nombreContributeursUniques = count($donneesContributeurs);

        return view('utilisateurcontribution.restitution.contributeurallprojet', [
            'contact' => $contact,
            'donneesContributeurs' => $donneesContributeurs,
            'nombreContributeursUniques' => $nombreContributeursUniques,
            'montantTotal' => $montantTotal,
        ]);
    }

    public function contributeurcagnotte($id_cagnotte)
    {
        // Récupérez la cagnotte correspondante à l'ID
        $cagnotte = Cagnotte::findOrFail($id_cagnotte);

        // Récupérez toutes les contributions associées à cette cagnotte
        $contributions = $cagnotte->contributions;

        // Initialisez un tableau pour stocker les données des contributeurs
        $donneesContributeurs = [];

        $montantTotal = 0; // Initialisez le montant total à zéro

        foreach ($contributions as $contribution) {
            $contributeurId = $contribution->id_contact;
            $montant = $contribution->montant;

            // Ajoutez le montant de cette contribution au montant total
            $montantTotal += $montant;

            // Initialisez ou mettez à jour les données du contributeur
            if (isset($donneesContributeurs[$contributeurId])) {
                $donneesContributeurs[$contributeurId]['nrbContributions']++;
                $donneesContributeurs[$contributeurId]['montantTotal'] += $montant;
            } else {
                $donneesContributeurs[$contributeurId] = [
                    'nom' => $contribution->contact->nom . ' ' . $contribution->contact->prenom,
                    'nrbContributions' => 1,
                    'montantTotal' => $montant,
                ];
            }
        }

        // Comptez le nombre total de contributeurs uniques
        $nombreContributeursUniques = count($donneesContributeurs);

        return view('utilisateurcontribution.restitution.contributeurcagnotte', [
            'cagnotte' => $cagnotte,
            'donneesContributeurs' => $donneesContributeurs,
            'nombreContributeursUniques' => $nombreContributeursUniques,
            'montantTotal' => $montantTotal,
        ]);
    }


    public function contribution($idCagnotte)
    {
        // Obtenez l'utilisateur connecté
        $contact = Contact::where('email', auth()->user()->email)->first();

        // Récupérez la cagnotte en fonction de son ID
        $cagnotte = Cagnotte::findOrFail($idCagnotte);

        // Vérifiez si l'utilisateur a accès à cette cagnotte via le projet
        $hasAccessToCagnotte = ContactProjet::where('id_projet', $cagnotte->id_projet)
            ->where('id_contact', $contact->id_contact)
            ->exists();

        if (!$cagnotte || !$hasAccessToCagnotte) {
            // La cagnotte n'existe pas ou l'utilisateur n'a pas accès à cette cagnotte via le projet.
            // Vous pouvez rediriger l'utilisateur vers la page d'accueil ou afficher un message d'erreur.
            return redirect()->route('utilisateur.compte');
        }

        // Récupérez toutes les contributions de cette cagnotte
        $contributions = $cagnotte->contributions;

        // Calculez le montant total des contributions
        $montantTotal = $contributions->sum('montant');

        return view('utilisateurcontribution.restitution.contributionprojet', [
            'contact' => $contact,
            'cagnotte' => $cagnotte,
            'contributions' => $contributions,
            'montantTotal' => $montantTotal,
        ]);
    }
}
