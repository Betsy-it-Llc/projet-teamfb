<?php

namespace App\Http\Controllers;
// use App\Groupecampagne;
use PDO;
use PDOException;
use App\Models\Groupe;
use App\Models\Segment;
use App\Models\Campagne;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Groupecampagne;
use App\Models\segment_groupe;
use Illuminate\Support\Facades\DB;
use PHPUnit\TextUI\XmlConfiguration\Group;

class GroupecampagneController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  Une fois on depasse 5 lignes par tableau Ca d'affiche
    public function index(Request $request, Groupecampagne $id_campagne, Groupe $groupes)
    {
    
        $groupecampagne = new Groupecampagne;
        $groupecampagne->setConnection('mysql');
        session_start();
        $ids = session('id_campagne');

        if (session()->has('id_campagne')) {
            $ids = session('id_campagne');
        } 
            // Utilisez la valeur de l'ID de campagne récupérée depuis l'URL de la manière que vous avez déjà mise en place dans votre code
            $id3 = (int) $request->id_campagne;
           
        

        // http: //127 .0.0. 1:800 0/gro upeca mpagn es?0  (38 en local)
        // https ://te amfb. lalac hante .fr/g roupe campa gnes? 0  (45 en ligne)

        // $id_campagne = $request->input('id_campagne');
        // dd($id_campagne);

        $groupes = Groupe::all()->get('groupes.*');
        $grpecamps = Groupecampagne::join('campagnes', 'campagnes.id_campagne', '=', 'campagne_groupe.id_campagne')
            ->get(['campagne_groupe.*', 'campagnes.id_campagne']);

        $segs = DB::connection('mysql')->table('segements')->select('segements.nom_segment', 'segements.id_segment')
            ->get();
        $cpgrps = DB::connection('mysql')->table('campagne_groupe')->select('campagne_groupe.statut_publication')
            ->groupby('campagne_groupe.statut_publication')
            ->get('campagne_groupe');

        $campagnes = DB::connection('mysql')->select('SELECT id_campagne FROM campagnes');
        foreach ($campagnes as $campagne => $rang) {
            if (isset($id3) && $id3 !== null) {
                if ($id3 === $rang->id_campagne) {
                    $ids = $id3;
                    $nom_campagne = DB::connection('mysql')->select('SELECT nom FROM campagnes WHERE id_campagne=' . $id3);
                }
            } 
            else {
                $ids = "NULL";
                $nom_campagne = 'nom-de-la-campagne';
            }
        }

        foreach ($campagnes as $campagne => $rang) {
            if ($id3 === $rang->id_campagne) {
                $nbre = DB::connection('mysql')->select('SELECT id_groupe FROM campagne_groupe
                WHERE id_campagne =' . $id3);
                $nbre2 = count($nbre);
            } 
            else {
                $nbre2 = 0;
            }
        }

        $groupecampagnes = DB::connection('mysql')->select('SELECT campagne_groupe.id_campagne, groupes.id, groupes.nom, campagne_groupe.statut_publication, campagne_groupe.id_groupe, segment_groupe.id_segment
        FROM campagne_groupe JOIN segment_groupe JOIN groupes
        ON campagne_groupe.id_groupe = segment_groupe.id_groupe
        AND campagne_groupe.id_groupe = groupes.id_groupe
        WHERE campagne_groupe.id_campagne=' . $ids);

        return view('groupecampagnes.index', ['id_campagne' => $id_campagne], compact('grpecamps', 'ids', 'campagnes', 'id3', 'nbre2', 'nom_campagne', 'groupecampagnes', 'segs', 'cpgrps', 'id_campagne', 'groupes'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
        session(['id_campagne' => 'value']);             // Récupérer la variable appellée dans la session de la table campagnes dans la table campagnegroupe

    }
    /*
    public function getcampagnes(){
        $groupecampagnes=DB::connection('mysql')->table('campagnes')
        ->select('campagnes.id_campagne', 'campagne_groupe.id_groupe', 'groupes.nom', 'campagne_groupe.statut_publication', 'segment_groupe.id_segment', 'campagnes.nom as C')
        ->join('campagne_groupe','campagnes.id_campagne','=','campagne_groupe.id_campagne')
        ->join('groupes','campagne_groupe.id_groupe','=','groupes.id_groupe')
        ->join('segment_groupe','segment_groupe.id_groupe','=','groupes.id_groupe')
        ->orderby('segment_groupe.id_segment','asc')
        ->get();
        return view('groupecampagnes.index',compact('groupecampagnes'));
    }
    */
    /*
    public function getseg(Request $request)
    {
        $search = $request->get('search');
        $groupecampagnes= DB::connection('mysql')->table('campagnes')
        ->select('campagnes.id_campagne', 'campagne_groupe.id_groupe', 'groupes.nom', 'campagne_groupe.statut_publication', 'segment_groupe.id_segment', 'campagnes.nom as C')
        ->join('campagne_groupe','campagnes.id_campagne','=','campagne_groupe.id_campagne')
        ->join('groupes','campagne_groupe.id_groupe','=','groupes.id_groupe')
        ->join('segment_groupe','segment_groupe.id_groupe','=','groupes.id_groupe')
        ->where('id_segment','LIKE','%'.$search.'%')
        ->paginate(100);
        return view('groupecampagnes.index',['groupecampagnes'=>$groupecampagnes]);
    }
*/

    // Direction view create
    public function create()
    {
        return view('groupecampagnes.create');
    }

    // Processus de creation
    public function store(Request $request)
    {
        $request->validate([
            'id_campagne',
            'id_groupe',
            'statut_publication',
            'statut_recherche',
            'traitement_publication',
        ]);

        Groupecampagne::create($request->all());

        return redirect()->route('groupecampagnes.store')
            ->with('success', '');
    }

    // Direction vers le view de details du Groupecampagne
    public function show(Groupecampagne $groupecampagne, segment_groupe $segementgroupe, Campagne $campagne)
    {
        $liste_groupe_campagne = DB::connection('mysql')->select('select id_campagne from campagne_groupe where id_campagne=?', ['$value->id_campagne']);
        

        return view('groupecampagnes.show', compact('groupecampagne', 'liste_groupe_campagne', 'segementgroupe'));
    }

    // Direction vers le view de la modification du Groupecampagne
    public function edit(Groupecampagne $groupecampagne)
    {
        return view('groupecampagnes.edit', compact('groupecampagne'));
    }

    // Processus de modification du Groupecampagne
    /**
     * Write code on Method
     *
     * @return response()
     */

    public function update(Request $request, Groupecampagne $groupecampagne)
    {
        $request->validate([
            'id_campagne',
            'id_groupe',
            'statut_publication',
            'statut_recherche',
            'traitement_publication',

        ]);

        $groupecampagne->update($request->all());

        return redirect()->route('groupecampagnes.index')
            ->with('success', '');
    }

    // Procesuus de la suppression du Groupecampagne
    public function destroy(Groupecampagne $groupecampagne)
    {
        $groupecampagne->delete();
        return redirect()->route('groupecampagnes.index')
            ->with('success', '');
    }

    // Procesuus de ajoute une list groupe segments pour chaque segment dans la table groupe campagne

    //     public function cherchSeg(Groupecampagne $groupecampagne,$id_segment,Campagne $campagne) {
    //        // $seg_group = DB::connection('mysql')->select('select * from segment_groupe where i_segment = ?', ['$id_segment']);
    //        $id_g=$campagne->id_campagne;
    //        $array1=explode(",",$id_g);
    //                     //  $grp_seg = DB::connection('mysql')->select('select id_segment from segment_groupe where id_segment=?',['$seg_choisi']);
    //                      $insertion=  DB::connection('mysql')->table('campagne_groupe')->insert([
    //                         ['id_groupe' => 'select id_segment from segment_groupe where id_segment=?'],
    //                         ['id_campagne'=> $array1[0] ]
    //                    ]);
    // // $insertion=DB::connection('mysql')->insert('insert into campganges_groupe id_groupe  values ('select * from segment_groupe where id_segment=?',['$seg_choisi'])'):
    // // $insertion = DB::connection('mysql')->insert('insert into campgange_groupes (id_groupe) values (select id_groupe from segment_groupe where id_segment=?)');

    //         return view('groupecampagnes',compact('groupecampagne','id_segment','insertion'));

    // return redirect()->route('cherchSeg' , [$id_segment] ,[$seg_group] )
    //                 ->with('success','');
    // }

    // public function insert(Groupecampagne $groupecampagne){

    //     $insertion = Groupecampagne:: OrderBy('id_campagne')->get();
    //     $reqz = Groupecampagne::insertGetID(array('id_groupe' => 'djazia'));


    //   return view('groupecampagnes.insert',compact('groupecampagne', 'insertion','reqz'));
    // }
    // public function insert_camp(Request $request)
    // {


    //     dd("cool");
    // }

    public function recup(Request $request, Groupecampagne $id_campagne, $ids)
    {
        $groupecampagne = new Groupecampagne;
        $groupecampagne->setConnection('mysql');

        $groupes = Groupe::all()->get('groupes.*');
        $grpecamps = Groupecampagne::join('campagnes', 'campagnes.id_campagne', '=', 'campagne_groupe.id_campagne')
            ->get(['campagne_groupe.*', 'campagnes.id_campagne']);

        $segs = DB::connection('mysql')->table('segements')->select('segements.nom_segment', 'segements.id_segment')
            ->get();

        $cpgrps = DB::connection('mysql')->table('campagne_groupe')->select('campagne_groupe.statut_publication')
            ->groupby('campagne_groupe.statut_publication')
            ->get('campagne_groupe');

        $valeur = $request->input('id_segment');

        $gps = DB::connection('mysql')->select('SELECT groupes.id_groupe
                    FROM groupes JOIN segment_groupe JOIN segements
                    ON groupes.id_groupe = segment_groupe.id_groupe
                    AND segment_groupe.id_segment = segements.id_segment
                    WHERE segment_groupe.id_segment =' . $valeur);

        
        $url1 = (int) $request->ids;
        

        // https ://te amfb. lalac hante .fr/r ecup/ 723   (35 en ligne / 28 en local)

        $camps = DB::connection('mysql')->select('SELECT id_campagne FROM campagnes');
        foreach ($camps as $camp => $rang) {
            foreach ($gps as $gp => $val) {
                if ($url1 === $rang->id_campagne) {
                    $ids = DB::connection('mysql')->insert('insert into campagne_groupe (id_groupe, id_campagne) values (?, ?)', [$val->id_groupe, $url1]);
                }
            }
        }

        $camps = DB::connection('mysql')->select('SELECT id_campagne FROM campagnes');
        foreach ($camps as $camp => $rang) {
            if ($url1 === $rang->id_campagne) {
                $nom_campagne = DB::connection('mysql')->select('SELECT nom FROM campagnes WHERE id_campagne=' . $url1);
            } 
        }

        foreach ($camps as $camp => $rang) {
            if ($url1 === $rang->id_campagne) {
                $nbre = DB::connection('mysql')->select('SELECT id_groupe FROM campagne_groupe
                WHERE id_campagne =' . $url1);
                $nbre2 = count($nbre);
            } 
        }

        foreach ($camps as $camp => $rang) {
            if ($url1 === $rang->id_campagne) {
                $ids = $url1;
            } 
        }

        $groupecampagnes = DB::connection('mysql')->select('SELECT campagne_groupe.id_campagne, groupes.id, groupes.nom, campagne_groupe.statut_publication, campagne_groupe.id_groupe, segment_groupe.id_segment
        FROM campagne_groupe JOIN segment_groupe JOIN groupes
        ON campagne_groupe.id_groupe = segment_groupe.id_groupe
        AND campagne_groupe.id_groupe = groupes.id_groupe
        WHERE campagne_groupe.id_campagne=' . $ids);

        session(['id_campagne' => $url1]);
        
        return redirect()->route('groupecampagnes.index',['id_campagne'=>$ids])->with(['segs' => $segs, 'grpecamps' => $grpecamps, 'groupes' => $groupes, 'groupecampagnes' => $groupecampagnes, 'ids' => $ids, 'id_campagne' => $url1, 'nom_campagne' => $nom_campagne, 'nbre2' => $nbre2, 'cpgrps' => $cpgrps])->with('i', (request()->input('page', 1) - 1) * 5);
        
        
    }

    public function ajaxupdate(Request $request, Groupecampagne $id_campagne, $ids)
    {
        $groupecampagne = new Groupecampagne;
        $groupecampagne->setConnection('mysql');


        $id_groupe = $request->input('id_groupe');
        $id_campagne = $request->input('id_campagne');
    
        $data = ['statut_publication' => $request->statut_publication];
        Groupecampagne::where('id_groupe', $id_groupe)->where('id_campagne', $id_campagne)->update($data);

        $groupes = Groupe::all()->get('groupes.*');
        $grpecamps = Groupecampagne::join('campagnes', 'campagnes.id_campagne', '=', 'campagne_groupe.id_campagne')
            ->get(['campagne_groupe.*', 'campagnes.id_campagne']);

        $segs = DB::connection('mysql')->table('segements')->select('segements.nom_segment', 'segements.id_segment')
            ->get();

        $cpgrps = DB::connection('mysql')->table('campagne_groupe')->select('campagne_groupe.statut_publication')
            ->groupby('campagne_groupe.statut_publication')
            ->get('campagne_groupe');

        //$url = $request->fullUrl();
        // http: //127 .0.0. 1:800 0/aja xupda te/ 845    (33 en local)
        // https ://te amfb. lalac hante .fr/a jaxup date/ 845   (40 en ligne)

        
        $url1 = (int) $request->ids;
        
        

        $camps = DB::connection('mysql')->select('SELECT id_campagne FROM campagnes');
        foreach ($camps as $camp => $rang) {
            if ($url1 === $rang->id_campagne) {
                $nom_campagne = DB::connection('mysql')->select('SELECT nom FROM campagnes WHERE id_campagne=' . $url1);
            } 
        }
        

        foreach ($camps as $camp => $rang) {
            if ($url1 === $rang->id_campagne) {
                $nbre = DB::connection('mysql')->select('SELECT id_groupe FROM campagne_groupe
                    WHERE id_campagne =' . $url1);
                $nbre2 = count($nbre);
            } 
        }

        foreach ($camps as $camp => $rang) {
            if ($url1 === $rang->id_campagne) {
                $ids = $url1;
            } 
        }

        $groupecampagnes = DB::connection('mysql')->select('SELECT campagne_groupe.id_campagne, groupes.id, groupes.nom, campagne_groupe.statut_publication, campagne_groupe.id_groupe, segment_groupe.id_segment
        FROM campagne_groupe JOIN segment_groupe JOIN groupes
        ON campagne_groupe.id_groupe = segment_groupe.id_groupe
        AND campagne_groupe.id_groupe = groupes.id_groupe
        WHERE campagne_groupe.id_campagne=' . $ids);

        session(['id_campagne' => $url1]);
        return redirect()->route('groupecampagnes.index',['id_campagne'=>$ids])->with(['segs' => $segs, 'grpecamps' => $grpecamps, 'groupes' => $groupes, 'groupecampagnes' => $groupecampagnes, 'ids' => $ids, 'id_campagne' => $url1, 'nom_campagne' => $nom_campagne, 'nbre2' => $nbre2, 'cpgrps' => $cpgrps])->with('i', (request()->input('page', 1) - 1) * 5);
        
        
    }

    public function supprimer($id, $id_campagne = null)
    {
        $groupecampagne = new Groupecampagne;
        $groupecampagne->setConnection('mysql');
        

        // Récupère le groupe en question
        $groupe = Groupe::find($id);
        // Supprime le groupe de la base de données
        $groupe->delete();

        return redirect()->route('redirection', ['id_campagne'=> $id_campagne]);
    }
}
