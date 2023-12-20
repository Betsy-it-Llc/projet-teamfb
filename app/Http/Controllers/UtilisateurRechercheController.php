<?php

namespace App\Http\Controllers;

use Carbon\Carbon;


use App\Models\Projet;
use App\Models\Projets;
use App\Models\Cagnotte;
use App\Models\TypesProjets;
use Illuminate\Http\Request;
use App\Models\experienceApp\Media;
use App\Models\experienceApp\Contact;
use App\Models\experienceApp\Experience;

class UtilisateurRechercheController extends Controller
{

    public function __construct()
    {
        // Applique le middleware 'auth' à toutes les méthodes du contrôleur sauf certaines
        $this->middleware('auth', ['except' => ['searchexperience', 'searchcause', 'searchprojet', 'searchorganisation']]);
    }

    public function searchprojet(Request $request)
    {
        $searchQuery = $request->input('searchQuery');

        $projetsQuery = Projets::orderBy('date_creation', 'desc');

        if ($searchQuery) {
            $projetsQuery->where('nom', 'like', '%' . $searchQuery . '%');
        }

        $projets = $projetsQuery->get();


        $typesProjets = TypesProjets::all(); // Pour remplir la liste déroulante

        $previousUrl = $projets->previousPageUrl();
        $nextUrl = $projets->nextPageUrl();

        return view('utilisateurcontribution.recherche.searchprojet', [
            'projets' => $projets,
            'typesProjets' => $typesProjets,
            'searchQuery' => $searchQuery,
            'previousUrl' => $previousUrl,
            'nextUrl' => $nextUrl,
        ]);
    }


    public function searchCause(Request $request)
    {
        // Récupérez le paramètre de recherche
        $searchQuery = $request->input('searchQuery');

        // Récupérez toutes les causes liées à un projet de type "Cagnotte Générale Cause",
        // triées par date de création la plus récente et paginées
        $causes = Projet::whereHas('types_projet', function ($query) {
            $query->where('valeur', 'Cagnotte Générale Cause');
        })->whereHas('cagnottes', function ($query) use ($searchQuery) {
            // Filtrez par titre de la cagnotte si une recherche est effectuée
            if ($searchQuery) {
                $query->where('titre', 'like', '%' . $searchQuery . '%');
            }
        })->orderBy('date_creation', 'desc')->get();

        // Itérez sur la collection pour mettre à jour la date de création de chaque projet
        foreach ($causes as $cause) {
            $cause->date_creation = Carbon::parse($cause->date_creation);

            // Récupérez toutes les cagnottes liées à chaque projet
            $cagnottes = $cause->cagnottes;

            // Itérez sur la collection de cagnottes
            foreach ($cagnottes as $cagnotte) {
                // Vérifiez si la cagnotte existe avant d'accéder à ses propriétés
                if ($cagnotte) {
                    // Récupérez le montant actuel de la cagnotte
                    $montantActuel = $cagnotte->montant_actuel;

                    // Récupérez le nom de la cagnotte
                    $nomCagnotte = $cagnotte->titre;

                    // Faites ce que vous devez avec le montant actuel et le nom de la cagnotte
                    // Par exemple, vous pouvez les passer à la vue
                    $cause->montant_actuel_cagnotte = $montantActuel;
                    $cause->nom_cagnotte = $nomCagnotte;
                }
            }
        }

        // Passez les projets de type "Cagnotte Générale Cause" à la vue
        return view('utilisateurcontribution.recherche.searchcause', compact('causes', 'searchQuery'));
    }


    public function searchorganisation()
    {
        // Récupérez la liste des projets de type "organisation" depuis la base de données
        $projetsOrganisation = Projets::whereHas('typeProjet', function ($query) {
            $query->where('valeur', 'organisation');
        })->orderBy('date_creation', 'desc')->paginate(5);

        // Itérez sur la collection pour mettre à jour la date de création de chaque projet
        foreach ($projetsOrganisation as $projet) {
            $projet->date_creation = Carbon::parse($projet->date_creation);
            
        }

        // Passez les projets de type "organisation" à la vue
        return view('utilisateurcontribution.recherche.searchorganisation', ['projetsOrganisation' => $projetsOrganisation]);
    }



    public function searchexperience(Request $request)
    {
        // Récupérez le paramètre de recherche
        $searchQuery = $request->input('searchQuery');

        // Récupérez toutes les expériences liées à un projet, triées par date de création la plus récente et paginées
        $experiences = Experience::whereNotNull('id_projet')
            ->where('visibility', '=' , 'public')//Seule les experiences publiques sont visible sur les pages de recherche
            ->orderBy('date_creation', 'desc')
            ->when($searchQuery, function ($query) use ($searchQuery) {
                // Filtrez par nom d'expérience si une recherche est effectuée
                $query->where('nom_experience', 'like', '%' . $searchQuery . '%');
            })
            ->get();

        // Itérez sur les expériences pour mettre à jour la date de création
        foreach ($experiences as $experience) {
            $experience->projet->date_creation = Carbon::parse($experience->projet->date_creation);
        }

        // Passez les données à votre vue, y compris le paramètre de recherche
        return view('utilisateurcontribution.recherche.searchexperience', [
            'experiences' => $experiences,
            'searchQuery' => $searchQuery, // Passez le paramètre de recherche à la vue
        ]);
    }



