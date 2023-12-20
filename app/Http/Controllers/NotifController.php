<?php

namespace App\Http\Controllers;

use App\Models\Groupe;
use App\Models\experienceApp\Notification;
use App\Models\Segement;
use App\Models\Segementation;
use App\Models\segment_groupe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\TextUI\XmlConfiguration\Group;

class NotifController extends Controller
{

    //  Une fois on depasse 5 lignes par tableau Ca d'affiche
    public function index(Request $request)
    {
        $notif = new Notification;
        $notif->setConnection('mysql3');

        $data = DB::connection('mysql3')->select('SELECT * FROM notification');
       
       
        $perPage = $request->get('perPage') ?? 10; // par défaut 10 éléments par page
        $notifs = Notification::orderBy('date', 'DESC')->sortable()->paginate($perPage);
        $data = Notification::orderBy('date', 'DESC')->sortable()->paginate($perPage);
        $value = session('id_notification');
        return view('notif.index', compact('data', 'notifs', 'perPage'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function multisearch(Request $request)
    {

        $multisearchstatut = $request->get('multisearchstatut');
        $multisearchsearch = $request->get('multisearchsearch');
        $multisearchdate = $request->get('multisearchdate');
        $notifs = DB::connection('mysql3')->table('notification')

            ->where('date', 'LIKE', '%' . $multisearchdate . '%')
            ->where('statut', 'LIKE', '%' . $multisearchstatut . '%')
            ->where('recherche', 'LIKE', '%' . $multisearchsearch . '%')
            ->paginate(20);

        return view('notif.index', ['notifs' => $notifs]);
    }



    
}
