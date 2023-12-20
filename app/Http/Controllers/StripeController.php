<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Stripe\Balance;
use App\Models\Paiement;
use Illuminate\Http\Request;
use App\Models\experienceApp\Pack;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\FactureProduitService;
use App\Models\AutrePrestationExperience;
use App\Models\experienceApp\PackExperience;
use App\Models\experienceApp\ProduitService;

class StripeController extends Controller
{

  public function getBalance()
  {
    $stripe = new \Stripe\StripeClient(
      env('STRIPE_SECRET')
    );

    $balance = $stripe->balance->retrieve();

    return $balance;
  }

  public function createCheckoutwithExperience($id_experience, $id_contact, $montant)
  {

    $stripe = new \Stripe\StripeClient(
      env('STRIPE_SECRET')
    );

    $contact = DB::connection('mysql2')->table('contact')
      ->where('id_contact', $id_contact)->first();

    // $stripe->prices->update(
    //   'price_1NsLmlJcMHqHTYoT5Bu4R26D',
    //   [
    //     'custom_unit_amount' => [
    //       'enabled' => 'true',
    //       'preset' => $montant * 100
    //     ]
    //   ]
    // );

    //     $price = $stripe->prices->retrieve(getenv('PRICE_DONS'));

    // $price['currency_options']['eur']['custom_unit_amount']['preset'] = $montant;
    if (isset($_GET['anonyme'])) {
      $anonyme = $_GET['anonyme'];
    }

    if (isset($_GET['hidden'])) {
      $hidden = $_GET['hidden'];
    }

    $checkout = $stripe->checkout->sessions->create([
      'success_url' => route('contributions', ['idExperience' => $id_experience]),
      'line_items' => [
        [
          //'price' => getenv('PRICE_DONS'),
          'price_data' => [
            'currency' => 'eur',
            'product' => 'prod_OfhBkj7tAXmdBN',
            'unit_amount' => $montant * 100
          ],
          'quantity' => 1
        ],
      ],
      'customer' => $contact->id_client_stripe,
      'mode' => 'payment',
      'metadata' => [
        'id_experience' => $id_experience,
        'id_contact' => $id_contact,
        'type' => 'contribution',
        'anonyme' => $anonyme,
        'hidden' => $hidden
      ]
    ]);

    return redirect($checkout['url']);
  }


  public function checkContact(Request $request)
  {
    // Vérifiez si un contact existe en fonction des données du formulaire, par exemple l'adresse e-mail.
    $email = $request->input('email');

    $existingContact = DB::connection('mysql2')->table('contact')
      ->where('email', $email)
      ->first();

    if ($existingContact) {
      $contactId = $existingContact->id_contact;
    } else {
      // Si le contact n'existe pas, créez un nouveau contact.
      $newContactId = $this->createNewContact($request);
      $contactId = $newContactId;
    }

    // Ensuite, redirigez l'utilisateur vers la page Stripe avec les informations nécessaires.
    $idExperience = $request->input('id_experience');
    $montant = $request->input('montant');
    $hidden = $request->input('hidden') === 'on' ? 1 : 0;
    $anonyme = $request->input('anonyme') === 'on' ? 1 : 0;


    return redirect()->route('createCheckoutwithExperience', [
      'id_experience' => $idExperience,
      'id_contact' => $contactId,
      'montant' => $montant,
      'anonyme' => $anonyme,
      'hidden' => $hidden
    ]);
  }

  private function createNewContact(Request $request)
  {
    // initialisation de l'API Stripe
    $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

    // Créez un tableau avec les données du contact
    $contactData = [
      'email' => $request->input('email'),
      'name' => $request->input('prenom') . ' ' . $request->input('nom'),
      'metadata' => [
        'date_naissance' => $request->input('date_naissance'),
        // Autres métadonnées que vous souhaitez associer au contact
      ]
    ];

    // Utilisez les données du formulaire pour créer un contact dans Stripe
    $contact = $stripe->customers->create($contactData);

    // Enregistrez l'ID client Stripe dans votre base de données
    $newContact = DB::connection('mysql2')->table('contact')->insertGetId([
      'nom' => $request->input('nom'),
      'prenom' => $request->input('prenom'),
      'email' => $request->input('email'),
      'date_naissance' => $request->input('date_naissance'),
      'id_client_stripe' => $contact->id,
      // Autres colonnes de votre table contact
    ]);

    return $newContact;
  }




