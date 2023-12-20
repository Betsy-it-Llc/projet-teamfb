<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use App\Models\experienceApp\ProduitService;
use Illuminate\Support\Facades\DB;
use PHPUnit\TextUI\XmlConfiguration\Group;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;

class produitserviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $produitservice = new ProduitService;
        $produitservice->setConnection('mysql2');

        $perPage = $request->get('perPage') ?? 10;

        $dataQuery = DB::connection('mysql2')->table('produits_services')
            ->leftjoin('liste_prix', 'produits_services.id_produit', '=', 'liste_prix.id_produit')
            ->whereIn('liste_prix.statut', ['Par Défaut', DB::raw('(SELECT MAX(statut) FROM liste_prix WHERE id_produit = produits_services.id_produit)')])
            ->select(DB::raw('MAX(liste_prix.prix) as prix'), 'produits_services.statut', 'produits_services.abstract', 'produits_services.description', 'produits_services.categorie', 'produits_services.nom_produit', 'produits_services.id_produit', 'produits_services.date_creation', 'produits_services.date_update', 'produits_services.id_stripe_produit', 'produits_services.url_stripe_produit')
            ->groupBy('produits_services.id_produit', 'produits_services.statut', 'produits_services.abstract', 'produits_services.description', 'produits_services.categorie', 'produits_services.nom_produit', 'produits_services.date_creation', 'produits_services.date_update', 'produits_services.id_stripe_produit', 'produits_services.url_stripe_produit')
            ->orderByDesc('id_produit')
            ->orderByDesc('prix');

        // -----------------------22.06.23-------------------------------------------------
        // dd($data);
        $multisearchnom = $request->get('multisearchnom');
        $multisearchtel = $request->get('multisearchtel');
        $multisearchprenom = $request->get('multisearchprenom');
        $multisearchcategorie = $request->get('multisearchcategorie');
        $multisearchstat = $request->get('multisearchstat');

        if (isset($multisearchnom) || isset($multisearchtel) || isset($multisearchprenom) || isset($multisearchcategorie) || isset($multisearchstat)) {
            $dataQuery = DB::connection('mysql2')->table('produits_services')
                ->join('liste_prix', 'produits_services.id_produit', '=', 'liste_prix.id_produit')
                ->whereIn('liste_prix.statut', ['Par Défaut', DB::raw('(SELECT MAX(statut) FROM liste_prix WHERE id_produit = produits_services.id_produit)')])
                ->select(DB::raw('MAX(liste_prix.prix) as prix'), 'produits_services.statut', 'produits_services.abstract', 'produits_services.description', 'produits_services.categorie', 'produits_services.nom_produit', 'produits_services.id_produit', 'produits_services.date_creation', 'produits_services.date_update', 'produits_services.id_stripe_produit', 'produits_services.url_stripe_produit')
                ->groupBy('produits_services.id_produit', 'produits_services.statut', 'produits_services.abstract', 'produits_services.description', 'produits_services.categorie', 'produits_services.nom_produit', 'produits_services.date_creation', 'produits_services.date_update', 'produits_services.id_stripe_produit', 'produits_services.url_stripe_produit')
                ->orderByDesc('id_produit')
                ->when(isset($multisearchcategorie), function ($query) use ($multisearchcategorie) {
                    return $query->where('produits_services.categorie', '=', $multisearchcategorie);
                })
                ->when(isset($multisearchstat), function ($query) use ($multisearchstat) {
                    return $query->where('produits_services.statut', '=', $multisearchstat);
                });
        }

        $liste_categorie = DB::connection('mysql2')->table('produits_services')
            ->select('categorie')
            ->distinct()
            ->get();

        $liste_statut    =  DB::connection('mysql2')->table('produits_services')
            ->select('statut')
            ->distinct()
            ->get();

        // -----------------------22.06.23-------------------------------------------------


        $statut = $request->get('statut'); // Récupérer le statut à partir de la requête
        $periode = $request->get('periode'); // Récupérer la période à partir de la requête

        $dataQuery = ProduitService::when($statut, function ($query) use ($statut) {
            if ($statut === 'actif') {
                return $query->where('statut', 'actif');
            } elseif ($statut === 'inactif') {
                return $query->where('statut', 'inactif');
            }
        })
            ->when($periode, function ($query) use ($periode) {
                if ($periode === 'semaine') {
                    $now = date('Y-m-d');
                    $weekStart = date('Y-m-d', strtotime('-1 week'));
                    return $query->whereBetween('date_creation', [$weekStart, $now]);
                } elseif ($periode === 'mois') {
                    $now = date('Y-m-d');
                    $monthStart = date('Y-m-d', strtotime('-1 month'));
                    return $query->whereBetween('date_creation', [$monthStart, $now]);
                } elseif ($periode === 'trimestre') {
                    $now = date('Y-m-d');
                    $trimesterStart = date('Y-m-d', strtotime('-3 months'));
                    return $query->whereBetween('date_creation', [$trimesterStart, $now]);
                } elseif ($periode === 'annee') {
                    $now = date('Y-m-d');
                    $yearStart = date('Y-m-d', strtotime('-1 year'));
                    return $query->whereBetween('date_creation', [$yearStart, $now]);
                }
            });

        $dataQuery = Produitservice::when($statut, function ($query) use ($statut) {
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
                    $now = date('Y-m-d H:i:s'); // Include time for more accurate comparison
                    $weekStart = date('Y-m-d H:i:s', strtotime('-1 week'));
                    $query->whereDate('date_creation', '>=', $weekStart)
                        ->whereDate('date_creation', '<=', $now);
                } elseif ($periode === 'mois') {
                    $now = date('Y-m-d H:i:s'); // Include time for more accurate comparison
                    $monthStart = date('Y-m-d H:i:s', strtotime('-1 month'));
                    $query->whereDate('date_creation', '>=', $monthStart)
                        ->whereDate('date_creation', '<=', $now);
                } elseif ($periode === 'trimestre') {
                    $now = date('Y-m-d H:i:s'); // Include time for more accurate comparison
                    $trimesterStart = date('Y-m-d H:i:s', strtotime('-3 months'));
                    $query->whereDate('date_creation', '>=', $trimesterStart)
                        ->whereDate('date_creation', '<=', $now);
                } elseif ($periode === 'annee') {
                    $now = date('Y-m-d H:i:s'); // Include time for more accurate comparison
                    $yearStart = date('Y-m-d H:i:s', strtotime('-1 year'));
                    $query->whereDate('date_creation', '>=', $yearStart)
                        ->whereDate('date_creation', '<=', $now);
                }
            });

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

        $totalProduit = $data->total();

        // dd($data);
        // $reservations = Reservationclient::sortable()->paginate(15)->withQueryString();
        return view(
            'produitservice.index',
            compact(
                'data',
                'perPage',
                'totalProduit',
                'liste_categorie',
                'liste_statut',
                'count_actif',
                'count_inactif',
                'count_archive',
            )
        )
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produitservice.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*if(isset($request->num_facture)) {
            DB::connection('mysql2')->table('Produits_Services')->insert(
                ['id_service' => $request->id_service,]
            );
        } else{
            echo "Pas de service";
        }*/

        $request->validate([
            'nom_produit' => 'required',
            'prix' => 'required|numeric|min:0',
            'categorie' => 'nullable',
            'abstract',
            'description' => 'required|string',
            'statut'
        ]);

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris')); //first argument "must" be a string
        $current_date->setTimestamp($timestamp); //adjust the object to correct timestamp

        $prod = ProduitService::create([
            'nom_produit' => $request->nom_produit,
            'prix' => $request->prix,
            'categorie' => $request->categorie,
            'abstract' => $request->abstract,
            'description' => $request->description,
            'statut' => $request->statut,
            'date_creation' => $current_date->format('Y-m-d H:i:s'),
            'date_update' => $current_date->format('Y-m-d H:i:s'),
        ]);


        $notif_text = 'Creation d\'un nouveau produit le ' .  $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
            ->insertGetId([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'produit'
            ]);

        //dd($prod->id_produit);

        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );

        $produit = $stripe->products->create([
            'name' => $request->nom_produit,
            'description' => $request->description,
            'default_price_data' =>
            [
                'currency' => 'eur',
                'unit_amount' => intval($request->prix) * 100
            ],
            'metadata' =>
            [
                'abstract' => $request->abstract,
                'id_produit' => $prod->id_produit,
                'statut' => 'actif',
                'categorie' => $request->categorie,
                'type' => 'produits_services'
            ]
        ]);

        $produit = substr($produit, 21);

        $produit = json_decode($produit, true);

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris')); //first argument "must" be a string
        $current_date->setTimestamp($timestamp); //adjust the object to correct timestamp
        $notif_text = 'Mise à jour liée à stripe du produit de ID ' . $prod->id_produit . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
            ->insertGetId([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'produit'
            ]);

        DB::connection('mysql2')
            ->update('UPDATE produits_services SET produits_services.id_stripe_produit="' . $produit['id'] . '", produits_services.url_stripe_produit="https://dashboard.stripe.com/test/products/' . $produit['id'] . '",produits_services.date_update="' . $current_date->format('Y-m-d H:i:s') . '"  WHERE produits_services.id_produit=' . $prod->id_produit . '');
        //     $ancienneEntree = DB::connection('mysql2')->table('liste_prix')
        //     ->where('id_produit', $prod->id_produit)
        //     ->where('statut', 'Par Défaut')
        //     ->first();
        //     // dd($ancienneEntree);

        // if ($ancienneEntree) {
        //     DB::connection('mysql2')->table('liste_prix')
        //         ->where('id_liste_prix', $ancienneEntree->id_liste_prix)
        //         ->update(['statut' => 'Actif']);
        // }

        DB::connection('mysql2')->table('liste_prix')->insert([
            'id_produit' => $prod->id_produit,
            'prix' => $prod->prix,
            'statut' => 'Par Défaut',
            'date_creation' => $prod->date_creation
        ]);


        return redirect()->route('produitservice.show', ['produitservice' => $prod->id_produit])
            ->with('success', 'Le produit a bien été ajouté');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $prosuitservice)
    {

        $modelproduitservice = new ProduitService;
        $modelproduitservice->setConnection('mysql2');
        $num_prd = DB::connection('mysql2')->select('SELECT id_produit FROM produits_services');
        $url1 = (int) $prosuitservice;

        foreach ($num_prd as $key => $value) {
            if ($url1 === $value->id_produit) {
                $url = $url1;
            }
        }
        if (!isset($url)) {
            //dd(view('clients.edit')->with(['contact'=>$id_contact]));

            return redirect('/produitservice');
        }


        $dbs = DB::connection('mysql2')->select('SELECT id_produit, nom_produit, prix, abstract,categorie,date_creation,statut,stock,description
                    FROM produits_services
                    WHERE id_produit=?', [$url]);

        $nb_achat = DB::connection('mysql2')
            ->table('produits_services')
            ->join('facture_produit_service', 'facture_produit_service.id_produit', '=', 'produits_services.id_produit')
            ->where('facture_produit_service.id_produit', $url)
            ->select(DB::raw('SUM(facture_produit_service.quantity) as total_quantite'))
            ->orderByDesc('produits_services.id_produit')
            ->first();

        $totalQuantite = $nb_achat->total_quantite;
        //   dd($totalQuantite);
        // dd($dbs);
        $statutPrix =  DB::connection('mysql2')
            ->table('liste_prix')
            ->where('id_produit', $url)
            ->latest('id_liste_prix')
            ->first();
        // dd($statutPrix);
        $defaultPrice =  DB::connection('mysql2')
            ->table('liste_prix')
            ->where('id_produit', $url)
            ->where('statut', 'Par Défaut')
            ->first();
        if (!$defaultPrice) {
            $defaultPrice = DB::connection('mysql2')
                ->table('liste_prix')
                ->where('id_produit', $url)
                ->latest('id_liste_prix')
                ->first();
        }

        $allPrices = DB::connection('mysql2')->table('liste_prix')
            ->where('id_produit', $url)
            ->get();

        // JM upload image
        //gestion des erreurs
        $id_produit = (int) $prosuitservice;
        
        // on trouver le produit grâce à son id 
        $produitservice=ProduitService::findorfail($id_produit);
        // on récupère le fichier venant de l'input file de la vue
        $image_produit = $request->file('image_produit');
        // si le fichier existe on execute le code
        if($image_produit){
            $request->validate([
                'image_produit' => 'required|image|mimes:jpeg,png,gif,jpg,bmp,tiff,webp,svg,ico,tga,pcx,pbm,pgm,ppm', // Acceptez uniquement les formats JPEG, PNG et GIF.
                
            ]);

            // on recupère l'extension
            $extension = $image_produit->getClientOriginalExtension();
            // on recupère le nom originale
            $originalFileName = $image_produit->getClientOriginalName();
            // on enlève les espaces, les accents
            $newFileName = preg_replace('/[\'"\sÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝàáâãäåæçèéêëìíîïðñòóôõöøùúûüý]/', '', $originalFileName);
            //si une image existe on l'efface, ( de la bdd ainsi que de google drive)
            if($produitservice->getFirstMedia('Images/image_produit')){
                $produitservice->getFirstMedia('Images/image_produit')->delete();
            }
            // on ajoute l'image
            $produitservice->addMedia($image_produit)
            // ->withCustomProperties(['folder' => 'Cloud_Laravel_App/Ressources/Produits/image_produit-'.$produitservice->nom_produit])
            ->usingFilename($newFileName)
            ->toMediaCollection('Images/image_produit','google');
            $produitservice->save();

            //upload success
            $success_image='L\'image à été ajouté avec succès';
            
            // Stockez la variable $success_image dans la session flash
            session()->flash('success_image', $success_image);
            return redirect()->to('produitservice.show/' . $id_produit);
        }

        // on initialise une variable à null
        $image_du_produit=null;
        // si l'image existe on creer son url qu'on enverra dans la vue
        if($produitservice->getFirstMedia('Images/image_produit')){
            $image_du_produit=$produitservice->getFirstMedia('Images/image_produit')->getUrl();
        }

        ////////////Suppression de l'image////////////
        $delete_image = $request->has('delete_image');
        if ($produitservice->getFirstMedia('Images/image_produit') && $delete_image) {
            $produitservice->getFirstMedia('Images/image_produit')->delete();
            
            //delete success
            $success_image_delete='L\'image à été supprimée';

            // Stockez la variable $success_image dans la session flash
            session()->flash('success_image_delete', $success_image_delete);

            return redirect()->to('produitservice.show/'.$id_produit);
        }
        return view('produitservice.show', compact('dbs', 'totalQuantite', 'statutPrix', 'defaultPrice', 'allPrices','image_du_produit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($produitservice)
    {
        $modelproduitservice = new ProduitService;
        $modelproduitservice->setConnection('mysql2');

        $num_prd = DB::connection('mysql2')->select('SELECT id_produit FROM produits_services');
        $url1 = (int) $produitservice;

        foreach ($num_prd as $key => $value) {
            if ($url1 === $value->id_produit) {
                $url = $url1;
            }
        }
        $dbs = DB::connection('mysql2')->select('SELECT id_produit, nom_produit, prix, abstract,categorie,date_creation,statut,description
                    FROM produits_services
                    WHERE id_produit=?', [$url]);

        $defaultPrice = DB::connection('mysql2')->table('liste_prix')
            ->where('id_produit', $url)
            ->where('statut', 'Par Défaut')
            ->latest('id_liste_prix')
            ->first();


        $statutPrix =  DB::connection('mysql2')
            ->table('liste_prix')
            ->where('id_produit', $url)
            // ->latest()
            ->first();

        $allPrices = DB::connection('mysql2')->table('liste_prix')
            ->where('id_produit', $url)
            ->get();

        return view('produitservice.edit', compact('dbs', 'produitservice', 'defaultPrice', 'statutPrix', 'allPrices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $produitservice)
    {
        $request->validate([
            'nom_produit' => 'required',
            'prix' => 'required|numeric|min:0',
            'categorie' => 'nullable',
            'statut',
            'abstract',
            'description' => 'required|string'
        ]);

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris')); //first argument "must" be a string
        $current_date->setTimestamp($timestamp); //adjust the object to correct timestamp

        $prod = ProduitService::find($produitservice);
        $prod->update([
            'nom_produit' => $request->nom_produit,
            'prix' => $request->prix,
            'categorie' => $request->categorie,
            'abstract' => $request->abstract,
            'description' => $request->description,
            'statut' => $request->statut,
            'date_update' => $current_date->format('Y-m-d H:i:s'),
        ]);


        $notif_text = 'Mise à jour du produit de ID ' . $produitservice . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
            ->insertGetId([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'produit'
            ]);
        // dd($prod);
        /*$stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
          );

        $produit=$stripe->products->update([
            'name' => $request->nom_produit,
            'description' => $request->description,
            'default_price_data' =>
                [
                    'currency'=>'eur',
                    'unit_amount'=>intval($request->prix)*100//il faudra créer un new price et set default le prix avant l'update produit
                ],
            'metadata' =>
                [
                    'abstract' => $request->abstract,
                    'id_produit' => $prod->id_produit,
                    'statut' => 'actif',
                    'categorie'=>$request->categorie,
                ]
        ]);*/
        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );

        $price = $stripe->prices->create([
            'unit_amount' => floatval($request->prix) * 100,
            'currency' => 'eur',
            'product' => $prod->id_stripe_produit,
        ]);

        $prices = $stripe->prices->all(['product' => $prod->id_stripe_produit]);

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
                'product' => $prod->id_stripe_produit,
            ]);
        }
        //$price = substr($price,19);
        //$price = json_decode($price,true);
        $price_id = $price['id'];


        //dd($price['id']);

        $pack = $stripe->products->update(
            $prod->id_stripe_produit,
            [
                'name' => $request->nom_produit,
                'description' => $request->description,
                //'default_price'=>$price_id,
                //'default_price'=>''.$price['id'],
                'metadata' =>
                [
                    'abstract' => $request->abstract,
                    'id_pack' => $prod->id_produit,
                    'statut' => 'actif',
                ]
            ]
        );

        if ($request->statutPrix == "Par Défaut") {
            $pack = $stripe->products->update(
                $pack->id,
                [
                    'default_price' => $price_id,
                ]
            );
        }

        $derniereEntree = DB::connection('mysql2')
            ->table('liste_prix')
            ->where('id_produit', $prod->id_produit)
            ->where('statut', 'Par Défaut')
            ->first();
        // dd($request);
        if ($derniereEntree) {
            DB::connection('mysql2')->table('liste_prix')
                ->where('id_liste_prix', $derniereEntree->id_liste_prix)
                ->update(['statut' => 'Actif']);
        }
        $defaultPrice =  DB::connection('mysql2')
            ->table('liste_prix')
            ->where('id_produit', $prod->id_produit)
            // ->latest()
            ->first();
        $id_prix = $request->allpricesId;
        // dd($request);
        DB::connection('mysql2')
            ->table('liste_prix')
            ->where('id_produit', $prod->id_produit)
            ->where('id_liste_prix', $id_prix)
            ->update(['statut' => $request->statutPrix, 'prix' => $request->prix]);




        return redirect()->route('produitservice.show', ['produitservice' => $prod->id_produit, 'defaultPrice' => $defaultPrice])
            ->with('success', 'La mise a jour a bien été effectuée');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($produitservice)
    // {

    //     $autre_prestation_experience= DB::connection('mysql2')->table('autre_prestation_experience')
    //     ->where('id_produit',$produitservice)
    //     ->get();

    //     $facture_produit_service=DB::connection('mysql2')->table('facture_produit_service')
    //     ->where('id_produit',$produitservice)
    //     ->get();

    //     $pack_produit_service=DB::connection('mysql2')->table('pack_produit_service')
    //     ->where('id_produit',$produitservice)
    //     ->get();

    //     $produit_service_remise=DB::connection('mysql2')->table('produit_service_remise')
    //     ->where('id_produit',$produitservice)
    //     ->get();

    //     $prod = DB::connection('mysql2')->table('produits_services')
    //     ->where('id_produit',$produitservice)
    //     ->get();
    //     // dd($prod);
    //     // $h_rem = DB::connection('mysql2')->table('produits_service_remise')
    //     // ->where('id_produit',$produitservice)
    //     // ->get();

    //     $list_prix = DB::connection('mysql2')->table('liste_prix')
    //     ->where('id_produit',$produitservice)
    //     ->get();

    //     if(($autre_prestation_experience->isEmpty())&&($facture_produit_service->isEmpty())&&($pack_produit_service->isEmpty())&&($produit_service_remise->isEmpty())&&($list_prix->isEmpty()))
    //     {

    //         $stripe = new \Stripe\StripeClient(
    //             env('STRIPE_SECRET')
    //         );
    //         $stripe->products->update(
    //             $prod[0]->id_stripe_produit,
    //             ['active'=>false]
    //         );

    //         $timestamp = time();
    //         $current_date = new DateTime("now", new DateTimeZone('Europe/Paris')); //first argument "must" be a string
    //         $current_date->setTimestamp($timestamp); //adjust the object to correct timestamp
    //         $notif_text = 'Suppression du produit de ID ' . $produitservice . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

    //         $notification = DB::connection('mysql2')->table('notification')
    //         ->insertGetId([
    //             'contenu_notification' => $notif_text,
    //             'date_notification' => $current_date->format('Y-m-d H:i:s'),
    //             'type' => 'produit'
    //         ]);

    //         DB::connection('mysql2')->table('produits_services')->where('id_produit', $produitservice)->delete();

    //         return redirect()->route('produitservice.index')
    //                     ->with('success','Le produit/service a bien été supprimé');
    //     }
    //     else
    //     {
    //         return redirect()->route('produitservice.index')
    //                         ->with('error','Erreur lors de la suppression du produits');
    //     }
    // }

    public function destroy($produitservice)
    {
        $autre_prestation_experience = DB::connection('mysql2')->table('autre_prestation_experience')
            ->where('id_produit', $produitservice)
            ->get();

        $facture_produit_service = DB::connection('mysql2')->table('facture_produit_service')
            ->where('id_produit', $produitservice)
            ->get();

        $pack_produit_service = DB::connection('mysql2')->table('pack_produit_service')
            ->where('id_produit', $produitservice)
            ->get();

        $produit_service_remise = DB::connection('mysql2')->table('produit_service_remise')
            ->where('id_produit', $produitservice)
            ->get();

        $prod = DB::connection('mysql2')->table('produits_services')
            ->where('id_produit', $produitservice)
            ->get();

        if (($autre_prestation_experience->isEmpty()) && ($facture_produit_service->isEmpty()) && ($pack_produit_service->isEmpty()) && ($produit_service_remise->isEmpty())) {

            $stripe = new \Stripe\StripeClient(
                env('STRIPE_SECRET')
            );
            $stripe->products->update(
                $prod[0]->id_stripe_produit,
                ['active' => false]
            );

            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris')); //first argument "must" be a string
            $current_date->setTimestamp($timestamp); //adjust the object to correct timestamp
            $notif_text = 'Suppression du produit de ID ' . $produitservice . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

            $notification = DB::connection('mysql2')->table('notification')
                ->insertGetId([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'produit'
                ]);

            ProduitService::destroy($produitservice);
            return redirect()->route('produitservice.index')
                ->with('success', 'Le produit/service a bien été supprimé');
        } else {
            return redirect()->route('produitservice.index')
                ->with('error', 'Erreur lors de la suppression du produits');
            // Vérifier si l'id_produit est référencé dans d'autres tables
            $isReferenced = DB::connection('mysql2')->table('autre_prestation_experience')
                ->where('id_produit', $produitservice)
                ->orWhere(function ($query) use ($produitservice) {
                    $query->orWhereIn('id_produit', function ($subQuery) use ($produitservice) {
                        $subQuery->select('id_produit')
                            ->from('facture_produit_service')
                            ->where('id_produit', $produitservice);
                    })->orWhereIn('id_produit', function ($subQuery) use ($produitservice) {
                        $subQuery->select('id_produit')
                            ->from('pack_produit_service')
                            ->where('id_produit', $produitservice);
                    })->orWhereIn('id_produit', function ($subQuery) use ($produitservice) {
                        $subQuery->select('id_produit')
                            ->from('produit_service_remise')
                            ->where('id_produit', $produitservice);
                    })->orWhereIn('id_produit', function ($subQuery) use ($produitservice) {
                        $subQuery->select('id_produit')
                            ->from('experience')
                            ->where('id_produit', $produitservice);
                    });
                })
                ->exists();

            if ($isReferenced) {
                // Supprimer les références dans les autres tables
                DB::connection('mysql2')->table('facture_produit_service')->where('id_produit', $produitservice)->delete();
                DB::connection('mysql2')->table('autre_prestation_experience')->where('id_produit', $produitservice)->delete();
                DB::connection('mysql2')->table('pack_produit_service')->where('id_produit', $produitservice)->delete();
                DB::connection('mysql2')->table('produit_service_remise')->where('id_produit', $produitservice)->delete();
                DB::connection('mysql2')->table('experience')->where('id_produit', $produitservice)->delete();
                DB::connection('mysql2')->table('liste_prix')->where('id_produit', $produitservice)->delete();
                // Supprimer le produit/service de la table "produits_services"
                DB::connection('mysql2')->table('produits_services')->where('id_produit', $produitservice)->delete();

                return redirect()->route('produitservice.index')->with('success', 'Le produit/service et ses références ont bien été supprimés');
            }

            // Le produit n'est pas référencé, nous pouvons simplement le supprimer
            DB::connection('mysql2')->table('produits_services')->where('id_produit', $produitservice)->delete();

            return redirect()->route('produitservice.index')->with('success', 'Le produit/service a bien été supprimé');
        }
    }

    public function valid(Request $request)
    {

        return view('produitservice.validate');
    }

    // -------------------- changer de statut produit ----------------------------
    public function change_statut($prosuitservice, $statut)
    {
        $modelproduitservice = new ProduitService;
        $modelproduitservice->setConnection('mysql2');

        $num_prd = DB::connection('mysql2')->select('SELECT id_produit FROM produits_services');
        $url1 = (int) $prosuitservice;

        foreach ($num_prd as $key => $value) {
            if ($url1 === $value->id_produit) {
                $url = $url1;
            }
        }
        if (!isset($url)) {
            //dd(view('clients.edit')->with(['contact'=>$id_contact]));
            return redirect('/produitservice');
        }

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris')); //first argument "must" be a string
        $current_date->setTimestamp($timestamp); //adjust the object to correct timestamp

        $changer_statut = DB::connection('mysql2')->statement('UPDATE produits_services SET statut=?,date_update=? WHERE id_produit = ?', [$statut, $current_date->format('Y-m-d H:i:s'), $url]);
    }

    public function saveAllPrices()
    {
        $data = DB::connection('mysql2')->table('produits_services')->get();
        $statut_prix = 'Par défaut';
        foreach ($data as $item) {
            $existingData = DB::connection('mysql2')->table('liste_prix')
                ->where('id_produit', $item->id_produit)
                ->where('date_creation', $item->date_creation)
                ->where('prix', $item->prix)
                ->first();

            if (!$existingData) {
                DB::connection('mysql2')->table('liste_prix')->insert([
                    'date_creation' => $item->date_creation,
                    'id_produit' => $item->id_produit,
                    'prix' => $item->prix,
                    'statut' => $statut_prix
                ]);
            }
        }

        return redirect('produitservice.index')->with('success', 'Données enregistrées avec succès');
    }

    public function statutPrix(Request $request)
    {
        $statutPrix = $request->statutPrix;
        $id_produit = $request->id_produit;
        $id_prix = $request->allPricesId;
        // dd($request);
        // $data = DB::connection('mysql2')->table('produits_services')->get();
        $derniereEntree = DB::connection('mysql2')
            ->table('liste_prix')
            ->where('id_produit', $id_produit)
            ->where('statut', 'Par defaut')
            ->first();
        // dd($statutPrix);
        if ($derniereEntree) {
            DB::connection('mysql2')->table('liste_prix')
                ->where('id_liste_prix', $derniereEntree->id_liste_prix)
                ->update(['statut' => 'Actif']);
        }
        DB::connection('mysql2')
            ->table('liste_prix')
            ->where('id_produit', $id_produit)
            ->where('id_liste_prix', $id_prix)
            ->update(['statut' => $statutPrix]);

        $prod = DB::connection('mysql2')
            ->table('produits_services')
            ->where('id_produit', $id_produit)
            ->first();

        $prix = DB::connection('mysql2')
            ->table('liste_prix')
            ->where('id_liste_prix', $id_prix)
            ->first();

        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );

        $prices = $stripe->prices->all(['product' => $prod->id_stripe_produit]);

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
                'product' => $prod->id_stripe_produit,
            ]);
        }

        switch ($statutPrix) {
            case 'Par Défaut':
                $price = $stripe->prices->update($price->id, [
                    'active' => 'true'
                ]);
                $pack = $stripe->products->update(
                    $prod->id_stripe_produit,
                    [
                        'default_price' => $price["id"],
                    ]
                );
                break;
            case 'actif':
                $pack = $stripe->products->retrieve($prod->id_stripe_produit, []);
                if ($price->id == $pack->default_price) {
                    $pack = $stripe->products->update(
                        $prod->id_stripe_produit,
                        [
                            'default_price' => null,
                        ]
                    );
                    //dd($pack->default_price);
                }
                $price = $stripe->prices->update($price->id, [
                    'active' => 'true'
                ]);
                break;
            case 'inactif':
                $pack = $stripe->products->retrieve($prod->id_stripe_produit, []);
                if ($price->id == $pack->default_price) {
                    $pack = $stripe->products->update(
                        $prod->id_stripe_produit,
                        [
                            'default_price' => null,
                        ]
                    );
                    //dd($pack->default_price);
                }
                $price = $stripe->prices->update($price->id, [
                    'active' => 'false'
                ]);
                break;
        }

        return redirect('produitservice.show/' . $id_produit)->with('statutPrix', $statutPrix);
    }

    public function addNewPrice(Request $request)
    {
        $id_produit = $request->id_produit;
        $prix = $request->nouveauPrix;
        $statutPrix = $request->statutPrix;
        $date = Carbon::now();
        // Vérification de l'existence d'une autre entrée avec le même id_produit et statut "Par Défaut"
        $ancienneEntree = DB::connection('mysql2')->table('liste_prix')
            ->where('id_produit', $id_produit)
            ->where('statut', 'Par Défaut')
            ->first();
        // dd($ancienneEntree);

        if ($ancienneEntree) {
            DB::connection('mysql2')->table('liste_prix')
                ->where('id_liste_prix', $ancienneEntree->id_liste_prix)
                ->update(['statut' => 'Actif']);
        }

        $id_liste_prix = DB::connection('mysql2')->table('liste_prix')->insertGetId([
            'id_produit' => $id_produit,
            'prix' => $prix,
            'statut' => $statutPrix,
            'date_creation' => $date
        ]);

        $prod = DB::connection('mysql2')
            ->table('produits_services')
            ->where('id_produit', $id_produit)

            ->first();

        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );
        $price = $stripe->prices->create([
            'unit_amount' => floatval($request->nouveauPrix) * 100,
            'currency' => 'eur',
            'product' => $prod->id_stripe_produit,
            'metadata' => [
                'id_liste_prix' => $id_liste_prix,
                'id_produit' => $id_produit
            ]
        ]);
        switch ($statutPrix) {
            case 'Par Défaut':
                $price = $stripe->prices->update($price->id, [
                    'active' => 'true'
                ]);
                $pack = $stripe->products->update(
                    $prod->id_stripe_produit,
                    [
                        'default_price' => $price["id"],
                    ]
                );
                break;
            case 'actif':
                $pack = $stripe->products->retrieve($prod->id_stripe_produit, []);
                if ($price->id == $pack->default_price) {
                    $pack = $stripe->products->update(
                        $prod->id_stripe_produit,
                        [
                            'default_price' => null,
                        ]
                    );
                    //dd($pack->default_price);
                }
                $price = $stripe->prices->update($price->id, [
                    'active' => 'true'
                ]);
                break;
            case 'inactif':
                $pack = $stripe->products->retrieve($prod->id_stripe_produit, []);
                if ($price->id == $pack->default_price) {
                    $pack = $stripe->products->update(
                        $prod->id_stripe_produit,
                        [
                            'default_price' => null,
                        ]
                    );
                    //dd($pack->default_price);
                }
                $price = $stripe->prices->update($price->id, [
                    'active' => 'false'
                ]);
                break;
        }

        return redirect('produitservice.show/' . $id_produit)->with('success', 'Nouveau Prix créé avec succes');
    }

    public function deleteSelect(Request $request)
    {
        $ids = $request->input('produits');
        DB::connection('mysql2')->table('produits_services')->whereIn('id_produit', $ids)->delete();
        return redirect()->route('produitservice.index')->with('success', 'Selection supprimée avec succes');
    }
    public function archiver($id_produit)
    {

        $produit = ProduitService::findOrFail($id_produit);

        // Update the status to "archived" (assuming the field name is 'statut')
        $produit->update(['statut' => 'archivé']);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Produit archivé avec succes.');
    }

    public function modifStockProduit(Request $request)
    {
        $request->validate([
            'id_produit' => 'required|exists:mysql2.produits_services,id_produit',
            'stock' => 'required',
        ]);
        //dd($request->all());

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);

        DB::connection('mysql2')->statement('UPDATE produits_services SET stock = ?, date_update = ? WHERE id_produit = ?', [$request->stock, $current_date->format('Y-m-d H:i:s'), $request->id_produit]);

        
        

        return redirect()->route('produitservice.show', ['produitservice' => $request->id_produit]);
    }
}
