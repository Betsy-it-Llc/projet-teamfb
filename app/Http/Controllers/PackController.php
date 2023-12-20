<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use App\Models\experienceApp\Pack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class PackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pack = new Pack();
        $pack->setConnection('mysql2');

        $perPage = $request->get('perPage') ?? 10;

        $dataQuery = DB::connection('mysql2')->table('pack')
            ->join('liste_prix', 'pack.id_pack', '=', 'liste_prix.id_pack')
            ->select(DB::raw('liste_prix.prix'), DB::raw('liste_prix.statut as statutPrix'), 'pack.statut', 'pack.abstract', 'pack.description', 'pack.nom', 'pack.id_pack', 'pack.date_creation', 'pack.date_update', 'pack.id_stripe_pack', 'pack.url_stripe_pack')
            ->where('liste_prix.statut', 'Par Défaut')
            ->orWhere(function ($query) {
                $query->latest('liste_prix.id_liste_prix');
            })
            ->groupBy('id_pack')
            ->orderByDesc('id_pack')
            ->orderByDesc('liste_prix.prix');
        // ------------------22.06.23---------------------------------
        $multisearchnom = $request->get('multisearchnom');
        $multisearchtel = $request->get('multisearchtel');
        $multisearchprenom = $request->get('multisearchprenom');
        $multisearchcategorie = $request->get('multisearchcategorie');
        $multisearchstat = $request->get('multisearchstat');

        if (isset($multisearchnom) || isset($multisearchtel) || isset($multisearchprenom) || isset($multisearchcategorie) || isset($multisearchstat)) {
            $data = DB::connection('mysql2')->table('pack')
                ->join('liste_prix', 'pack.id_pack', '=', 'liste_prix.id_pack')
                ->select(DB::raw('liste_prix.prix'), DB::raw('liste_prix.statut as statutPrix'), 'pack.statut', 'pack.abstract', 'pack.description', 'pack.nom', 'pack.id_pack', 'pack.date_creation', 'pack.date_update', 'pack.id_stripe_pack', 'pack.url_stripe_pack')
                ->where('liste_prix.statut', 'Par Défaut')
                ->orWhere(function ($query) {
                    $query->latest('liste_prix.id_liste_prix');
                })
                ->groupBy('id_pack')
                ->orderByDesc('id_pack')
                ->orderByDesc('liste_prix.prix')
                ->where('pack.statut', '=', $multisearchstat);
        }
        $liste_statut = DB::connection('mysql2')->table('pack')
            ->select('statut')
            ->distinct()
            ->get();



        // ------------------22.06.23---------------------------------


        $statut = $request->get('statut'); // Récupérer le statut à partir de la requête
        $periode = $request->get('periode'); // Récupérer la période à partir de la requête

        $dataQuery = Pack::when($statut, function ($query) use ($statut) {
            if ($statut === 'actif') {
                return $query->where('statut', 'actif');
            } elseif ($statut === 'inactif') {
                return $query->where('statut', 'inactif');
            } elseif ($statut === 'archivé') {
                return $query->where('statut', 'archivé');
            }
        })
            ->when($periode, function ($query) use ($periode) {
                if ($periode === 'semaine') {
                    $now = date('Y-m-d H:i:s');
                    $weekStart = date('Y-m-d H:i:s', strtotime('-1 week'));
                    $query->whereDate('date_creation', '>=', $weekStart)
                        ->whereDate('date_creation', '<=', $now);
                } elseif ($periode === 'mois') {
                    $now = date('Y-m-d H:i:s');
                    $monthStart = date('Y-m-d H:i:s', strtotime('-1 month'));
                    $query->whereDate('date_creation', '>=', $monthStart)
                        ->whereDate('date_creation', '<=', $now);
                } elseif ($periode === 'trimestre') {
                    $now = date('Y-m-d H:i:s');
                    $trimesterStart = date('Y-m-d H:i:s', strtotime('-3 months'));
                    $query->whereDate('date_creation', '>=', $trimesterStart)
                        ->whereDate('date_creation', '<=', $now);
                } elseif ($periode === 'annee') {
                    $now = date('Y-m-d H:i:s');
                    $yearStart = date('Y-m-d H:i:s', strtotime('-1 year'));
                    $query->whereDate('date_creation', '>=', $yearStart)
                        ->whereDate('date_creation', '<=', $now);
                }
            });

        //dd($dataQuery);    
        $data_counter = $dataQuery->paginate(100000);
        $count_actif = 0;
        $count_inactif = 0;
        $count_archive = 0;
        foreach ($data_counter as $item) {

            if ($item->statut == 'actif') {
                $count_actif++;
            } elseif ($item->statut == 'inactif') {
                $count_inactif++;
            } elseif ($item->statut == 'archivé') {
                $count_archive++;
            }
        }

        $data = $dataQuery->paginate($perPage);

        $totalPack = $data->total();
        return view(
            'packs.index',
            compact(
                'data',
                'perPage',
                'totalPack',
                'liste_statut',
                'count_actif',
                'count_inactif',
                'count_archive',
            )
        )
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function show(Request $request)
    {
        $pack = new Pack();
        $pack->setConnection('mysql2');

        $url1 = (int) $request->id_pack;
        $url = $url1;

        $id_pack = DB::connection('mysql2')->select('SELECT id_pack FROM pack');

        foreach ($id_pack as $key => $value) {
            if ($url1 === $value->id_pack) {
                $url = $url1;
            }
        }

        $pack = DB::connection('mysql2')->selectOne('SELECT * from pack WHERE id_pack=?', [$url]);

        $produitspack = DB::connection('mysql2')->select('SELECT produits_services.id_produit,produits_services.nom_produit,produits_services.prix,pack_produit_service.quantity
        FROM produits_services JOIN pack_produit_service JOIN pack
        ON produits_services.id_produit=pack_produit_service.id_produit
        AND pack_produit_service.id_pack=pack.id_pack
        WHERE pack.id_pack=?', [$url]);

        $total = 0;

        foreach ($produitspack as $produit) {
            $total += ((int) $produit->prix * (int) $produit->quantity);
        }

        $gain = ($total - (int) $pack->prix) / ((int) $pack->prix) * 100;

        $remises = DB::connection('mysql2')->select('SELECT DISTINCT remise.id_remise,remise.nom_remise,remise.type_remise,remise.taux,remise.montant,remise.date_debut,remise.date_fin,codes_promo.code,codes_promo.nb_utilisation,cRem.numRemises
        FROM remise
        JOIN packs_remise
        JOIN pack
        JOIN codes_promo
        JOIN factures_remise
        JOIN(
            SELECT factures_remise.id_remise, COUNT(*) AS numRemises
            FROM factures_remise
            GROUP BY factures_remise.id_remise) cRem ON cRem.id_remise = factures_remise.id_remise
        AND remise.id_remise=packs_remise.id_remise
        AND packs_remise.id_pack=pack.id_pack
        AND codes_promo.id_remise=remise.id_remise
        AND factures_remise.id_remise=remise.id_remise
        WHERE pack.id_pack=?', [$url]);
        // ---------------------yasser-------------------------------
        $remise_pack = DB::connection('mysql2')
            ->select(' SELECT DISTINCT remise.id_remise,remise.nom_remise, remise.taux,  codes_promo.code,codes_promo.nb_utilisation
                    FROM pack
                    JOIN packs_remise
                        ON pack.id_pack = packs_remise.id_pack
                    JOIN remise
                        ON packs_remise.id_remise = remise.id_remise
                    JOIN codes_promo
                        ON remise.id_remise = codes_promo.id_remise
                    WHERE pack.id_pack=?', [$url]);


        // ----------------------------------
        $totAchat = DB::connection('mysql2')->selectOne('SELECT COUNT(*) as achat
        FROM pack JOIN pack_experience JOIN factures JOIN facture_statut_notification JOIN facture_statut
        ON pack.id_pack=pack_experience.id_pack
        AND pack_experience.num_facture=factures.num_facture
        AND factures.num_facture=facture_statut_notification.num_facture
        AND facture_statut_notification.id_facture_statut=facture_statut.id_facture_statut
        WHERE pack.id_pack=?', [$url]);

        $moisAchat = DB::connection('mysql2')->selectOne('SELECT COUNT(factures.num_facture) as achat
        FROM pack JOIN pack_experience JOIN factures JOIN facture_statut_notification JOIN facture_statut
        ON pack.id_pack=pack_experience.id_pack
        AND pack_experience.num_facture=factures.num_facture
        AND factures.num_facture=facture_statut_notification.num_facture
        AND facture_statut_notification.id_facture_statut=facture_statut.id_facture_statut
        WHERE (pack.id_pack=?
        AND facture_statut_notification.date_statut >= DATE_FORMAT( CURRENT_DATE - INTERVAL 1 MONTH, "%Y/%m/01" )
        AND facture_statut_notification.date_statut < DATE_FORMAT( CURRENT_DATE, "%Y/%m/01" ))', [$url]);

        $trimAchat = DB::connection('mysql2')->selectOne('SELECT COUNT(factures.num_facture) as achat
        FROM pack JOIN pack_experience JOIN factures JOIN facture_statut_notification JOIN facture_statut
        ON pack.id_pack=pack_experience.id_pack
        AND pack_experience.num_facture=factures.num_facture
        AND factures.num_facture=facture_statut_notification.num_facture
        AND facture_statut_notification.id_facture_statut=facture_statut.id_facture_statut
        WHERE (pack.id_pack=?
        AND facture_statut_notification.date_statut >= DATE_FORMAT( CURRENT_DATE - INTERVAL 3 MONTH, "%Y/%m/01" )
        AND facture_statut_notification.date_statut < DATE_FORMAT( CURRENT_DATE, "%Y/%m/01" ))', [$url]);

        $anneeAchat = DB::connection('mysql2')->selectOne('SELECT COUNT(factures.num_facture) as achat
        FROM pack JOIN pack_experience JOIN factures JOIN facture_statut_notification JOIN facture_statut
        ON pack.id_pack=pack_experience.id_pack
        AND pack_experience.num_facture=factures.num_facture
        AND factures.num_facture=facture_statut_notification.num_facture
        AND facture_statut_notification.id_facture_statut=facture_statut.id_facture_statut
        WHERE (pack.id_pack=?
        AND facture_statut_notification.date_statut >= DATE_FORMAT( CURRENT_DATE - INTERVAL 1 YEAR, "%Y/%m/01" )
        AND facture_statut_notification.date_statut < DATE_FORMAT( CURRENT_DATE, "%Y/%m/01" ))', [$url]);
        $statutPrix =  DB::connection('mysql2')
            ->table('liste_prix')
            ->where('id_pack', $url)
            ->latest('id_liste_prix')
            ->orderByDesc('id_pack')
            ->first();

        $defaultPrice =  DB::connection('mysql2')
            ->table('liste_prix')
            ->where('id_pack', $url)
            ->where('statut', 'Par Défaut')
            ->first();
        if (!$defaultPrice) {
            $defaultPrice = DB::connection('mysql2')
                ->table('liste_prix')
                ->where('id_pack', $url)
                ->latest('id_liste_prix')
                ->first();
        }

        $allPrices = DB::connection('mysql2')->table('liste_prix')
            ->where('id_pack', $url)
            ->get();



         // JM upload image
        //gestion des erreurs

        $id_pack = (int) $request->id_pack;
        
        // on trouver le produit grâce à son id 
        $pack=Pack::findorfail($id_pack);
        // on récupère le fichier venant de l'input file de la vue
        $image_pack = $request->file('image_pack');
        // si le fichier existe on execute le code
        if($image_pack){
            $request->validate([
                'image_pack' => 'required|image|mimes:jpeg,png,gif,jpg,bmp,tiff,webp,svg,ico,tga,pcx,pbm,pgm,ppm', // Acceptez uniquement les formats JPEG, PNG et GIF.
                
            ]);

            // on recupère le nom originale
            $originalFileName = $image_pack->getClientOriginalName();
            // on enlève les espaces, les accents
            $newFileName = preg_replace('/[\'"\sÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝàáâãäåæçèéêëìíîïðñòóôõöøùúûüý]/', '', $originalFileName);
            //si une image existe on l'efface, ( de la bdd ainsi que de google drive)
            if($pack->getFirstMedia('image_pack')){
                $pack->getFirstMedia('image_pack')->delete();
            }
            // on ajoute l'image
            $pack->addMedia($image_pack)
            ->withCustomProperties(['folder' => 'Cloud_Laravel_App/Ressources/Packs/image_pack-'.$pack->nom])
            ->usingFilename($newFileName)
            ->toMediaCollection('image_pack','google');
            $pack->save();

            //upload success
            $success_image='L\'image à été ajouté avec succès';
            
            // Stockez la variable $success_image dans la session flash
            session()->flash('success_image', $success_image);
            return back();
        }

        // on initialise une variable à null
        $image_du_pack=null;
        // si l'image existe on creer son url qu'on enverra dans la vue
        if($pack->getFirstMedia('image_pack')){
            $image_du_pack=$pack->getFirstMedia('image_pack')->getUrl();
        }

        ////////////Suppression de l'image////////////
        $delete_image = $request->has('delete_image');
        if ($pack->getFirstMedia('image_pack') && $delete_image) {
            $pack->getFirstMedia('image_pack')->delete();
            
            //delete success
            $success_image_delete='L\'image à été supprimée';

            // Stockez la variable $success_image dans la session flash
            session()->flash('success_image_delete', $success_image_delete);

            return back();
         }


        return view('packs.show', ['pack' => $pack, 'produitspack' => $produitspack, 'remises' => $remises, 'total' => $total, 'gain' => $gain, 'totAchat' => $totAchat, 'moisAchat' => $moisAchat, 'trimAchat' => $trimAchat, 'anneeAchat' => $anneeAchat, 'remise_pack' => $remise_pack, 'statutPrix' => $statutPrix, 'defaultPrice' => $defaultPrice, 'allPrices' => $allPrices,'image_du_pack'=>$image_du_pack]);
    }

    public function edit($packs)
    {
        $modelpack = new Pack();
        $modelpack->setConnection('mysql2');

        $id_pack = DB::connection('mysql2')->select('SELECT id_pack FROM pack');
        $url1 = (int) $packs;

        foreach ($id_pack as $key => $value) {
            if ($url1 === $value->id_pack) {
                $url = $url1;
            }
        }

        $pack = DB::connection('mysql2')->selectOne('SELECT nom,prix,description,abstract,statut from pack WHERE id_pack=?', [$url]);
        $defaultPrice =  DB::connection('mysql2')
            ->table('liste_prix')
            ->where('id_pack', $url)
            ->where('statut', 'Par Défaut')
            ->first();
        $statutPrix =  DB::connection('mysql2')
            ->table('liste_prix')
            ->where('id_pack', $url)
            ->first();

        $allPrices = DB::connection('mysql2')->table('liste_prix')
            ->where('id_pack', $url)
            ->get();
        return view('packs.edit', compact('pack', 'packs', 'defaultPrice', 'statutPrix', 'allPrices'));
    }

    public function create()
    {
        return view('packs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prix' => 'required|numeric',
            'statut',
            'abstract' => 'required',
            'description' => 'required|string'
        ]);

        $current_date = date('Y-m-d');

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);

        $pac = Pack::create([
            'nom' => $request->nom,
            'prix' => $request->prix,
            'abstract' => $request->abstract,
            'description' => $request->description,
            'statut' => $request->statut,
            'date_creation' => $current_date->format('Y-m-d H:i:s'),
            'date_update' => $current_date->format('Y-m-d H:i:s'),
        ]);

        $notif_text = 'Creation d\'un nouveau pack le ' .  $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
            ->insertGetId([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'pack'
            ]);

        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );
        $pack = $stripe->products->create([
            'name' => $request->nom,
            'description' => $request->description,
            'default_price_data' =>
            [
                'currency' => 'eur',
                'unit_amount' => intval($request->prix) * 100
            ],
            'metadata' =>
            [
                'abstract' => $request->abstract,
                'id_pack' => $pac->id_pack,
                'statut' => 'actif',
                'type' => 'pack'
            ]
        ]);

        $pack = substr($pack, 21);

        $pack = json_decode($pack, true);

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $notif_text = 'Mise à jour liée au pack de ID ' . $pac->id_pack . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
            ->insertGetId([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'pack'
            ]);

        DB::connection('mysql2')
            ->update('UPDATE pack SET pack.id_stripe_pack="' . $pack['id'] . '", pack.url_stripe_pack="https://dashboard.stripe.com/test/products/' . $pack['id'] . '",pack.date_update="' . $current_date->format('Y-m-d H:i:s') . '" WHERE pack.id_pack=' . $pac->id_pack . '');

        DB::connection('mysql2')->table('liste_prix')->insert([
            'id_pack' => $pac->id_pack,
            'prix' => $pac->prix,
            'statut' => 'Par Défaut',
            'date_creation' => $pac->date_creation
        ]);

        return redirect()->route('packs.show', ['id_pack' => $pac->id_pack])
            ->with('success', 'Le pack a bien été ajouté');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id_pack' => 'required|exists:mysql2.pack,id_pack',
            'nom' => 'required',
            'prix' => 'required|numeric',
            'abstract',
            'statut',
            'description' => 'required|string'
        ]);


        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $notif_text = 'Mise à jour du pack de ID ' . $request->id_pack . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
            ->insertGetId([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'pack'
            ]);

        $pack = Pack::find($request->id_pack);
        $pack->update([
            'nom' => $request->nom,
            'prix' => $request->prix,
            'abstract' => $request->abstract,
            'description' => $request->description,
            'statut' => $request->statut,
            'date_update' => $current_date->format('Y-m-d H:i:s'),
        ]);


        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );

        $price = $stripe->prices->create([
            'unit_amount' => floatval($request->prix) * 100,
            'currency' => 'eur',
            'product' => $pack->id_stripe_pack,
        ]);
        $prices = $stripe->prices->all(['product' => $pack->id_stripe_pack]);

        $trouve = false;

        foreach ($prices as $pric) {
            // Accédez à chaque élément du tableau $prices
            $id = $pric->id;
            $amount = $pric->unit_amount;
            if ($request->prix * 100 == $pric->unit_amount) {
                $price = $pric;
                $trouve = true;
                break;
            }
        }

        if ($trouve == false) {
            $price = $stripe->prices->create([
                'unit_amount' => floatval($request->prix) * 100,
                'currency' => 'eur',
                'product' => $pack->id_stripe_pack,
            ]);
        }

        $price_id = $price['id'];




        $pack = $stripe->products->update(
            $pack->id_stripe_pack,
            [
                'name' => $request->nom,
                'description' => $request->description,

                'metadata' =>
                [
                    'abstract' => $request->abstract,
                    'id_pack' => $pack->id_pack,
                    'statut' => 'actif',
                ]
            ]
        );

        if ($request->statutPrix == "Par Défaut") {
            $pack = $stripe->products->update(
                $pack->id,
                [
                    'default_price' => $price['id'],
                ]
            );
        }

        $pk = Pack::find($request->id_pack);
        $id_prix = $request->allPricesId;
        $derniereEntree = DB::connection('mysql2')
            ->table('liste_prix')
            ->where('id_pack', $request->id_pack)
            ->where('statut', 'Par Défaut')
            ->first();
        if ($derniereEntree) {
            DB::connection('mysql2')->table('liste_prix')
                ->where('id_liste_prix', $derniereEntree->id_liste_prix)
                ->update(['statut' => 'Actif']);
        }

        DB::connection('mysql2')
            ->table('liste_prix')
            ->where('id_pack', $request->id_pack)
            ->where('id_liste_prix', $id_prix)
            ->update(['statut' => $request->statutPrix, 'prix' => $request->prix]);

        return redirect()->route('packs.show', ['id_pack' => $pk->id_pack])
            ->with('success', 'La mise a jour a bien été effectuée');
    }
    public function destroy($packs)
    {

        $pack_experience = DB::connection('mysql2')->table('pack_experience')
            ->where('id_pack', $packs)
            ->get();

        $pack_produit_service = DB::connection('mysql2')->table('pack_produit_service')
            ->where('id_pack', $packs)
            ->get();

        $packs_remise = DB::connection('mysql2')->table('packs_remise')
            ->where('id_pack', $packs)
            ->get();

        $pack = DB::connection('mysql2')->table('pack')
            ->where('id_pack', $packs)
            ->get();

        if (($pack_experience->isEmpty()) && ($pack_produit_service->isEmpty()) && ($packs_remise->isEmpty())) {



            $stripe = new \Stripe\StripeClient(
                env('STRIPE_SECRET')
            );



            $stripe->products->update(
                $pack[0]->id_stripe_pack,
                ['active' => false]
            );

            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
            $current_date->setTimestamp($timestamp);
            $notif_text = 'Suppression du pack de ID ' . $packs . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

            $notification = DB::connection('mysql2')->table('notification')
                ->insertGetId([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'pack'
                ]);

            Pack::destroy($packs);
            return redirect()->route('packs.index')
                ->with('success', 'Pack supprimé avec succes');
        } else {
            return redirect()->route('packs.index')
                ->with('error', 'Erreur lors de la suppression du pack');
        }
    }
    // -------------------- changer de statut produit ----------------------------
    public function change_statut($pack, $statut)
    {
        $packModel = new Pack();
        $packModel->setConnection('mysql2');

        $url1 = (int) $pack;
        $url = $url1;
        $id_pack = DB::connection('mysql2')->select('SELECT id_pack FROM pack');

        foreach ($id_pack as $key => $value) {
            if ($url1 === $value->id_pack) {
                $url = $value->id_pack;
            }
        }



        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);

        DB::connection('mysql2')->statement('UPDATE pack SET statut=?,date_update=? WHERE id_pack = ?', [$statut, $current_date->format('Y-m-d H:i:s'), $url]);
    }
    public function saveAllPrices()
    {
        $data = DB::connection('mysql2')->table('pack')->get();
        $statut_prix = 'Par défaut';

        foreach ($data as $item) {
            $existingData = DB::connection('mysql2')->table('liste_prix')
                ->where('id_pack', $item->id_pack)
                ->where('date_creation', $item->date_creation)
                ->where('prix', $item->prix)
                ->first();

            if (!$existingData) {
                DB::connection('mysql2')->table('liste_prix')->insert([
                    'date_creation' => $item->date_creation,
                    'id_pack' => $item->id_pack,
                    'prix' => $item->prix,
                    'statut' => $statut_prix
                ]);
            }
        }

        return redirect('packs.index')->with('success', 'Données enregistrées avec succès');
    }
    public function statutPrix(Request $request)
    {
        $statutPrix = $request->statutPrix;

        $id_pack = $request->id_pack;
        $id_prix = $request->allPricesId;

        $derniereEntree = DB::connection('mysql2')
            ->table('liste_prix')
            ->where('id_pack', $id_pack)
            ->where('statut', 'Par defaut')
            ->first();
        if ($derniereEntree) {
            DB::connection('mysql2')->table('liste_prix')
                ->where('id_liste_prix', $derniereEntree->id_liste_prix)
                ->update(['statut' => 'Actif']);
        }
        DB::connection('mysql2')->table('liste_prix')
            ->where('id_pack', $id_pack)
            ->where('id_liste_prix', $id_prix)
            ->update(['statut' => $statutPrix]);

        $prod = DB::connection('mysql2')
            ->table('pack')
            ->where('id_pack', $id_pack)
            ->first();

        $prix = DB::connection('mysql2')
            ->table('liste_prix')
            ->where('id_liste_prix', $id_prix)
            ->first();

        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );

        $prices = $stripe->prices->all(['product' => $prod->id_stripe_pack]);

        $trouve = false;

        foreach ($prices as $pric) {
            // Accédez à chaque élément du tableau $prices
            $id = $pric->id;
            $amount = $pric->unit_amount;
            if ($prix->prix * 100 == $pric->unit_amount) {
                $price = $pric;
                //dd($price);
                $trouve = true;
                break;
            }
        }

        if ($trouve == false) {
            $price = $stripe->prices->create([
                'unit_amount' => floatval($prix->prix) * 100,
                'currency' => 'eur',
                'product' => $prod->id_stripe_pack,
            ]);
        }

        switch ($statutPrix) {
            case 'Par Défaut':
                $price = $stripe->prices->update($price->id, [
                    'active' => 'true'
                ]);
                $pack = $stripe->products->update(
                    $prod->id_stripe_pack,
                    [
                        'default_price' => $price["id"],
                    ]
                );
                break;
            case 'actif':
                $pack = $stripe->products->retrieve($prod->id_stripe_pack, []);
                if ($price->id == $pack->default_price) {
                    $pack = $stripe->products->update(
                        $prod->id_stripe_pack,
                        [
                            'default_price' => null,
                        ]
                    );
                }
                $price = $stripe->prices->update($price->id, [
                    'active' => 'true'
                ]);
                break;
            case 'inactif':
                $pack = $stripe->products->retrieve($prod->id_stripe_pack, []);
                if ($price->id == $pack->default_price) {
                    $pack = $stripe->products->update(
                        $prod->id_stripe_pack,
                        [
                            'default_price' => null,
                        ]
                    );
                }
                $price = $stripe->prices->update($price->id, [
                    'active' => 'false'
                ]);
                break;
        }

        return redirect()->route('packs.show', ['id_pack' => $id_pack])->with('statutPrix', $statutPrix);
    }
    public function addNewPrice(Request $request)
    {
        $id_pack = $request->id_pack;
        $prix = $request->nouveauPrix;
        $statutPrix = $request->statutPrix;
        $date = Carbon::now();
        // Vérification de l'existence d'une autre entrée avec le même id_produit et statut "Par Défaut"
        $ancienneEntree = DB::connection('mysql2')->table('liste_prix')
            ->where('id_pack', $id_pack)
            ->where('statut', 'Par Défaut')
            ->first();

        if ($ancienneEntree) {
            DB::connection('mysql2')->table('liste_prix')
                ->where('id_liste_prix', $ancienneEntree->id_liste_prix)
                ->update(['statut' => 'Actif']);
        }

        $id_liste_prix = DB::connection('mysql2')->table('liste_prix')->insertGetId([
            'id_pack' => $id_pack,
            'prix' => $prix,
            'statut' => $statutPrix,
            'date_creation' => $date
        ]);

        $prod = DB::connection('mysql2')
            ->table('pack')
            ->where('id_pack', $id_pack)
            ->first();

        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );
        $price = $stripe->prices->create([
            'unit_amount' => floatval($request->nouveauPrix) * 100,
            'currency' => 'eur',
            'product' => $prod->id_stripe_pack,
            'metadata' => [
                'id_liste_prix' => $id_liste_prix,
                'id_pack' => $id_pack
            ]
        ]);
        switch ($statutPrix) {
            case 'Par Défaut':
                $price = $stripe->prices->update($price->id, [
                    'active' => 'true'
                ]);
                $pack = $stripe->products->update(
                    $prod->id_stripe_pack,
                    [
                        'default_price' => $price["id"],
                    ]
                );
                break;
            case 'actif':
                $pack = $stripe->products->retrieve($prod->id_stripe_pack, []);
                if ($price->id == $pack->default_price) {
                    $pack = $stripe->products->update(
                        $prod->id_stripe_pack,
                        [
                            'default_price' => null,
                        ]
                    );
                }
                $price = $stripe->prices->update($price->id, [
                    'active' => 'true'
                ]);
                break;
            case 'inactif':
                $pack = $stripe->products->retrieve($prod->id_stripe_pack, []);
                if ($price->id == $pack->default_price) {
                    $pack = $stripe->products->update(
                        $prod->id_stripe_pack,
                        [
                            'default_price' => null,
                        ]
                    );
                }
                $price = $stripe->prices->update($price->id, [
                    'active' => 'false'
                ]);
                break;
        }

        return redirect()->route('packs.show', ['id_pack' => $id_pack])->with('success', 'Nouveau Prix créé avec succès');
    }

    public function deleteSelect(Request $request)
    {
        $ids = $request->input('packs');
        DB::connection('mysql2')->table('pack')->whereIn('id_pack', $ids)->delete();
        return redirect()->route('packs.index')->with('success', 'Selection supprimée avec succes');
    }

    public function archiver($id_pack)
    {

        $pack = Pack::findOrFail($id_pack);

        // Update the status to "archived" (assuming the field name is 'statut')
        $pack->update(['statut' => 'archivé']);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Produit archivé avec succes.');
    }

    public function modifStock(Request $request)
    {
        $request->validate([
            'id_pack' => 'required|exists:mysql2.pack,id_pack',
            'stock' => 'required',
        ]);
        //dd($request->all());

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);

        DB::connection('mysql2')->statement('UPDATE pack SET stock = ?, date_update = ? WHERE id_pack = ?', [$request->stock, $current_date->format('Y-m-d H:i:s'), $request->id_pack]);

        return redirect()->route('packs.show', ['id_pack' => $request->id_pack]);
    }
}
