<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\FactureStatutNotification;
use DateTime;
use DateTimeZone;
use Carbon\Carbon;
use App\Models\Compte;
use App\Models\Panier;
use App\Models\Projets;
use App\Models\Cagnotte;
use App\Models\Paiement;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\ContactProjet;
use App\Models\experienceApp\Pack;
use Illuminate\Support\Facades\DB;

use App\Models\experienceApp\Contact;
use App\Models\experienceApp\Facture;
use App\Models\FactureProduitService;
use App\Models\ListePrix;
use App\Http\Controllers\PanierController;
use App\Models\experienceApp\PackExperience;
use App\Models\experienceApp\ProduitService;
use Google\Service\TrafficDirectorService\StaticCluster;


class UtilisateurAchatExperienceController extends Controller
{
    public function produitpack()
    {
        // Récupérer tous les packs
        $packs = Pack::all();

        // Récupérer tous les produits de service
        $produitsService = ProduitService::all();

        // Fusionner les collections en une seule
        $items = $packs->concat($produitsService);

        return view('utilisateurcontribution.parcourachat.produitpack', [
            'items' => $items,
        ]);
    }


    public function pack()
    {
        // Récupérer tous les packs
        $packs = Pack::all();

        return view('utilisateurcontribution.parcourachat.pack', [
            'packs' => $packs
        ]);
    }

    public function experience()
    {
        // Récupérer tous les produits de service
        $produitsService = ProduitService::all();
        return view('utilisateurcontribution.parcourachat.experience', [
            'produitsService' => $produitsService
        ]);
    }

    public function detailpack($id_pack)
    {
        $pack = Pack::find($id_pack);

        if (!$pack) {
            abort(404); // Gérer le cas où le pack n'est pas trouvé.
        }

        return view('utilisateurcontribution.parcourachat.detailpack', ['pack' => $pack]);
    }

    public function addToCartPackFromForm(Request $request)
    {
        $packId = $request->input('pack_id');
        $nombrePersonnes = $request->input('nombre_personnes');
        $nombreTitres = $request->input('nombre_titres');

        // Utilisez ces données pour ajouter au panier
        // ...

        // Ensuite, redirigez l'utilisateur vers la route "addtocart" avec les paramètres appropriés
        return redirect()->route('utilisateur.addtocart', [
            'item' => $packId,
            'type' => 'App\\Models\\experienceApp\\Pack',
            'nb_participants' => $nombrePersonnes,
            'nb_titres' => $nombreTitres,
            'quantity' => 1,
        ]);
    }

    public function addToCartProduitFromForm(Request $request)
    {
        $produitId = $request->input('produit_id');
        $quantity = $request->input('quantity');

        // Utilisez ces données pour ajouter au panier
        // ...

        // Ensuite, redirigez l'utilisateur vers la route "addtocart" avec les paramètres appropriés
        return redirect()->route('utilisateur.addtocart', [
            'item' => $produitId,
            'type' => 'App\\Models\\experienceApp\\ProduitService',
            'nb_participants' => 1,
            'nb_titres' => 1,
            'quantity' => $quantity,
        ]);
    }

    public static function addToCart($item, $type, $nb_participants = null, $nb_titres = null, $quantity = null)
    {
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        //$contact = Contact::find(139);
        $contact = Contact::where('email', auth()->user()->email)->get()->first();
        $panier = Panier::where('id_contact', $contact->id_contact)->where('statut', 'En cours')->get()->first();

        if (!$panier) {
            $facture = Facture::create([
                'nb_paiement' => 1,
                'date_creation' => $current_date,
                'date_update' => $current_date
            ]);

            $notification = Notification::create([
                'contenu_notification' => 'Facture ID ' . $facture->num_facture . ' créé',
                'date_notification' => $current_date,
                'type' => 'facture'
            ]);

            $facture_statut_notification = FactureStatutNotification::create([
                'id_notification' => $notification->id_notification,
                'date_statut' => $current_date,
                'num_facture' => $facture->num_facture,
                'id_facture_statut' => '11'
            ]);

            $panier = Panier::create([
                'statut' => 'En cours',
                'date_creation' => $current_date,
                'id_contact' => $contact->id_contact,
                'num_facture' => $facture->num_facture
            ]);

            $paiement = Paiement::create([
                'libelle'=>'Paiement panier de '.$contact->nom.' '.$contact->prenom,
                'prix'=>0,
                'statut_paiement'=>'Non Payé',
                'date_creation'=>$current_date,
                'num_facture'=>$facture->num_facture,
                'id_contact'=>$contact->id_contact
            ]);
        }
        //dd($panier);
        // dd($type);
        if ($type == 'App\Models\experienceApp\Pack') {
            $item = Pack::find($item);
            // dd($item);


            PanierController::addPackToCart($item, $panier, $nb_participants, $nb_titres);
        }
        if ($type == 'App\Models\experienceApp\ProduitService') {
            $item = ProduitService::find($item);
            PanierController::addProduitToCart($item, $panier, $quantity);
        }

        return redirect()->route('utilisateur.panier', ['id_panier' => $panier->id_panier]);
    }