  public static function createInvoice($contact, $facture)
  {
    $stripe = new \Stripe\StripeClient(
      env('STRIPE_SECRET')
    );
    $paiement = Paiement::where('num_facture', $facture->num_facture)->get()->first();
    if (!$paiement) {
      $paiement = Paiement::create([
        'libelle' => 'paiement',
        'prix' => $facture->prix_facture,
        'statut_paiement' => 'Non payé',
        'date_creation' => now(),
        'num_facture' => $facture->num_facture,
        'id_contact' => $contact->id_contact
      ]);
    }
    $date_echeance = strtotime('+1 day');
    $invoice = $stripe->invoices->create([
      'customer' => $contact->id_client_stripe,
      'collection_method' => 'send_invoice',
      'due_date' => $date_echeance,
      //'description' => $description,
      'metadata' => [
        'id_contact' => $contact->id_contact,
        //'id_paiement' => $id_paiement,
        'num_facture' => $facture->num_facture,
        'id_paiement' => $paiement->id_paiment
      ]
    ]);

    $paiement->id_stripe_paiement = $invoice->id; // Remplacez par la nouvelle valeur
    $paiement->save();

    $packs_experience = PackExperience::where('num_facture', $facture->num_facture)->get();
    foreach ($packs_experience as $pp) {
      $pack = Pack::find($pp->id_pack);
      $product_pack = $stripe->products->retrieve($pack->id_stripe_pack, []);
      $stripe->invoiceItems->create([
        'customer' => $contact->id_client_stripe,
        'price' => $product_pack->default_price,
        'invoice' => $invoice['id'],
      ]);
      if ($pp->nb_titres > 1) {
        $product_titre = $stripe->products->retrieve(getenv('PRODUIT_TITRE'), []);
        $stripe->invoiceItems->create([
          'customer' => $contact->id_client_stripe,
          'price' => $product_titre->default_price,
          'invoice' => $invoice['id'],
          'quantity' => $pp['nb_titres'] - 1
        ]);
      }

      if ($pp->nb_participants > 1) {
        $product_part = $stripe->products->retrieve(getenv('PRODUIT_PARTICIPANT'), []);
        $stripe->invoiceItems->create([
          'customer' => $contact->id_client_stripe,
          'price' => $product_part->default_price,
          'invoice' => $invoice['id'],
          'quantity' => $pp['nb_participants'] - 1
        ]);
      }

      $autres_prestation = AutrePrestationExperience::where('id_pack_experience', $pp->id_pack_experience)->get();

      if (!is_null($autres_prestation)) {
        $checked_once = [];
        foreach ($autres_prestation as $ap) {
          if (!in_array($ap, $checked_once)) {
            $prest = ProduitService::find($ap->id_produit);
            $product_prest = $stripe->products->retrieve($prest->id_stripe_produit, []);
            $stripe->invoiceItems->create([
              'customer' => $contact->id_client_stripe,
              'price' => $product_prest->default_price,
              'invoice' => $invoice['id'],
            ]);
          }
        }
      }
    }

    $facture_produits = FactureProduitService::where('num_facture', $facture->num_facture)->get();
    foreach ($facture_produits as $produit) {
      $prest = ProduitService::find($produit->id_produit);
      $product_prest = $stripe->products->retrieve($prest->id_stripe_produit, []);
      $stripe->invoiceItems->create([
        'customer' => $contact->id_client_stripe,
        'price' => $product_prest->default_price,
        'invoice' => $invoice['id'],
        'quantity' => $produit->quantity
      ]);
    }



    //Application d'une remise
    // $remrem = DB::connection('mysql2')->table('remise')->where('id_remise', $fact_rem)->get()->first();
    // if (!is_null($remrem)) {
    //     $stripe->invoices->update(
    //         $invoice['id'],
    //         [
    //             'discounts' => [
    //                 ['coupon' => $remrem->id_stripe_remise]
    //             ]
    //         ]
    //     );
    // }

    $invoice = $stripe->invoices->finalizeInvoice(
      $invoice['id'],
      []
    );

    return ($invoice);
  }
}
