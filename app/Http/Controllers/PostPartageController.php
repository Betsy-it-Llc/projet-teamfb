<?php

namespace App\Http\Controllers;
use App\Models\Postpartage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PostPartageController extends Controller
{

    //  Une fois on depasse 5 lignes par tableau Ca d'affiche
    public function index(Request $request)
    {
        $postpartage = new Postpartage;
        $postpartage->setConnection('mysql');
        $perPage = $request->get('perPage') ?? 10; // par défaut 10 éléments par page
        $postpartages = Postpartage::sortable()->paginate($perPage);
        $value = session('id_post');  // Stocker la variable dans la session de la table campagne
        return view('postpartages.index',compact('postpartages'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function multisearch_camp(Request $request)
    {
        $multisearchtitre = $request->get('multisearchtitre');
        $multisearchstatut = $request->get('multisearchstatut');

        $postpartage = DB::connection('mysql')->table('postpartages')
            ->where('titre', 'LIKE', '%' . $multisearchtitre . '%')
            ->where('statut', 'LIKE', '%' . $multisearchstatut . '%')
            ->paginate(20);

        return view('postpartages.index', ['postpartages' => $postpartage]);
    }

    // Direction view create
    public function create()
    {
        return view('postpartages.create');
    }

    // Processus de creation
    public function store(Request $request)
    {
         $request->validate([
            'id_post'=>'required',
            'id_groupe' => 'required',
            'nom',
            'prenom',
            'message_personnalise',
            'statut',
            'id_utilisateur'
        ]);

        Postpartage::create($request->all());

        return redirect()->route('postpartages.index')
            ->with('success','');
    }

    public function show(Postpartage $postpartage)
    {
        return view('postpartages.show',compact('postpartage'));
    }

    public function edit(Postpartage $postpartage)
    {
        return view('postpartages.edit',compact('postpartage'));
    }

    public function update(Request $request, Postpartage $postpartage)
    {
        $request->validate([
            'id_post'=>'required',
            'id_groupe' => 'required',
            'nom',
            'prenom',
            'message_personnalise',
            'statut',
            'id_utilisateur'
        ]);

        $postpartage->update($request->all());
        return redirect()->route('postpartages.index')
            ->with('success','');
    }

    public function destroy(Postpartage $postpartage)
    {
        $postpartage->delete();
        return redirect()->route('postpartages.index')
                        ->with('success','');
    }
}
