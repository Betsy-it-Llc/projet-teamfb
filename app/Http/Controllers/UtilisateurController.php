<?php

namespace App\Http\Controllers;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UtilisateurController extends Controller
{

    //  Une fois on depasse 5 lignes par tableau Ca d'affiche
    public function index(Request $request)
    {
        $utilisateur = new Utilisateur;
        $utilisateur->setConnection('mysql');

        $perPage = $request->get('perPage') ?? 10; // par défaut 10 éléments par page
        $utilisateurs = Utilisateur::sortable()->paginate($perPage);
        $value = session('id_post');  // Stocker la variable dans la session de la table campagne
        return view('utilisateurs.index',compact('utilisateurs'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    // Recherche multi
    public function multisearch_utilisateurs(Request $request){

        $multisearchid = $request->get('multisearchid');
        $multisearchNom = $request->get('multisearchNom');
        $multisearchprenom = $request->get('multisearchprenom');
        $multisearchgenre = $request->get('multisearchgenre');
        $multisearprofil= $request->get('multisearprofil');
        $perPage = $request->get('perPage') ?? 10; // par défaut 10 éléments par page

        $utilisateurs= DB::connection('mysql')->table('utilisateur')
        ->where('id_utilisateur','LIKE','%'.$multisearchid.'%')
        ->where('Nom','LIKE','%'.$multisearchNom.'%')
        ->where('prenom','LIKE','%'.$multisearchprenom.'%')
        ->where('genre','LIKE','%'.$multisearchgenre.'%')
        ->where('profil','LIKE','%'.$multisearprofil.'%')
        ->paginate($perPage);

        return view('utilisateurs.index',['utilisateurs'=>$utilisateurs,'perPage'=>$perPage])
        ->with('i', (request()->input('page', 1) - 1) * 5);

    }


    // Direction view create
    public function create(Utilisateur $utilisateurs )
    {
        $utilisateurs=DB::connection('mysql')->table('utilisateur')->max('id_utilisateur');
        return view('utilisateurs.create',compact('utilisateurs'));
    }

    // Processus de creation
    public function store(Request $request)
    {
         $request->validate([
            'id_utilisateur',
            'Nom',
            'prenom',
            'genre',
            'url_utilisateur',
            'profil'
        ]);

        Utilisateur::create($request->all());

        return redirect()->route('utilisateurs.index')
            ->with('success','');
    }

    // Direction vers le view de details du utilisateurs
    public function show(Utilisateur $utilisateur)
    {
        return view('utilisateurs.show',compact('utilisateur'));
    }

    // Direction vers le view de la modification du utilisateurs
    public function edit(Utilisateur $utilisateur)
    {
        return view('utilisateurs.edit',compact('utilisateur'));
    }

    // Processus de modification du utilisateurs
    public function update(Request $request, Utilisateur $utilisateur)
    {
        $request->validate([
            'id_utilisateur',
            'Nom',
            'prenom',
            'genre',
            'url_utilisateur',
            'profil'
        ]);

        $utilisateur->update($request->all());
        return redirect()->route('utilisateurs.index')
            ->with('success','');
    }

    // Procesuus de la suppression du utilisateurs
    public function destroy(Utilisateur $utilisateur)
    {
        $utilisateur->delete();
        return redirect()->route('utilisateurs.index')
                        ->with('success','');
    }
}
