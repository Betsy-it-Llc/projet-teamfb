<?php

namespace App\Http\Controllers;

use Carbon\Carbon;


use App\Models\Contact;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UtilisateurExperienceController extends Controller
{
    public function mesexperience()
    {
        // Récupérez l'utilisateur connecté
        $user = auth()->user();

        // Recherchez le contact correspondant à l'adresse e-mail de l'utilisateur
        $contact = Contact::where('email', $user->email)->first();

        // Vérifiez si le contact existe
        if ($contact) {
            // Récupérez les expériences associées au contact avec les relations chargées
            $experiences = $contact->experiences()->with('projet.types_projet', 'contents_experiences.storytelling.tag_storytellings.tag_story')->get();

            // Initialiser le montant total de toutes les contributions
            $montantTotalContributions = 0;

            // Initialiser le nombre total de contributeurs uniques
            $nombreTotalContributeurs = 0;

            // Initialiser le nombre total de contributions
            $nombreTotalContributions = 0;

            // Calculer le montant total disponible pour toutes les expériences
            $montantTotalDisponible = 0;

            foreach ($experiences as $experience) {
                // Obtenez toutes les cagnottes liées à cette expérience
                $cagnottes = $experience->projet->cagnottes;

                // Calculez le montant total disponible
                $montantTotalDisponible += $cagnottes->sum('montant_actuel');

                // Calculez le nombre total de contributeurs uniques
                $nombreTotalContributeurs += $cagnottes->flatMap->contributions->unique('id_contact')->count();

                // Calculez le nombre total de contributions
                $nombreTotalContributions += $cagnottes->flatMap->contributions->count();

                // Ajoutez le montant de toutes les contributions de toutes les cagnottes
                $montantTotalContributions += $cagnottes->flatMap->contributions->sum('montant');
            }

            // Passez les expériences, le montant total, le nombre total de contributeurs et le montant total de toutes les contributions à la vue
            return view('utilisateurcontribution.compteutilisateur.experience', compact('experiences', 'montantTotalDisponible', 'nombreTotalContributions', 'nombreTotalContributeurs', 'montantTotalContributions'));
        } else {
            // Gérez le cas où le contact n'est pas trouvé
            return view('utilisateurcontribution.compteutilisateur.experience')->withErrors(['message' => 'Contact introuvable']);
        }
    }

    public function detailexperience($id_experience)
    {
        // Récupérez l'expérience correspondante à l'ID
        $experience = Experience::with('projet.types_projet', 'contents_experiences.storytelling.tag_storytellings.tag_story')
            ->findOrFail($id_experience);

        // Initialiser le montant total de toutes les contributions
        $montantTotalContributions = 0;

        // Initialiser le montant total disponible pour toutes les expériences
        $montantTotalDisponible = 0;

        // Initialiser le nombre total de contributions
        $nombreTotalContributions = 0;

        // Initialiser le nombre total de contributeurs uniques
        $nombreTotalContributeurs = 0;

        // Obtenez toutes les cagnottes liées à cette expérience
        $cagnottes = $experience->projet->cagnottes;

        // Calculez le montant total disponible
        $montantTotalDisponible += $cagnottes->sum('montant_actuel');

        // Ajoutez le montant de toutes les contributions de toutes les cagnottes
        $montantTotalContributions += $cagnottes->flatMap->contributions->sum('montant');

        // Parcourez toutes les cagnottes liées à cette expérience
        foreach ($experience->projet->cagnottes as $cagnotte) {
            // Ajoutez le nombre de contributeurs uniques de cette cagnotte au total
            $nombreTotalContributeurs += $cagnotte->contributions->unique('id_contact')->count();

            // Ajoutez le nombre de contributions de cette cagnotte au total
            $nombreTotalContributions += $cagnotte->contributions->count();
        }

        // Passez l'expérience, le montant total, le montant total de toutes les contributions et le nombre total de contributeurs à la vue
        return view('utilisateurcontribution.compteutilisateur.detailexperience', compact('experience', 'montantTotalDisponible', 'montantTotalContributions', 'nombreTotalContributions', 'nombreTotalContributeurs'));
    }
}
