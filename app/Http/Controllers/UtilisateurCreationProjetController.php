<?php

namespace App\Http\Controllers;

use App\Models\Projets;
use App\Models\Cagnotte;
use App\Models\TypesProjets;
use Illuminate\Http\Request;
use App\Models\ContactProjet;
use App\Models\experienceApp\Contact;

class UtilisateurCreationProjetController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function type(Request $request)
    {
        $typesProjet = TypesProjets::all();


        return view('utilisateurcontribution.creationprojet.type', compact('typesProjet'));
    }

    public function posttype(Request $request)
    {
        // Récupérez le nom du type de projet à partir de la requête
        $nomType = $request->input('nom_type');

        // Stockez le nom du type de projet dans la session
        $request->session()->put('nom_type', $nomType);

        // Redirigez l'utilisateur vers l'étape 2
        return redirect()->route('creation.etape2');
    }

    public function etape2(Request $request)
    {
        // Récupérez le nom du type de projet à partir de la session
        $nomType = $request->session()->get('nom_type');



        return view('utilisateurcontribution.creationprojet.etape2', ['nom_type' => $nomType]);
    }


    public function postetape2(Request $request)
    {
        // Validez les données
        $request->validate([
            'nom' => 'required|string|max:255',
            'objectif_financier' => 'numeric|nullable',
        ]);

        // Si les données passent la validation, vous pouvez les récupérer
        $nomProjet = $request->input('nom', 'Projet Experience');
        $montant = $request->input('objectif_financier', 0);

        // Stockez ces informations dans la session
        $request->session()->put('nom_projet', $nomProjet);
        $request->session()->put('montant', $montant);

        // Redirigez l'utilisateur vers l'étape 3
        return redirect()->route('creation.etape3');
    }



    public function etape3(Request $request)
    {
        // Récupérez le nom du type de projet à partir de la session
        $nomType = $request->session()->get('nom_type');

        return view('utilisateurcontribution.creationprojet.etape3', ['nom_type' => $nomType]);
    }


    public function postetape3(Request $request)
    {
        // Valider les données
        $validatedData = $request->validate([
            'description_detaille' => 'required|string',
            'projetName' => 'nullable|string',
            'localisation' => 'nullable|string',
            'porteurs' => 'nullable|string',
        ]);

        // Stocker les données validées en session
        $request->session()->put('etape3_data', $validatedData);

        // Redirigez l'utilisateur vers l'étape 4
        return redirect()->route('creation.etape4');
    }

    public function etape4(Request $request)
    {
        // Récupérez le nom du type de projet à partir de la session
        $nomType = $request->session()->get('nom_type');

        return view('utilisateurcontribution.creationprojet.etape4', ['nom_type' => $nomType]);
    }

    public function postEtape4(Request $request)
    {
        $validatedData = $request->validate([
            'info_contributeur' => 'string|nullable',

        ]);

        session()->put('etape4', $validatedData);

        return redirect()->route('creation.etape5');
    }

    public function etape5(Request $request)
    {
        // Récupérez le nom du type de projet à partir de la session
        $nomType = $request->session()->get('nom_type');

        return view('utilisateurcontribution.creationprojet.etape5', ['nom_type' => $nomType]);
    }



    public function postEtape5(Request $request)
    {

        // Récupérez toutes les données que vous avez collectées depuis la session
        $nomType = $request->session()->get('nom_type');
        $nomProjet = $request->session()->get('nom_projet');
        $montant = $request->session()->get('montant');
        $etape3Data = $request->session()->get('etape3_data');
        $etape4Data = $request->session()->get('etape4');

        // Créez une nouvelle instance du modèle Projet
        $projet = new Projets();
        $projet->nom = $nomProjet;
        $projet->objectif_financier = $montant;
        $projet->description_detaille = $etape3Data['description_detaille'];
        $projet->info_contributeur = $etape4Data['info_contributeur'];
        $projet->id_type_projet = TypesProjets::where('valeur', $nomType)->first()->id;
        $projet->date_creation = now();

        // Enregistrez le modèle Projet en base de données
        $projet->save();

        // Créez une nouvelle instance du modèle Cagnotte
        $cagnotte = new Cagnotte();
        $cagnotte->titre = $nomProjet;
        $cagnotte->id_projet = $projet->id_projet;
        $cagnotte->id_categorie = TypesProjets::where('valeur', $nomType)->first()->id;
        $cagnotte->montant_actuel = 0;

        // Enregistrez le modèle Cagnotte en base de données
        $cagnotte->save();

        // Obtenez l'utilisateur connecté
        $contact = Contact::where('email', auth()->user()->email)->first();

        // Associez le contact au projet
        $contactProjet = new ContactProjet();
        $contactProjet->id_contact = $contact->id_contact;
        $contactProjet->id_projet = $projet->id_projet;
        $contactProjet->save();

        // Après avoir enregistré toutes les données en base de données, ajoutez ceci pour nettoyer la session
        //$request->session()->flush();

        // Redirigez l'utilisateur vers la page appropriée
        return redirect()->route('utilisateur.cagnotte');
    }
}
