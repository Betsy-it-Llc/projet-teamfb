<?php

namespace App\Http\Controllers;

use App\Models\Campagne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CampagneController extends Controller
{

    //  Une fois on depasse 5 lignes par tableau Ca d'affiche
    public function index(Request $request)
    {
        $campagne = new Campagne;
        $campagne->setConnection('mysql');
        $perPage = $request->get('perPage') ?? 10; // par défaut 10 éléments par page
        $campagnes = Campagne::sortable()->paginate($perPage);
        $value = session('id_campagne');  // Stocker la variable dans la session de la table campagne
        return view('campagnes.index', compact('campagnes','perPage'))
            ->with('i', (request()->input('page', 1) - 1) * 5);



    }

    public function multisearch_camp(Request $request)
    {
        $multisearchnom = $request->get('multisearchnom');
        $multisearchetat = $request->get('multisearchetat');
        $perPage = $request->get('perPage') ?? 10; // par défaut 10 éléments par page

        $campagnes = DB::connection('mysql')->table('campagnes')
            ->where('nom', 'LIKE', '%' . $multisearchnom . '%')
            ->where('etat', 'LIKE', '%' . $multisearchetat . '%')
            ->paginate($perPage);

        return view('campagnes.index', ['campagnes' => $campagnes,'perPage' => $perPage])
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    // Direction view create
    public function create()
    {
        return view('campagnes.create');
    }

    // Processus de creation
    public function store(Request $request)
    {
        $request->validate([
            'id_campagne',
            'nom',
            'score',
            'date_debut',
            'date_fin',
            'contexte',
            'etat',
            'contenu_post_mere',
            'objectifs',
            'recommandation',
            'bilan',
            'date_programmation',
            'nb_likes',
            'nb_comments',
            'nb_shares',
            'portee',
            'id_segmentation',
        ]);

        Campagne::create($request->all());

        return redirect()->route('campagnes.index')
            ->with('success', '');
    }

    // Direction vers le view de details du campagne
    public function show(Campagne $campagne)
    {
        return view('campagnes.show', compact('campagne'));
    }

    // Direction vers le view de la modification du campagne
    public function edit(Campagne $campagne)
    {
        return view('campagnes.edit', compact('campagne'));
    }

    // Processus de modification du campagne
    public function update(Request $request, Campagne $campagne)
    {
        $request->validate([
            'id_campagne',
            'nom',
            'score',
            'date_debut',
            'date_fin',
            'contexte',
            'etat',
            'contenu_post_mere',
            'objectifs',
            'recommandation',
            'bilan',
            'date_programmation',
            'nb_likes',
            'nb_comments',
            'nb_shares',
            'portee',
            'id_segmentation',
        ]);

        $campagne->update($request->all());
        return redirect()->route('campagnes.show', $campagne->id_campagne)
            ->with('success', '');
    }

    // Procesuus de la suppression du campagne
    public function destroy(Campagne $campagne)
    {
        $campagne->delete();
        return redirect()->route('campagnes.index')
            ->with('success', '');
    }

    public function deleteall_c(Request $request)
    {
        $ids = $request->get('ids');
        Campagne::whereIn('id_campagne', $ids)->delete();
        return redirect('campagnes');
    }


    public function show2(Campagne $campagne)
    {
        return view('campagnes.show2', compact('campagne'));
        //return redirect()->route('campagnes.show2', ['campagne'=> $campagne->id_campagne])
        //->with('success' , 'Company updated successfully');
    }

    // public function recup2(Request $request){
    //     $id2 = $request->input('id_campagne');
    //     dd($id2);
    // }
}