    public function detailProduitService($id_produit)
    {
        $produitsService = ProduitService::find($id_produit);

        if (!$produitsService) {
            abort(404); // Gérer le cas où le produit de service n'est pas trouvé.
        }

        return view('utilisateurcontribution.parcourachat.detailproduit', ['produitsService' => $produitsService]);
    }


    public function panier($id_panier)
    {

        $panier = Panier::find($id_panier);

        //verification qu ele panier apaprtient bien au contact connecter
        if (!$this->verifyPanierOwnership($panier)) {
            return "Vous n'avez pas l'autorisation d'accéder à ce panier.";
        }

        if ($panier->statut === 'En cours') {
            // Le panier est en cours, vous pouvez afficher ses détails
        } else {
            return "Ce panier est terminé ou inactif.";
        }

        $packs = PackExperience::where('num_facture', $panier->num_facture)->get();
        $produits = FactureProduitService::where('num_facture', $panier->num_facture)->get();
        $listItem = [];
        $totalMontant = 0;
        foreach ($packs as $pack) {
            $prix = ListePrix::where('id_pack', $pack->id_pack)->orderBy('date_creation', 'desc')->first();
            $montant = $prix->prix + 40 * ($pack->nb_participants - 1) + 85 * ($pack->nb_titres - 1);
            $listItem[] = ['objet' => Pack::find($pack->id_pack), 'item' => $pack, 'montant' => $montant, 'num_facture' => $panier->num_facture,];
            $totalMontant += $montant;
        }
        foreach ($produits as $produit) {
            $prix = ListePrix::where('id_produit', $produit->id_produit)->orderBy('date_creation', 'desc')->first();
            $montant = $prix->prix * $produit->quantity;
            $listItem[] = ['objet' => ProduitService::find($produit->id_produit), 'item' => $produit, 'montant' => $montant, 'num_facture' => $panier->num_facture,];
            $totalMontant += $montant;
        }
        // dd($listItem);

        return view('utilisateurcontribution.parcourachat.panier', ['listItem' => $listItem, 'totalMontant' => $totalMontant, 'id_panier' => $id_panier]);
    }

