<?php

namespace App\Http\Controllers;

use DateTime;
use DateInterval;
use DateTimeZone;
use App\Models\experienceApp\Contact;
use App\Models\Sortable;
use App\Models\Entreprise;
use App\Models\PackExperience;
use App\Models\experienceApp\Experience;
use App\Models\experienceApp\Interaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailConfirmationExperimentateur;
use App\Models\experienceApp\ExperienceStatutNotification;
use App\Models\Notification;
use Carbon\Carbon;
use Google_Service_Drive_DriveFile;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $experience = new Experience;
        $experience->setConnection('mysql2');

        $liste = DB::connection('mysql2')->select('SELECT * from experience');

        $perPage = $request->get('perPage') ?? 10;
        // ---------------------------21.06.23 ------------------------------------------
        $liste_experience_statut = DB::connection('mysql2')->table('experience_statut')->get();
        // ------------------------------------------------
        $statut_experience = $request->get('statut_experience');
        $periode = $request->get('periode');
        $ma_periode = $request->get('ma_periode');
        $la_periode = null;
        // dd($request);
        // **********************************
        // Temps actuel
        $now = Carbon::now();
        switch ($periode) {
            case 'oneWeek':
                // enlever 1 semaine
                $la_periode = $now->copy()->subWeek();
                break;
            case 'oneMonth':
                // enlever 1 mois
                $la_periode = $now->copy()->subMonth();
                break;
            case 'oneQuarter':
                // enlever 1 trimestre (3 mois)
                $la_periode = $now->copy()->subQuarter();
                break;
            case 'oneYear':
                // enlever 1 an
                $la_periode = $now->copy()->subYear();
                break;
            case 'all':
                $la_periode = Carbon::create(2016, 1, 1, 0, 0, 0);
                break;
        }
        // **********************************
        // $la_periode_multi_crit = $la_periode;
        $multisearchnom = $request->get('multisearchnom');
        $multisearchtel = $request->get('multisearchtel');
        $multisearchstat = $request->get('multisearchstat');
        // ------------------------------------------------
        $data = DB::connection('mysql2')->table('experience')
            // ------------- yasser --------------
            ->orderByDesc('experience.id_experience')
            // ------------- yasser --------------
            ->join('pack_experience', 'experience.id_experience', '=', 'pack_experience.id_experience')
            ->join('factures', 'factures.num_facture', '=', 'pack_experience.num_facture')
            ->join(DB::raw("(SELECT id_experience, id_statut_experience AS id_statut_experience
            FROM experience_statut_notification
            WHERE `date_statut` IN (
                SELECT MAX(`date_statut`)
                FROM experience_statut_notification
                GROUP BY id_experience
            )) AS exp_stat_notif"), function ($join) {
                $join->on("pack_experience.id_experience", "=", "exp_stat_notif.id_experience");
            })
            ->join(DB::raw("(SELECT num_facture, MAX(id_facture_statut) AS id_facture_statut
                FROM facture_statut_notification
                GROUP BY num_facture) AS fact_stat_notif"), function ($join) {
                $join->on("factures.num_facture", "=", "fact_stat_notif.num_facture");
            })
            ->join('facture_statut', 'fact_stat_notif.id_facture_statut', '=', 'facture_statut.id_facture_statut')
            ->join('experience_statut', 'exp_stat_notif.id_statut_experience', '=', 'experience_statut.id_statut_experience')
            ->paginate($perPage);
        // dd($data);
        // ________________ 28.06.23 ________________________
        $query = DB::connection('mysql2')->table('experience')
            ->join('pack_experience', 'experience.id_experience', '=', 'pack_experience.id_experience')
            ->join('factures', 'factures.num_facture', '=', 'pack_experience.num_facture')
            ->join(DB::raw("(SELECT id_experience, id_statut_experience AS id_statut_experience
                    FROM experience_statut_notification
                    WHERE `date_statut` IN (
                        SELECT MAX(`date_statut`)
                        FROM experience_statut_notification
                        GROUP BY id_experience
                    )) AS exp_stat_notif"), function ($join) {
                $join->on("pack_experience.id_experience", "=", "exp_stat_notif.id_experience");
            })
            ->join(DB::raw("(SELECT num_facture, MAX(id_facture_statut) AS id_facture_statut
                    FROM facture_statut_notification
                    GROUP BY num_facture) AS fact_stat_notif"), function ($join) {
                $join->on("factures.num_facture", "=", "fact_stat_notif.num_facture");
            })
            ->join('facture_statut', 'fact_stat_notif.id_facture_statut', '=', 'facture_statut.id_facture_statut')
            ->join('experience_statut', 'exp_stat_notif.id_statut_experience', '=', 'experience_statut.id_statut_experience');

        // ***************************************
        $count_stats = [];
        foreach ($liste_experience_statut as $statut) {
            $count_query = clone $query;
            $count_query->where('experience_statut.statut_experience', '=', $statut->statut_experience);
            $count = $count_query->count();

            $count_stats[$statut->statut_experience] = [
                'count' => $count,
                'date' => Carbon::create(2016, 1, 1, 0, 0, 0),
            ];
        }
        // var_dump($count_stats);

        // -----------------------------------------------------
        if (isset($multisearchnom) || isset($multisearchtel)  || isset($multisearchstat)) {
            // dd($periode);
            $data = DB::connection('mysql2')->table('experience')
                ->orderByDesc('experience.id_experience')
                ->join('pack_experience', 'experience.id_experience', '=', 'pack_experience.id_experience')
                ->join('factures', 'factures.num_facture', '=', 'pack_experience.num_facture')
                ->join(DB::raw("(SELECT id_experience, id_statut_experience AS id_statut_experience,date_statut
                FROM experience_statut_notification
                WHERE `date_statut` IN (
                    SELECT MAX(`date_statut`)
                    FROM experience_statut_notification
                    GROUP BY id_experience
                )) AS exp_stat_notif"), function ($join) {
                    $join->on("pack_experience.id_experience", "=", "exp_stat_notif.id_experience");
                })
                ->join(DB::raw("(SELECT num_facture, MAX(id_facture_statut) AS id_facture_statut
                    FROM facture_statut_notification
                    GROUP BY num_facture) AS fact_stat_notif"), function ($join) {
                    $join->on("factures.num_facture", "=", "fact_stat_notif.num_facture");
                })
                ->join('facture_statut', 'fact_stat_notif.id_facture_statut', '=', 'facture_statut.id_facture_statut')
                ->join('experience_statut', 'exp_stat_notif.id_statut_experience', '=', 'experience_statut.id_statut_experience')
                ->when($la_periode, function ($query, $la_periode) {
                    return $query->whereBetween('date_statut', [
                        $la_periode->format('Y-m-d H:i:s'),
                        Carbon::now()->format('Y-m-d H:i:s')
                    ]);
                })
                ->when($multisearchstat, function ($query, $multisearchstat) {
                    return $query->where('experience_statut.statut_experience', '=', $multisearchstat);
                })
                ->paginate($perPage);
            // dd($data);

        }
        // ---------------------------21.06.23 ------------------------------------------
        // ----------------------------------------29.06.23-----------------------------------------------
        if (isset($la_periode)) {
            // dd($la_periode);
            $query_1 = DB::connection('mysql2')->table('experience')
                ->orderByDesc('experience.id_experience')
                ->join('pack_experience', 'experience.id_experience', '=', 'pack_experience.id_experience')
                ->join('factures', 'factures.num_facture', '=', 'pack_experience.num_facture')
                ->join(DB::raw("(SELECT id_experience, id_statut_experience AS id_statut_experience,date_statut
                FROM experience_statut_notification
                WHERE `date_statut` IN (
                    SELECT MAX(`date_statut`)
                    FROM experience_statut_notification
                    GROUP BY id_experience
                )) AS exp_stat_notif"), function ($join) {
                    $join->on("pack_experience.id_experience", "=", "exp_stat_notif.id_experience");
                })
                ->join(DB::raw("(SELECT num_facture, MAX(id_facture_statut) AS id_facture_statut
                    FROM facture_statut_notification
                    GROUP BY num_facture) AS fact_stat_notif"), function ($join) {
                    $join->on("factures.num_facture", "=", "fact_stat_notif.num_facture");
                })
                ->join('facture_statut', 'fact_stat_notif.id_facture_statut', '=', 'facture_statut.id_facture_statut')
                ->join('experience_statut', 'exp_stat_notif.id_statut_experience', '=', 'experience_statut.id_statut_experience')
                //
                ->when($la_periode, function ($query, $la_periode) {
                    return $query->whereBetween('date_statut', [
                        $la_periode->format('Y-m-d H:i:s'),
                        Carbon::now()->format('Y-m-d H:i:s')
                    ]);
                });


            $count_stats = [];
            foreach ($liste_experience_statut as $statut) {
                $count_query = clone $query_1;
                $count_query->where('experience_statut.statut_experience', '=', $statut->statut_experience);
                $count = $count_query->count();

                $count_stats[$statut->statut_experience] = [
                    'count' => $count,
                    'date' => $la_periode,
                ];
            }
            $data = $query_1->paginate($perPage);
        }
        if (isset($statut_experience) && isset($ma_periode)) {
            // dd($ma_periode);
            $data = DB::connection('mysql2')->table('experience')
                ->orderByDesc('experience.id_experience')
                ->join('pack_experience', 'experience.id_experience', '=', 'pack_experience.id_experience')
                ->join('factures', 'factures.num_facture', '=', 'pack_experience.num_facture')
                ->join(DB::raw("(SELECT id_experience, id_statut_experience AS id_statut_experience,date_statut
                FROM experience_statut_notification
                WHERE `date_statut` IN (
                    SELECT MAX(`date_statut`)
                    FROM experience_statut_notification
                    GROUP BY id_experience
                )) AS exp_stat_notif"), function ($join) {
                    $join->on("pack_experience.id_experience", "=", "exp_stat_notif.id_experience");
                })
                ->join(DB::raw("(SELECT num_facture, MAX(id_facture_statut) AS id_facture_statut
                    FROM facture_statut_notification
                    GROUP BY num_facture) AS fact_stat_notif"), function ($join) {
                    $join->on("factures.num_facture", "=", "fact_stat_notif.num_facture");
                })
                ->join('facture_statut', 'fact_stat_notif.id_facture_statut', '=', 'facture_statut.id_facture_statut')
                ->join('experience_statut', 'exp_stat_notif.id_statut_experience', '=', 'experience_statut.id_statut_experience')
                //
                ->when($ma_periode, function ($query, $ma_periode) {
                    return $query->whereBetween('date_statut', [
                        $ma_periode,
                        Carbon::now()->format('Y-m-d H:i:s')
                    ]);
                })
                ->when($statut_experience, function ($query, $statut_experience) {
                    return $query->where('experience_statut.statut_experience', '=', $statut_experience);
                })
                ->paginate($perPage);
            // dd($data);

        }

        // ----------------------------------------29.06.23-----------------------------------------------

        $statut_experience = DB::connection('mysql2')->table('experience_statut_notification')
            ->join('experience_statut', 'experience_statut_notification.id_statut_experience', '=', 'experience_statut.id_statut_experience')
            ->orderByDesc('experience_statut_notification.id_notification')
            ->get();

        $statut_facture = DB::connection('mysql2')->table('facture_statut_notification')
            ->join('facture_statut', 'facture_statut_notification.id_facture_statut', '=', 'facture_statut.id_facture_statut')
            ->orderByDesc('facture_statut_notification.id_notification')
            ->get();
        $totalExp =  $data->total();



        /*
            $data = Experience::sortable()->paginate($perPage);
            $value = session('id_experience');  // Stocker la variable dans la session de la table campagne
        */
        // $reservations = Reservationclient::sortable()->paginate(15)->withQueryString();


        return view('experience.index', compact('liste', 'data', 'perPage', 'statut_experience', 'statut_facture', 'totalExp', 'count_stats'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('experience.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (isset($request->id_experience)) {
            DB::connection('mysql2')->table('experience')->insert(
                ['id_experience' => $request->id_experience,]
            );
        } else {
            echo "Service not stored";
        }

        return redirect()->route('experience.index')
            ->with('success', '');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function show(Request $request)
    {
        $experience = new Experience;
        $experience->setConnection('mysql2');

        $num_fact = DB::connection('mysql2')->select('SELECT id_experience FROM experience');

        $dbs = DB::connection('mysql2')->select('SELECT id_experience, nom_experience, statut_experience, histoire_experience, url_experience_folder
                    FROM experience');
        // dd($dbs);
        return view('experience.show', compact('dbs'));
    }*/

    /*public function show()
    {
        return view('experience.show');
    }*/

    public function show($id_experience, $num_facture,Request $request)
    {   
        // récuperer les liste des médias
        $experience=Experience::findorfail($id_experience);
        $experienceMedias=null;
        //on récupère les medias
        if($experience->getMedia("*")){
            $experienceMedias=$experience->getMedia("*")->reverse();
        }
        // supprimer le fichier au clique du bouton "trash"
        if($request->has('delete_file')){
            $media=$experience->getMedia("*")->find($request->input('delete_file'));
            // suppression du media
            $media->delete();
            // suppression success
                    $delete_success='Le contenu a été supprimé';
                    
                    // Stockez la variable $success_image dans la session flash
                    session()->flash('error', $delete_success);
            return redirect()->back();
        }
        //dd($experience->getMedia("*"));
        $modelexp = new Experience;
        $modelexp->setConnection('mysql2');
        $id_exp = DB::connection('mysql2')->select('SELECT id_experience FROM experience');

        //
        // http: //127 .0.0. 1:800 0/res ervat ioncl ient. show? 1  (45 en local)
        // https ://te amfb. lalac hante .fr/r eserv ation clien t.sho w? 1  (52 en ligne)
        $url1 = (int) $id_experience;
        $url = $url1;

        foreach ($id_exp as $key => $value) {
            if ($url1 === $value->id_experience) {
                $url = $url1;
            }
        }


        $num_fact = DB::connection('mysql2')->select('SELECT num_facture FROM factures');

        //
        // http: //127 .0.0. 1:800 0/res ervat ioncl ient. show? 1  (45 en local)
        // https ://te amfb. lalac hante .fr/r eserv ation clien t.sho w? 1  (52 en ligne)
        $fact1 = (int) $num_facture;
        $fact = $fact1;

        foreach ($num_fact as $key => $value) {
            if ($fact1 === $value->num_facture) {
                $fact = $fact1;
            }
        }

        $clients = DB::connection('mysql2')->select(
            'SELECT contact.id_contact,contact.tel,contact.nom,contact.prenom,contact.email,contact.adresse,contact.code_postal,contact.ville,contact_experience.profil
        FROM contact JOIN contact_experience JOIN experience
        ON contact_experience.id_experience=experience.id_experience
        AND contact_experience.id_contact=contact.id_contact
        WHERE experience.id_experience=?
        AND (contact_experience.profil="Client" OR contact_experience.profil="Client-User")',
            [$url]
        );

        $experimentateurs = DB::connection('mysql2')->select(
            'SELECT contact.id_contact,contact.tel,contact.nom,contact.prenom,contact.email,contact.adresse,contact.code_postal,contact.ville,contact_experience.profil
        FROM contact JOIN contact_experience JOIN experience
        ON contact_experience.id_experience=experience.id_experience
        AND contact_experience.id_contact=contact.id_contact
        WHERE experience.id_experience=?
        AND (contact_experience.profil="User" OR contact_experience.profil="Client-User")',
            [$url]
        );
        // dump($experimentateurs);

        $contacts = DB::connection('mysql2')->table('contact')
            ->join('contact_experience', 'contact.id_contact', '=', 'contact_experience.id_contact')
            ->where('contact_experience.id_experience', '=', $url)
            ->get();

        $experience = DB::connection('mysql2')->select('SELECT experience.*,pack.nom,pack_experience.nb_titres,pack_experience.nb_participants
            FROM experience JOIN pack_experience JOIN pack
            ON pack.id_pack=pack_experience.id_pack
            AND pack_experience.id_experience=experience.id_experience
            WHERE experience.id_experience=? AND pack_experience.num_facture=?', [$url, $fact]);
        // $histoire = DB::connection('mysql2')->select('SELECT histoire_experience From experience WHERE experience.id_experience=', [$id_experience]);
        // dd($histoire);
        // $histoire = DB::connection('mysql2')->select('SELECT histoire_experience, experience.id_experience,experience.nom_experience
        // From experience JOIN pack_experience
        // on experience.id_experience=pack_experience.id_experience

        // WHERE experience.id_experience='.$id_experience);

        $experiences_liees = DB::connection('mysql2')->select('SELECT experience.id_experience,experience.nom_experience
        FROM experience JOIN pack_experience JOIN factures
        ON factures.num_facture=pack_experience.num_facture
        AND experience.id_experience=pack_experience.id_experience
        WHERE pack_experience.num_facture=?', [$fact]);

        $bon_cadeau = DB::connection('mysql2')->select('SELECT bon_cadeau.nom_destinataire,bon_cadeau.titre,bon_cadeau.message
        FROM bon_cadeau JOIN contents_experience JOIN experience
        ON bon_cadeau.id_content_experience=contents_experience.id_content_experience
        AND contents_experience.id_experience=experience.id_experience
        WHERE  experience.id_experience=?', [$url]);

        $facture = DB::connection('mysql2')->select('SELECT DISTINCT pack.nom,pack_experience.nb_titres,pack_experience.nb_participants,experience_statut.statut_experience,factures.num_facture
        FROM experience JOIN experience_statut
        JOIN pack_experience
        JOIN pack JOIN factures
        JOIN (
            SELECT id_experience, MAX(id_statut_experience) AS id_statut_experience
            FROM experience_statut_notification
            GROUP BY id_experience) AS exp_stat_notif ON pack_experience.id_experience = exp_stat_notif.id_experience
        AND exp_stat_notif.id_statut_experience=experience_statut.id_statut_experience
        AND experience.id_experience=pack_experience.id_experience
        AND pack_experience.id_pack=pack.id_pack
        AND pack_experience.num_facture=factures.num_facture
        WHERE experience.id_experience=?
        AND pack_experience.num_facture=?
        ', [$url, $fact]);

        $autres_prestations = DB::connection('mysql2')->select('SELECT produits_services.nom_produit
        FROM experience JOIN produits_services JOIN autre_prestation_experience JOIN pack_experience JOIN factures
        ON experience.id_experience=pack_experience.id_experience
        AND autre_prestation_experience.id_produit=produits_services.id_produit
        AND autre_prestation_experience.id_pack_experience=pack_experience.id_pack_experience
        AND pack_experience.num_facture=factures.num_facture
        WHERE experience.id_experience=?
        AND pack_experience.num_facture=?', [$url, $fact]);

        $histoire = DB::connection('mysql2')->select('SELECT histoire_experience From experience WHERE id_experience=?', [$id_experience]);
        //dump($histoire);


        $storytelling = DB::connection('mysql2')->select('SELECT storytelling.id_storytelling,storytelling.description, contents_experience.date_heure
        FROM storytelling JOIN contents_experience JOIN experience
        ON storytelling.id_content_experience=contents_experience.id_content_experience
        AND contents_experience.id_experience=experience.id_experience
        WHERE experience.id_experience=?
        ORDER BY contents_experience.date_heure DESC', [$url]);


        $evenements = DB::connection('mysql2')->select('SELECT notification.contenu_notification,notification.date_notification,experience_statut_notification.date_statut
        FROM experience_statut_notification JOIN notification JOIN experience
        ON experience_statut_notification.id_notification=notification.id_notification
        AND experience_statut_notification.id_experience=experience.id_experience
        WHERE experience.id_experience=?
        ORDER BY experience_statut_notification.date_statut DESC', [$url]);


        $interactions = DB::connection('mysql2')->select('SELECT interaction.date_heure,interaction.texte,interaction.id_interaction
        FROM interaction JOIN experience
        ON interaction.id_experience=experience.id_experience
        WHERE experience.id_experience=?
        ORDER BY interaction.date_heure DESC', [$url]);
        //dump($interactions);

        $statut_experience = DB::connection('mysql2')->table('experience_statut_notification')
            ->join('experience_statut', 'experience_statut_notification.id_statut_experience', '=', 'experience_statut.id_statut_experience')
            ->where('experience_statut_notification.id_experience', $url)
            ->orderByDesc('experience_statut_notification.id_notification')
            ->first();

        $statut_facture = DB::connection('mysql2')->table('facture_statut_notification')
            ->join('facture_statut', 'facture_statut_notification.id_facture_statut', '=', 'facture_statut.id_facture_statut')
            ->where('facture_statut_notification.num_facture', $fact)
            ->orderByDesc('facture_statut_notification.id_notification')
            ->first();

        $id_con = DB::connection('mysql2')->select('SELECT id_contact,nom,prenom FROM contact');

        $id_org = Entreprise::where('id_organisation', '>', 0)->pluck('id_organisation')->toArray();
        $nom_org =  Entreprise::where('id_organisation', '>', 0)->pluck('nom')->toArray();

        $events = DB::connection('mysql2')->table('evenement')
            ->where('id_experience', '=', $url)
            ->get();

        $bons = DB::connection('mysql2')->table('bon_cadeau')
            ->join('contents_experience', 'contents_experience.id_content_experience', '=', 'bon_cadeau.id_content_experience')
            ->where('id_experience', '=', $url)
            ->get();

        $livrables = DB::connection('mysql2')->table('livrables')
            ->join('contents_experience', 'contents_experience.id_content_experience', '=', 'livrables.id_content_experience')
            ->where('id_experience', '=', $url)
            ->get();

        $media = DB::connection('mysql2')->table('medias_lalachante')
            ->join('contents_experience', 'contents_experience.id_content_experience', '=', 'medias_lalachante.id_content_experience') 
            ->where('id_experience', '=', $url)
            ->get();

        $stories = DB::connection('mysql2')->table('storytelling')
            ->join('contents_experience', 'contents_experience.id_content_experience', '=', 'storytelling.id_content_experience')
            ->where('id_experience', '=', $url)
            ->get();
        $ExpFolder = DB::connection('mysql2')->table('experience')
            ->where('experience.id_experience', '=', $url)
            ->select('url_experience_folder')
            ->get();

        // -------------------------------------yasser--------------------------------------------------
        // ----------tags_interaction--------------
        $les_tags_lier_avec_inter = DB::connection('mysql2')->table('tag_interaction')
            ->join('interaction_tag', 'tag_interaction.id_tag_interaction', '=', 'interaction_tag.id_tag_interaction')
            ->orderByDesc('tag_interaction.id_tag_interaction')
            ->get();
        // ----------tags_interaction--------------
        // ----------tags_storytelling--------------
        $les_tags_lier_avec_story = DB::connection('mysql2')->table('tag_story')
            ->join('tag_storytelling', 'tag_story.id_tag_story', '=', 'tag_storytelling.id_tag_story')
            ->orderByDesc('tag_story.id_tag_story')
            // ->groupBy('tag_interaction.tag')
            ->get();
        // dd($les_tags_lier_avec_story);
        // ----------tags_storytelling--------------
        // -------------------------------------yasser--------------------------------------------------

        // Appel d'une fonction pour récupérer le lien de la cagnotte
        $cagnotteLink = $this->getCagnotteLink($id_experience);

        return view('experience.show', [
            'id_experience' => $url, 'num_facture' => $fact, 'clients' => $clients, 'experimentateurs' => $experimentateurs, 'experience' => $experience,
            'bon_cadeau' => $bon_cadeau, 'facture' => $facture, 'autres_prestations' => $autres_prestations, 'histoire' => $histoire,
            'storytelling' => $storytelling, 'evenements' => $evenements, 'interactions' => $interactions, 'experiences_liees' => $experiences_liees, 'statut_experience' => $statut_experience,
            'statut_facture' => $statut_facture, 'contacts' => $contacts, 'id_con' => $id_con, 'id_org' => $id_org, 'nom_org' => $nom_org, 'events' => $events, 'bons' => $bons, 'livrables' => $livrables,
            'media' => $media, 'stories' => $stories, 'ExpFolder' => $ExpFolder, 'les_tags_lier_avec_inter' => $les_tags_lier_avec_inter, 'les_tags_lier_avec_story' => $les_tags_lier_avec_story,
            'cagnotteLink' => $cagnotteLink,'experienceMedias'=>$experienceMedias,
        ]);
    }


    private function getCagnotteLink($id_experience)
    {
        // Supposons que vous avez une relation "belongsTo" dans le modèle Experience
        // pour accéder à la cagnotte associée
        $experience = Experience::findOrFail($id_experience);
        $cagnotte = $experience->cagnotte;

        // Vérifiez si la relation a été définie
        if ($cagnotte) {
            // Si la relation existe, construisez le lien vers la page "show" de la cagnotte
            $cagnotteLink = route('cagnottes.show', ['id_cagnotte' => $cagnotte->id_projet]);

            return $cagnotteLink;
        }

        // Si la cagnotte n'est pas associée à l'expérience, retournez une valeur par défaut ou une URL d'erreur
        return '';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     */
    //Ilham
    public function updateNameHistoire(Request $request, $id_experience, $num_facture)
    { {
            $request->validate([
                "histoire_experience" => "required",
            ]);

            $experience = Experience::find($id_experience);
            $experience->histoire_experience = $request->input('histoire_experience');
            $experience->save();

            return redirect()->route('experience.show', ['id_experience' => $id_experience, 'num_facture' => $num_facture])
                ->with("experience.show", "Historique modifiée avec succès !");
        }
    }

    //ILham


    public function edit($id_experience, $num_facture)
    {

        $experience = DB::connection('mysql2')->table('experience')
            ->join('experience_statut_notification', 'experience.id_experience', '=', 'experience_statut_notification.id_experience')
            ->join('experience_statut', 'experience_statut_notification.id_statut_experience', '=', 'experience_statut.id_statut_experience')
            ->where('experience.id_experience', $id_experience)->orderByDesc('experience_statut_notification.id_notification')
            ->first();

        $statuts = DB::connection('mysql2')->table('experience_statut')->get();

        $pack_experience = DB::connection('mysql2')->table('pack_experience')
            ->where('pack_experience.id_experience', $id_experience)
            ->first();

        // dd($pack_experience);

        return view('experience.edit', compact('experience', 'statuts', 'id_experience', 'num_facture', 'pack_experience'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_experience, $num_facture)
    {
        $request->validate([
            'current_stat' => 'required|exists:mysql2.experience_statut,id_statut_experience',
            'exp_stat' => 'required|exists:mysql2.experience_statut,id_statut_experience',
            'date_reservation' => 'required_with:heure_reservation,duree_reservation|nullable|date_format:Y-m-d',
            'heure_reservation' => 'nullable|date_format:H:i:s|required_with:date_reservation,duree_reservation',
            'duree_reservation' => 'nullable|date_format:H:i:s|required_with:date_reservation,date_reservation'
        ]);
        $experience = Experience::find($id_experience);

        if ($request->current_stat != $request->exp_stat) {
            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
            $current_date->setTimestamp($timestamp);
            $old_stat = DB::connection('mysql2')->table('experience_statut')
                ->where('id_statut_experience', $request->current_stat)
                ->first();
            $new_stat = DB::connection('mysql2')->table('experience_statut')
                ->where('id_statut_experience', $request->exp_stat)
                ->first();



            $notif_text = "L'experience " . $experience->nom_experience . " passe du statut " . $old_stat->statut_experience . " au statut " . $new_stat->statut_experience . " le " .  $current_date->format('Y-m-d H:i:s') . " ";


            $notification = DB::connection('mysql2')->table('notification')
                ->insert([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'experience'
                ]);
            $latest_notification = DB::connection('mysql2')->selectOne('SELECT id_notification FROM notification ORDER BY id_notification DESC');


            $exp_stat_notif = DB::connection('mysql2')->table('experience_statut_notification')
                ->insert([
                    'id_notification' => $latest_notification->id_notification,
                    'date_statut' => $current_date->format('Y-m-d H:i:s'),
                    'id_experience' => $experience->id_experience,
                    'id_statut_experience' => $request->exp_stat
                ]);

            switch ($request->exp_stat) {
                case 2:
                    $type_evenement = 'Prise de contact';
                    break;
                case 3:
                    $type_evenement = 'Speetch experience';
                    break;
                case 4:
                    $type_evenement = 'Interaction (pré experience)';
                    break;
                case 0:
                    $type_evenement = 'Reservation date';
                    break;
                case 5:
                    $type_evenement = 'Record date';
                    break;
                case -1:
                    $type_evenement = 'Période studio experience';
                    break;
                case 6:
                    $type_evenement = 'Livraison chanson Experience';
                    break;
                case 7:
                    $type_evenement = 'Sucess post Experience';
                    break;
                default:
                    $type_evenement = null;
                    break;
            }

            if (!is_null($type_evenement)) {
                $count_event = DB::connection('mysql2')->table('evenement')
                    ->where('type_evenement', '=', $type_evenement)
                    ->where('id_experience', '=', $id_experience)
                    ->count();
            } else {
                $count_event = 2;
            }

            if ($count_event == 0) {

                $timestamp = time();
                $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
                $current_date->setTimestamp($timestamp);
                $notif_text = 'Création d\'un nouveau événement de type ' . $type_evenement . ' associé à l\'experience de ID ' . $id_experience . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

                $notification = DB::connection('mysql2')->table('notification')
                    ->insertGetId([
                        'contenu_notification' => $notif_text,
                        'date_notification' => $current_date->format('Y-m-d H:i:s'),
                        'type' => 'evenement'
                    ]);

                $date_evenement = $current_date->format('Y-m-d H:i:s');

                if ($type_evenement == "Record date") {
                    $evenement = DB::connection('mysql2')->table('evenement')
                        ->insert([
                            'type_evenement' => $type_evenement,
                            'date_evenement' => $request->date_reservation . ' ' . $request->heure_reservation,
                            'id_experience' => $id_experience
                        ]);

                    $count_event = DB::connection('mysql2')->table('evenement')
                        ->where('type_evenement', '=', 'Livraison chanson Experience')
                        ->where('id_experience', '=', $id_experience)
                        ->count();

                    if ($count_event == 0) {
                        $timestamp = time();
                        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
                        $current_date->setTimestamp($timestamp);
                        $notif_text = 'Création d\'un nouveau événement de type Livraison chanson Experience associé à l\'experience de ID ' . $id_experience . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

                        $notification = DB::connection('mysql2')->table('notification')
                            ->insertGetId([
                                'contenu_notification' => $notif_text,
                                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                                'type' => 'evenement'
                            ]);

                        $date_livraison = date_create($date_evenement);
                        date_add($date_livraison, date_interval_create_from_date_string("15 days"));


                        $evenement = DB::connection('mysql2')->table('evenement')
                            ->insert([
                                'type_evenement' => "Livraison chanson Experience",
                                'date_evenement' => date_format($date_livraison, "Y-m-d H:i:s"),
                                'id_experience' => $id_experience
                            ]);
                    }
                } else {
                    $evenement = DB::connection('mysql2')->table('evenement')
                        ->insert([
                            'type_evenement' => $type_evenement,
                            'date_evenement' => $date_evenement,
                            'id_experience' => $id_experience
                        ]);
                }
            } elseif ($count_event == 1) {
                $id_evenement = DB::connection('mysql2')->table('evenement')
                    ->where('type_evenement', '=', $type_evenement)
                    ->where('id_experience', '=', $id_experience)
                    ->first()->id_evenement;

                $timestamp = time();
                $current_date = new DateTime("now", new DateTimeZone('Europe/Paris')); //first argument "must" be a string
                $current_date->setTimestamp($timestamp); //adjust the object to correct timestamp
                $notif_text = 'Mise à jour de l\'événement nouveau évenement de type ' . $id_evenement . ' associé à l\'experience de ID ' . $id_experience . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

                $notification = DB::connection('mysql2')->table('notification')
                    ->insertGetId([
                        'contenu_notification' => $notif_text,
                        'date_notification' => $current_date->format('Y-m-d H:i:s'),
                        'type' => 'evenement'
                    ]);

                $date_evenement = $current_date->format('Y-m-d H:i:s');

                $evenement = DB::connection('mysql2')->table('evenement')
                    ->where('id_evenement', '=', $id_evenement)
                    ->update([
                        'type_evenement' => $type_evenement,
                        'date_evenement' => $request->date_evenement
                    ]); 
            }
        }
        /*      
        if (!is_null($request->date_reservation)) {
            $date_reservation = $request->date_reservation;
            $heure_reservation = $request->heure_reservation;
            $duree_reservation = $request->duree_reservation;

            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
            $current_date->setTimestamp($timestamp);
            $notif_text = "Mise à jour de la réservation de l'experience " . $experience->nom_experience . " le " .  $current_date->format('Y-m-d H:i:s') . "";


            $notification = DB::connection('mysql2')->table('notification')
                ->insert([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'experience'
                ]);
            $exp = DB::connection('mysql2')->table('experience')
                ->where('id_experience', '=', $id_experience)->update([
                    'date_reservation' => $date_reservation,
                    'heure_reservation' => $heure_reservation,
                    'duree_reservation' => $duree_reservation,
                    'date_update' => $current_date->format('Y-m-d H:i:s')
                
                ]);

            $summary = 'Session Enregistrement ' . $experience->nom_experience;
            // dd($summary);
            $location = 'Toulouse LalaChante';
            $start = $date_reservation . 'T' . $heure_reservation;
            // dd($duree_reservation);
            $end = new DateTime($start);
            $time = DateTime::createFromFormat('H:i:s', $duree_reservation);
            $end = $end->add(new DateInterval('PT' . $time->format('H') . 'H' . $time->format('i') . 'M' . $time->format('s') . 'S'));
            $end =  $end->format('Y-m-d\TH:i:s');
            $date_livraison_defaut = new DateTime($end);
            $date_livraison_defaut->modify('+15 days');
            $date_livraison_defaut =  $date_livraison_defaut->format('Y-m-d\TH:i:s');
            // dd($date_livraison_defaut);
            // dd($end);
            $calendarId = '5bea421ea0518ff606569e12bec10ffa8f8baf1f7280e095efa07db852cf4e2d@group.calendar.google.com';
            $event = GoogleCalendarController::class::createEvent($summary, $location, $start, $end, $calendarId);
            $event = GoogleCalendarController::class::createEvent($summary, $location, $date_livraison_defaut, $date_livraison_defaut, $calendarId);
        }*/
        //Ilham
        // if ($request->has('histoire_experience')) {
        //     // Enregistrez l'historique avant de mettre à jour l'histoire
        //     $this->enregistrerHistorique($id_experience);

        //     // Mettez à jour l'histoire dans la table experience
        //     DB::connection('mysql2')->table('experience')
        //         ->where('id_experience', $id_experience)
        //         ->update(['histoire_experience' => $request->histoire_experience]);
        // }
        //Ilham



        return redirect()->route('experience.show', compact('id_experience', 'num_facture'))
            ->with('success', 'La mise a jour a bien été effectuée !');
    }

    public function updateDateReservation(Request $request)
    {

        
        $request->validate([
            'date_reservation' => 'required|date_format:Y-m-d',
            'heure_reservation' => 'required|date_format:H:i:s',
            'duree_reservation' => 'required|date_format:H:i:s'
        ]);

        $id_experience = $request->id_experience;
        $num_facture = $request->num_facture;
        $experience = Experience::find($request->id_experience);
        //dd($request);

        $date_reservation = $request->date_reservation;
        $heure_reservation = $request->heure_reservation;
        $duree_reservation = $request->duree_reservation;

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $notif_text = "Mise à jour de la réservation de l'experience " . $experience->nom_experience . " le " .  $current_date->format('Y-m-d H:i:s') . "";

        $notification = DB::connection('mysql2')->table('notification')
        ->insertGetId([
            'contenu_notification' => $notif_text,
            'date_notification' => $current_date->format('Y-m-d H:i:s'),
            'type' => 'experience'
        ]);
        $experienceStatusNotification = DB::connection('mysql2')->table('experience_statut_notification')
        ->insert([
            'id_notification' => $notification,
            'date_statut' => $current_date->format('Y-m-d H:i:s'),
            'id_experience' => $experience->id_experience,
            'id_statut_experience' => 5]);

    $exp = DB::connection('mysql2')->table('experience')
        ->where('id_experience', '=', $experience->id_experience)->update([
            'date_reservation' => $date_reservation,
            'heure_reservation' => $heure_reservation,
            'duree_reservation' => $duree_reservation,
            'date_update' => $current_date->format('Y-m-d H:i:s')
        
        ]);

        $event = DB::connection('mysql2')->table('evenement')
        ->where('type_evenement', '=', 'Record date')
        ->where('id_experience', '=', $id_experience);
        
    if ($event == null) {
          $evenement = DB::connection('mysql2')->table('evenement')
                            ->insert([
                                'type_evenement' => "Record date",
                                'date_evenement' => $date_reservation . ' ' . $heure_reservation,
                                'id_experience' => $id_experience
                            ]);
                        } else { 
                            $evenement = DB::connection('mysql2')->table('evenement')
                            ->where('type_evenement', '=', 'Record date')
                            ->where('id_experience', '=', $id_experience)
                            ->update([
                                'type_evenement' => "Record date",
                                'date_evenement' => $date_reservation . ' ' . $heure_reservation,
                                'id_experience' => $id_experience
                            ]);
                        }
                        $event = DB::connection('mysql2')->table('evenement')
                        ->where('type_evenement', '=', 'Reservation date')
                        ->where('id_experience', '=', $id_experience);
    if ($event == null) {
             $evenement = DB::connection('mysql2')->table('evenement')
                            ->insert([
                                'type_evenement' => "Reservation date",
                                'date_evenement' => $current_date->format('Y-m-d H:i:s'),
                                'id_experience' => $id_experience
                            ]);
                        } else {
                            $evenement = DB::connection('mysql2')->table('evenement')
                            ->where('type_evenement', '=', 'Reservation date')
                            ->where('id_experience', '=', $id_experience)
                            ->update([
                                'type_evenement' => "Reservation date",
                                'date_evenement' => $current_date->format('Y-m-d H:i:s'),
                                'id_experience' => $id_experience
                            ]);
                        }

    $summary = 'Session Enregistrement ' . $experience->nom_experience;
    // dd($summary);
    $location = 'Toulouse LalaChante';
    $start = $date_reservation . 'T' . $heure_reservation;
    // dd($duree_reservation);
    $end = new DateTime($start);
    $time = DateTime::createFromFormat('H:i:s', $duree_reservation);
    $end = $end->add(new DateInterval('PT' . $time->format('H') . 'H' . $time->format('i') . 'M' . $time->format('s') . 'S'));
    $end =  $end->format('Y-m-d\TH:i:s');
    $date_livraison_defaut = new DateTime($end);
    $date_livraison_defaut->modify('+15 days');
    $date_livraison_defaut =  $date_livraison_defaut->format('Y-m-d\TH:i:s');
    // dd($date_livraison_defaut);
    // dd($end);
    $calendarId = '5bea421ea0518ff606569e12bec10ffa8f8baf1f7280e095efa07db852cf4e2d@group.calendar.google.com';
    $event = GoogleCalendarController::class::createEvent($summary, $location, $start, $end, $calendarId);
    $event = GoogleCalendarController::class::createEvent($summary, $location, $date_livraison_defaut, $date_livraison_defaut, $calendarId);

    return redirect()->route('experience.show', compact('id_experience', 'num_facture'))
            ->with('success', 'La mise a jour a bien été effectuée !');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Experience $experience)
    {
        return \view('experience.validate');
    }

    public function verifierlogin(Request $request)
    {
        $request->validate(
            [
                'nom' => 'required',
                'prenom' => 'required',
                'email' => ['nullable', 'required_without:tel', 'email'],
                'tel' => 'nullable|numeric|digits:10|required_without:email',
                'num_exp' => 'required|exists:mysql2.experience,numero_experience'
            ],
            [
                'num_exp.exists' => 'Votre numéro d\'exéprience n\'est pas valide. Veillez le resaisir ou recontacter LalaChante'
            ]
        );

        //dump('verifierlogin');

        if (!is_null($request->email) && (!is_null($request->tel))) {
            $con = DB::connection('mysql2')->table('contact')
                ->where('email', '=', $request->email)
                ->where('tel', '=', $request->tel)
                ->first();
        } elseif (!is_null($request->email)) {
            $con = DB::connection('mysql2')->table('contact')
                ->where('email', '=', $request->email)
                ->first();
        } else {
            $con = DB::connection('mysql2')->table('contact')
                ->where('tel', '=', $request->tel)
                ->first();
        }
        if (is_null($con)) {

            $nom = $request->nom;
            $prenom = $request->prenom;
            $tel = $request->tel;
            $email = $request->email;
            $num_exp = $request->num_exp;

            return redirect()->route('experience.loginnewcontact', compact('nom', 'prenom', 'tel', 'email', 'num_exp'))
                ->with('success', 'Vous etes connecté #1');
        } else {
            $num_exp = $request->num_exp;
            $contact = $con->id_contact;
            return redirect()->route('experience.loginexistingcontact', compact('num_exp', 'contact'))
                ->with('success', 'Vous etes connecté #2');
        }
    }

    public function copyFolder($sourceFolderId, $destinationFolderId, $newFolderName, $service)
    {
        // Obtenir les métadonnées du dossier source.
        $sourceFolder = $service->files->get($sourceFolderId, ['fields' => 'name, mimeType, parents']);

        // Créer un nouveau dossier dans la destination avec le même nom que le dossier source.
        $newFolder = new \Google_Service_Drive_DriveFile([
            'name' => $newFolderName,
            'mimeType' => 'application/vnd.google-apps.folder',
            'parents' => [$destinationFolderId]
        ]);
        $newFolder = $service->files->create($newFolder, ['fields' => 'id']);
        $newFolderId = $newFolder->getId();

        // Récupérer les fichiers et les sous-dossiers dans le dossier source.
        $files = $service->files->listFiles([
            'q' => "'{$sourceFolderId}' in parents and trashed = false",
            'fields' => 'files(id, name, mimeType)',
        ]);

        // Copier chaque fichier et sous-dossier dans le nouveau dossier.
        foreach ($files->getFiles() as $file) {
            if ($file->getMimeType() == 'application/vnd.google-apps.folder') {
                // Si c'est un dossier, récursivement copier son contenu.
                $this->copyFolder($file->getId(), $newFolderId, $file->getName(), $service);
            } else {
                // Si c'est un fichier, le copier dans le nouveau dossier.
                $copy = new \Google_Service_Drive_DriveFile([
                    'name' => $file->getName(),
                    'parents' => [$newFolderId]
                ]);
                $service->files->copy($file->getId(), $copy);
            }
        }
        // Retourner l'ID du nouveau dossier.
        return $newFolderId;
    }

    public function loginnewcontact(Request $request)
    {

        session_start();
        //CONNECTION à DRIVE
        $clientDrive = new \Google_Client();
        $clientDrive->setAuthConfig(__DIR__ . '/../../Google/google_credentials.json');
        $clientDrive->addScope(\Google_Service_Drive::DRIVE);
        $clientDrive->setAccessType('offline');
        $clientDrive->setAccessToken(file_get_contents(__DIR__ . '/../../Google/google_access_token.json')); //$_SESSION['access_token']
        // Use the access token to make API requests
        $drive = new \Google_Service_Drive($clientDrive);
        //}

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $notif_text = "Creation d'un nouveau contact graçe au login par numéro d'experience " . $request->num_exp . " le " .  $current_date->format('Y-m-d H:i:s') . "";

        $notification = DB::connection('mysql2')->table('notification')
            ->insert([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'contact'
            ]);

        $con = DB::connection('mysql2')->table('contact')
            ->insertGetId([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'email' => $request->email,
                'tel' => $request->tel,
                'date_creation' => $current_date->format('Y-m-d H:i:s'),
                'date_update' => $current_date->format('Y-m-d H:i:s'),
            ]);

        $new_contact = DB::connection('mysql2')->table('contact')->where('id_contact', '=', $con)->first();

        $email = new MailConfirmationExperimentateur();
        Mail::to($request->email)
            ->send($email);

        $exp = DB::connection('mysql2')->table('experience')
            ->where('numero_experience', '=', $request->num_exp)
            ->first();




        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $notif_text = 'Creation d\'un nouveau contact experience associé au contact de ID ' . $con . ' et à l\'experience de ID  ' . $exp->id_experience . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';


        $notification = DB::connection('mysql2')->table('notification')
            ->insert([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'contact experience'
            ]);

        DB::connection('mysql2')->table('contact_experience')
            ->insert([
                'id_experience' => $exp->id_experience,
                'id_contact' => $con,
                'profil' => 'User'
            ]);
        //dd($exp->url_experience_folder);
        $parameters = array(
            'q' => "'$exp->url_experience_folder' in parents and mimeType='application/vnd.google-apps.folder' and name='Users'",
            'fields' => 'nextPageToken, files(id, name)',
        );
        $results = $drive->files->listFiles($parameters);
        $results = $results->getFiles()[0];
        $results = $results->getId();

        //dd($results);


        $sourceFolderId = '1F5h75yuQ0E2Xh-LOKNzXfWVXrLB1vBKn';
        $destinationFolderId = $results;
        $newFolderName = '' . $con . ' - ' . $request->nom . ' ' . $request->prenom;
        $sourceFolder = $this->copyFolder($sourceFolderId, $destinationFolderId, $newFolderName, $drive);



        return view('experience.welcome', ['con' => $new_contact, 'exp' => $exp])
            ->with('success', 'contact crée avec succes');
    }

    public function loginexistingcontact(Request $request)
    {

        session_start();
        //CONNECTION à DRIVE
        $clientDrive = new \Google_Client();
        $clientDrive->setAuthConfig(__DIR__ . '/../../Google/google_credentials.json');
        $clientDrive->addScope(\Google_Service_Drive::DRIVE);
        $clientDrive->setAccessType('offline');
        $clientDrive->setAccessToken(file_get_contents(__DIR__ . '/../../Google/google_access_token.json')); //$_SESSION['access_token']
        // Use the access token to make API requests
        $drive = new \Google_Service_Drive($clientDrive);
        //}

        //dump('loginexistingcontact');

        $con = DB::connection('mysql2')->table('contact')->where('id_contact', '=', $request->contact)->first();

        $exp = DB::connection('mysql2')->table('experience')
            ->where('numero_experience', '=', $request->num_exp)
            ->first();

        $con_experience = DB::connection('mysql2')->table('contact_experience')
            ->where('id_contact', '=', $con->id_contact)
            ->where('id_experience', '=', $exp->id_experience)
            ->first();

        if (is_null($con_experience)) {
            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
            $current_date->setTimestamp($timestamp);
            $notif_text = 'Creation d\'un nouveau contact experience associé au contact de ID ' . $con->id_contact . ' et à l\'experience de ID  ' . $exp->id_experience . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';


            $notification = DB::connection('mysql2')->table('notification')
                ->insert([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'contact experience'
                ]);

            DB::connection('mysql2')->table('contact_experience')
                ->insert([
                    'id_experience' => $exp->id_experience,
                    'id_contact' => $con->id_contact,
                    'profil' => 'User'
                ]);
        } elseif ($con_experience->profil == 'Client') {
            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
            $current_date->setTimestamp($timestamp);
            $notif_text = 'Mise à jour du contact experience associé au contact de ID ' . $con->id_contact . ' et à l\'experience de ID  ' . $exp->id_experience . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';


            $notification = DB::connection('mysql2')->table('notification')
                ->insert([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'contact experience'
                ]);

            DB::connection('mysql2')->table('contact_experience')
                ->where('id_contact', '=', $con->id_contact)
                ->where('id_experience', '=', $exp->id_experience)
                ->update([
                    'profil' => 'Client-User'
                ]);
        } else {
        }

        $email = new MailConfirmationExperimentateur();
        Mail::to($request->email)
            ->send($email);

        $sourceFolderId = '1F5h75yuQ0E2Xh-LOKNzXfWVXrLB1vBKn';
        $destinationFolderId = '1giPB1l92TeE8Jw0O5aKWW4P49z52Dv-d';
        $newFolderName = '' . $con->id_contact . ' - ' . $con->nom . ' ' . $con->prenom;

        $sourceFolder = $this->copyFolder($sourceFolderId, $destinationFolderId, $newFolderName, $drive);

        return view('experience.welcome', ['con' => $con, 'exp' => $exp])
            ->with('success', 'succes loginexistingcontact');
    }
    //***********************************************Oumayma****************************************************//

    public function updateName(Request $request, $id_experience, $num_facture)
    {
        $request->validate([
            "nom_experience" => "required",
        ]);

        $experience = Experience::find($id_experience);
        $experience->nom_experience = $request->input('nom_experience');
        $experience->save();

        session_start();
        //CONNECTION à DRIVE
        $clientDrive = new \Google_Client();
        $clientDrive->setAuthConfig(__DIR__ . '/../../Google/google_credentials.json');
        $clientDrive->addScope(\Google_Service_Drive::DRIVE);
        $clientDrive->setAccessType('offline');
        $clientDrive->setAccessToken(file_get_contents(__DIR__ . '/../../Google/google_access_token.json')); //$_SESSION['access_token']
        // Use the access token to make API requests
        $drive = new \Google_Service_Drive($clientDrive);
        //}

        // dd($con->url_contact_folder);

        if (($experience->url_experience_folder != null) && ($experience->url_experience_folder != "")) {
            $id_folder = substr($experience->url_experience_folder, 43);
            $fileMetadata = new Google_Service_Drive_DriveFile([
                'name' => $experience->numero_experience . ' - ' . $experience->nom_experience,
                'mimeType' => 'application/vnd.google-apps.folder'
            ]);
            // dd($id_folder);
            $drive->files->update($id_folder, $fileMetadata, ['fields' => 'id,name']);
        }

        return redirect()->route('experience.show', ['id_experience' => $id_experience, 'num_facture' => $num_facture])
            ->with("experience.show", "Nom de l'expérience modifiée avec succès !");
    }

    public function createInteraction(Request $request)
    {
        $request->validate([
            'id_experience' => 'required|exists:mysql2.experience,id_experience',
            'num_facture' => 'required|exists:mysql2.factures,num_facture',
            'id_cnt' => 'required|exists:mysql2.contact,id_contact',
            'type_int',
            'texte' => 'required',
            // ---------
            'le_tag_1' => 'nullable|exists:mysql2.tag_interaction,id_tag_interaction',
            'le_tag_2' => 'nullable|exists:mysql2.tag_interaction,id_tag_interaction',
            'le_tag_3' => 'nullable|exists:mysql2.tag_interaction,id_tag_interaction',
            'le_tag_4' => 'nullable|exists:mysql2.tag_interaction,id_tag_interaction',
            'le_tag_5' => 'nullable|exists:mysql2.tag_interaction,id_tag_interaction',
            // nouveau
            'nouveau_tag_1' => 'nullable|',
            'nouveau_tag_2' => 'nullable|',
            'nouveau_tag_3' => 'nullable|',
            'nouveau_tag_4' => 'nullable|',
            'nouveau_tag_5' => 'nullable|',
        ]);
        // --------------------yasser----------------
        // -les tags- il y a 5 au maximum.
        $le_tag_1 = $request->le_tag_1;
        $le_tag_2 = $request->le_tag_2;
        $le_tag_3 = $request->le_tag_3;
        $le_tag_4 = $request->le_tag_4;
        $le_tag_5 = $request->le_tag_5;
        // ------
        $tags = [];
        if (isset($le_tag_1) && !in_array($le_tag_1, $tags)) {
            $tags[] = $le_tag_1;
        }
        if (isset($le_tag_2) && !in_array($le_tag_2, $tags)) {
            $tags[] = $le_tag_2;
        }
        if (isset($le_tag_3) && !in_array($le_tag_3, $tags)) {
            $tags[] = $le_tag_3;
        }
        if (isset($le_tag_4) && !in_array($le_tag_4, $tags)) {
            $tags[] = $le_tag_4;
        }
        if (isset($le_tag_5) && !in_array($le_tag_5, $tags)) {
            $tags[] = $le_tag_5;
        }

        // -----nouveau tag---
        $nouveau_tag_1 = $request->nouveau_tag_1;
        $nouveau_tag_2 = $request->nouveau_tag_2;
        $nouveau_tag_3 = $request->nouveau_tag_3;
        $nouveau_tag_4 = $request->nouveau_tag_4;
        $nouveau_tag_5 = $request->nouveau_tag_5;
        // --------
        $nouveau_tags = [];
        if (isset($nouveau_tag_1)) {
            $nouveau_tags['le_tag_1'] = $nouveau_tag_1;
        }
        if (isset($nouveau_tag_2)) {
            $nouveau_tags['le_tag_2'] = $nouveau_tag_2;
        }
        if (isset($nouveau_tag_3)) {
            $nouveau_tags['le_tag_3'] = $nouveau_tag_3;
        }
        if (isset($nouveau_tag_4)) {
            $nouveau_tags['le_tag_4'] = $nouveau_tag_4;
        }
        if (isset($nouveau_tag_5)) {
            $nouveau_tags['le_tag_5'] = $nouveau_tag_5;
        }
        // --------------------yasser----------------


        $id_experience = $request->id_experience;
        $num_facture = $request->num_facture;
        $id_cnt = $request->id_cnt;
        $type_int = $request->type_int;
        $texte = $request->texte;

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $notif_text = 'Creation d\'une nouvelle interaction associé à l\'experience de ID ' . $id_experience . ' et au contact de ID ' . $id_cnt . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';


        $notification = DB::connection('mysql2')->table('notification')
            ->insert([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'interaction'
            ]);

        $interaction = DB::connection('mysql2')->table('interaction')
            ->insertGetId([
                'date_heure' => $current_date->format('Y-m-d H:i:s'),
                'texte' => $texte,
                'type_interaction' => $type_int,
                'id_contact' => $id_cnt,
                'id_experience' => $id_experience
            ]);
        // -----------associer avec le tag selected--------
        foreach ($tags as $tag) {
            DB::connection('mysql2')->table('interaction_tag')
                ->insertGetId([
                    'id_interaction' =>    $interaction,
                    'id_tag_interaction' =>    $tag,
                ]);
        }
        // ---------- ajouter nouveau tag et associer -----
        foreach ($nouveau_tags as $tag) {
            // Insérer le nouveau tag dans la table tag_interaction
            $tagId = DB::connection('mysql2')->table('tag_interaction')->insertGetId([
                'tag' => $tag
            ]);

            // Faire l'association dans la table interaction_tag
            DB::connection('mysql2')->table('interaction_tag')->insert([
                'id_interaction' => $interaction,
                'id_tag_interaction' => $tagId,
            ]);
        }

        // ---------------
        return redirect()->route('experience.show', ['id_experience' => $id_experience, 'num_facture' => $num_facture])
            ->with('success', 'Interaction crée avec succes !');
    }

    public function createStorytelling(Request $request)
    {
        $request->validate([
            'id_experience' => 'required|exists:mysql2.experience,id_experience',
            'num_facture' => 'required|exists:mysql2.factures,num_facture',
            'desc_content',
            'desc_story' => 'required',
            // --------
            'le_tag_1' => 'nullable|exists:mysql2.tag_story,id_tag_story',
            'le_tag_2' => 'nullable|exists:mysql2.tag_story,id_tag_story',
            'le_tag_3' => 'nullable|exists:mysql2.tag_story,id_tag_story',
            'le_tag_4' => 'nullable|exists:mysql2.tag_story,id_tag_story',
            'le_tag_5' => 'nullable|exists:mysql2.tag_story,id_tag_story',
            // nouveau
            'nouveau_tag_1' => 'nullable|',
            'nouveau_tag_2' => 'nullable|',
            'nouveau_tag_3' => 'nullable|',
            'nouveau_tag_4' => 'nullable|',
            'nouveau_tag_5' => 'nullable|',
        ]);

        // -les tags- il y a 5 au maximum.
        $le_tag_1 = $request->le_tag_1;
        $le_tag_2 = $request->le_tag_2;
        $le_tag_3 = $request->le_tag_3;
        $le_tag_4 = $request->le_tag_4;
        $le_tag_5 = $request->le_tag_5;
        // --------
        $tags = [];
        if (isset($le_tag_1) && !in_array($le_tag_1, $tags)) {
            $tags[] = $le_tag_1;
        }
        if (isset($le_tag_2) && !in_array($le_tag_2, $tags)) {
            $tags[] = $le_tag_2;
        }
        if (isset($le_tag_3) && !in_array($le_tag_3, $tags)) {
            $tags[] = $le_tag_3;
        }
        if (isset($le_tag_4) && !in_array($le_tag_4, $tags)) {
            $tags[] = $le_tag_4;
        }
        if (isset($le_tag_5) && !in_array($le_tag_5, $tags)) {
            $tags[] = $le_tag_5;
        }
        // ----------
        // -----nouveau tag---
        $nouveau_tag_1 = $request->nouveau_tag_1;
        $nouveau_tag_2 = $request->nouveau_tag_2;
        $nouveau_tag_3 = $request->nouveau_tag_3;
        $nouveau_tag_4 = $request->nouveau_tag_4;
        $nouveau_tag_5 = $request->nouveau_tag_5;
        // --------
        $nouveau_tags = [];
        if (isset($nouveau_tag_1)) {
            $nouveau_tags['le_tag_1'] = $nouveau_tag_1;
        }
        if (isset($nouveau_tag_2)) {
            $nouveau_tags['le_tag_2'] = $nouveau_tag_2;
        }
        if (isset($nouveau_tag_3)) {
            $nouveau_tags['le_tag_3'] = $nouveau_tag_3;
        }
        if (isset($nouveau_tag_4)) {
            $nouveau_tags['le_tag_4'] = $nouveau_tag_4;
        }
        if (isset($nouveau_tag_5)) {
            $nouveau_tags['le_tag_5'] = $nouveau_tag_5;
        }
        // ------------------yasser-------------------

        $id_experience = $request->id_experience;
        $num_facture = $request->num_facture;
        $desc_content = $request->desc_content;
        $desc_story = $request->desc_story;


        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris')); //first argument "must" be a string
        $current_date->setTimestamp($timestamp); //adjust the object to correct timestamp
        $notif_text = 'Creation d\'un nouveau content experience de type storytelling associé à l\'experience de ID ' . $id_experience . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';


        $notification = DB::connection('mysql2')->table('notification')
            ->insert([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'content experience/storytelling'
            ]);
        $content = DB::connection('mysql2')->table('contents_experience')
            ->insertGetId([
                'date_heure' => $current_date->format('Y-m-d H:i:s'),
                'date_update' => $current_date->format('Y-m-d H:i:s'),
                'description_' => $desc_content,
                'type' => 'storytelling',
                'id_experience' => $id_experience
            ]);
        $storytelling = DB::connection('mysql2')->table('storytelling')
            ->insertGetId([
                'id_content_experience' => $content,
                'description' => $desc_story,
                'date_creation' => $current_date->format('Y-m-d H:i:s'),
                'date_update' => $current_date->format('Y-m-d H:i:s'),
            ]);
        // -----------associer avec le tag selected--------
        foreach ($tags as $tag) {
            DB::connection('mysql2')->table('tag_storytelling')
                ->insertGetId([
                    'id_storytelling' =>    $storytelling,
                    'id_tag_story' =>    $tag,
                ]);
        }
        // ---------- ajouter nouveau tag et associer -----
        foreach ($nouveau_tags as $tag) {
            // Insérer le nouveau tag dans la table tag_interaction
            $tagId = DB::connection('mysql2')->table('tag_story')->insertGetId([
                'tag' => $tag
            ]);

            // Faire l'association dans la table interaction_tag
            DB::connection('mysql2')->table('tag_storytelling')
                ->insertGetId([
                    'id_storytelling' =>    $storytelling,
                    'id_tag_story' =>    $tagId,
                ]);
        }
        // ---------------
        return redirect()->route('experience.show', ['id_experience' => $id_experience, 'num_facture' => $num_facture])
            ->with('success', 'Storytelling crée avec succes !');
    }

    public function destroyStorytelling($story, $id_experience, $num_facture)
    {

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $notif_text = 'Suppression du storytelling de ID ' . $story . ' et du content experience associé le ' .  $current_date->format('Y-m-d H:i:s') . '';
        // --------------suppression des tags ----------
        DB::connection('mysql2')->table('tag_storytelling')
            ->where('id_storytelling', $story)
            ->delete();
        // --------------suppression des tags ----------
        $notification = DB::connection('mysql2')->table('notification')
            ->insertGetId([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'content experience/storytelling'
            ]);

        $storytelling = DB::connection('mysql2')->table('storytelling')
            ->where('id_storytelling', '=', $story)
            ->first();

        $id_content = $storytelling->id_content_experience;

        $storytelling = DB::connection('mysql2')->table('storytelling')
            ->where('id_storytelling', '=', $story)
            ->delete();

        $content = DB::connection('mysql2')->table('contents_experience')
            ->where('id_content_experience', '=', $id_content)
            ->delete();


        return redirect()->route('experience.show', compact('id_experience', 'num_facture'))
            ->with('success', 'Storytelling supprimée avec succes');
    }

    public function destroyInteraction($interactionz, $id_experience, $num_facture)
    {

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $notif_text = 'Suppression de l\'interaction ID ' . $interactionz . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
            ->insert([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'interaction'
            ]);
        // --------------suppression des tags ----------
        DB::connection('mysql2')->table('interaction_tag')
            ->where('id_interaction', $interactionz)
            ->delete();
        // --------------suppression des tags ----------
        Interaction::destroy($interactionz);

        return redirect()->route('experience.show', compact('id_experience', 'num_facture'))
            ->with('success', 'Interaction supprimée avec succes');
    }

    public function insertExistingExperimentateur(Request $request)
    {
        $request->validate([
            'id_experience' => 'required|exists:mysql2.experience,id_experience',
            'num_facture' => 'required|exists:mysql2.factures,num_facture',
            'id_cnt' => 'required|exists:mysql2.contact,id_contact'
        ]);

        $id_experience = $request->id_experience;
        $num_facture = $request->num_facture;
        $id_cnt = $request->id_cnt;

        $count = DB::connection('mysql2')->table('contact_experience')
            ->where('id_contact', '=', $id_cnt)
            ->where('id_experience', '=', $id_experience)
            ->count();
        if ($count == 0) {

            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris')); //first argument "must" be a string
            $current_date->setTimestamp($timestamp); //adjust the object to correct timestamp
            $notif_text = 'Création d\'un nouveau experimentateur associé au contact de ID ' . $id_cnt . ' et à l\'experience de ID ' . $id_experience . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

            $notification = DB::connection('mysql2')->table('notification')
                ->insertGetId([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'contact experience/experimentateur'
                ]);


            $con_exp = DB::connection('mysql2')->table('contact_experience')
                ->insert([
                    'id_experience' => $id_experience,
                    'id_contact' => $id_cnt,
                    'profil' => 'User'
                ]);


            return redirect()->route('experience.show', compact('id_experience', 'num_facture'))
                ->with('success', 'Le contact a bien été lié à l\'experience');
        } else {
            dd('error');
            return redirect()->route('experience.show', compact('id_experience', 'num_facture'))
                ->with('error', 'Le contact est déjà liée à cette experience');
        }
    }

    public function insertNewExperimentateur(Request $request)
    {
        $request->validate([

            'id_experience' => 'required|exists:mysql2.experience,id_experience',
            'num_facture' => 'required|exists:mysql2.factures,num_facture',
            'Nom' => 'required',
            'Prénom' => 'required',
            'mail' => ['nullable', 'required_without:tel', 'email', 'unique:mysql2.contact,email'],
            'tel' => 'nullable|numeric|digits:10|unique:mysql2.contact,tel|required_without:mail',
            'adress',
            'cp' => 'nullable|numeric|digits_between:3,5',
            'ville',
            'url',
            'entreprise' => 'nullable|exists:mysql2.organisation,id_organisation',
            'type'
        ]);

        $id_experience = $request->id_experience;
        $num_facture = $request->num_facture;

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris')); //first argument "must" be a string
        $current_date->setTimestamp($timestamp); //adjust the object to correct timestamp
        $notif_text = 'Création d\'un nouveau contact le ' .  $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
            ->insertGetId([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'contact'
            ]);

        $con = Contact::create([
            'nom' => $request->Nom,
            'prenom' => $request->Prénom,
            'mail' => $request->mail,
            'tel' => $request->tel,
            'adresse' => $request->adress,
            'CP' => $request->cp,
            'ville' => $request->ville,
            'date_creation' => $current_date->format('Y-m-d H:i:s'),
            'date_update' => $current_date->format('Y-m-d H:i:s'),
        ]);

        if (!is_null($request->entreprise)) {
            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
            $current_date->setTimestamp($timestamp);
            $notif_text = 'Creation d\'un nouveau contact_entreprise liée au contact de ID ' . $con->id . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

            $notification = DB::connection('mysql2')->table('notification')
                ->insert([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'contact entreprise'
                ]);

            $org = DB::connection('mysql2')->insert("INSERT INTO contact_entreprise (id_contact, type, id_organisation) VALUES (?,?,?)", [$con->id, $request->type, $request->entreprise]);
        }

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $notif_text = 'Création d\'un nouveau experimentateur associé au contact de ID ' . $con->id . ' et à l\'experience de ID ' . $id_experience . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
            ->insertGetId([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'contact experience/experimentateur'
            ]);

        $con_exp = DB::connection('mysql2')->table('contact_experience')
            ->insert([
                'id_experience' => $id_experience,
                'id_contact' => $con->id,
                'profil' => 'User'
            ]);


        return redirect()->route('experience.show', compact('id_experience', 'num_facture'))
            ->with('success', 'Le nouveau contact a bien été lié a l\'expérience');
    }

    public function clientToExperimentateur($id_experience, $num_facture, $id_contact)
    {

        $count = DB::connection('mysql2')->table('contact_experience')
            ->where('id_contact', '=', $id_contact)
            ->where('id_experience', '=', $id_experience)
            ->where('profil', '=', 'Client')
            ->count();

        if ($count == 1) {

            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
            $current_date->setTimestamp($timestamp);
            $notif_text = 'Mise à jour du client associé au contact de ID ' . $id_contact . ' et à l\'experience de ID ' . $id_experience . ' pour le rendre un Client-User le ' .  $current_date->format('Y-m-d H:i:s') . '';

            $notification = DB::connection('mysql2')->table('notification')
                ->insertGetId([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'contact experience/experimentateur'
                ]);

            $con_exp = DB::connection('mysql2')->table('contact_experience')
                ->where('id_contact', '=', $id_contact)
                ->where('id_experience', '=', $id_experience)
                ->where('profil', '=', 'Client')
                ->update([
                    'profil' => 'Client-User'
                ]);

            return redirect()->route('experience.show', compact('id_experience', 'num_facture'))
                ->with('success', 'le client a bien été ajouté');
        } else {
            return redirect()->route('experience.show', compact('id_experience', 'num_facture'))
                ->with('error', 'le client n\'a pas été ajouté');
        }
    }

    public function insertEvenement(Request $request)
    {
        $request->validate([
            'current_stat' => 'required|exists:mysql2.experience_statut,id_statut_experience',
            'id_experience' => 'required|exists:mysql2.experience,id_experience',
            'num_facture' => 'required|exists:mysql2.factures,num_facture',
            'type_evenement' => 'required',
            'date_evenement' => 'required|date_format:Y-m-d',
        ]);

        $id_experience = $request->id_experience;
        $num_facture = $request->num_facture;
        $type_evenement = $request->type_evenement;

        $date_evenement = new DateTime();
        $date_evenement = $date_evenement->createFromFormat('Y-m-d', $request->date_evenement);
        $date_evenement->setTime(0, 0, 0, 0);

        switch ($type_evenement) {
            case 'Prise de contact':
                $new_stat_id = 2;
                break;
            case 'Speetch experience':
                $new_stat_id = 3;
                break;
            case 'Interaction (pré experience)':
                $new_stat_id = 4;
                break;
            case 'Reservation date':
                $new_stat_id = 0;
                break;
            case 'Record date':
                $new_stat_id = 5;
                break;
            case 'Période studio experience':
                $new_stat_id = 0;
                break;
            case 'Livraison chanson Experience':
                $new_stat_id = 6;
                break;
            case 'Sucess post Experience':
                $new_stat_id = 7;
                break;
            default:
                $new_stat_id = -1;
                break;
        }

        $count_event = DB::connection('mysql2')->table('evenement')
            ->where('type_evenement', '=', $type_evenement)
            ->where('id_experience', '=', $id_experience)
            ->count();
        if ($count_event == 0) {

            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
            $current_date->setTimestamp($timestamp);
            $notif_text = 'Création d\'un nouveau événement de type ' . $type_evenement . ' associé à l\'experience de ID ' . $id_experience . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

            $notification = DB::connection('mysql2')->table('notification')
                ->insertGetId([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'evenement'
                ]);

            if (($request->current_stat != $new_stat_id) && ($new_stat_id > 0)) {
                $experience = Experience::find($id_experience);

                $timestamp = time();
                $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
                $current_date->setTimestamp($timestamp);
                $old_stat = DB::connection('mysql2')->table('experience_statut')
                    ->where('id_statut_experience', $request->current_stat)
                    ->first();
                $new_stat = DB::connection('mysql2')->table('experience_statut')
                    ->where('id_statut_experience', $new_stat_id)
                    ->first();


                $notif_text = "L'experience " . $experience->nom_experience . " passe du statut " . $old_stat->statut_experience . " au statut " . $new_stat->statut_experience . " le " .  $current_date->format('Y-m-d H:i:s') . " ";


                $notification = DB::connection('mysql2')->table('notification')
                    ->insert([
                        'contenu_notification' => $notif_text,
                        'date_notification' => $current_date->format('Y-m-d H:i:s'),
                        'type' => 'experience'
                    ]);
                $latest_notification = DB::connection('mysql2')->selectOne('SELECT id_notification FROM notification ORDER BY id_notification DESC');


                $exp_stat_notif = DB::connection('mysql2')->table('experience_statut_notification')
                    ->insert([
                        'id_notification' => $latest_notification->id_notification,
                        'date_statut' => $current_date->format('Y-m-d H:i:s'),
                        'id_experience' => $experience->id_experience,
                        'id_statut_experience' => $new_stat_id
                    ]);
            }

            if ($type_evenement == "Record date") {
                $evenement = DB::connection('mysql2')->table('evenement')
                    ->insert([
                        'type_evenement' => $type_evenement,
                        'date_evenement' => $date_evenement->format('Y-m-d H:i:s'),
                        'id_experience' => $id_experience
                    ]);

                $count_event = DB::connection('mysql2')->table('evenement')
                    ->where('type_evenement', '=', 'Livraison chanson Experience')
                    ->where('id_experience', '=', $id_experience)
                    ->count();

                if ($count_event == 0) {
                    $timestamp = time();
                    $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
                    $current_date->setTimestamp($timestamp);
                    $notif_text = 'Création d\'un nouveau événement de type Livraison chanson Experience associé à l\'experience de ID ' . $id_experience . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

                    $notification = DB::connection('mysql2')->table('notification')
                        ->insertGetId([
                            'contenu_notification' => $notif_text,
                            'date_notification' => $current_date->format('Y-m-d H:i:s'),
                            'type' => 'evenement'
                        ]);

                    $date_livraison = date_create($date_evenement->format('Y-m-d H:i:s'));
                    date_add($date_livraison, date_interval_create_from_date_string("15 days"));


                    $evenement = DB::connection('mysql2')->table('evenement')
                        ->insert([
                            'type_evenement' => "Livraison chanson Experience",
                            'date_evenement' => $date_livraison->format("Y-m-d H:i:s"),
                            'id_experience' => $id_experience
                        ]);
                }
            } else {
                $evenement = DB::connection('mysql2')->table('evenement')
                    ->insert([
                        'type_evenement' => $type_evenement,
                        'date_evenement' => $date_evenement->format('Y-m-d H:i:s'),
                        'id_experience' => $id_experience
                    ]);
            }

            return redirect()->route('experience.show', compact('id_experience', 'num_facture'))
                ->with('success', 'Evenement ajouté avec succes');
        } elseif ($count_event == 1) {
            $id_evenement = DB::connection('mysql2')->table('evenement')
                ->where('type_evenement', '=', $type_evenement)
                ->where('id_experience', '=', $id_experience)
                ->first()->id_evenement;

            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
            $current_date->setTimestamp($timestamp);
            $notif_text = 'Mise à jour de l\'événement nouveau évenement de type ' . $id_evenement . ' associé à l\'experience de ID ' . $id_experience . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

            $notification = DB::connection('mysql2')->table('notification')
                ->insertGetId([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'evenement'
                ]);

            $evenement = DB::connection('mysql2')->table('evenement')
                ->where('id_evenement', '=', $id_evenement)
                ->update([
                    'type_evenement' => $type_evenement,
                    'date_evenement' => $date_evenement->format('Y-m-d H:i:s')
                ]);

            if (($request->current_stat != $new_stat_id) && ($new_stat_id > 0)) {
                $experience = Experience::find($id_experience);

                $timestamp = time();
                $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
                $current_date->setTimestamp($timestamp);
                $old_stat = DB::connection('mysql2')->table('experience_statut')
                    ->where('id_statut_experience', $request->current_stat)
                    ->first();
                $new_stat = DB::connection('mysql2')->table('experience_statut')
                    ->where('id_statut_experience', $new_stat_id)
                    ->first();


                $notif_text = "L'experience " . $experience->nom_experience . " passe du statut " . $old_stat->statut_experience . " au statut " . $new_stat->statut_experience . " le " .  $current_date->format('Y-m-d H:i:s') . " ";


                $notification = DB::connection('mysql2')->table('notification')
                    ->insert([
                        'contenu_notification' => $notif_text,
                        'date_notification' => $current_date->format('Y-m-d H:i:s'),
                        'type' => 'experience'
                    ]);
                $latest_notification = DB::connection('mysql2')->selectOne('SELECT id_notification FROM notification ORDER BY id_notification DESC');


                $exp_stat_notif = DB::connection('mysql2')->table('experience_statut_notification')
                    ->insert([
                        'id_notification' => $latest_notification->id_notification,
                        'date_statut' => $current_date->format('Y-m-d H:i:s'),
                        'id_experience' => $experience->id_experience,
                        'id_statut_experience' => $new_stat_id
                    ]);
            }

            return redirect()->route('experience.show', compact('id_experience', 'num_facture'))
                ->with('success', 'Evenement ajouté avec succes');
        } else {
            return redirect()->route('experience.show', compact('id_experience', 'num_facture'))
                ->with('error', 'Erreur l\'evenement n\'a pas pu etre ajouté');
        }
    }

    public function createContent(Request $request)
    {
        $request->validate([
            'id_experience' => 'required|exists:mysql2.experience,id_experience',
            'num_facture' => 'required|exists:mysql2.factures,num_facture',
            'type_contenu' => 'required|string',
            'nom' => 'required|string',
            'url' => 'nullable|string'
        ]);

        $id_experience = $request->id_experience;
        $num_facture = $request->num_facture;
        $type_contenu = $request->type_contenu;
        $nom = $request->nom;
        $url = $request->url;

        function validationForImages($request){
            $validate=$request->validate([
                'file' => 'required|image|mimes:jpeg,png,gif,jpg,bmp,tiff,webp,svg,ico,tga,pcx,pbm,pgm,ppm', // Acceptez uniquement les formats JPEG, PNG et GIF.
            ]);
            return $validate;
        }
        function validationForSongs($request){
            $validate=$request->validate([
                'file' => 'required|mimetypes:audio/*', // Tous les types de fichiers audio
            ]);
            return $validate;
        }
        function validationForVideos($request){
            $validate=$request->validate([
                'file' => 'required|mimetypes:video/*', // Tous les types de fichiers vidéo
            ]);
            return $validate;
        }
        function validationForAllFiles($request){
            $validate=$request->validate([
                'file' => 'required|file', // Valide tous les types de fichiers
            ]);
            return $validate;
        }

        function sendVideoYoutube($request,$id_experience){
            $regex = '/^(https?:\/\/)?(www\.)?youtube\.com\/watch\?v=[A-Za-z0-9_-]+$/';
            $youtubeLink=$request->input('url');
            $name=$request->input('nom');
            if($youtubeLink && $name){
                if(preg_match($regex, $youtubeLink)){
                    $filePath = storage_path('app/file.txt');
                    
                    // Ajoutez le texte au fichier existant
                    file_put_contents($filePath, $youtubeLink,FILE_APPEND);

                    //Storage::disk('google')->put($myfile->getClientOriginalName(), File::get($myfile->getRealPath()));
                    //Gdrive::put($myfile->getClientOriginalName(), $myfile);
                    $experience=Experience::findorfail($id_experience);
                    $experience->addMedia($filePath)
                    ->withCustomProperties(['folder' => 'video_youtube','youtube_link'=> $youtubeLink])
                    ->usingFileName($name.'.txt')
                    ->toMediaCollection('prod/video_youtube/'.$name,'google');
                    $experience->save();
                    // Effacez le contenu du fichier
                    file_put_contents($filePath, '');
                }else{
                    //upload success
                    $error='Rentrez un lien et un nom de fichier valide !';
                        
                    // Stockez la variable $success_image dans la session flash
                    session()->flash('error', $error);
                }
            
            return redirect()->to('drive');
        }
    }
        function sendContentToDrive($request,$destination,$validationFunction){
            // JM upload image
                //gestion des erreurs
                $id_experience = $request->input('id_experience');
                
                
                // on trouve l'id expérience 
                $experience=Experience::findorfail($id_experience);
                // on récupère le fichier venant de l'input file de la vue
                $file = $request->file('file');
                
                // si le fichier existe on execute le code
                if($file && $validationFunction ){
                    // on recupère l'extension
                    $extension = $file->getClientOriginalExtension();
                    // on recupère le nom du fichier via l'input
                    $originalFileName = $request->input('nom');

                    if($request->input('nom')==""){
                        // nom originale sans l'extenstion
                        $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    }
                    
                    // on enlève les espaces, les accents
                    $newFileName = preg_replace('/[\'"\sÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝàáâãäåæçèéêëìíîïðñòóôõöøùúûüý]/', '', $originalFileName.'.'.$extension);
                    $processedFileName=preg_replace('/[\'"\sÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝàáâãäåæçèéêëìíîïðñòóôõöøùúûüý]/', '', $originalFileName);
                    // on ajoute le fichier a l'instance du modèle
                    $experience->addMedia($file)
                    // ->withCustomProperties(['folder' => 'Cloud_Laravel_App/Ressources/Produits/image_produit-'.$produitservice->nom_produit]) exemple envoyer des custom properties
                    ->usingFilename($newFileName)
                    ->toMediaCollection($destination.'/'.$processedFileName,'google');
                    $experience->save();
                    
                    //upload success
                    $success='Le fichier a été ajouté avec succès';
                    
                    // Stockez la variable $success_image dans la session flash
                    session()->flash('success', $success);
                    return redirect()->back();
                }

        }

        switch ($type_contenu) {
            case 'bon cadeau':
                $timestamp = time();
                $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
                $current_date->setTimestamp($timestamp);
                $notif_text = 'Création d\'un nouveau content experience de type ' . $type_contenu . ' associé à l\'experience de ID ' . $id_experience . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

                $notification = DB::connection('mysql2')->table('notification')
                    ->insertGetId([
                        'contenu_notification' => $notif_text,
                        'date_notification' => $current_date->format('Y-m-d H:i:s'),
                        'type' => 'content experience/bon cadeau'
                    ]);


                $content = DB::connection('mysql2')->table('contents_experience')
                    ->insertGetId([
                        'date_heure' => $current_date->format('Y-m-d H:i:s'),
                        'date_update' => $current_date->format('Y-m-d H:i:s'),
                        'description_' => $nom,
                        'type' => 'storytelling',
                        'id_experience' => $id_experience
                    ]);
                $bon_cadeau = DB::connection('mysql2')->table('bon_cadeau')
                    ->insert([
                        'id_content_experience' => $content,
                        'nom_destinataire' => $nom,
                        'titre' => $nom,
                        'message' => $nom,
                    ]);

                break;

            case 'storytelling':
                $timestamp = time();
                $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
                $current_date->setTimestamp($timestamp);
                $notif_text = 'Création d\'un nouveau content experience de type ' . $type_contenu . ' associé à l\'experience de ID ' . $id_experience . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

                $notification = DB::connection('mysql2')->table('notification')
                    ->insertGetId([
                        'contenu_notification' => $notif_text,
                        'date_notification' => $current_date->format('Y-m-d H:i:s'),
                        'type' => 'content experience/storytelling'
                    ]);

                $content = DB::connection('mysql2')->table('contents_experience')
                    ->insertGetId([
                        'date_heure' => $current_date->format('Y-m-d H:i:s'),
                        'date_update' => $current_date->format('Y-m-d H:i:s'),
                        'description_' => $nom,
                        'type' => 'storytelling',
                        'id_experience' => $id_experience
                    ]);
                $storytelling = DB::connection('mysql2')->table('storytelling')
                    ->insert([
                        'id_content_experience' => $content,
                        'description' => $nom,
                        'date_creation' => $current_date->format('Y-m-d H:i:s'),
                        'date_update' => $current_date->format('Y-m-d H:i:s'),
                    ]);

                break;

            case 'livrable':
                $timestamp = time();
                $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
                $current_date->setTimestamp($timestamp);
                $notif_text = 'Création d\'un nouveau content experience de type ' . $type_contenu . ' associé à l\'experience de ID ' . $id_experience . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

                $notification = DB::connection('mysql2')->table('notification')
                    ->insertGetId([
                        'contenu_notification' => $notif_text,
                        'date_notification' => $current_date->format('Y-m-d H:i:s'),
                        'type' => 'content experience/livrable'
                    ]);

                $content = DB::connection('mysql2')->table('contents_experience')
                    ->insertGetId([
                        'date_heure' => $current_date->format('Y-m-d H:i:s'),
                        'date_update' => $current_date->format('Y-m-d H:i:s'),
                        'description_' => $nom,
                        'type' => 'storytelling',
                        'id_experience' => $id_experience
                    ]);
                $livrables = DB::connection('mysql2')->table('livrables')
                    ->insert([
                        'id_content_experience' => $content,
                        'nom' => $nom,
                        'url' => $url,
                        'date_creation' => $current_date->format('Y-m-d H:i:s'),
                        'date_update' => $current_date->format('Y-m-d H:i:s'),
                    ]);

                break;

            case 'media':
                $timestamp = time();
                $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
                $current_date->setTimestamp($timestamp);
                $notif_text = 'Création d\'un nouveau content experience de type ' . $type_contenu . ' associé à l\'experience de ID ' . $id_experience . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

                $notification = DB::connection('mysql2')->table('notification')
                    ->insertGetId([
                        'contenu_notification' => $notif_text,
                        'date_notification' => $current_date->format('Y-m-d H:i:s'),
                        'type' => 'content experience/media'
                    ]);

                $content = DB::connection('mysql2')->table('contents_experience')
                    ->insertGetId([
                        'date_heure' => $current_date->format('Y-m-d H:i:s'),
                        'date_update' => $current_date->format('Y-m-d H:i:s'),
                        'description_' => $nom,
                        'type' => 'storytelling',
                        'id_experience' => $id_experience
                    ]);
                $media = DB::connection('mysql2')->table('media')
                    ->insert([
                        'id_content_experience' => $content,
                        'description' => $nom,
                        'url' => $url,
                        'date_creation' => $current_date->format('Y-m-d H:i:s'),
                        'date_update' => $current_date->format('Y-m-d H:i:s'),
                    ]);

                break;
            case 'header':
                    sendContentToDrive($request,'prod/header',validationForImages($request));
                break;
            case 'pochette':
                    sendContentToDrive($request,'prod/pochette',validationForImages($request));
                break;
            case 'video_youtube':
                sendVideoYoutube($request,$id_experience);
                break;
            case 'master_video_clip':
                sendContentToDrive($request,'prod/master_video_clip',validationForVideos($request));
                break;
            case 'interview':
                sendContentToDrive($request,'prod/interview',validationForVideos($request));
                break;
            case 'mix':
                sendContentToDrive($request,'prod/mix',validationForSongs($request));
                break;
            case 'enregistrement_studio':
                sendContentToDrive($request,'enregistrement/studio',validationForSongs($request));
                break;
            case 'enregistrement_video':
                sendContentToDrive($request,'enregistrement/video',validationForVideos($request));
                break;
            case 'enregistrement_photo':
                sendContentToDrive($request,'enregistrement/photo',validationForImages($request));
                break;
            case 'enregistrement_interview':
                sendContentToDrive($request,'enregistrement/interview',validationForVideos($request));
                break;
            case 'teaser_experience_musique':
                sendContentToDrive($request,'market/916_teaser_experience_music',validationForSongs($request));
                break;
            case 'teaser_experience_clip':
                sendContentToDrive($request,'market/916_teaser_experience_clip',validationForVideos($request));
                break;
            case 'teaser_experience_interview':
                sendContentToDrive($request,'market/916_teaser_ interview',validationForVideos($request));
                break;
            case 'content_experience':
                sendContentToDrive($request,'market/content_experience',validationForAllFiles($request));
                break;
            case 'customer_success':
                sendContentToDrive($request,'market/customer_success',validationForAllFiles($request));
                break;
            case 'content_promo_experience':
                sendContentToDrive($request,'market/content_promo_expérience',validationForAllFiles($request));
                break;
            case 'content_promo_lalachante':
                sendContentToDrive($request,'market/content_promo_lalachante',validationForAllFiles($request));
                break;
            case 'content_promo_story':
                sendContentToDrive($request,'market/story',validationForVideos($request));
                break;
            case 'bon_cadeau_image':
                sendContentToDrive($request,'bon_cadeau',validationForImages($request));
                break;
            default:
                return redirect()->route('experience.show', compact('id_experience', 'num_facture'))
                    ->with('error', 'Erreur type de contenu invalide');
        }

        return redirect()->route('experience.show', compact('id_experience', 'num_facture'))
            ->with('success', 'Contenu ajouté avec succès');
    }

    public function deleteSelect(Request $request)
    {
        $ids = $request->input('experiences');
        DB::connection('mysql2')->table('experience')->whereIn('id_experience', $ids)->delete();

        return redirect()->route('experience.index')->with('success', 'Selection supprimée avec succes');
    }

    public function createExperienceFolder($id_experience, $num_facture)
    {

        session_start();
        //CONNECTION à DRIVE
        $clientDrive = new \Google_Client();
        $clientDrive->setAuthConfig(__DIR__ . '/../../Google/google_credentials.json');
        $clientDrive->addScope(\Google_Service_Drive::DRIVE);
        $clientDrive->setAccessType('offline');
        $clientDrive->setAccessToken(file_get_contents(__DIR__ . '/../../Google/google_access_token.json')); //$_SESSION['access_token']
        // Use the access token to make API requests
        $drive = new \Google_Service_Drive($clientDrive);
        //}

        $exp = DB::connection('mysql2')->table('experience')
            ->where('id_experience', $id_experience)
            ->first();


        if ($exp->url_experience_folder == null) {
            $sourceFolderId = '1SGYhhShuGOsMg4S-8OKgiiE83stlmvX3';
            $destinationFolderId = getenv('DRIVE_EXPERIENCE');
            $newFolderName = '' . $exp->numero_experience . ' - ' . $exp->nom_experience;

            $sourceFolder = $this->copyFolder($sourceFolderId, $destinationFolderId, $newFolderName, $drive);

            DB::connection('mysql2')->table('experience')
                ->where('id_experience', $id_experience)
                ->update(['url_experience_folder' => 'https://drive.google.com/drive/u/1/folders/' . $sourceFolder]);
            return redirect()->route('experience.show', ['id_experience' => $id_experience, 'num_facture' => $num_facture])->with('success', 'Creation de dossier éffectué avec succes');
        } else {
            return redirect()->route('experience.show', ['id_experience' => $id_experience, 'num_facture' => $num_facture])->with('fail', 'A déja un dossier lier, regarder si les données sont corrects');
        }
    }

    public function fillExperienceProject()
    {   
        set_time_limit(500);
        $timezone = new DateTimeZone('Europe/Paris');

        // Créez un objet DateTime avec la timezone de Paris
        $date = new DateTime('now', $timezone);

        // Formatez la date selon votre besoin
        $currentDate = $date->format('Y-m-d H:i:s');

        $experiences = DB::connection('mysql2')->table('experience')->where('id_projet', null)->get();
        //dd($experiences);
        // Parcours des experiences de la base de données
        foreach ($experiences as $experience) {
            $pr = DB::connection('mysql2')->table('experience')->where('id_experience', $experience->id_experience)->first();
            $con = DB::connection('mysql2')->table('contact_experience')
                ->where('profil','Client')
                ->orWhere('profil','Client-User')
                ->first();
            if (empty($pr->id_projet)) {
                error_log('PARCOURS DES EXPERIENCES EN COURS');
                $pr = DB::connection('mysql2')->table('projets')
                    ->insertGetId([
                        'nom' => $experience->nom_experience,
                        'description_courte' => '',
                        'description_detaille' => '',
                        'info_contributeur' => '',
                        'date_creation' => $currentDate,
                        'visibilite' => 'publique',
                        'id_type_projet' => 1,
                        'id_statut_projet' => 1
                    ]);

                // DB::connection('mysql2')->table('contact_projets')
                //     ->insert([
                //         'id_contact' => $con->id_contact,
                //         'id_projet' => $pr
                //     ]);

                DB::connection('mysql2')->table('experience')
                    ->where('id_experience', $experience->id_experience)
                    ->update([
                        'id_projet' => $pr
                    ]);

                $cgnt = DB::connection('mysql2')->table('cagnottes')
                    ->insert([
                        'titre' => 'Cagnotte ' . $experience->nom_experience,
                        'montant_actuel' => 0,
                        'id_categorie' => 1,
                        'id_projet' => $pr,
                        'id_statut_cagnotte' => 1
                    ]);

                error_log('PAROURS DES EXPERIENCES OK');

            }
        }
    }

    public static function setVisibility(int|Experience $experience, string $visibility){
        if (empty($experience->id_experience)) {
            $experience = Experience::find($experience);
        }
        $experience->visibility = $visibility;
        $experience->save();
        return response()->json(['message' => 'Succès']);
    }

    public static function createExperiencePlus(){
        $pack_experiences = PackExperience::where('nb_titres','>',1)
            ->whereNotNull('id_experience')->get();
        $experiences = [];
        // dd($pack_experiences);
        foreach ($pack_experiences as $pack_experience) {
            $expe = Experience::find($pack_experience->id_experience);
            $experiences[] = $expe;
            error_log('Before loop');
            for ($i=1;$i<intval($pack_experience->nb_titres);$i) {
                error_log('GOOOOO');
                $exp = Experience::create([
                    'nom_experience' => 'Expérience '.$expe->numero_experience.'-'.($i+1),
                    'numero_experience' => $expe->numero_experience.'-'.($i+1),
                    'date_creation'=>$expe->date_creation
                ]);

                $notification2 = Notification::create([
                    'contenu_notification'=>'L\'experience a été créée',
                    'date_notification'=>$expe->date_creation,
                    'type'=>'facture'
                ]);
                
                $experience_statut_notification = ExperienceStatutNotification::create([
                    'id_notification'=>$notification2->id_notification,
                    'date_statut'=>$expe->date_creation,
                    'id_experience'=>$exp->id_experience,
                    'id_statut_experience'=>1
                ]);
                
                $experiences[] = $exp;
                
                $pack_ = PackExperience::create([
                    'nb_titres'=>1,
                    'nb_participants'=>$pack_experience->nb_participants,
                    'id_pack'=>$pack_experience->id_pack,
                    'num_facture'=>$pack_experience->num_facture,
                    'id_experience'=> $exp->id_experience,
                    'id_liste_prix'=> 7
                ]);
                $pack_experience->nb_titres+=-1;
            }
            $pack_experience->save();
        }
        error_log('OK');
        dd($experiences);
    }
}
