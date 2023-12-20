<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use App\Models\experienceApp\Pack;
use App\Models\experienceApp\Remise;
use Illuminate\Http\Request;
use App\Models\experienceApp\ProduitService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RemiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $remise = new Remise;
        $remise->setConnection('mysql2');

        $perPage = $request->get('perPage') ?? 10; // par défaut 10 éléments par page

        $data = DB::connection('mysql2')
            ->table('remise')
            ->leftJoin('historique_remise', function ($join) {
                $join->on('historique_remise.id_remise', '=', 'remise.id_remise')
                    ->whereRaw('historique_remise.id_historique_remise = (SELECT id_historique_remise FROM historique_remise WHERE historique_remise.id_remise = remise.id_remise ORDER BY date_creation DESC LIMIT 1)');
            })
            ->select(
                'remise.id_remise',
                'historique_remise.id_historique_remise',
                'historique_remise.montant',
                'historique_remise.taux',
                'remise.nom_remise',
                'remise.type_remise',
                'remise.date_debut',
                'remise.date_fin',
                'remise.statut',
                'remise.description',
                'remise.id_stripe_remise',
                'remise.url_stripe_remise'
            )
            ->orderByDesc('remise.date_fin')
            ->paginate($perPage);

        // -------------------28.06.23-------------------------------------
        $liste_type =  DB::connection('mysql2')->table('remise')
            ->select('type_remise')
            ->distinct()
            ->get();

        $liste_statut = DB::connection('mysql2')->table('remise')
            ->select('statut')
            ->distinct()
            ->get();
        // ------------------------------------------------
        $statut_experience = $request->get('statut_experience');
        $periode = $request->get('periode');
        $ma_periode = $request->get('ma_periode');
        $la_periode = null;
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
        $query = DB::connection('mysql2')
            ->table('remise')
            ->leftJoin('historique_remise', function ($join) {
                $join->on('historique_remise.id_remise', '=', 'remise.id_remise')
                    ->whereRaw('historique_remise.id_historique_remise = (SELECT id_historique_remise FROM historique_remise WHERE historique_remise.id_remise = remise.id_remise ORDER BY date_creation DESC LIMIT 1)');
            })
            ->select('remise.id_remise', 'historique_remise.id_historique_remise', 'historique_remise.montant', 'historique_remise.taux', 'remise.nom_remise', 'remise.type_remise', 'remise.date_debut', 'remise.date_fin', 'remise.statut', 'remise.description', 'remise.id_stripe_remise', 'remise.url_stripe_remise')
            ->orderByDesc('remise.date_fin');

        // ***************************************
        $count_stats = [];
        foreach ($liste_statut as $statut) {
            $count_query = clone $query;
            $count_query->where('remise.statut', '=', $statut->statut);
            $count = $count_query->count();

            $count_stats[$statut->statut] = [
                'count' => $count,
                'date' => Carbon::create(2016, 1, 1, 0, 0, 0),
            ];
        }
        // ------- prochain------
        $count_query = clone $query;
        $count_query->where('remise.date_debut', '>', $now);
        $count = $count_query->count();

        $count_stats['prochain'] = [
            'count' => $count,
            'date' => Carbon::create(2016, 1, 1, 0, 0, 0),
        ];
        // ------- expiré------
        $count_query = clone $query;
        $count_query->where('remise.date_fin', '<', $now);
        $count = $count_query->count();

        $count_stats['expiré'] = [
            'count' => $count,
            'date' => Carbon::create(2016, 1, 1, 0, 0, 0),
        ];

        // ------------------21.06.23--------------------------------------
        $multisearchnom = $request->get('multisearchnom');
        $multisearchtel = $request->get('multisearchtel');
        $multisearchprenom = $request->get('multisearchprenom');
        $multisearchtype = $request->get('multisearchtype');
        $multisearchstat = $request->get('multisearchstat');

        if (isset($multisearchnom) || isset($multisearchtel) || isset($multisearchprenom) || isset($multisearchtype) || isset($multisearchstat)) {
            $data = DB::connection('mysql2')->table('remise')
                ->leftJoin('historique_remise', function ($join) {
                    $join->on('historique_remise.id_remise', '=', 'remise.id_remise')
                        ->whereRaw('historique_remise.id_historique_remise = (SELECT id_historique_remise FROM historique_remise WHERE historique_remise.id_remise = remise.id_remise ORDER BY date_creation DESC LIMIT 1)');
                })
                ->select(
                    'remise.id_remise',
                    'historique_remise.id_historique_remise',
                    'historique_remise.montant',
                    'historique_remise.taux',
                    'remise.nom_remise',
                    'remise.type_remise',
                    'remise.date_debut',
                    'remise.date_fin',
                    'remise.statut',
                    'remise.description',
                    'remise.id_stripe_remise',
                    'remise.url_stripe_remise'
                )
                ->orderByDesc('remise.date_fin')
                ->when($multisearchtype, function ($query, $multisearchtype) {
                    return $query->where('remise.type_remise', '=', $multisearchtype);
                })
                ->when($multisearchstat, function ($query, $multisearchstat) {
                    return $query->where('remise.statut', '=', $multisearchstat);
                })
                ->paginate($perPage);
        }

        // -----------------------------------------------29.06.23----------------------------------------------------------
        if (isset($la_periode)) {
            $query_1 = DB::connection('mysql2')->table('remise')
                ->leftJoin('historique_remise', function ($join) {
                    $join->on('historique_remise.id_remise', '=', 'remise.id_remise')
                        ->whereRaw('historique_remise.id_historique_remise = (SELECT id_historique_remise FROM historique_remise WHERE historique_remise.id_remise = remise.id_remise ORDER BY date_creation DESC LIMIT 1)');
                })
                ->select(
                    'remise.id_remise',
                    'historique_remise.id_historique_remise',
                    'historique_remise.montant',
                    'historique_remise.taux',
                    'remise.nom_remise',
                    'remise.type_remise',
                    'remise.date_debut',
                    'remise.date_fin',
                    'remise.statut',
                    'remise.description',
                    'remise.id_stripe_remise',
                    'remise.url_stripe_remise'
                )
                ->orderByDesc('remise.date_fin')
                // 
                ->when($la_periode, function ($query, $la_periode) {
                    return $query->whereBetween('remise.date_debut', [
                        $la_periode->format('Y-m-d H:i:s'),
                        Carbon::now()->endOfDay()->format('Y-m-d H:i:s')
                    ]);
                });
            // ***************************************
            $count_stats = [];
            foreach ($liste_statut as $statut) {
                $count_query = clone $query_1;
                $count_query->where('remise.statut', '=', $statut->statut);
                $count = $count_query->count();

                $count_stats[$statut->statut] = [
                    'count' => $count,
                    'date' => $la_periode,
                ];
            }
            // ------- prochain------
            $count_query = clone $query_1;
            $count_query->where('remise.date_debut', '>', $now);
            $count = $count_query->count();

            $count_stats['prochain'] = [
                'count' => $count,
                'date' => $la_periode,
            ];
            // ------- expiré------
            $count_query = clone $query_1;
            $count_query->where('remise.date_fin', '<', $now);
            $count = $count_query->count();

            $count_stats['expiré'] = [
                'count' => $count,
                'date' => $la_periode,
            ];
            // ------------------------------------

            $data = $query_1->paginate($perPage);
        }
        // --------------------------
        if (isset($statut_experience) && isset($ma_periode)) {
            // _______________________filtre : prochain + une periode donnée _________
            if ($statut_experience === 'prochain') {
                $data = DB::connection('mysql2')->table('remise')
                    ->leftJoin('historique_remise', function ($join) {
                        $join->on('historique_remise.id_remise', '=', 'remise.id_remise')
                            ->whereRaw('historique_remise.id_historique_remise = (SELECT id_historique_remise FROM historique_remise WHERE historique_remise.id_remise = remise.id_remise ORDER BY date_creation DESC LIMIT 1)');
                    })
                    ->select(
                        'remise.id_remise',
                        'historique_remise.id_historique_remise',
                        'historique_remise.montant',
                        'historique_remise.taux',
                        'remise.nom_remise',
                        'remise.type_remise',
                        'remise.date_debut',
                        'remise.date_fin',
                        'remise.statut',
                        'remise.description',
                        'remise.id_stripe_remise',
                        'remise.url_stripe_remise'
                    )
                    ->orderByDesc('remise.date_fin')
                    // 
                    ->where('remise.date_debut', '>', $now)
                    ->when($ma_periode, function ($query, $ma_periode) use ($now) {
                        return $query->whereBetween('remise.date_creation', [
                            $ma_periode,
                            $now->endOfDay()->format('Y-m-d H:i:s')
                        ]);
                    })
                    ->paginate($perPage);
                // _______________________filtre : expiré + une periode donnée _________
            } elseif ($statut_experience === 'expiré') {
                $data = DB::connection('mysql2')->table('remise')
                    ->leftJoin('historique_remise', function ($join) {
                        $join->on('historique_remise.id_remise', '=', 'remise.id_remise')
                            ->whereRaw('historique_remise.id_historique_remise = (SELECT id_historique_remise FROM historique_remise WHERE historique_remise.id_remise = remise.id_remise ORDER BY date_creation DESC LIMIT 1)');
                    })
                    ->select(
                        'remise.id_remise',
                        'historique_remise.id_historique_remise',
                        'historique_remise.montant',
                        'historique_remise.taux',
                        'remise.nom_remise',
                        'remise.type_remise',
                        'remise.date_debut',
                        'remise.date_fin',
                        'remise.statut',
                        'remise.description',
                        'remise.id_stripe_remise',
                        'remise.url_stripe_remise'
                    )
                    ->orderByDesc('remise.date_fin')
                    ->where('remise.date_fin', '<', $now)
                    ->when($ma_periode, function ($query, $ma_periode) {
                        return $query->whereBetween('remise.date_creation', [
                            $ma_periode,
                            Carbon::now()->endOfDay()->format('Y-m-d H:i:s')
                        ]);
                    })
                    ->paginate($perPage);
                // _______________________filtre : les autres statut + une periode donnée _________
            } else {
                $data = DB::connection('mysql2')->table('remise')
                    ->leftJoin('historique_remise', function ($join) {
                        $join->on('historique_remise.id_remise', '=', 'remise.id_remise')
                            ->whereRaw('historique_remise.id_historique_remise = (SELECT id_historique_remise FROM historique_remise WHERE historique_remise.id_remise = remise.id_remise ORDER BY date_creation DESC LIMIT 1)');
                    })
                    ->select(
                        'remise.id_remise',
                        'historique_remise.id_historique_remise',
                        'historique_remise.montant',
                        'historique_remise.taux',
                        'remise.nom_remise',
                        'remise.type_remise',
                        'remise.date_debut',
                        'remise.date_fin',
                        'remise.statut',
                        'remise.description',
                        'remise.id_stripe_remise',
                        'remise.url_stripe_remise'
                    )
                    ->orderByDesc('remise.date_fin')
                    ->when($ma_periode, function ($query, $ma_periode) {
                        return $query->whereBetween('remise.date_creation', [
                            $ma_periode,
                            Carbon::now()->endOfDay()->format('Y-m-d H:i:s')
                        ]);
                    })
                    ->when($statut_experience, function ($query, $statut_experience) {
                        return $query->where('remise.statut', '=', $statut_experience);
                    })
                    ->paginate($perPage);
            }
        }


        // -----------------------------------------------29.06.23----------------------------------------------------------
        $value = session('id_remise');  // Stocker la variable dans la session de la table campagne
        $totalRem = $data->total();
        return view('remises.index', compact('data', 'perPage', 'totalRem', 'liste_statut', 'liste_type', 'count_stats'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('remises.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'nom_remise' => 'required',
            'type_remise',
            'taux' => 'required_without:montant|numeric|prohibited_unless:montant,null|nullable',
            'montant' => 'required_without:taux|numeric|prohibited_unless:taux,null|nullable',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut'
        ]);

        if ((date('Y-m-d') >= date('Y-m-d', strtotime($request->date_debut))) && (date('Y-m-d') <= date('Y-m-d', strtotime($request->date_fin)))) {
            $statut = "actif";
        } else {
            $statut = "inactif";
        }

        if (!is_null($request->taux)) {
            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
            $current_date->setTimestamp($timestamp);
            $notif_text = ' Creation d\'une nouvelle remise le ' .  $current_date->format('Y-m-d H:i:s') . '';

            $notification = DB::connection('mysql2')->table('notification')
                ->insertGetId([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'remise'
                ]);


            $date_debut = new DateTime();
            $date_debut = $date_debut->createFromFormat('Y-m-d', $request->date_debut);
            $date_debut->setTime(0, 0, 0, 0);

            $date_fin = new DateTime();
            $date_fin = $date_fin->createFromFormat('Y-m-d', $request->date_fin);
            $date_fin->setTime(0, 0, 0, 0);

            $rem = Remise::create([
                'nom_remise' => $request->nom_remise,
                'type_remise' => $request->type_remise,
                'taux' => $request->taux,
                'montant' => $request->montant,
                'date_debut' => $date_debut->format('Y-m-d H:i:s'),
                'date_fin' => $date_fin->format('Y-m-d H:i:s'),
                'date_creation' => $current_date->format('Y-m-d H:i:s'),
                'date_update' => $current_date->format('Y-m-d H:i:s'),
                'statut' => $statut
            ]);


            // $stripe = new \Stripe\StripeClient(
            //     env('STRIPE_SECRET')
            // );
            // $remise = $stripe->coupons->create([
            //     'percent_off' => floatval($request->taux),
            //     'duration' => 'forever',
            //     'name' => $request->nom_remise,
            //     'metadata' =>
            //     [
            //         'type_remise' => $request->type_remise,
            //         'statut' => $statut,
            //         'id_remise' => $rem->id_remise,
            //     ]
            // ]);
        } elseif (!is_null($request->montant)) {

            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
            $current_date->setTimestamp($timestamp);
            $notif_text = ' Creation d\'une nouvelle remise le ' .  $current_date->format('Y-m-d H:i:s') . '';

            $notification = DB::connection('mysql2')->table('notification')
                ->insertGetId([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'remise'
                ]);


            $date_debut = new DateTime();
            $date_debut = $date_debut->createFromFormat('Y-m-d', $request->date_debut);
            $date_debut->setTime(0, 0, 0, 0);

            $date_fin = new DateTime();
            $date_fin = $date_fin->createFromFormat('Y-m-d', $request->date_fin);
            $date_fin->setTime(0, 0, 0, 0);

            $rem = Remise::create([
                'nom_remise' => $request->nom_remise,
                'type_remise' => $request->type_remise,
                'taux' => $request->taux,
                'montant' => $request->montant,
                'date_debut' => $date_debut->format('Y-m-d H:i:s'),
                'date_fin' => $date_fin->format('Y-m-d H:i:s'),
                'date_creation' => $current_date->format('Y-m-d H:i:s'),
                'date_update' => $current_date->format('Y-m-d H:i:s'),
                'statut' => $statut
            ]);


            // $stripe = new \Stripe\StripeClient(
            //     env('STRIPE_SECRET')
            // );
            // $remise = $stripe->coupons->create([
            //     'amount_off' => floatval($request->montant) * 100,
            //     'currency' => 'eur',
            //     'duration' => 'forever',
            //     'name' => $request->nom_remise,
            //     'metadata' =>
            //     [
            //         'type_remise' => $request->type_remise,
            //         'statut' => $statut,
            //         'id_remise' => $rem->id_remise,
            //     ]
            // ]);
        } else {
            return redirect()->route('remises.index')
                ->with('error', ' Erreur lors de l\'ajout de la remise');
        }

        // $remise = substr($remise, 20);

        // $remise = json_decode($remise, true);

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);

        // DB::connection('mysql2')
        //     ->update('UPDATE remise SET remise.id_stripe_remise="' . $remise['id'] . '", remise.url_stripe_remise="https://dashboard.stripe.com/test/coupons/' . $remise['id'] . '",remise.date_update="' . $current_date->format('Y-m-d H:i:s') . '" WHERE remise.id_remise=' . $rem->id_remise . '');
        DB::connection('mysql2')->table('historique_remise')->insert([
            'id_remise' => $rem->id_remise,
            'montant' => $rem->montant,
            'taux' => $rem->taux,
            'date_creation' => $rem->date_creation
        ]);

        $rems = DB::connection('mysql2')->table('historique_remise')
            ->join('codes_promo', 'codes_promo.id_remise', '=', 'historique_remise.id_remise')
            ->where('historique_remise.id_remise', $rem->id_remise)
            ->first();

        return redirect()->route('remises.show', ['id_remise' => $rem->id_remise, 'rems' => $rems])
            ->with('success', 'La remise a bien été ajoutée');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id_remise)
    {

        $modelremise = new Remise;
        $modelremise->setConnection('mysql2');

        $id_con = DB::connection('mysql2')->select('SELECT id_remise FROM remise');

        $url1 = (int) $id_remise;
        $url = $url1;

        foreach ($id_con as $key => $value) {
            if ($url1 === $value->id_remise) {
                $url = $url1;
            }
        }

        $remise = DB::connection('mysql2')->selectOne('SELECT remise.description, remise.id_remise,remise.nom_remise,remise.type_remise,remise.taux,remise.montant,remise.date_debut,remise.date_fin,remise.statut,COUNT(codes_promo.id_remise) as nb_codes
        FROM remise JOIN codes_promo
        ON remise.id_remise=codes_promo.id_remise
        WHERE remise.id_remise=?', [$url]);

        $statut = $remise->statut;


        $id_hist_rem = session()->get('id_hist_rem');


        $packsremise = DB::connection('mysql2')
            ->table('pack')
            ->join('packs_remise', 'pack.id_pack', '=', 'packs_remise.id_pack')
            ->join('historique_remise', function ($join) {
                $join->on('packs_remise.id_remise', '=', 'historique_remise.id_remise')
                    ->whereRaw('historique_remise.id_historique_remise = (SELECT MAX(id_historique_remise) FROM historique_remise WHERE historique_remise.id_remise = packs_remise.id_remise)');
            })
            ->select('pack.id_pack', 'pack.nom', 'pack.prix', 'historique_remise.taux', 'historique_remise.montant', 'packs_remise.id_remise', 'historique_remise.id_historique_remise')
            ->where('packs_remise.id_remise', $url)
            ->get();

        $produitsremise = DB::connection('mysql2')
            ->table('produits_services')
            ->join('produit_service_remise', 'produits_services.id_produit', '=', 'produit_service_remise.id_produit')
            ->join('historique_remise', function ($join) {
                $join->on('produit_service_remise.id_remise', '=', 'historique_remise.id_remise')
                    ->whereRaw('historique_remise.id_historique_remise = (SELECT MAX(id_historique_remise) FROM historique_remise WHERE historique_remise.id_remise = produit_service_remise.id_remise)');
            })
            ->select('produits_services.id_produit', 'produits_services.nom_produit', 'produits_services.prix', 'historique_remise.montant', 'historique_remise.taux')
            ->where('produit_service_remise.id_remise', $url)
            ->get();


        $num_fact = [];
        $benstep1 = DB::connection('mysql2')->table('remise')->join('factures_remise', 'factures_remise.id_remise', '=', 'remise.id_remise')->where('remise.id_remise', '=', $url)->get();
        foreach ($benstep1 as $key => $value) {
            array_push($num_fact, $value->num_facture);
        }

        $beneficiaires = DB::connection('mysql2')->table('paiement')
            ->join('contact', 'paiement.id_contact', '=', 'contact.id_contact')
            ->select('num_facture', 'nom', 'prenom', 'contact.date_creation', 'contact.id_contact')
            ->whereIn('num_facture', $num_fact)
            ->distinct()
            ->get();



        $countfactrem = DB::connection('mysql2')->table('factures_remise')->where('id_remise', '=', $url)->count();

        if ($countfactrem > 0) {
            $codes = DB::connection('mysql2')->select('SELECT codes_promo.id_code,codes_promo.code,codes_promo.nb_utilisation,  codes_promo.nb_code
            FROM codes_promo JOIN historique_remise JOIN factures_remise
            ON codes_promo.id_remise=historique_remise.id_remise
            AND historique_remise.id_remise=factures_remise.id_remise
            WHERE historique_remise.id_remise=?
            GROUP BY codes_promo.id_code', [$url]);
        } else {
            $codes = DB::connection('mysql2')->select('SELECT codes_promo.id_code,codes_promo.code,codes_promo.nb_utilisation, codes_promo.nb_code
            FROM codes_promo JOIN remise
            ON codes_promo.id_remise=remise.id_remise
            WHERE remise.id_remise=?
            GROUP BY codes_promo.id_code', [$url]);
        }

        $rems = DB::connection('mysql2')->table('historique_remise')
            ->join('remise', 'remise.id_remise', '=', 'historique_remise.id_remise')
            ->leftJoin('codes_promo', 'codes_promo.id_remise', '=', 'historique_remise.id_remise')
            ->where('historique_remise.id_remise', $url)
            ->first();


        $id_pack = Pack::where('id_pack', '>', 0)->pluck('id_pack')->toArray();
        $nom_pack =  Pack::where('id_pack', '>', 0)->pluck('nom')->toArray();

        $id_prod = ProduitService::where('id_produit', '>', 0)->pluck('id_produit')->toArray();
        $nom_prod =  ProduitService::where('id_produit', '>', 0)->pluck('nom_produit')->toArray();

        $hist_rem = DB::connection('mysql2')->table('historique_remise')
            ->whereIn('id_remise', function ($query) {
                $query->select('id_remise')
                    ->from('historique_remise')
                    ->latest('date_creation')
                    ->groupBy('id_remise');
            })
            ->get();
            
        // JM upload image
        //gestion des erreurs
        $id_remise = (int) $id_remise;
        
        // on trouver la remise grâce à son id 
        $remise=Remise::findorfail($id_remise);
        // on récupère le fichier venant de l'input file de la vue
        $image_remise = $request->file('image_remise');
        // si le fichier existe on execute le code
        if($image_remise){
            $request->validate([
                'image_remise' => 'required|image|mimes:jpeg,png,gif,jpg,bmp,tiff,webp,svg,ico,tga,pcx,pbm,pgm,ppm', // Acceptez uniquement les formats JPEG, PNG et GIF.
                
            ]);

            // on recupère l'extension
            $extension = $image_remise->getClientOriginalExtension();
            // on recupère le nom originale
            $originalFileName = $image_remise->getClientOriginalName();
            // on enlève les espaces, les accents
            $newFileName = preg_replace('/[\'"\sÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝàáâãäåæçèéêëìíîïðñòóôõöøùúûüý]/', '', $originalFileName);
            //si une image existe on l'efface, ( de la bdd ainsi que de google drive)
            if($remise->getFirstMedia('image_remise')){
                $remise->getFirstMedia('image_remise')->delete();
            }
            // on ajoute l'image
            $remise->addMedia($image_remise)
            ->withCustomProperties(['folder' => 'Cloud_Laravel_App/Ressources/Remises/image_remise-'.$remise->nom_remise])
            ->usingFilename($newFileName)
            ->toMediaCollection('image_remise','google');
            $remise->save();

            //upload success
            $success_image='L\'image à été ajouté avec succès';
            
            // Stockez la variable $success_image dans la session flash
            session()->flash('success_image', $success_image);
            return redirect()->to('remises.show/' . $id_remise);
        }

        // on initialise une variable à null
        $image_de_remise=null;
        // si l'image existe on creer son url qu'on enverra dans la vue
        if($remise->getFirstMedia('image_remise')){
            $image_de_remise=$remise->getFirstMedia('image_remise')->getUrl();
        }

        ////////////Suppression de l'image////////////
        $delete_image = $request->has('delete_image');
        if ($remise->getFirstMedia('image_remise') && $delete_image) {
            $remise->getFirstMedia('image_remise')->delete();
            
            //delete success
            $success_image_delete='L\'image à été supprimée';

            // Stockez la variable $success_image dans la session flash
            session()->flash('success_image_delete', $success_image_delete);

            return redirect()->to('remises.show/'.$id_remise);
        }

        return view('remises.show', compact('remise', 'statut', 'packsremise', 'produitsremise', 'beneficiaires', 'codes', 'rems', 'id_pack', 'nom_pack', 'id_prod', 'nom_prod', 'hist_rem','image_de_remise'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($remises)
    {
        $modelremise = new Remise();
        $modelremise->setConnection('mysql2');

        $id_remise = DB::connection('mysql2')->select('SELECT id_remise FROM remise');
        $url1 = (int) $remises;

        foreach ($id_remise as $key => $value) {
            if ($url1 === $value->id_remise) {
                $url = $url1;
            }
        }


        $rem = DB::connection('mysql2')->table('historique_remise')
            ->join('remise', 'historique_remise.id_remise', '=', 'remise.id_remise')
            ->where('historique_remise.id_remise', $url)
            ->select('historique_remise.id_remise', 'historique_remise.montant', 'historique_remise.taux', 'remise.nom_remise', 'remise.type_remise', 'remise.date_debut', 'remise.date_fin', 'remise.statut')
            ->first();

        return view('remises.edit', compact('rem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'id_remise' => 'required|exists:mysql2.remise,id_remise',
            'nom_remise' => 'required',
            'type_remise',
            'taux' => 'required_without:montant|numeric|prohibited_unless:montant,null|nullable',
            'montant' => 'required_without:taux|numeric|prohibited_unless:taux,null|nullable',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut'
        ]);

        if ((date('Y-m-d') >= date('Y-m-d', strtotime($request->date_debut))) && (date('Y-m-d') <= date('Y-m-d', strtotime($request->date_fin)))) {
            $statut = "actif";
        } else {
            $statut = "inactif";
        }

        $remise = Remise::find($request->id_remise);

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $notif_text = 'Mise à jour de la remise de ID ' . $request->id_remise . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

        $date_debut = new DateTime();
        $date_debut = $date_debut->createFromFormat('Y-m-d', $request->date_debut);
        $date_debut->setTime(0, 0, 0, 0);

        $date_fin = new DateTime();
        $date_fin = $date_fin->createFromFormat('Y-m-d', $request->date_fin);
        $date_fin->setTime(0, 0, 0, 0);

        $notification = DB::connection('mysql2')->table('notification')
            ->insertGetId([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'remise'
            ]);

        $remise->update([
            'nom_remise' => $request->nom_remise,
            'type_remise' => $request->type_remise,
            'taux' => $request->taux,
            'montant' => $request->montant,
            'date_debut' => $date_debut->format('Y-m-d H:i:s'),
            'date_fin' => $date_fin->format('Y-m-d H:i:s'),
            'date_update' => $current_date->format('Y-m-d H:i:s'),
            'statut' => $statut
        ]);

        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );
        $stripe->coupons->update(
            $remise->id_stripe_remise,
            [
                'name' => $request->nom_remise,
                'metadata' =>
                [
                    'type_remise' => $request->type_remise,
                    'statut' => $statut,
                    'id_remise' => $remise->id_remise,
                ]
            ]
        );
        DB::connection('mysql2')->table('historique_remise')

            ->insert([
                'id_remise' => $request->id_remise,
                'montant' => $request->montant,
                'taux' => $request->taux,
                'date_creation' => $remise->date_update
            ]);



        return redirect()->route('remises.show', ['id_remise' => $remise->id_remise])
            ->with('success', 'La mise a jour a bien été effectuée');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($remise)
    {
        $parrainage = DB::connection('mysql2')->table('parrainage')
            ->join('codes_promo', 'parrainage.id_code', '=', 'codes_promo.id_code')
            ->join('remise', 'codes_promo.id_remise', '=', 'remise.id_remise')
            ->where('remise.id_remise', $remise)
            ->get();

        $facture_remise = DB::connection('mysql2')->table('factures_remise')
            ->where('id_remise', $remise)
            ->get();

        $packs_remise = DB::connection('mysql2')->table('packs_remise')
            ->where('id_remise', $remise)
            ->get();

        $produit_service_remise = DB::connection('mysql2')->table('produit_service_remise')
            ->where('id_remise', $remise)
            ->get();

        $rem = DB::connection('mysql2')->table('remise')
            ->where('id_remise', $remise)
            ->get();

        if (($parrainage->isEmpty()) && ($facture_remise->isEmpty()) && ($packs_remise->isEmpty()) && ($produit_service_remise->isEmpty())) {
            if ($rem[0]->id_stripe_remise != null) {
                $stripe = new \Stripe\StripeClient(
                    env('STRIPE_SECRET')
                );
                $stripe->coupons->delete(
                    $rem[0]->id_stripe_remise,
                    []
                );
            }

            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
            $current_date->setTimestamp($timestamp);
            $notif_text = ' Suppression de la remise de ID ' . $remise . ' et tous les codes associés avec cette remise le ' .  $current_date->format('Y-m-d H:i:s') . '';

            $notification = DB::connection('mysql2')->table('notification')
                ->insertGetId([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'remise'
                ]);

            $code = DB::connection('mysql2')->table('codes_promo')
                ->where('id_remise', $remise)
                ->delete();

            $hist_rem = DB::connection('mysql2')->table('historique_remise')
                ->where('id_remise', '=', $remise)
                ->update(['id_remise' => null]);

            $remise = Remise::destroy($remise);
            return redirect()->route('remises.index')
                ->with('success', 'La remise a bien été supprimée');
        }
        return redirect()->route('remises.index')
            ->with('error', 'Erreur lors de la suppression de la remise');
    }


    // -------------------- changer de statut produit ----------------------------
    public function change_statut($id_remise, $statut)
    {
        $modelRemise = new Remise();
        $modelRemise->setConnection('mysql2');

        $idRemise = DB::connection('mysql2')->select('SELECT id_remise FROM remise');
        $url1 = (int)$id_remise;

        $url = null;
        foreach ($idRemise as $key => $value) {
            if ($url1 === $value->id_remise) {
                $url = $url1;
                break;
            }
        }

        if ($url === null) {
            return redirect('/remises');
        }


        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);

        DB::connection('mysql2')->statement('UPDATE remise SET statut = ? , date_update = ? WHERE id_remise = ?', [$statut, $current_date->format('Y-m-d H:i:s'), $url]);
    }
    // ---------
    public function modif_descrip(Request $request)
    {
        $request->validate([
            'id_remise' => 'required|exists:mysql2.remise,id_remise',
            'description' => 'required',
        ]);
        // dd( $variable2);

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);

        DB::connection('mysql2')->statement('UPDATE remise SET description = ?, date_update = ? WHERE id_remise = ?', [$request->description, $current_date->format('Y-m-d H:i:s'), $request->id_remise]);

        return redirect()->route('remises.show', ['id_remise' => $request->id_remise]);
    }

    public function saveAll()
    {
        $data = DB::connection('mysql2')->table('remise')->leftJoin('historique_remise', 'remise.id_remise', '=', 'historique_remise.id_remise')->get();
        foreach ($data as $item) {
            $existingData = DB::connection('mysql2')->table('historique_remise')
                ->where('id_remise', $item->id_remise)
                ->where('date_creation', $item->date_creation)
                ->where('montant', $item->montant)
                ->where('taux', $item->taux)
                ->first();
            if (!$existingData) {
                DB::connection('mysql2')->table('historique_remise')->insert([
                    'date_creation' => $item->date_creation,
                    'montant' => $item->montant,
                    'taux' => $item->taux,
                    'id_remise' => $item->id_remise
                ]);
            }
        }
        return redirect('remises.index')->with('success', 'Remises enregistrée avec succes !');
    }

    public function insertPack($remises)
    {
        $modelremise = new Remise();
        $modelremise->setConnection('mysql2');

        $id_remise = DB::connection('mysql2')->select('SELECT id_remise FROM remise');
        $url1 = (int) $remises;

        foreach ($id_remise as $key => $value) {
            if ($url1 === $value->id_remise) {
                $url = $url1;
            }
        }
        $rem = DB::connection('mysql2')->selectOne('SELECT remise.id_remise,remise.nom_remise,remise.type_remise,remise.taux,remise.montant,remise.date_debut,remise.date_fin,remise.statut
        FROM remise
        WHERE remise.id_remise=?', [$url]);

        $id_pack = Pack::where('id_pack', '>', 0)->pluck('id_pack')->toArray();
        $nom_pack =  Pack::where('id_pack', '>', 0)->pluck('nom')->toArray();

        $hist_rem = DB::connection('mysql2')->table('historique_remise')
            ->where('id_remise', '=', $url)
            ->get();

        return view('remises.insertpack', compact('rem', 'id_pack', 'nom_pack', 'hist_rem'));
    }

    public function addPack(Request $request)
    {
        $request->validate([
            'id_remise' => 'required|exists:mysql2.remise,id_remise',
            'id_pack' => 'required|exists:mysql2.pack,id_pack',
            'id_hist_rem' => 'required_without_all:taux,montant|prohibited_unless:montant,null|prohibited_unless:taux,null|nullable|exists:mysql2.historique_remise,id_historique_remise',
            'taux' => 'required_without_all:montant,id_hist_rem|numeric|prohibited_unless:montant,null||nullable',
            'montant' => 'required_without_all:taux,id_hist_rem|numeric|prohibited_unless:taux,null|prohibited_unless:id_hist_rem,null|nullable',
        ]);

        if (!is_null($request->id_hist_rem)) {
            $countfactrem = DB::connection('mysql2')->table('packs_remise')
                ->where('id_remise', '=', $request->id_remise)
                ->where('id_pack', '=', $request->id_pack)
                ->count();

            if ($countfactrem == 1) {
                $timestamp = time();
                $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
                $current_date->setTimestamp($timestamp);
                $notif_text = 'Mise à jour de l\'association entre la remise de ID ' . $request->id_remise . ' et du pack de ID ' . $request->id_pack . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

                $notification = DB::connection('mysql2')->table('notification')
                    ->insertGetId([
                        'contenu_notification' => $notif_text,
                        'date_notification' => $current_date->format('Y-m-d H:i:s'),
                        'type' => 'packs remise'
                    ]);

                DB::connection('mysql2')->table('packs_remise')
                    ->where('id_remise', '=', $request->id_remise)
                    ->where('id_pack', '=', $request->id_pack)
                    ->update(['id_historique_remise' => $request->id_hist_rem]);
            } elseif ($countfactrem == 0) {
                $timestamp = time();
                $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
                $current_date->setTimestamp($timestamp);
                $notif_text = 'Creation de l\'association entre la remise de ID ' . $request->id_remise . ' et du pack de ID ' . $request->id_pack . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

                $notification = DB::connection('mysql2')->table('notification')
                    ->insertGetId([
                        'contenu_notification' => $notif_text,
                        'date_notification' => $current_date->format('Y-m-d H:i:s'),
                        'type' => 'packs remise'
                    ]);

                DB::connection('mysql2')->table('packs_remise')
                    ->insert([
                        'id_remise' => $request->id_remise,
                        'id_pack' => $request->id_pack,
                        'id_historique_remise' => $request->id_hist_rem,
                    ]);
            } else {
                return redirect()->route('remises.show', ['id_remise' => $request->id_remise])
                    ->with('error', 'Erreur lors de l\'insertion du pack dans la remise utilisant un taux/montant déjà existant');
            }
        } elseif (!is_null($request->taux)) {

            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
            $current_date->setTimestamp($timestamp);
            $notif_text = 'Creation d\'une nouvelle entrée de la table historique_remise associé à la remise de ID ' . $request->id_remise . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

            $notification = DB::connection('mysql2')->table('notification')
                ->insertGetId([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'historique remise'
                ]);

            $new_rem_id = DB::connection('mysql2')->table('historique_remise')
                ->insertGetId([
                    'date_creation' => $current_date->format('Y-m-d H:i:s'),
                    'taux' => $request->taux,
                    'id_remise' => $request->id_remise,
                ]);

            $countfactrem = DB::connection('mysql2')->table('packs_remise')
                ->where('id_remise', '=', $request->id_remise)
                ->where('id_pack', '=', $request->id_pack)
                ->count();

            if ($countfactrem == 1) {
                $timestamp = time();
                $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
                $current_date->setTimestamp($timestamp);
                $notif_text = 'Mise à jour de l\'association entre la remise de ID ' . $request->id_remise . ' et du pack de ID ' . $request->id_pack . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

                $notification = DB::connection('mysql2')->table('notification')
                    ->insertGetId([
                        'contenu_notification' => $notif_text,
                        'date_notification' => $current_date->format('Y-m-d H:i:s'),
                        'type' => 'packs remise'
                    ]);

                DB::connection('mysql2')->table('packs_remise')
                    ->where('id_remise', '=', $request->id_remise)
                    ->where('id_pack', '=', $request->id_pack)
                    ->update(['id_historique_remise' => $new_rem_id]);
            } elseif ($countfactrem == 0) {
                $timestamp = time();
                $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
                $current_date->setTimestamp($timestamp);
                $notif_text = 'Creation de l\'association entre la remise de ID ' . $request->id_remise . ' et du pack de ID ' . $request->id_pack . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

                $notification = DB::connection('mysql2')->table('notification')
                    ->insertGetId([
                        'contenu_notification' => $notif_text,
                        'date_notification' => $current_date->format('Y-m-d H:i:s'),
                        'type' => 'packs remise'
                    ]);

                DB::connection('mysql2')->table('packs_remise')
                    ->insert([
                        'id_remise' => $request->id_remise,
                        'id_pack' => $request->id_pack,
                        'id_historique_remise' => $new_rem_id,
                    ]);
            } else {
                return redirect()->route('remises.show', ['id_remise' => $request->id_remise])
                    ->with('error', 'Erreur lors de l\'insertion du pack dans la remise utilisant une nouvelle historique_remise (taux)');
            }
        } elseif (!is_null($request->montant)) {
            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
            $current_date->setTimestamp($timestamp);
            $notif_text = 'Creation d\'une nouvelle entrée de la table historique_remise associé à la remise de ID ' . $request->id_remise . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

            $notification = DB::connection('mysql2')->table('notification')
                ->insertGetId([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'historique remise'
                ]);

            $new_rem_id = DB::connection('mysql2')->table('historique_remise')
                ->insertGetId([
                    'date_creation' => $current_date->format('Y-m-d H:i:s'),
                    'montant' => $request->montant,
                    'id_remise' => $request->id_remise,
                ]);

            $countfactrem = DB::connection('mysql2')->table('packs_remise')
                ->where('id_remise', '=', $request->id_remise)
                ->where('id_pack', '=', $request->id_pack)
                ->count();

            if ($countfactrem == 1) {
                $timestamp = time();
                $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
                $current_date->setTimestamp($timestamp);
                $notif_text = 'Mise à jour de l\'association entre la remise de ID ' . $request->id_remise . ' et du pack de ID ' . $request->id_pack . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

                $notification = DB::connection('mysql2')->table('notification')
                    ->insertGetId([
                        'contenu_notification' => $notif_text,
                        'date_notification' => $current_date->format('Y-m-d H:i:s'),
                        'type' => 'packs remise'
                    ]);

                DB::connection('mysql2')->table('packs_remise')
                    ->where('id_remise', '=', $request->id_remise)
                    ->where('id_pack', '=', $request->id_pack)
                    ->update(['id_historique_remise' => $new_rem_id]);
            } elseif ($countfactrem == 0) {
                $timestamp = time();
                $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
                $current_date->setTimestamp($timestamp);
                $notif_text = 'Creation de l\'association entre la remise de ID ' . $request->id_remise . ' et du pack de ID ' . $request->id_pack . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

                $notification = DB::connection('mysql2')->table('notification')
                    ->insertGetId([
                        'contenu_notification' => $notif_text,
                        'date_notification' => $current_date->format('Y-m-d H:i:s'),
                        'type' => 'packs remise'
                    ]);

                DB::connection('mysql2')->table('packs_remise')
                    ->insert([
                        'id_remise' => $request->id_remise,
                        'id_pack' => $request->id_pack,
                        'id_historique_remise' => $new_rem_id,
                    ]);
            } else {
                return redirect()->route('remises.show', ['id_remise' => $request->id_remise])
                    ->with('error', 'Erreur lors de l\'insertion du pack dans la remise utilisant une nouvelle historique_remise (montant)');
            }
        } else {
            return redirect()->route('remises.show', ['id_remise' => $request->id_remise])
                ->with('error', 'Erreur inconnu lors de la validation');
        }
        session()->put('id_hist_rem', $request->id_hist_rem);
        return redirect()->route('remises.show', ['id_remise' => $request->id_remise])
            ->with('succes', 'Le pack a bien été associé au produit');
    }

    public function insertProduct($remises)
    {
        $modelremise = new Remise();
        $modelremise->setConnection('mysql2');

        $id_remise = DB::connection('mysql2')->select('SELECT id_remise FROM remise');
        $url1 = (int) $remises;

        foreach ($id_remise as $key => $value) {
            if ($url1 === $value->id_remise) {
                $url = $url1;
            }
        }
        $rem = DB::connection('mysql2')->selectOne('SELECT remise.id_remise,remise.nom_remise,remise.type_remise,remise.taux,remise.montant,remise.date_debut,remise.date_fin,remise.statut
        FROM remise
        WHERE remise.id_remise=?', [$url]);

        $id_prod = ProduitService::where('id_produit', '>', 0)->pluck('id_produit')->toArray();
        $nom_prod =  ProduitService::where('id_produit', '>', 0)->pluck('nom_produit')->toArray();

        $hist_rem = DB::connection('mysql2')->table('historique_remise')
            ->where('id_remise', '=', $url)
            ->get();

        return view('remises.insertproduct', compact('rem', 'id_prod', 'nom_prod', 'hist_rem'));
    }

    public function addProduct(Request $request)
    {
        $request->validate([
            'id_remise' => 'required|exists:mysql2.remise,id_remise',
            'id_produit' => 'required|exists:mysql2.produits_services,id_produit',
            'id_hist_rem' => 'required_without_all:taux,montant|prohibited_unless:montant,null|prohibited_unless:taux,null|nullable|exists:mysql2.historique_remise,id_historique_remise',
            'taux' => 'required_without_all:montant,id_hist_rem|numeric|prohibited_unless:montant,null||nullable',
            'montant' => 'required_without_all:taux,id_hist_rem|numeric|prohibited_unless:taux,null|prohibited_unless:id_hist_rem,null|nullable',
        ]);


        if (!is_null($request->id_hist_rem)) {
            $countfactrem = DB::connection('mysql2')->table('produit_service_remise')
                ->where('id_remise', '=', $request->id_remise)
                ->where('id_produit', '=', $request->id_produit)
                ->count();

            if ($countfactrem == 1) {
                $timestamp = time();
                $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
                $current_date->setTimestamp($timestamp);
                $notif_text = 'Mise à jour de l\'association entre la remise de ID ' . $request->id_remise . ' et du produit de ID ' . $request->id_produit . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

                $notification = DB::connection('mysql2')->table('notification')
                    ->insertGetId([
                        'contenu_notification' => $notif_text,
                        'date_notification' => $current_date->format('Y-m-d H:i:s'),
                        'type' => 'produit service remise'
                    ]);

                DB::connection('mysql2')->table('produit_service_remise')
                    ->where('id_remise', '=', $request->id_remise)
                    ->where('id_produit', '=', $request->id_produit)
                    ->update(['id_historique_remise' => $request->id_hist_rem]);
            } elseif ($countfactrem == 0) {
                $timestamp = time();
                $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
                $current_date->setTimestamp($timestamp);
                $notif_text = 'Creation de l\'association entre la remise de ID ' . $request->id_remise . ' et du produit de ID ' . $request->id_produit . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

                $notification = DB::connection('mysql2')->table('notification')
                    ->insertGetId([
                        'contenu_notification' => $notif_text,
                        'date_notification' => $current_date->format('Y-m-d H:i:s'),
                        'type' => 'produit service remise'
                    ]);

                DB::connection('mysql2')->table('produit_service_remise')
                    ->insert([
                        'id_remise' => $request->id_remise,
                        'id_produit' => $request->id_produit,
                        'id_historique_remise' => $request->id_hist_rem,
                    ]);
            } else {
                return redirect()->route('remises.show', ['id_remise' => $request->id_remise])
                    ->with('error', 'Erreur lors de l\'insertion du produit dans la remise utilisant un taux/montant déjà existant');
            }
        } elseif (!is_null($request->taux)) {

            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
            $current_date->setTimestamp($timestamp);
            $notif_text = 'Creation d\'une nouvelle entrée de la table historique_remise associé à la remise de ID ' . $request->id_remise . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

            $notification = DB::connection('mysql2')->table('notification')
                ->insertGetId([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'historique remise'
                ]);

            $new_rem_id = DB::connection('mysql2')->table('historique_remise')
                ->insertGetId([
                    'date_creation' => $current_date->format('Y-m-d H:i:s'),
                    'taux' => $request->taux,
                    'id_remise' => $request->id_remise,
                ]);

            $countfactrem = DB::connection('mysql2')->table('produit_service_remise')
                ->where('id_remise', '=', $request->id_remise)
                ->where('id_produit', '=', $request->id_produit)
                ->count();

            if ($countfactrem == 1) {
                $timestamp = time();
                $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
                $current_date->setTimestamp($timestamp);
                $notif_text = 'Mise à jour de l\'association entre la remise de ID ' . $request->id_remise . ' et du produit de ID ' . $request->id_produit . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

                $notification = DB::connection('mysql2')->table('notification')
                    ->insertGetId([
                        'contenu_notification' => $notif_text,
                        'date_notification' => $current_date->format('Y-m-d H:i:s'),
                        'type' => 'produit service remise'
                    ]);

                DB::connection('mysql2')->table('produit_service_remise')
                    ->where('id_remise', '=', $request->id_remise)
                    ->where('id_produit', '=', $request->id_produit)
                    ->update(['id_historique_remise' => $new_rem_id]);
            } elseif ($countfactrem == 0) {
                $timestamp = time();
                $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
                $current_date->setTimestamp($timestamp);
                $notif_text = 'Creation de l\'association entre la remise de ID ' . $request->id_remise . ' et du produit de ID ' . $request->id_produit . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

                $notification = DB::connection('mysql2')->table('notification')
                    ->insertGetId([
                        'contenu_notification' => $notif_text,
                        'date_notification' => $current_date->format('Y-m-d H:i:s'),
                        'type' => 'produit service remise'
                    ]);

                DB::connection('mysql2')->table('produit_service_remise')
                    ->insert([
                        'id_remise' => $request->id_remise,
                        'id_produit' => $request->id_produit,
                        'id_historique_remise' => $new_rem_id,
                    ]);
            } else {
                return redirect()->route('remises.show', ['id_remise' => $request->id_remise])
                    ->with('error', 'Erreur lors de l\'insertion du produit dans la remise utilisant une nouvelle historique_remise (taux)');
            }
        } elseif (!is_null($request->montant)) {
            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
            $current_date->setTimestamp($timestamp);
            $notif_text = 'Creation d\'une nouvelle entrée de la table historique_remise associé à la remise de ID ' . $request->id_remise . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

            $notification = DB::connection('mysql2')->table('notification')
                ->insertGetId([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'historique remise'
                ]);

            $new_rem_id = DB::connection('mysql2')->table('historique_remise')
                ->insertGetId([
                    'date_creation' => $current_date->format('Y-m-d H:i:s'),
                    'montant' => $request->montant,
                    'id_remise' => $request->id_remise,
                ]);

            $countfactrem = DB::connection('mysql2')->table('produit_service_remise')
                ->where('id_remise', '=', $request->id_remise)
                ->where('id_produit', '=', $request->id_produit)
                ->count();

            if ($countfactrem == 1) {
                $timestamp = time();
                $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
                $current_date->setTimestamp($timestamp);
                $notif_text = 'Mise à jour de l\'association entre la remise de ID ' . $request->id_remise . ' et du produit de ID ' . $request->id_produit . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

                $notification = DB::connection('mysql2')->table('notification')
                    ->insertGetId([
                        'contenu_notification' => $notif_text,
                        'date_notification' => $current_date->format('Y-m-d H:i:s'),
                        'type' => 'produit service remise'
                    ]);

                DB::connection('mysql2')->table('produit_service_remise')
                    ->where('id_remise', '=', $request->id_remise)
                    ->where('id_produit', '=', $request->id_produit)
                    ->update(['id_historique_remise' => $new_rem_id]);
            } elseif ($countfactrem == 0) {
                $timestamp = time();
                $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
                $current_date->setTimestamp($timestamp);
                $notif_text = 'Creation de l\'association entre la remise de ID ' . $request->id_remise . ' et du produit de ID ' . $request->id_produit . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

                $notification = DB::connection('mysql2')->table('notification')
                    ->insertGetId([
                        'contenu_notification' => $notif_text,
                        'date_notification' => $current_date->format('Y-m-d H:i:s'),
                        'type' => 'produit service remise'
                    ]);

                DB::connection('mysql2')->table('produit_service_remise')
                    ->insert([
                        'id_remise' => $request->id_remise,
                        'id_produit' => $request->id_produit,
                        'id_historique_remise' => $new_rem_id,
                    ]);
            } else {
                return redirect()->route('remises.show', ['id_remise' => $request->id_remise])
                    ->with('error', 'Erreur lors de l\'insertion du produit dans la remise utilisant une nouvelle historique_remise (taux)');
            }
        } else {
            return redirect()->route('remises.show', ['id_remise' => $request->id_remise])
                ->with('error', 'Erreur inconnu lors de la validation');
        }
        return redirect()->route('remises.show', ['id_remise' => $request->id_remise])
            ->with('succes', 'La remise a bien été associé au produit');
    }

    public function removePack($id_remise, $id_pack)
    {
        DB::connection('mysql2')->table('packs_remise')
            ->where('id_remise', '=', $id_remise)
            ->where('id_pack', '=', $id_pack)
            ->delete();

        return redirect()->route('remises.show', ['id_remise' => $id_remise])
            ->with('succes', 'Le pack a bien été disassocié de la remise');
    }

    public function removeProduct($id_remise, $id_produit)
    {
        DB::connection('mysql2')->table('produit_service_remise')
            ->where('id_remise', '=', $id_remise)
            ->where('id_produit', '=', $id_produit)
            ->delete();

        return redirect()->route('remises.show', ['id_remise' => $id_remise])
            ->with('succes', 'Le produit a bien été disassocié de la remise');
    }
    public function deleteSelect(Request $request)
    {
        $ids = $request->input('remises');
        DB::connection('mysql2')->table('remise')->whereIn('id_remise', $ids)->delete();
        return redirect()->route('remises.index')->with('success', 'Selection supprimée avec succes');
    }
}
