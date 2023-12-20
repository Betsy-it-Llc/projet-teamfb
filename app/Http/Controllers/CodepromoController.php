<?php

namespace App\Http\Controllers;


use DateTime;
use DateTimeZone;
use App\Models\experienceApp\Codepromo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CodepromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $code = new Codepromo;
        $code->setConnection('mysql2');

        $perPage = $request->get('perPage') ?? 10; // par défaut 10 éléments par page

        $data = DB::connection('mysql2')->table('codes_promo')
            ->join('remise', 'codes_promo.id_remise', '=', 'remise.id_remise')
            ->join('historique_remise', 'historique_remise.id_remise', '=', 'remise.id_remise')
            ->orderByDesc('remise.date_debut')
            ->whereRaw('historique_remise.id_historique_remise = (SELECT MAX(id_historique_remise) FROM historique_remise WHERE historique_remise.id_remise = remise.id_remise)')
            ->paginate($perPage);

        $liste_nom_remise =  DB::connection('mysql2')->table('remise')
            ->join('historique_remise', 'historique_remise.id_remise', '=', 'remise.id_remise')
            ->select('remise.nom_remise')
            ->distinct()
            ->get();

        $liste_statut = DB::connection('mysql2')->table('codes_promo')
            // ->join('historique_remise','historique_remise.id_remise','=','codes_promo.id_remise')
            ->select('statut_code')
            ->distinct()
            ->get();
        // ------------------------28.06.23 -----------------------------------
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
        $query =  DB::connection('mysql2')->table('codes_promo')
            ->join('remise', 'codes_promo.id_remise', '=', 'remise.id_remise')
            ->join('historique_remise', 'historique_remise.id_remise', '=', 'remise.id_remise')
            ->orderByDesc('remise.date_debut')
            ->whereRaw('historique_remise.id_historique_remise = (SELECT MAX(id_historique_remise) FROM historique_remise WHERE historique_remise.id_remise = remise.id_remise)');


        // ***************************************
        $count_stats = [];

        foreach ($liste_statut as $statut) {

            $count_query = clone $query;
            $count_query->where('codes_promo.statut_code', '=', $statut->statut_code);
            $count = $count_query->count();

            $count_stats[$statut->statut_code] = [
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

        // ------------------28.06.23--------------------------------------

        $remises = DB::connection('mysql2')->select('SELECT id_remise,nom_remise
        FROM remise');
        // --------------------21.06.21 :  à verifier si la requete est en coherence avec la requete $data en haut------------------------------------------
        $multisearchnom = $request->get('multisearchnom');
        $multisearchtel = $request->get('multisearchtel');
        $multisearchprenom = $request->get('multisearchprenom');
        $multisearchremise = $request->get('multisearchremise');
        $multisearchstat = $request->get('multisearchstat');

        if (isset($multisearchnom) || isset($multisearchtel) || isset($multisearchprenom) || isset($multisearchremise) || isset($multisearchstat)) {
            $data = DB::connection('mysql2')->table('codes_promo')
                ->join('remise', 'codes_promo.id_remise', '=', 'remise.id_remise')
                ->when(isset($multisearchremise), function ($query) use ($multisearchremise) {
                    return $query->where('remise.nom_remise', '=', $multisearchremise);
                })
                ->when(isset($multisearchstat), function ($query) use ($multisearchstat) {
                    return $query->where('codes_promo.statut_code', '=', $multisearchstat);
                })
                ->orderByDesc('remise.date_debut')
                ->paginate($perPage);
        }


        // --------------------21.06.21------------------------------------------

        // --------------------29.06.23 -------------------------------------
        if (isset($la_periode)) {
            $query_1 = DB::connection('mysql2')->table('codes_promo')
                ->join('remise', 'codes_promo.id_remise', '=', 'remise.id_remise')
                ->join('historique_remise', 'historique_remise.id_remise', '=', 'remise.id_remise')
                ->orderByDesc('remise.date_debut')
                ->whereRaw('historique_remise.id_historique_remise = (SELECT MAX(id_historique_remise) FROM historique_remise WHERE historique_remise.id_remise = remise.id_remise)')

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
                $count = $count_query->count();

                $count_stats[$statut->statut_code] = [
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
        //dd($count_stats);

        // --------------------29.06.23 -------------------------------------

        $value = session('id_code');  // Stocker la variable dans la session de la table campagne
        $totalCodeP = $data->total();

        return view('codespromo.index', compact('data', 'perPage', 'remises', 'totalCodeP', 'liste_nom_remise', 'liste_statut', 'count_stats'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('codespromo.create');
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
            'id_remise' => 'required|exists:mysql2.remise,id_remise',
            'code' => ['required', 'regex:/^[A-Za-z0-9]+$/'],
            'nb_utilisation' => 'required|numeric|integer'
        ], [
            'code.regex' => 'Le code promo ne peut pas contenir de caractere spéciaux !'
        ]);
        // variable qui verifie que le nom de code existe
        $check_code_name = DB::connection('mysql2')
            ->table('codes_promo')
            ->where('code', $request->code)
            ->first();
        
        // condition et retour de l'erreur
        if (!empty($check_code_name)) {
            return redirect()->route('codespromo.index')
                ->with('error', 'Le code promo existe déjà dans Stripe');
        }
        
        $id_coupon = DB::connection('mysql2')
            ->select('SELECT remise.id_stripe_remise AS id FROM remise WHERE remise.id_remise =' . $request->id_remise);


        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $notif_text = ' Creation d\'un nouvel code promo le ' .  $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
            ->insertGetId([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i;s'),
                'type' => 'code promo'
            ]);

        $cod = Codepromo::create([
            'id_remise' => $request->id_remise,
            'code' => $request->code,
            'nb_utilisation' => $request->nb_utilisation,
            'nb_code' => 0,
            'date_creation' => $current_date->format('Y-m-d H:i;s'),
            'date_update' => $current_date->format('Y-m-d H:i;s'),
        ]);

        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );
        
        $code = $stripe->promotionCodes->create([
            'coupon' => $id_coupon[0]->id,
            'code' => $request->code,
            'max_redemptions' => $request->nb_utilisation,
            'metadata' =>
            [
                'id_code' => $cod->id_code,
                'id_remise' => $request->id_remise
            ]
        ]);
        $code = substr($code, 26);

        $code = json_decode($code, true);

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $notif_text = ' Mise à jour liée à stripe du code promo de ID ' . $cod->id_code . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
            ->insertGetId([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'code promo'
            ]);

            DB::connection('mysql2')->table('codes_promo')
            ->where('id_code', $cod->id_code)
            ->update([
                'code' => $code['code'],
                'id_stripe_code' => $code['id'],
                'url_stripe_code' => 'https://dashboard.stripe.com/test/promotion_codes/' . $code['id'],
                'date_update' => $current_date->format('Y-m-d H:i:s')
            ]);
        
        return redirect()->route('codespromo.show', ['id_code' => $cod->id_code])
            ->with('success', 'Le code promo a bien été ajouté');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id_code)
    {

        $Code_promo_e = Codepromo::all();
        $modelpromo = new Codepromo;
        $modelpromo->setConnection('mysql2');
        $id_codes = DB::connection('mysql2')->select('SELECT id_code FROM codes_promo');
        $url1 = (int) $id_code;
        $url = $url1;

        foreach ($id_codes as $key => $value) {
            if ($url1 === $value->id_code) {
                $url = $url1;
            }
        }
        $remises = DB::connection('mysql2')->select('SELECT id_remise,nom_remise
        FROM remise');
/*
        $code = DB::connection('mysql2')->selectOne('SELECT  codes_promo.description ,codes_promo.id_code,codes_promo.code,codes_promo.nb_utilisation, codes_promo.statut_code ,remise.id_remise
        FROM remise JOIN codes_promo
        ON remise.id_remise=codes_promo.id_remise
        JOIN historique_remise ON historique_remise.id_remise=remise.id_remise
        WHERE codes_promo.id_code=?', [$url]);
*/
        $code = DB::connection('mysql2')
            ->table('remise')
            ->join('codes_promo', 'remise.id_remise', '=', 'codes_promo.id_remise')
            ->join('historique_remise', 'historique_remise.id_remise', '=', 'remise.id_remise')
            ->select('codes_promo.description', 'codes_promo.id_code', 'codes_promo.code', 'codes_promo.nb_utilisation', 'codes_promo.statut_code', 'remise.id_remise')
            ->where('codes_promo.id_code', $url)
            ->first();
    

        $contact = DB::connection('mysql2')
            ->table('contact')
            ->join('contact_code_promo', 'contact.id_contact', '=', 'contact_code_promo.id_contact')
            ->join('codes_promo', 'contact_code_promo.id_code', '=', 'codes_promo.id_code')
            ->select('contact.id_contact', 'contact.nom', 'contact.prenom', 'codes_promo.statut_code', 'codes_promo.date_creation')
            ->where('codes_promo.id_code', $url)
            ->get();
    
        $id_rem = $request->id_remise;

        $remise = DB::connection('mysql2')->selectOne('SELECT remise.id_remise,remise.nom_remise,remise.type_remise,remise.taux,remise.montant,remise.date_debut,remise.date_fin,remise.statut,COUNT(codes_promo.id_remise) as nb_codes
        FROM remise JOIN codes_promo
        ON remise.id_remise=codes_promo.id_remise
        JOIN historique_remise ON remise.id_remise=historique_remise.id_remise
       WHERE historique_remise.id_remise=?', [$id_rem]);

        $packsremise = DB::connection('mysql2')->select('SELECT pack.id_pack, pack.nom, pack.prix, historique_remise.taux, historique_remise.montant
        FROM pack
        JOIN packs_remise ON pack.id_pack = packs_remise.id_pack
        JOIN historique_remise ON historique_remise.id_remise = packs_remise.id_remise
        WHERE packs_remise.id_remise = ?
        AND historique_remise.id_historique_remise = (
            SELECT MAX(id_historique_remise)
            FROM historique_remise
            WHERE historique_remise.id_remise = packs_remise.id_remise
        )', [$id_rem]);

        $produitsremise = DB::connection('mysql2')->select('SELECT produits_services.id_produit, produits_services.nom_produit, produits_services.prix,historique_remise.taux, historique_remise.montant
    FROM produits_services
    JOIN produit_service_remise ON produits_services.id_produit = produit_service_remise.id_produit
    JOIN historique_remise ON historique_remise.id_remise = produit_service_remise.id_remise
    WHERE produit_service_remise.id_remise = ?
    AND historique_remise.id_historique_remise = (
        SELECT MAX(id_historique_remise)
        FROM historique_remise
        WHERE historique_remise.id_remise = produit_service_remise.id_remise
    )', [$id_rem]);

        $num_fact = [];
        $benstep1 = DB::connection('mysql2')->table('remise')->join('factures_remise', 'factures_remise.id_remise', '=', 'remise.id_remise')->where('remise.id_remise', '=', $id_rem)->get();
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
            $codes = DB::connection('mysql2')->select('SELECT codes_promo.id_code ,codes_promo.code ,codes_promo.nb_utilisation, codes_promo.nb_code 
            FROM codes_promo JOIN historique_remise JOIN factures_remise
            ON codes_promo.id_remise=historique_remise.id_remise
            AND historique_remise.id_remise=factures_remise.id_remise
            WHERE historique_remise.id_remise=?
            GROUP BY codes_promo.id_code', [$id_rem]);
        } else {
            $codes = DB::connection('mysql2')->select('SELECT codes_promo.id_code,codes_promo.code,codes_promo.nb_utilisation,  codes_promo.nb_code
            FROM codes_promo JOIN historique_remise
            ON codes_promo.id_remise=historique_remise.id_remise
            WHERE historique_remise.id_remise=?
            GROUP BY codes_promo.id_code', [$id_rem]);
        }

        // JM upload image
        //gestion des erreurs
        $messages=[];
        $id_produit = (int) $id_code;
        
        // on trouver le produit grâce à son id 
        $codepromo=Codepromo::findorfail($id_produit);
        // on récupère le fichier venant de l'input file de la vue
        $image_promo = $request->file('image_promo');
        // si le fichier existe on execute le code
        if($image_promo){
            $request->validate([
                'image_promo' => 'required|image|mimes:jpeg,png,gif,jpg,bmp,tiff,webp,svg,ico,tga,pcx,pbm,pgm,ppm', // Acceptez uniquement les formats JPEG, PNG et GIF.
                
            ]);

            // on recupère l'extension
            $extension = $image_promo->getClientOriginalExtension();
            // on recupère le nom originale
            $originalFileName = $image_promo->getClientOriginalName();
            // on enlève les espaces, les accents
            $newFileName = preg_replace('/[\'"\sÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝàáâãäåæçèéêëìíîïðñòóôõöøùúûüý]/', '', $originalFileName);
            //si une image existe on l'efface, ( de la bdd ainsi que de google drive)
            if($codepromo->getFirstMedia('image_promo')){
                $codepromo->getFirstMedia('image_promo')->delete();
            }
            // on ajoute l'image
            $codepromo->addMedia($image_promo)
            ->withCustomProperties(['folder' => 'Cloud_Laravel_App/Ressources/Code_Promos/image_promo-'.$codepromo->code])
            ->usingFilename($newFileName)
            ->toMediaCollection('image_promo','google');
            $codepromo->save();

            //upload success
            $success_image='L\'image à été ajouté avec succès';
            
            // Stockez la variable $success_image dans la session flash
            session()->flash('success_image', $success_image);
            return redirect()->to('codespromo.show/' . $id_produit);
        }

        // on initialise une variable à null
        $image_de_promo=null;
        // si l'image existe on creer son url qu'on enverra dans la vue
        if($codepromo->getFirstMedia('image_promo')){
            $image_de_promo=$codepromo->getFirstMedia('image_promo')->getUrl();
        }

        ////////////Suppression de l'image////////////
        $delete_image = $request->has('delete_image');
        if ($codepromo->getFirstMedia('image_promo') && $delete_image) {
            $codepromo->getFirstMedia('image_promo')->delete();
            
            //delete success
            $success_image_delete='L\'image à été supprimée';

            // Stockez la variable $success_image dans la session flash
            session()->flash('success_image_delete', $success_image_delete);

            return redirect()->to('codespromo.show/'.$id_produit);
        }

        return view('codespromo.show', compact('contact','Code_promo_e','code', 'remise', 'remises', 'packsremise', 'produitsremise', 'beneficiaires', 'codes','image_de_promo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($codepromo)
    {
        $modelpro = new Codepromo();
        $modelpro->setConnection('mysql2');

        $id_code = DB::connection('mysql2')->select('SELECT id_code FROM codes_promo');
        $url1 = (int) $codepromo;

        foreach ($id_code as $key => $value) {
            if ($url1 === $value->id_code) {
                $url = $url1;
            }
        }
        $remises = DB::connection('mysql2')->select('SELECT id_remise,nom_remise
        FROM remise');
        $code = DB::connection('mysql2')->selectOne('SELECT codes_promo.id_code,codes_promo.code,codes_promo.nb_utilisation,remise.id_remise
        FROM remise JOIN codes_promo
        ON remise.id_remise=codes_promo.id_remise
        WHERE codes_promo.id_code=?', [$url]);

        $id_rem = $code->id_remise;

        $remise = DB::connection('mysql2')->selectOne('SELECT remise.id_remise,remise.nom_remise,remise.type_remise,remise.taux,remise.montant,remise.date_debut,remise.date_fin,remise.statut,COUNT(codes_promo.id_remise) as nb_codes
         FROM remise JOIN codes_promo
         ON remise.id_remise=codes_promo.id_remise
        WHERE remise.id_remise=?', [$id_rem]);

        return view('codespromo.edit', compact('code', 'remise', 'remises', 'codepromo'));
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
            'codepromo' => 'required|exists:mysql2.codes_promo,id_code',
            'id_remise' => 'required|exists:mysql2.remise,id_remise',
            'code' => 'required',
            'nb_utilisation' => 'required|numeric|integer'
        ]);

        $id_code = $request->codepromo;

        $code = Codepromo::find($id_code);


        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $notif_text = ' Mise à jour du code promo de ID ' . $code->id_code . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
            ->insertGetId([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'code promo'
            ]);

        $code->update([
            'id_remise' => $request->id_remise,
            'nb_utilisation' => $request->nb_utilisation,
            'code' => $request->code,
            'date_update' => $current_date->format('Y-m-d H:i:s')
        ]);

        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );
        $stripe->promotionCodes->update(
            $code->id_stripe_code,
            [
                'metadata' =>
                [
                    'id_code' => $code->id_code,
                    'id_remise' => $request->id_remise
                ]
            ]
        );

        return redirect()->route('codespromo.show', ['id_remise' => $code->id_code])
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
        $code = Codepromo::find($remise);

        $all_codes = DB::connection('mysql2')->table('codes_promo')
            ->where('id_remise', $code->id_remise)
            ->get();

        $parrainage = DB::connection('mysql2')->table('parrainage')
            ->join('codes_promo', 'parrainage.id_code', '=', 'codes_promo.id_code')
            ->where('codes_promo.id_code', $remise)
            ->get();

        if (($all_codes->count() > 1) && ($parrainage->isEmpty())) {
            if ($code->id_stripe_code != null) {
                $stripe = new \Stripe\StripeClient(
                    env('STRIPE_SECRET')
                );
                $stripe->promotionCodes->update(
                    $code->id_stripe_code,
                    ['active' => false]
                );
            }


            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
            $current_date->setTimestamp($timestamp);
            $notif_text = ' Suppression du code promo de ID ' . $code->id_code . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

            $notification = DB::connection('mysql2')->table('notification')
                ->insertGetId([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'code promo'
                ]);

            $code->delete();

            return redirect()->route('codespromo.index')
                ->with('success', 'Code promo suprimé avec succes');
        }
        return redirect()->route('codespromo.index')
            ->with('error', 'Erreur lors de la suppression');
        dd($parrainage);
    }

    // -------------------- changer de statut produit ----------------------------
    public function change_statut($id_remise, $statut)
    {
        $modelCodepromo = new Codepromo;
        $modelCodepromo->setConnection('mysql2');

        $idCodes = DB::connection('mysql2')->select('SELECT id_code FROM codes_promo');
        
        $url1 = (int)$id_remise;

        $url = null;
        foreach ($idCodes as $key => $value) {
            if ($url1 === $value->id_code) {
                $url = $url1;
                break;
            }
        }

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);

        if ($url === null) {
            return redirect('/codes_promo');
        }

        DB::connection('mysql2')->statement('UPDATE codes_promo SET statut_code = ? , date_update = ? WHERE id_code = ?', [$statut, $current_date->format('Y-m-d H:i:s'), $url]);
    }
    // ---------
    public function modif_descrip(Request $request)
    {
        $request->validate([
            'id_remise' => 'required|exists:mysql2.codes_promo,id_code',
            'description' => 'required',
        ]);

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris')); //first argument "must" be a string
        $current_date->setTimestamp($timestamp); //adjust the object to correct timestamp

        DB::connection('mysql2')->statement('UPDATE codes_promo SET description = ?, date_update = ? WHERE id_code = ?', [$request->description, $current_date->format('Y-m-d H:i:s'), $request->id_remise]);

        return redirect()->route('codespromo.show', ['id_remise' => $request->id_remise])
            ->with('success', 'La mise a jour a bien été effectuée');
    }
    public function deleteSelect(Request $request)
    {
        $ids = $request->input('codespromo');
        DB::connection('mysql2')->table('codes_promo')->whereIn('id_code', $ids)->delete();
        return redirect()->route('codespromo.index')->with('success', 'Selection supprimée avec succes');
    }
}