    public function paiement($id_panier)
    {
        $panier = Panier::find($id_panier);

        //verification qu ele panier apaprtient bien au contact connecter
        if (!$this->verifyPanierOwnership($panier)) {
            return "Vous n'avez pas l'autorisation d'accéder à ce panier.";
        }
        if ($panier->statut === 'En cours') {
            // Le panier est en cours, vous pouvez afficher ses détails
        } else {
            return "Ce panier est terminé ou inactif.";
        }

        $packs = PackExperience::where('num_facture', $panier->num_facture)->get();
        $produits = FactureProduitService::where('num_facture', $panier->num_facture)->get();
        $listItem = [];
        $totalMontant = 0;
        foreach ($packs as $pack) {
            $prix = ListePrix::where('id_pack', $pack->id_pack)->orderBy('date_creation', 'desc')->first();
            $montant = $prix->prix + 40 * ($pack->nb_participants - 1) + 85 * ($pack->nb_titres - 1);
            $listItem[] = ['objet' => Pack::find($pack->id_pack), 'item' => $pack, 'montant' => $montant];
            $totalMontant += $montant;
        }
        foreach ($produits as $produit) {
            $prix = ListePrix::where('id_produit', $produit->id_produit)->orderBy('date_creation', 'desc')->first();
            $montant = $prix->prix * $produit->quantity;
            $listItem[] = ['objet' => ProduitService::find($produit->id_produit), 'item' => $produit, 'montant' => $montant];
            $totalMontant += $montant;
        }
        $contact = Contact::where('email', auth()->user()->email)->get()->first();
        $compte = Compte::where('id_contact', $contact->id_contact)->where('type', 'Llc')->get()->first();
        $contactProjets = ContactProjet::where('id_contact', $contact->id_contact)->get();

        $cagnottes = [];
        $totalCagnotte = 0;
        foreach ($contactProjets as $contactProjet) {
            $cagnotte = Cagnotte::where('id_projet', $contactProjet->id_projet)->get()->first();
            $cagnottes[] = $cagnotte;
            $totalCagnotte += $cagnotte->montant_actuel;
        }
        return view('utilisateurcontribution.parcourachat.paiement', [
            'listItem' => $listItem,
            'totalMontant' => $totalMontant,
            'id_panier' => $id_panier,
            'totalCagnotte' => $totalCagnotte,
            'compte' => $compte,
            'cagnottes' => $cagnottes
        ]);
    }


    public function payAchat(Request $request, $id_panier)
    {
        $contact = Contact::where("email", "=", auth()->user()->email)->get()->first();
        $compte = Compte::where('id_contact', $contact->id_contact)->where('type', 'Llc')->get()->first();
        $compteAvoir = [];

        $selected = $request->input('methode_paiement');
        $cagnottes = json_decode(request('cagnottes'), true);

        // $id_compte = $compte->id_compte;
        $somme = request('somme');
        $panier = Panier::find($id_panier);
        $panier->statut = 'Validé';
        $panier->save();
        $facture = Facture::find($panier->num_facture);
        $facture->prix_facture = $somme; // Remplacez par la nouvelle valeur
        $facture->save();
        $paiement = Paiement::where('num_facture', $panier->num_facture)->get()->first();
        if($contact->id_client_stripe==null) {
            $stripe = new \Stripe\StripeClient(
                env('STRIPE_SECRET')
            );
            $customer = $stripe->customers->create([
                'address'=>[
                    'line1'=>$request->adress,
                    'postal_code'=>$request->cp,
                    'city'=>$request->ville,
                ],
                'phone'=>$contact->tel,
                'email'=>$contact->email,
                'name'=>$contact->prenom.' '.$contact->nom,
                'metadata' =>
                    [
                        'id_contact'=>$contact->id_contact,
                    ]
            ]);
            $contact->id_client_stripe=$customer->id;
            $contact->save();
        }
        if (!$paiement) {
            $paiement = Paiement::create([
                'libelle' => 'paiement',
                'prix' => $somme,
                'statut_paiement' => 'Non payé',
                'date_creation' => now(),
                'num_facture' => $facture->num_facture,
                'id_contact' => $contact->id_contact
            ]);
        }
        switch ($selected) {
            case 'cagnotte':
                $max = $selected = $request->input('totalCagnotte');
                $request->validate([
                    'methode_paiement' => 'required',
                    'somme' => ['required', 'numeric', 'max:' . $max]
                ]);
                $invoice = $this->payCagnotte($contact, $somme, $facture);
                // dd($invoice);
                if ($invoice == false) {
                    return redirect()->route('utilisateur.paiement', ['id_panier', $panier->panier])
                        ->with('error', 'Aucune cagnotte n\'est suffisant, transferez les sommes des cagnottes dans votre compte Llc pour accumuler des fonds');
                }
                return redirect(route('utilisateur.recapachat', ['id_panier' => $panier->id_panier]))->with('success', 'Achat réussi');
            case 'compte-llc':
                $max = intval($compte->solde);
                $request->validate([
                    'methode_paiement' => 'required',
                    'cagnottes' => 'required',
                    'somme' => ['required', 'numeric', 'max:' . $max]
                ]);
                $invoice = $this->payCompte($compte, $somme, $facture);
                // dd($invoice);
                return redirect(route('utilisateur.recapachat', ['id_panier' => $panier->id_panier]))->with('success', 'Achat réussi');
            case 'par-carte':
                $invoice = $this->payCarte($somme, $facture);
                // dd($invoice['hosted_invoice_url']);
                return redirect($invoice['hosted_invoice_url'])->with('success', 'Achat réussi');
                /*case 'avoir':
                $max = intval($compteAvoir->solde);
                $request->validate([
                    'methode_paiement' => 'required',
                    'cagnottes' => 'required',
                    'somme' => ['required', 'numeric', 'max:' . $max]
                ]);
                $invoice = $this->payCompte($compteAvoir, $somme, $facture);
                // dd($invoice);
                return redirect(route('utilisateur.recapachat', ['panier' => $panier->id_panier]))->with('success', 'Achat réussi');
            return redirect(route('utilisateur.recapachat'))->with('success','Achat réussi');*/
            default:
                return redirect()->route('utilisateur.payachat', ['id_panier', $panier->panier])
                    ->with('error', 'Mode de paiement inconnu');
        }
    }

