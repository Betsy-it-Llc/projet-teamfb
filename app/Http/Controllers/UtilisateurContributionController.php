<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\Projet;
use App\Models\Cagnotte;
use App\Models\Experience;
use App\Models\Contribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\experienceApp\Contact;
use App\Models\UtilisateurContribution;

class UtilisateurContributionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function information()
    {
        // Récupérez l'utilisateur connecté
        $user = auth()->user();

        // Vérifiez si l'utilisateur est connecté
        if ($user) {
            $contact = Contact::where('email', $user->email)->first();
            return view('utilisateurcontribution.compteutilisateur.parametre.information', ['contact' => $contact]);
        } else {
            abort(404); // Ou redirigez vers une autre page d'accueil, selon vos besoins
        }
    }

    // Méthode pour enregistrer les modifications du contact

    public function enregistrerModification(Request $request)
    {
        // Récupérez l'utilisateur connecté
        $user = auth()->user();

        // Récupérez le contact en fonction de l'email de l'utilisateur connecté
        $contact = Contact::where('email', $user->email)->first();

        // Validez les données du formulaire (à ajouter selon vos besoins)
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required',
            'tel' => 'required',
            'pseudo' => 'required',
            'nationalite' => 'required',
            'pays_residence' => 'required',
            'date_naissance' => 'required',
            'code_postal' => 'required',
            'ville' => 'required',
            'adresse' => 'required',

        ]);

        // Convertissez la date au format "YYYY-MM-DD" si elle est présente dans la requête
        $dateNaissance = $request->filled('date_naissance') ? Carbon::parse($request->input('date_naissance'))->format('Y-m-d') : null;



        $contact->update([
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'email' => $request->input('email'),
            'tel' => $request->input('tel'),
            'pseudo' => $request->input('pseudo'),
            'nationalite' => $request->input('nationalite'),
            'pays_residence' => $request->input('pays_residence'),
            'date_naissance' => $dateNaissance,
            'code_postal' => $request->input('code_postal'),
            'ville' => $request->input('ville'),
            'adresse' => $request->input('adresse'),
            // Mettez à jour d'autres champs selon vos besoins
        ]);

        $user->update([
            'name' => $request->input('prenom') . ' ' . $request->input('nom'),
            'email' => $request->input('email'),
            // Mettez à jour d'autres champs dans la table users selon vos besoins
        ]);

        // Redirigez l'utilisateur vers la page d'information après la modification
        return redirect()->route('utilisateur.information')->with('success', 'Informations mises à jour avec succès');
    }



    public function cagnotte()
    {
        // Récupérez le contact actuellement connecté 
        $contact = Contact::where('email', auth()->user()->email)->get()->first();

        //$contact = Contact::find(139);

        if (!$contact) {
            return "Contact non trouvé";
        }

        // Récupérez tous les projets associés à ce contact via la table pivot contact_projets
        $projetsDuContact = $contact->projets;

        // Initialisez un tableau pour stocker les cagnottes
        $cagnottes = collect();

        // Parcourez tous les projets du contact
        foreach ($projetsDuContact as $projet) {
            // Ajoutez les cagnottes du projet à la collection
            $cagnottes = $cagnottes->merge($projet->cagnottes);
        }

        // Calculez le montant total des cagnottes
        $montantTotalCagnottes = $cagnottes->sum('montant_actuel');

        // Calculez le nombre de contributeurs uniques pour chaque cagnotte
        $nombreContributeursParCagnotte = $cagnottes->mapWithKeys(function ($cagnotte) {
            // Utilisez la relation contributions pour vérifier s'il y a des contributions
            if ($cagnotte->contributions->isNotEmpty()) {
                // S'il y a des contributions, calculez le nombre de contributeurs uniques
                $count = $cagnotte->contributions->groupBy('id_contact')->count();
            } else {
                // S'il n'y a aucune contribution, définissez le nombre à 0
                $count = 0;
            }

            return [$cagnotte->id_cagnotte => $count];
        });

        // Triez les cagnottes par date de création du projet (supposez que le champ de date soit nommé 'date_creation' dans le modèle de projet)
        $cagnottes = $cagnottes->sortByDesc(function ($cagnotte) {
            return $cagnotte->projet->date_creation;
        });

        return view('utilisateurcontribution.compteutilisateur.cagnotte', [
            'cagnottes' => $cagnottes,
            'montantTotalCagnottes' => $montantTotalCagnottes,
            'nombreContributeursParCagnotte' => $nombreContributeursParCagnotte,
        ]);
    }


    public function droit()
    {
        // Récupérez l'utilisateur connecté
        $contact = Contact::where('email', '=', auth()->user()->email)->get()->first();

        if (!$contact) {
            // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion ou faites quelque chose d'autre
            return redirect()->route('utilisateur.connection');
        }
        // Accédez à l'ID de l'organisation associée à l'utilisateur

        $idOrganisation = $contact->contact_entreprises->id_organisation;

        return view('utilisateurcontribution.compteutilisateur.parametre.droit', [
            'idOrganisation' => $idOrganisation,
        ]);
    }

    public function notif()
    {
        $contact = Contact::where('email', '=', auth()->user()->email)->get()->first();

        return view('utilisateurcontribution.compteutilisateur.parametre.notif')->with('contact', $contact);
    }

    public function parametre()
    {
        $contact = Contact::where('email', '=', auth()->user()->email)->get()->first();

        return view('utilisateurcontribution.compteutilisateur.parametre.parametre')->with('contact', $contact);
    }

    public function securite()
    {
        $contact = Contact::where('email', '=', auth()->user()->email)->get()->first();

        return view('utilisateurcontribution.compteutilisateur.parametre.securite')->with('contact', $contact);
    }


    public function updatePassword(Request $request)
    {
        // Vérifiez si le mot de passe actuel correspond au mot de passe de l'utilisateur
        if (Hash::check($request->password, auth()->user()->password) && $request->newpassword === $request->newpassword_confirmation) {
            // Si le mot de passe actuel est correct, mettez à jour le mot de passe
            auth()->user()->update([
                'password' => Hash::make($request->newpassword),
            ]);

            // Redirigez l'utilisateur vers une page de succès ou affichez un message de succès
            return redirect()->route('utilisateur.securite')->with('success', 'Mot de passe mis à jour avec succès.');
        } else {
            // Redirigez l'utilisateur vers une page d'erreur ou affichez un message d'erreur
            return redirect()->route('utilisateur.securite')->with('error', 'Mot de passe actuel incorrect ou erreur de correspondance dans les champs suivants');
        }
    }



    public function identite(Request $request)
    {
        $contact = Contact::where('email', auth()->user()->email)->first();

        if ($contact) {
            $userId = $contact->id_contact;
            // Utilisez $userId pour obtenir l'ID de l'utilisateur

            // JM upload image
            //gestion des erreurs

            $id_contact = (int) $userId;


            // on récupère le fichier venant de l'input file de la vue
            $image_contact_identite = $request->file('image_contact_identite');
            // si le fichier existe on execute le code
            if ($image_contact_identite) {
                $request->validate([
                    'image_contact_identite' => 'required|image|mimes:jpeg,png,gif,jpg,bmp,tiff,webp,svg,ico,tga,pcx,pbm,pgm,ppm', // Acceptez uniquement les formats JPEG, PNG et GIF.

                ]);

                // on recupère le nom originale
                $originalFileName = $image_contact_identite->getClientOriginalName();
                // on enlève les espaces, les accents
                $newFileName = preg_replace('/[\'"\sÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝàáâãäåæçèéêëìíîïðñòóôõöøùúûüý]/', '', $originalFileName);
                //si une image existe on l'efface, ( de la bdd ainsi que de google drive)
                if ($contact->getFirstMedia('image_contact_identite')) {
                    $contact->getFirstMedia('image_contact_identite')->delete();
                }
                // on ajoute l'image
                $contact->addMedia($image_contact_identite)
                    // ->withCustomProperties(['folder' => 'Cloud_Laravel_App/ClientTEST/'.$contact->id_contact.' - '.$contact->prenom.'_'.$contact->nom.'/image_identite-'.$contact->prenom.'_'.$contact->nom])
                    ->usingFilename($newFileName)
                    ->toMediaCollection('Images/image_contact_identite', 'google');
                $contact->save();

                //upload success
                $success_image = 'L\'image à été ajouté avec succès';

                // Stockez la variable $success_image dans la session flash
                session()->flash('success_image', $success_image);
                return back();
            }

            // on initialise une variable à null
            $image_de_contact_identite = null;
            // si l'image existe on creer son url qu'on enverra dans la vue
            if ($contact->getFirstMedia('Images/image_contact_identite')) {
                $image_de_contact_identite = $contact->getFirstMedia('Images/image_contact_identite')->getUrl();
            }

            ////////////Suppression de l'image////////////
            $delete_image = $request->has('delete_image');
            if ($contact->getFirstMedia('Images/image_contact_identite') && $delete_image) {
                $contact->getFirstMedia('Images/image_contact_identite')->delete();

                //delete success
                $success_image_delete = 'L\'image à été supprimée';

                // Stockez la variable $success_image dans la session flash
                session()->flash('success_image_delete', $success_image_delete);

                return back();
            }
        } else {
        }

        return view('utilisateurcontribution.compteutilisateur.parametre.identite', compact('image_de_contact_identite'));
    }



    public function mesprojet()
    {
        return view('utilisateurcontribution.compteutilisateur.projet');
    }

    public function mescauseprojet()
    {
        return view('utilisateurcontribution.compteutilisateur.causeprojet');
    }

    public function compte()
    {
        $contact = Contact::where('email', auth()->user()->email)->first();

        if (!$contact) {
            return "Contact non trouvé";
        }

        $montantTotalAvoirs = $contact->avoirs->sum('montant');
        $comptes = $contact->comptes;
        $soldeContact = $comptes->first() ? $comptes->first()->solde : null;

        $projetsContact = $contact->projets;
        $montantTotalCagnottes = 0;
        $contributeursUniques = collect(); // Initialisez la collection des contributeurs uniques

        foreach ($projetsContact as $projet) {
            $cagnottesProjet = $projet->cagnottes;
            $montantTotalCagnottes += $cagnottesProjet->sum('montant_actuel');

            foreach ($cagnottesProjet as $cagnotte) {
                $contributeurs = $cagnotte->contributions->pluck('id_contact');

                // Fusionnez les contributeurs de chaque cagnotte dans la collection
                $contributeursUniques = $contributeursUniques->merge($contributeurs);
            }
        }

        // Obtenez les contributeurs uniques en utilisant la méthode unique de la collection
        $contributeursUniques = $contributeursUniques->unique()->toArray();
        $nombreContributeursTotal = count($contributeursUniques);

        $nombreTotalContributions = 0;

        foreach ($projetsContact as $projet) {
            foreach ($projet->cagnottes as $cagnotte) {
                $nombreTotalContributions += $cagnotte->contributions->count();
            }
        }

        $transactions = $contact->transactions->sortByDesc('date_transaction');

        $montantTotalContributions = 0;

        // Parcourez tous les projets associés à ce contact
        foreach ($projetsContact as $projet) {
            // Parcourez toutes les cagnottes associées à ce projet
            foreach ($projet->cagnottes as $cagnotte) {
                // Ajoutez le montant total des contributions de cette cagnotte au total
                $montantTotalContributions += $cagnotte->contributions->sum('montant');
            }
        }

        $nombreTotalCagnottes = 0;

        // Parcourez tous les projets associés à ce contact
        foreach ($projetsContact as $projet) {
            // Ajoutez 1 au nombre total de cagnottes pour chaque cagnotte dans le projet
            $nombreTotalCagnottes += $projet->cagnottes->count();
        }

        $nombreTotalExperiences = 0;

        // Ajoutez le nombre total d'expériences pour chaque projet
        $nombreTotalExperiences += $contact->experiences->count();

        return view('utilisateurcontribution.compteutilisateur.moncompte', [
            'soldeContact' => $soldeContact,
            'montantTotalCagnottes' => $montantTotalCagnottes,
            'nombreContributeursTotal' => $nombreContributeursTotal,
            'montantAvoir' => $montantTotalAvoirs,
            'montantTotalContributions' => $montantTotalContributions,
            'nombreTotalContributions' => $nombreTotalContributions,
            'transactions' => $transactions,
            'nombreTotalCagnottes' => $nombreTotalCagnottes,
            'nombreTotalExperiences' => $nombreTotalExperiences,
        ]);
    }







    public function operation()
    {
        $contact = Contact::where('email', auth()->user()->email)->get()->first();

        // Récupérez le contact en fonction de son ID (139 dans votre cas)
        //$contact = Contact::find(139);

        if (!$contact) {
            return "Contact non trouvé";
        }
        $montantTotalAvoirs = $contact->avoirs->sum('montant');

        //$contact = Contact::find(139);
        $comptes = $contact->comptes; // Récupérez les comptes du contact
        $soldeContact = $comptes->first() ? $comptes->first()->solde : null;

        // Récupérez tous les projets associés à ce contact
        $projetsContact = $contact->projets;

        // Initialisez une variable pour stocker le montant total
        $montantTotalCagnottes = 0;

        // Parcourez tous les projets pour obtenir les cagnottes et les ajouter au montant total
        foreach ($projetsContact as $projet) {
            $cagnottesProjet = $projet->cagnottes;
            $montantTotalCagnottes += $cagnottesProjet->sum('montant_actuel');
        }

        $transactions = $contact->transactions->sortByDesc('date_transaction');

        return view('utilisateurcontribution.compteutilisateur.operation', [
            'soldeContact' => $soldeContact,
            'montantTotalCagnottes' => $montantTotalCagnottes,
            'montantAvoir' => $montantTotalAvoirs,
            'transactions' => $transactions,
        ]);
    }
}
