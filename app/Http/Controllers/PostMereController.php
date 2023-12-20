<?php

namespace App\Http\Controllers;
use App\Models\Postmere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostMereController extends Controller
{

    //  Une fois on depasse 5 lignes par tableau Ca d'affiche
    public function index(Request $request)
    {
        $postmere = new Postmere;
        $postmere->setConnection('mysql');
        $perPage = $request->get('perPage') ?? 10; // par défaut 10 éléments par page
        $postmeres = Postmere::sortable()->paginate($perPage);
        $value = session('id_post');  // Stocker la variable dans la session de la table campagne
        return view('postmeres.index',compact('postmeres'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function multisearch_camp(Request $request)
    {
        $multisearchtitre = $request->get('multisearchtitre');
        $multisearchstatut = $request->get('multisearchstatut');

        $postmere = DB::connection('mysql')->table('postmeres')
            ->where('titre', 'LIKE', '%' . $multisearchtitre . '%')
            ->where('statut_scrappe', 'LIKE', '%' . $multisearchstatut . '%')
            ->paginate(20);

        return view('postmeres.index', ['postmeres' => $postmere]);
    }

    // Direction view create
    public function create()
    {
        return view('postmeres.create');
    }

    // Processus de creation
    public function store(Request $request)
    {
         $request->validate([
            'id_post'=>'required',
            'id_campagne' => 'required',
            'url_post',
            'statut_scrappe',
            'titre',
            'type_media',
            'legende',
            'hashtag',
            'portee',
            'interaction'
        ]);

        Postmere::create($request->all());

        return redirect()->route('postmeres.index')
            ->with('success','');
    }

    public function show(Postmere $postmere)
    {
        return view('postmeres.show',compact('postmere'));
    }

    public function edit(Postmere $postmere)
    {
        return view('postmeres.edit',compact('postmere'));
    }

    public function update(Request $request, Postmere $postmere)
    {
        $request->validate([
            'id_post'=>'required',
            'id_campagne' => 'required',
            'url_post',
            'statut_scrappe',
            'titre',
            'type_media',
            'legende',
            'hashtag',
            'portee',
            'interaction'
        ]);

        $postmere->update($request->all());
        return redirect()->route('postmeres.index')
            ->with('success','');
    }

    public function destroy(Postmere $postmere)
    {
        $postmere->delete();
        return redirect()->route('postmeres.index')
                        ->with('success','');
    }
}