    public function soutienprojet(Request $request)
    {
        $searchQuery = $request->input('searchQuery');
        //$montant = $request->input('montant');
        //$date = $request->input('date');
        //$typeProjet = $request->input('typeProjet');

        $projetsQuery = Projets::orderBy('date_creation', 'desc');

        if ($searchQuery) {
            $projetsQuery->where('nom', 'like', '%' . $searchQuery . '%');
        }

        //if ($montant) {
        // $projetsQuery->whereHas('cagnottes', function ($query) use ($montant) {
        //$query->where('montant_actuel', '>=', $montant);
        // });
        // }

        // if ($date) {
        // $projetsQuery->whereDate('date_creation', $date);
        // }

        // if ($typeProjet) {
        // $projetsQuery->where('id_type_projet', $typeProjet);
        //}

        $projets = $projetsQuery->get();

        foreach ($projets as $projet) {
            $projet->description_courte=$this->getMediaName('header',0,$projet->id_projet);
        }

        $typesProjets = TypesProjets::all(); // Pour remplir la liste déroulante



        return view('utilisateurcontribution.soutenir.soutenirprojet', [
            'projets' => $projets,
            'typesProjets' => $typesProjets,
            'searchQuery' => $searchQuery,
            //'montant' => $montant,
            //'date' => $date,
            //'typeProjet' => $typeProjet,

        ]);
    }



    public function soutiencause(Request $request)
    {
        // Récupérez le paramètre de recherche
        $searchQuery = $request->input('searchQuery');

        // Récupérez la liste des projets de type "Cagnotte Générale Cause"
        $causes = Projet::whereHas('types_projet', function ($query) {
            $query->where('valeur', 'Cagnotte Générale Cause');
        })
            ->when($searchQuery, function ($query) use ($searchQuery) {
                // Filtrez par titre de cagnotte si une recherche est effectuée
                $query->whereHas('cagnottes', function ($innerQuery) use ($searchQuery) {
                    $innerQuery->where('titre', 'like', '%' . $searchQuery . '%');
                });
            })
            ->orderBy('date_creation', 'desc')
            ->get();

        // Itérez sur la collection pour mettre à jour la date de création de chaque projet
        foreach ($causes as $cause) {
            $cause->date_creation = Carbon::parse($cause->date_creation);

            // Récupérez toutes les cagnottes liées à chaque projet
            $cagnottes = $cause->cagnottes;

            // Itérez sur la collection de cagnottes
            foreach ($cagnottes as $cagnotte) {
                // Vérifiez si la cagnotte existe avant d'accéder à ses propriétés
                if ($cagnotte) {
                    // Récupérez le montant actuel de la cagnotte
                    $montantActuel = $cagnotte->montant_actuel;

                    // Récupérez le nom de la cagnotte
                    $nomCagnotte = $cagnotte->titre;

                    // Faites ce que vous devez avec le montant actuel et le nom de la cagnotte
                    // Par exemple, vous pouvez les passer à la vue
                    $cause->montant_actuel_cagnotte = $montantActuel;
                    $cause->nom_cagnotte = $nomCagnotte;

                    //JM images
                    $cagnotte->nom_image=null;
                    $cagnotte->nom_image=$this->getMediaName('header',0,$cagnotte->id_cagnotte);
                }
            }
        }

        // Passez les projets de type "Cagnotte Générale Cause" à la vue
        return view('utilisateurcontribution.soutenir.soutenircause', compact('causes', 'searchQuery'));
    }


    public function soutienorganisation()
    {
        // Récupérez la liste des projets de type "organisation" depuis la base de données
        $projetsOrganisation = Projets::whereHas('typeProjet', function ($query) {
            $query->where('valeur', 'organisation');
        })->orderBy('date_creation', 'desc')->paginate(5);

        // Itérez sur la collection pour mettre à jour la date de création de chaque projet
        foreach ($projetsOrganisation as $projet) {
            $projet->date_creation = Carbon::parse($projet->date_creation);
        }

        // Passez les projets de type "organisation" à la vue
        return view('utilisateurcontribution.soutenir.soutenirorganisation', ['projetsOrganisation' => $projetsOrganisation]);
    }

    public function soutienexperience(Request $request)
    {
        // Récupérez le paramètre de recherche
        $searchQuery = $request->input('searchQuery');

        // Récupérez toutes les expériences liées à un projet, triées par date de création la plus récente et paginées
        $experiences = Experience::whereNotNull('id_projet')
            ->where('visibility', '=' , 'public')//Seule les experiences publiques sont visible sur les pages de recherche
            ->orderBy('date_creation', 'desc')
            ->when($searchQuery, function ($query) use ($searchQuery) {
                // Filtrez par nom d'expérience si une recherche est effectuée
                $query->where('nom_experience', 'like', '%' . $searchQuery . '%');
            })
            ->get();

        // Itérez sur les expériences pour mettre à jour la date de création
        foreach ($experiences as $experience) {
            $experience->projet->date_creation = Carbon::parse($experience->projet->date_creation);

            $experience->type_experience=$this->getMediaName('prod/header',0,$experience->id_experience);
        }
        // Passez les données à votre vue, y compris le paramètre de recherche
        return view('utilisateurcontribution.soutenir.soutenirexperience', [
            'experiences' => $experiences,
            'searchQuery' => $searchQuery, // Passez le paramètre de recherche à la vue
        ]);
    }

    public function getMediaName($Collection,$index,$id){

        if(Media::where('collection_name', 'LIKE', '%'.$Collection.'%')->get()){
            $fichiers=Media::where('collection_name', 'LIKE', '%'.$Collection.'%')->where('model_id',$id)->get();
            if(isset($fichiers[$index])){
                $nomDeFichier=explode(".",$fichiers[$index]->file_name)[0];
            }else{
                $nomDeFichier=null;
            }
            return $nomDeFichier;
        }
    }
}