    public function payCagnotte($contact, $somme, $facture)
    {

        //Initialisation de l'API de Stripe
        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );
        //recuperation de compte
        $compte = Compte::where('id_contact', '=', $contact->id_contact)->where('type', 'Llc')->get()->first();

        //recuperation de cagnotte
        $cagnottes = $this->getCagnottesContact($contact->id_contact);

        //parcours dees cagnottes pour voir si une cagnotte rempli les condition
        foreach ($cagnottes as $cagn) {
            $cagnotte = $cagn[0];
            if ($cagnotte->montant_actuel >= $somme) {
                // dd($cagnotte->montant_actuel);
                $paiement = Paiement::where('num_facture', $facture->num_facture)->get()->first();
                $cagnotte->decrement('montant_actuel', $somme);
                $compte->increment('solde', $somme);
                $transact1 = Transaction::create([
                    'montant' => $somme,
                    'type' => 'transfert',
                    'id_cagnotte' => $cagnotte->id_cagnotte,
                    'id_compte_destinataire' => $compte->id_compte,
                    'id_paiement' => $paiement->id_paiement,
                    'id_contact' => $contact->id_contact
                ]);
                //creation du credit dans stripe
                $transaction = $stripe->customers->createBalanceTransaction(
                    $contact->id_client_stripe,
                    [
                        'amount' => -intval($somme * 100),
                        'currency' => 'eur',
                        'description' => 'Le solde du client a augmenté de ' . $somme,
                    ]
                );
                $compte->decrement('solde', $somme);
                $transact2 = Transaction::create([
                    'montant' => $somme,
                    'type' => 'paiement',
                    'id_compte_source' => $compte->compte,
                    'id_paiement' => $paiement->id_paiement,
                    'id_contact' => $contact->id_contact
                ]);
                $invoice = StripeController::createInvoice($contact, $facture);
                return $invoice;
            }
        }
        return redirect()->route('utilisateur.achat')->with('error', 'Aucune cagnotte n\'est suffisant, transferez les sommes des cagnottes dans votre compte Llc pour accumuler des fonds');
    }

    public function getCagnottesContact($id_contact)
    {
        $contactProjets = ContactProjet::where('id_contact', '=', $id_contact)->get();
        $projets = [];
        foreach ($contactProjets as $contactProjet) {
            $projets[] = Projets::find($contactProjet->id_projet);
        }
        $cagnottes = [];
        foreach ($projets as $projet) {
            $cagnottes[] = Cagnotte::where('id_projet', '=', $projet->id_projet)->get();
        }
        return $cagnottes;
    }

    public function payCompte($compte, $somme, $facture)
    {

        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );

        $contact = Contact::where("email", "=", auth()->user()->email)->get()->first();
        if ($compte->solde < $somme) {
            abort('402', 'La solde du compte n\'est pas suffisant.');
        }

        $compte->decrement('solde', $somme);
        $transaction = $stripe->customers->createBalanceTransaction(
            $contact->id_client_stripe,
            [
                'amount' => -intval($somme * 100),
                'currency' => 'eur',
                'description' => 'Le solde du client a augmenté de ' . $somme,
            ]
        );
        $invoice = StripeController::createInvoice($contact, $facture);
        return $invoice;
    }

    public function payAvoir($compte, $somme, $facture)
    {

        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );

        $contact = Contact::where("email", "=", auth()->user()->email)->get()->first();
        if ($compte->solde < $somme) {
            abort('402', 'La solde du compte n\'est pas suffisant.');
        }
        $compte->decrement('solde', $somme);
        $transaction = $stripe->customers->createBalanceTransaction(
            $contact->id_client_stripe,
            [
                'amount' => -intval($somme * 100),
                'currency' => 'eur',
                'description' => 'Le solde du client a augmenté de ' . $somme,
            ]
        );
        $invoice = StripeController::createInvoice($contact, $facture);
        return $invoice;
    }

    public function payCarte($somme, $facture)
    {

        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );
        $contact = Contact::where("email", "=", auth()->user()->email)->get()->first();
        $invoice = StripeController::createInvoice($contact, $facture);
        return $invoice;
    }

    public function recapachat($id_panier)
    {
        $contact = Contact::where("email", "=", auth()->user()->email)->get()->first();

        // 1. Récupérer le montant total des cagnottes du contact
        $totalCagnottes = $contact->projets->sum(function ($projet) {
            return $projet->cagnottes->sum('montant_actuel');
        });

        // 2. Récupérer le montant du compte du contact
        $compte = Compte::where('id_contact', $contact->id_contact)->value('solde');

        // 3. Récupérer le dernier panier en cours du contact
        $dernierPanier = Panier::where('num_facture', '!=', null)
            ->where('id_contact', $contact->id_contact)
            ->orderBy('date_creation', 'desc')
            ->first();

        // Vérifiez que l'ID du panier correspond à l'ID passé dans l'URL
        if ($dernierPanier && $dernierPanier->id_panier == $id_panier) {
            // Le panier existe et l'ID correspond
            // Le reste de votre code pour afficher la page
            // ...
        } else {
            // Redirigez l'utilisateur vers une page d'erreur ou la page d'accueil
            return redirect()->route('utilisateur.produitpack');
        }


        $produitsDuPanier = [];
        $totalDuPanier = 0;

        if ($dernierPanier) {
            $numFacture = $dernierPanier->num_facture;

            // Récupérer les produits du panier
            $produitsDuPanier = FactureProduitService::where('num_facture', $numFacture)->get();

            // Récupérer les packs du panier
            $packsDuPanier = PackExperience::where('num_facture', $numFacture)->get();

            // Calculer le montant total du panier pour les packs
            $totalDuPanierPacks = $packsDuPanier->sum(function ($pack) {
                $prix = ListePrix::where('id_pack', $pack->id_pack)->orderBy('date_creation', 'desc')->first();
                $montant = $prix->prix + 40 * ($pack->nb_participants - 1) + 85 * ($pack->nb_titres - 1);
                $pack->montant = $montant; // Mettez à jour le montant du pack
                return $montant;
            });

            // Calculer le montant total du panier pour les produits avec quantité
            $totalDuPanierProduits = $produitsDuPanier->sum(function ($produit) {
                $prix = ListePrix::where('id_produit', $produit->id_produit)->orderBy('date_creation', 'desc')->first();
                return $prix->prix * $produit->quantity;
            });

            // Calculer le montant total du panier
            $totalDuPanier = $totalDuPanierPacks + $totalDuPanierProduits;
        }

        return view('utilisateurcontribution.parcourachat.recapachat', compact('totalCagnottes', 'compte', 'produitsDuPanier', 'packsDuPanier', 'totalDuPanier'));
    }


    private function verifyPanierOwnership($panier)
    {
        $user = Contact::where('email', auth()->user()->email)->first();

        if (!$user) {
            return false;
        }

        if ($panier->id_contact === $user->id_contact) {
            return true;
        }

        return false;
    }
}
