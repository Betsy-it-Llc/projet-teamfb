<?php

namespace App\Http\Controllers;
use App\Models\Cagnotte;
use App\Models\Historique;
use App\Models\HistoriqueLiaison;
use App\Models\Projet;
use DateTime;
use DateTimeZone;
use \Stripe\Stripe;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ContactProjet;
use App\Models\StripeWebhook;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

//require_once(base_path('storage/app/secrets.php'));
require_once(__DIR__ . '/../../../vendor/stripe/stripe-php/lib/Stripe.php');
require_once(__DIR__ . '/../../../vendor/autoload.php');

use App\Models\experienceApp\Contact;
use App\Notifications\ContributionMade;
use App\Mail\MailConfirmationContribution;
use PHPUnit\TextUI\XmlConfiguration\Group;
use App\Notifications\NotifyExperimentateurContributionMade;

class StripeWebhookController extends Controller
{

    //création du numéro d'expérience
    function generateNumeroExperience()
    {
        $date = getdate();
        $year = substr($date['year'], -2);
        $month = $date['mon'];
        if (intval($month) < 10) {
            $month = '0' . $month;
        }
        $day = $date['mday'];
        $string = $year . $month . $day;
        $chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        for ($i = 0; $i < 4; $i++) {
            $string .= $chars[rand(0, strlen($chars) - 1)];
        }
        return $string;
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

    public function handleWebhook(Request $request)
    {

        http_response_code(200);
        session_start();

        //CONNECTION à DRIVE
        $clientDrive = new \Google_Client();
        $clientDrive->setAuthConfig(__DIR__ . '/../../Google/google_credentials.json');
        $clientDrive->addScope(\Google_Service_Drive::DRIVE);
        $clientDrive->setAccessType('offline');

        // Redirect the user to the consent page to authorize your application
        /*if (!isset($_SESSION['access_token'])||$_SESSION['access_token']==null) {
            $redirect_uri = 'http://localhost:8000/contacts.create';
            $clientDrive->setRedirectUri($redirect_uri);
            $auth_url = $clientDrive->createAuthUrl();
            header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
            exit();
        } else {*/
        $clientDrive->setAccessToken(file_get_contents(__DIR__ . '/../../Google/google_access_token.json')); //$_SESSION['access_token']
        // Use the access token to make API requests
        $drive = new \Google_Service_Drive($clientDrive);
        $mautic = new MauticController();
        //}

        Stripe::setApiKey(env('STRIPE_SECRET'));
        // Replace this endpoint secret with your endpoint's unique secret
        // If you are testing with the CLI, find the secret by running 'stripe listen'
        // If you are using an endpoint defined with the API or dashboard, look in your webhook settings
        // at https://dashboard.stripe.com/webhooks
        //$endpoint_secret = 'whsec_5527b673f6457877f1a0461fa4bdbd6c3a3c044e874a8572981bca14958a4cf8';
        $endpoint_secret = null;
        $payload = file_get_contents('php://input');
        $event = json_decode($payload, true);
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        /* try {
        $event = \Stripe\Event::constructFrom($event);
        } catch(\UnexpectedValueException $e) {
        // Invalid payload
        echo 'Webhook error while parsing basic request.';
        http_response_code(400);
        exit();
        }
        if ($endpoint_secret) {
        // Only verify the event if there is an endpoint secret defined
        // Otherwise use the basic decoded event
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        try {
            $event = \Stripe\Webhook::constructEvent(
            $payload, $sig_header, $endpoint_secret
            );
        } catch(\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            echo 'Webhook error while validating signature.';
            http_response_code(400);
            exit();
        }
        }*/

        // Handle the event
        switch ($event["type"]) {
            case 'invoice.paid':
                $invoice = $event['data']['object']; // contains a \Stripe\PaymentIntent
                //Then define and call a method to handle the successful payment intent.
                if ($invoice['id'] != null & $invoice['customer'] != null) {
                    $customer_id = $invoice['customer'];
                    $customer = $stripe->customers->retrieve($customer_id, []);
                    // $invoice =$stripe->invoices->retrieve($invoice['invoice'],[]);
                    $achat = new StripeWebhook;
                    $achat->setConnection('mysql2');

                    $currentDate = date('Y-m-d H:i:s');

                    if ($invoice['metadata'] != null) {
                        //mise à jour du statut du paiement
                        DB::connection('mysql2')
                            ->table('paiement')
                            ->where('id_paiment', '=', $invoice['metadata']['id_paiement'])
                            ->update([
                                'statut_paiement' => 'Payé',
                                'date_update' => $currentDate
                            ]);

                        //Notification et mise à jour du statut de la facture
                        $insert_id_facture_notification = DB::connection('mysql2')->table('notification')->insertGetId([
                            'contenu_notification' => 'Un paiement a été effectué le ' . $currentDate,
                            'date_notification' => $currentDate,
                            'type' => 'facture'
                        ]);

                        DB::connection('mysql2')->table('facture_statut_notification')->insert([
                            'id_notification' => $insert_id_facture_notification,
                            'date_statut' => $currentDate,
                            'num_facture' => $invoice['metadata']['num_facture'],
                            'id_facture_statut' => 5 //Partiellement payé
                        ]);

                        DB::connection('mysql2')->table('factures')
                            ->where('num_facture', $invoice['metadata']['num_facture'])
                            ->update(['date_update' => $currentDate]);

                        DB::connection('mysql2')->table('paiement')
                            ->where('id_paiment', $invoice['metadata']['id_paiement'])
                            ->update(['date_update' => $currentDate]);

                        $paiements = DB::connection('mysql2')
                            ->table('paiement')
                            ->select('*')
                            ->where('num_facture', '=', $invoice['metadata']['num_facture'])
                            ->get();

                        //Verification des paiement de la facture si ils sont tous payé
                        $allpayed = true;

                        foreach ($paiements as $paiement) {

                            if ($paiement->statut_paiement != 'Payé') {
                                $allpayed = false;
                                break;
                            }
                        }

                        if ($allpayed == true) {
                            $currentDate = date('Y-m-d H:i:s');
                            //mise à jour du statut de la facture
                            $insert_id_facture_notification = DB::connection('mysql2')->table('notification')->insertGetId([
                                'contenu_notification' => 'La facture a été payée',
                                'date_notification' => $currentDate,
                                'type' => 'facture'
                            ]);

                            DB::connection('mysql2')->table('facture_statut_notification')->insert([
                                'id_notification' => $insert_id_facture_notification,
                                'date_statut' => $currentDate,
                                'num_facture' => $invoice['metadata']['num_facture'],
                                'id_facture_statut' => 6 //Payé
                            ]);
                        }
                        //recupération des pack_experience de la facture
                        $packs_experiences = DB::connection('mysql2')
                            ->table('pack_experience')
                            ->select('*')
                            ->where('num_facture', '=', $invoice['metadata']['num_facture'])
                            ->get();

                        //recupération du contact
                        $contact = DB::connection('mysql2')
                            ->select('SELECT * FROM contact WHERE id_contact=' . $invoice['metadata']['id_contact'] . '');

                        // if ($contact[0]->url_contact_folder = null) {
                        //     $sourceFolderId = '1SGYhhShuGOsMg4S-8OKgiiE83stlmvX3';
                        //     $destinationFolderId = getenv('DRIVE_CLIENT');
                        //     $newFolderName = '' . $contact[0]->id_contact . ' - ' . $contact[0]->nom;
                        //     $sourceFolder = $this->copyFolder($sourceFolderId, $destinationFolderId, $newFolderName, $drive);
                        //     DB::connection('mysql2')
                        //         ->table('contact')
                        //         ->where('contact.id_contact', '=', $contact[0]->id_contact)
                        //         ->update([
                        //             'date_update' => $currentDate,
                        //             'url_contact_folder' => 'https://drive.google.com/drive/u/1/folders/' . $sourceFolder
                        //         ]);
                        // }

                        // $contactMautic = $mautic->createContact(new Request (get_object_vars($contact[0])));

                        // $jsonStart = strpos($contactMautic, '{');

                        // // Extrait la partie JSON brute à partir du début trouvé
                        // $jsonData = substr($contactMautic, $jsonStart);
                        // $jsonData = json_decode($jsonData,true);

                        // $contactMautic = $mautic->updateContactSegment($jsonData["contact"]["id"], 2);

                        foreach ($packs_experiences as $pack_experience) {
                            //créer l'experience si elle n'a pas encore été créé
                            if (empty($pack_experience->id_experience)) {
                                //Création d'un numéro unique
                                $numExp = "";
                                $numeroUnique = false;

                                while (!$numeroUnique) {
                                    $numExp = $this->generateNumeroExperience();
                                    $numeroUnique = !DB::connection('mysql2')
                                        ->table('experience')
                                        ->where('numero_experience', $numExp)
                                        ->exists();
                                }

                                //Recupération du pack lié au pack_experience

                                $pack = DB::connection('mysql2')
                                    ->select('SELECT * FROM pack WHERE id_pack=' . $pack_experience->id_pack . '');

                                //Création de dossier
                                // $sourceFolderId = '1SGYhhShuGOsMg4S-8OKgiiE83stlmvX3';
                                // $destinationFolderId = getenv('DRIVE_EXPERIENCE');
                                // $newFolderName = '' . $numExp . ' - ' . 'Exp ' . $contact[0]->nom . ' ' . $pack[0]->nom . ' ' . $pack_experience->nb_participants . 'p';
                                // $sourceFolder = $this->copyFolder($sourceFolderId, $destinationFolderId, $newFolderName, $drive);
                                //$docClient = 
                                // Insertion d'un nouvel enregistrement dans la table "experience"
                                $insert_id_exp = DB::connection('mysql2')
                                    ->table('experience')
                                    ->insertGetId([
                                        'numero_experience' => $numExp,
                                        'nom_experience' => 'Exp ' . $contact[0]->nom . ' ' . $pack[0]->nom . ' ' . $pack_experience->nb_participants . 'p',
                                        'date_creation' => $currentDate,
                                        'date_update' => $currentDate,
                                    ]);

                                $currentDate = date('Y-m-d H:i:s');

                                $insert_id_facture_notification3 = DB::connection('mysql2')->table('notification')->insertGetId([
                                    'contenu_notification' => 'L\'expérience a été créée',
                                    'date_notification' => $currentDate,
                                    'type' => 'facture'
                                ]);

                                DB::connection('mysql2')->table('experience_statut_notification')->insert([
                                    'id_notification' => $insert_id_facture_notification3,
                                    'date_statut' => $currentDate,
                                    'id_experience' => $insert_id_exp,
                                    'id_statut_experience' => 1
                                ]);

                                // Insertion d'un nouvel enregistrement dans la table "contact_experience"
                                DB::connection('mysql2')
                                    ->table('contact_experience')
                                    ->insert([
                                        'id_experience' => $insert_id_exp,
                                        'id_contact' => $contact[0]->id_contact,
                                        'profil' => 'Client'
                                    ]);

                                //Mise à jour du pack_experience
                                DB::connection('mysql2')
                                    ->table('pack_experience')
                                    ->where('id_pack_experience', '=', $pack_experience->id_pack_experience)
                                    ->update(['id_experience' => $insert_id_exp]);

                                //Creation du projet de l'experience si n'existe pas+cagnottes
                                $pr = DB::connection('mysql2')->table('experience')->where('id_experience', $insert_id_exp)->first();
                                if (empty($pr->id_projet)) {
                                    error_log('CAGNOTTE EN ROUTE');
                                    $pr = DB::connection('mysql2')->table('projets')
                                        ->insertGetId([
                                            'nom' => 'Projet Exp ' . $contact[0]->nom . ' ' . $pack[0]->nom . ' ' . $pack_experience->nb_participants . 'p',
                                            'description_courte' => '',
                                            'description_detaille' => '',
                                            'info_contributeur' => '',
                                            'date_creation' => $currentDate,
                                            'visibilite' => 'publique',
                                            'id_type_projet' => 1,
                                            'id_statut_projet' => 1
                                        ]);

                                    DB::connection('mysql2')->table('contact_projets')
                                        ->insert([
                                            'id_contact' => $contact[0]->id_contact,
                                            'id_projet' => $pr
                                        ]);

                                    DB::connection('mysql2')->table('experience')
                                        ->where('id_experience', $insert_id_exp)
                                        ->update([
                                            'id_projet' => $pr
                                        ]);

                                    $cgnt = DB::connection('mysql2')->table('cagnottes')
                                        ->insert([
                                            'titre' => 'Cagnotte ' . 'Exp ' . $contact[0]->nom . ' ' . $pack[0]->nom . ' ' . $pack_experience->nb_participants . 'p',
                                            'montant_actuel' => 0,
                                            'id_categorie' => 1,
                                            'id_projet' => $pr,
                                            'id_statut_cagnotte' => 1
                                        ]);

                                    error_log('CAGNOTTE OK');
                                }
                            }
                        }
                    }
                    error_log('OK process');
                }
                break;
            case 'payment_intent.payment_failed':
                $paymentIntent = $event['data']['object']; // contains a \Stripe\PaymentIntent
                //Then define and call a method to handle the successful payment intent.
                error_log('PROCESS START');
                if ($paymentIntent['invoice'] != null & $paymentIntent['customer'] != null) {
                    $customer_id = $paymentIntent['customer'];
                    $customer = $stripe->customers->retrieve($customer_id, []);
                    $invoice = $stripe->invoices->retrieve($paymentIntent['invoice'], []);
                    $achat = new StripeWebhook;
                    $achat->setConnection('mysql2');

                    $currentDate = date('Y-m-d H:i:s');

                    if ($invoice['metadata'] != null) {
                        //mise à jour du statut du paiement
                        DB::connection('mysql2')
                            ->table('paiement')
                            ->where('id_paiment', '=', $invoice['metadata']['id_paiement'])
                            ->update([
                                'statut_paiement' => 'Echoué',
                                'date_update' => $currentDate
                            ]);

                        //Notification et mise à jour du statut de la facture
                        $insert_id_facture_notification = DB::connection('mysql2')->table('notification')->insertGetId([
                            'contenu_notification' => 'Une tentative de paiement de la facture a echoué le ' . $currentDate,
                            'date_notification' => $currentDate,
                            'type' => 'facture'
                        ]);

                        $lastStatus = DB::connection('mysql2')
                            ->table('facture_statut_notification')
                            ->where('num_facture', $invoice['metadata']['num_facture'])
                            ->orderBy('id_notification', 'desc')
                            ->first();

                        DB::connection('mysql2')->table('facture_statut_notification')->insert([
                            'id_notification' => $insert_id_facture_notification,
                            'date_statut' => $currentDate,
                            'num_facture' => $invoice['metadata']['num_facture'],
                            'id_facture_statut' => $lastStatus->id_facture_statut
                        ]);

                        DB::connection('mysql2')->table('factures')
                            ->where('num_facture', $invoice['metadata']['num_facture'])
                            ->update(['date_update' => $currentDate]);

                        DB::connection('mysql2')->table('paiement')
                            ->where('id_paiment', $invoice['metadata']['id_paiement'])
                            ->update(['date_update' => $currentDate]);
                    }
                    error_log('OK process');
                }
                break;
            case 'checkout.session.expired':
                $checkout = $event['data']['object'];
                $customer = $checkout['customer_details'];
                $achat = new StripeWebhook;
                $achat->setConnection('mysql2');

                $paymentIntent = $stripe->paymentIntents->retrieve($checkout['payment_intent'], []);
                $paymentIntent = substr($paymentIntent, 27);
                $paymentIntent = json_decode($paymentIntent, true);

                $tele = $customer['phone'];
                $nom = $customer['name'];
                $mail = $customer['email'];
                $adres = $customer['address']['line1'] . ' ' . $customer['address']['line2'];
                $cp = $customer['address']['postal_code'];
                $vil = $customer['address']['city'];

                $currentDate = date('Y-m-d H:i:s');

                $verifClientReq = DB::connection('mysql2')
                    ->select('SELECT * FROM contact WHERE email="' . $mail . '"');
                if (empty($verifClientReq)) {
                    DB::connection('mysql2')
                        ->table('contact')
                        ->insert([
                            'tel' => $tele,
                            'nom' => $nom,
                            'email' => $mail,
                            'adresse' => $adres,
                            'code_postal' => $cp,
                            'ville' => $vil,
                            'date_creation' => $currentDate,
                            'date_update' => $currentDate
                        ]); //$tele,$nom,$mail,$adres,$cp,$vil

                    $req = DB::connection('mysql2')
                        ->table('contact')
                        ->select('contact.id_contact')
                        ->where('contact.email', '=', $mail)
                        ->first();

                    // if ($checkout['payment_status'] == 'paid') {
                    //     $sourceFolderId = '1sbSFiPv6oGc8LIhHyolijipI61aO0jcs';
                    //     $destinationFolderId = getenv('DRIVE_CLIENT');
                    //     $newFolderName = '' . $req->id_contact . ' - ' . $nom;
                    //     $sourceFolder = $this->copyFolder($sourceFolderId, $destinationFolderId, $newFolderName, $drive);
                    //     DB::connection('mysql2')
                    //         ->table('contact')
                    //         ->where('contact.id_contact', '=', $req->id_contact)
                    //         ->update([
                    //             'date_update' => $currentDate,
                    //             'url_contact_folder' => 'https://drive.google.com/drive/u/1/folders/' . $sourceFolder
                    //         ]);
                    // }
                } else {
                    error_log('Client déja présent dans la base de données');
                }

                //recupération de l'id_contact
                $req = DB::connection('mysql2')
                    ->table('contact')
                    ->select('contact.id_contact')
                    ->where('contact.email', '=', $mail)
                    ->first();
                //$client = $req['id_contact'];
                $client = $req->id_contact;

                //Recuperation produit&pack, creation de la facture
                $lineItems = $stripe->checkout->sessions->allLineItems($checkout['id']);
                $items = $lineItems['data'];

                // Création de la facture
                DB::connection('mysql2')->table('factures')->insert([
                    'description_lib' => 'Facture ' . $nom,
                    'prix_facture' => intval($checkout['amount_total']) / 100,
                    'nb_paiement' => 1,
                    'date_creation' => $currentDate,
                    'date_update' => $currentDate,
                    'canal_reservation' => 'Stripe Checkout'
                ]);

                // Récupération de l'ID de la facture insérée
                $insert_id_facture = DB::connection('mysql2')->getPdo()->lastInsertId();

                $currentDate = date('Y-m-d H:i:s');
                // Création du paiement

                DB::connection('mysql2')->table('paiement')->insert([
                    'libelle' => 'Paiement de ' . $nom,
                    'prix' => intval($checkout['amount_total']) / 100,
                    'statut_paiement' => 'Abandonné',
                    'num_facture' => $insert_id_facture, // Utilisation de l'ID de la facture
                    'id_contact' => $client,
                    'date_creation' => $currentDate,
                    'date_update' => $currentDate
                ]);

                $insert_id_facture_notification1 = DB::connection('mysql2')->table('notification')->insertGetId([
                    'contenu_notification' => 'La facture a été créée',
                    'date_notification' => $currentDate,
                    'type' => 'facture'
                ]);

                DB::connection('mysql2')->table('facture_statut_notification')->insert([
                    'id_notification' => $insert_id_facture_notification1,
                    'date_statut' => $currentDate,
                    'num_facture' => $insert_id_facture,
                    'id_facture_statut' => 2
                ]);

                $insert_id_facture_notification2 = DB::connection('mysql2')->table('notification')->insertGetId([
                    'contenu_notification' => 'UNe tentative de paiement de la facture a expirée',
                    'date_notification' => $currentDate,
                    'type' => 'facture'
                ]);

                DB::connection('mysql2')->table('facture_statut_notification')->insert([
                    'id_notification' => $insert_id_facture_notification2,
                    'date_statut' => $currentDate,
                    'num_facture' => $insert_id_facture,
                    'id_facture_statut' => 3
                ]);

                $events = $stripe->events->all(['type' => 'customer.discount.created']);
                $events = substr($events, 24);
                // error_log($events);
                // $events = json_encode($events);
                $events = json_decode($events, true);
                foreach ($events["data"] as $eventDis) {
                    error_log($eventDis["data"]["object"]["checkout_session"]);
                    if ($eventDis["data"]["object"]["checkout_session"] == $checkout["id"]) {
                        $couponID = $eventDis["data"]["object"]["coupon"]["id"];
                        $coupon = $stripe->coupons->retrieve($couponID, []);
                        $remise = DB::connection('mysql2')->table('remise')
                            ->where('id_stripe_remise', $couponID)
                            ->first();
                        // $hist_remise = DB::connection('mysql2')->table('historique_remise')
                        // ->where('id_remise',$remise[0]->id_remise)
                        // ->latest()
                        // ->first();
                        $code = DB::connection('mysql2')->table('codes_promo')
                            ->where('id_stripe_code', $eventDis["data"]["object"]["promotion_code"])
                            ->first();

                        // if(isset($code->nb_utilisation)){
                        //     if($code->nb_utilisation > 0) {
                        DB::connection('mysql2')->table('codes_promo')
                            ->where('id_code', $code->id_code)
                            ->update([
                                'nb_code' => $code->nb_code + 1,
                            ]);
                        //     }
                        // }

                        DB::connection('mysql2')->table('factures_remise')
                            ->insert([
                                'id_remise' => $remise->id_remise,
                                'num_facture' => $insert_id_facture
                            ]);

                        //error_log($coupon);
                        break;
                    }
                }

                DB::connection('mysql2')->table('factures')
                    ->where('num_facture', $insert_id_facture)
                    ->update(['date_update' => $currentDate]);

                //Création du pack_experience et produit services
                foreach ($items as &$lineItem) {
                    $product = $lineItem['price']['product'];
                    $product = $stripe->products->retrieve($product, []);
                    $type_product = $product['metadata']['type'];
                    if ($product['metadata']['id_pack'] != null) {
                        $id_product = $product['metadata']['id_pack'];
                    }
                    if ($product['metadata']['id_produit'] != null) {
                        $id_product = $product['metadata']['id_produit'];
                    }
                    switch ($type_product) {
                        case 'pack':

                            $id_liste_prix = DB::connection('mysql2')->table('liste_prix')
                                ->select('id_liste_prix')
                                ->where('id_pack', $id_product)
                                ->whereIn('statut', ['Par defaut', 'Par Defaut', 'Par Défaut', 'Par défaut'])
                                ->first();

                            DB::connection('mysql2')
                                ->table('pack_experience')
                                ->insert([
                                    'nb_titres' => 1,
                                    'nb_participants' => 1,
                                    'id_pack' => $id_product,
                                    'num_facture' => $insert_id_facture,
                                    'id_liste_prix' => $id_liste_prix->id_liste_prix
                                ]);

                            break;
                        case 'produits_services':

                            $id_liste_prix = DB::connection('mysql2')->table('liste_prix')
                                ->select('id_liste_prix')
                                ->where('id_produit', $id_product)
                                ->whereIn('statut', ['Par defaut', 'Par Defaut', 'Par Défaut', 'Par défaut'])
                                ->first();

                            DB::connection('mysql2')
                                ->table('facture_produit_service')
                                ->insert([
                                    'num_facture' => $insert_id_facture,
                                    'id_produit' => $id_product,
                                    'quantity' => $lineItem['quantity'],
                                    'id_liste_prix' => $id_liste_prix->id_liste_prix
                                ]);
                            break;
                    }
                }

                break;
            case 'checkout.session.completed':
                $checkout = $event['data']['object'];
                $customer = $checkout['customer_details'];
                $achat = new StripeWebhook;
                $achat->setConnection('mysql2');

                $paymentIntent = $stripe->paymentIntents->retrieve($checkout['payment_intent'], []);
                $paymentIntent = substr($paymentIntent, 27);
                $paymentIntent = json_decode($paymentIntent, true);

                //$plink = $stripe->paymentLinks->retrieve($checkout['payment_link'],[]);
                $type_p = $checkout["metadata"]["type"];
                error_log($type_p);

                $tele = $customer['phone'];
                $nom = $customer['name'];
                $mail = $customer['email'];
                $adres = $customer['address']['line1'] . ' ' . $customer['address']['line2'];
                $cp = $customer['address']['postal_code'];
                $vil = $customer['address']['city'];

                $currentDate = date('Y-m-d H:i:s');

                $verifClientReq = DB::connection('mysql2')
                    ->select('SELECT * FROM contact WHERE email="' . $mail . '"');
                if (empty($verifClientReq)) {
                    DB::connection('mysql2')
                        ->table('contact')
                        ->insert([
                            'tel' => $tele,
                            'nom' => $nom,
                            'email' => $mail,
                            'adresse' => $adres,
                            'code_postal' => $cp,
                            'ville' => $vil,
                            'date_creation' => $currentDate,
                            'date_update' => $currentDate
                        ]); //$tele,$nom,$mail,$adres,$cp,$vil

                    $req = DB::connection('mysql2')
                        ->table('contact')
                        ->select('contact.id_contact')
                        ->where('contact.email', '=', $mail)
                        ->first();

                    // if ($checkout['payment_status'] == 'paid') {
                    //     $sourceFolderId = '1sbSFiPv6oGc8LIhHyolijipI61aO0jcs';
                    //     $destinationFolderId = getenv('DRIVE_CLIENT');
                    //     $newFolderName = '' . $req->id_contact . ' - ' . $nom;
                    //     $sourceFolder = $this->copyFolder($sourceFolderId, $destinationFolderId, $newFolderName, $drive);
                    //     DB::connection('mysql2')
                    //         ->table('contact')
                    //         ->where('contact.id_contact', '=', $req->id_contact)
                    //         ->update([
                    //             'date_update' => $currentDate,
                    //             'url_contact_folder' => 'https://drive.google.com/drive/u/1/folders/' . $sourceFolder
                    //         ]);
                    // }
                }else{
                    error_log('Client déja présent dans la base de données');
                }



                //recupération de l'id_contact
                $req = DB::connection('mysql2')
                    ->table('contact')
                    ->where('contact.email', '=', $mail)
                    ->first();

                // $contactMautic = $mautic->createContact(new Request (get_object_vars($req)));

                // $jsonStart = strpos($contactMautic, '{');

                // // Extrait la partie JSON brute à partir du début trouvé
                // $jsonData = substr($contactMautic, $jsonStart);
                // $jsonData = json_decode($jsonData,true);

                // $contactMautic = $mautic->updateContactSegment($jsonData["contact"]["id"], 2);
                //$client = $req['id_contact'];
                $client = $req->id_contact;

                switch ($type_p) {
                    case 'contribution':
                        error_log('contribution START');
                        $experience = DB::connection('mysql2')->table('experience')
                            ->where('id_experience', $checkout['metadata']['id_experience'])
                            ->first();
                        $cagnotte = DB::connection('mysql2')->table('cagnottes')
                            ->where('id_projet', $experience->id_projet)
                            ->first();

                        $id_contribution = DB::connection('mysql2')->table('contributions')->insertGetId([
                            'date_contribution' => $currentDate,
                            'statut' => "accepté",
                            'montant' => intval($checkout['amount_total']) / 100,
                            'id_contact' => $req->id_contact,
                            'id_cagnotte' => $cagnotte->id_cagnotte,
                            'is_anonymous' => $checkout['metadata']['anonyme'],
                            'is_hidden_price' => $checkout['metadata']['hidden']

                        ]);

                        $contribution = DB::connection('mysql2')->table('contributions')
                            ->where('id_contributions', $id_contribution)
                            ->first();

                        DB::connection('mysql2')->table('cagnottes')
                            ->where('id_cagnotte', $cagnotte->id_cagnotte)
                            ->increment('montant_actuel', intval($checkout['amount_total']) / 100);

                        DB::connection('mysql2')->table('historiques')->insert([
                            'action' => $currentDate . ' - la somme de la cagnotte a augmenté de ' . intval($checkout['amount_total']) / 100,
                            'date_creation' => $currentDate,
                            'id_cagnotte' => $cagnotte->id_cagnotte
                        ]);

                        $insert_id_contact_notification1 = DB::connection('mysql2')->table('notification')->insertGetId([
                            'contenu_notification' => 'Le contact a fait une contribution de ' . (intval($checkout['amount_total']) / 100) . 'pour la cagnotte ' . $cagnotte->titre,
                            'date_notification' => $currentDate,
                            'type' => 'facture'
                        ]);

                        DB::connection('mysql2')->table('contact_notification')->insert([
                            'id_notification' => $insert_id_contact_notification1,
                            'date_creation' => $currentDate,
                            'id_contact' => $req->id_contact
                        ]);

                        // $ben = DB::connection('mysql2')->table('contact_')
                        // ->where('id_contact',$req->id_contact)
                        // ->first();

                        // $balance = $stripe->customers->createBalanceTransaction(
                        //     $ben->id_client_stripe,
                        //     [
                        //         'amount' => +intval($checkout['amount_total']),
                        //         'currency' => 'eur',
                        //         'description' => $currentDate.' - la somme de la cagnotte a augmenté de '.intval($checkout['amount_total'])/100,
                        //         'metadata'=>[
                        //             'id_contribution'=>$id_contribution
                        //         ]
                        //     ]
                        // ); 

                        $url = getenv('DISCORD_WEBHOOK');
                        $data = array(
                            'content' => 'Une contribution de ' . intval($checkout['amount_total']) / 100 . '€ a été fait pour la cagnotte ' . $cagnotte->titre . ''
                        );
                        $options = array(
                            'http' => array(
                                'header'  => "Content-type: application/json\r\n",
                                'method'  => 'POST',
                                'content' => json_encode($data),
                            ),
                        );
                        $context  = stream_context_create($options);
                        $result = file_get_contents($url, false, $context);
                        if ($result === false) {
                            // Gérer l'erreur de l'envoi du message
                        } else {
                            // Message envoyé avec succès
                        }

                        $contact_projets = ContactProjet::where('id_projet', $cagnotte->id_projet)->get();
                        foreach ($contact_projets as $contact_projet) {
                            $contact = Contact::find(intval($contact_projet->id_contact));
                            if ($contact->notification_contribution_enabled === 1) {
                                $contact->notify(new NotifyExperimentateurContributionMade($cagnotte, $contribution));
                            }
                        }
                        $etat_liaison = HistoriqueLiaison::where('id_projet_source',$experience->id_projet)->orderBy('created_date','desc')->first();

                        error_log($etat_liaison);

                        if(isset($etat_liaison)&&$etat_liaison->etat_actuel == 1) {
                            error_log("DON EN COURS");
                            $projet_cause = Projet::find( $etat_liaison->id_projet_cible );
                            $cagnotte_cause = $projet_cause->cagnottes[0];
                            $cagnotte_exp = Cagnotte::find($cagnotte->id_cagnotte);
                            $ont=intval($checkout['amount_total']) / 100;
                            $cagnotte_exp->decrement('montant_actuel', $ont);
                            $cagnotte_cause->increment('montant_actuel',$ont);
                            $current_date = (new DateTime('now', new DateTimeZone('Europe/Paris')))->format('Y-m-d H:i:s');
                            $historique_cagnotte = Historique::create([
                                'action'=>"Un don de ".$ont."€ a été effectué vers la cagnotte ".$cagnotte_cause->titre,
                                'date_creation'=>$current_date,
                                'id_cagnotte'=>$cagnotte_exp->id_cagnotte
                            ]);
                            $historique_cagnotte_cause = Historique::create([
                                'action'=>"Un don de ".$ont."€ a été reçu depuis la cagnotte ".$cagnotte_exp->titre,
                                'date_creation'=>$current_date,
                                'id_cagnotte'=>$cagnotte_cause->id_cagnotte
                            ]);
                        }

                        $email = new MailConfirmationContribution();
                        Mail::to($mail)
                            ->send($email);
                        $user = Contact::where('email', $mail)->get()->first();
                        if ($user->notification_contributed_enabled === 1) {
                            $user->notify(new ContributionMade());
                        }
                    error_log('contribution OK');
                    break;
                default:
                    //Recuperation produit&pack, creation de la facture
                    $lineItems = $stripe->checkout->sessions->allLineItems($checkout['id']);
                    $items = $lineItems['data'];

                        // Création de la facture
                        DB::connection('mysql2')->table('factures')->insert([
                            'description_lib' => 'Facture ' . $nom,
                            'prix_facture' => intval($checkout['amount_total']) / 100,
                            'nb_paiement' => 1,
                            'date_creation' => $currentDate,
                            'date_update' => $currentDate,
                            'canal_reservation' => 'Stripe Checkout'
                        ]);

                        // Récupération de l'ID de la facture insérée
                        $insert_id_facture = DB::connection('mysql2')->getPdo()->lastInsertId();

                        $currentDate = date('Y-m-d H:i:s');
                        // Création du paiement
                        if ($paymentIntent['status'] == 'succeeded') {
                            $statut_paiement = 'Payé';
                        }
                        if ($paymentIntent['status'] == 'canceled') {
                            $statut_paiement = 'Annulé';
                        }
                        if ($paymentIntent['status'] == 'requires_payment_method') {
                            $statut_paiement = 'Echoué';
                        }

                        DB::connection('mysql2')->table('paiement')->insert([
                            'libelle' => 'Paiement de ' . $nom,
                            'prix' => intval($checkout['amount_total']) / 100,
                            'statut_paiement' => $statut_paiement,
                            'num_facture' => $insert_id_facture, // Utilisation de l'ID de la facture
                            'id_contact' => $client,
                            'date_creation' => $currentDate,
                            'date_update' => $currentDate
                        ]);

                        // DB::connection('mysql2')->table('paiement')
                        // ->where('num_facture',$insert_id_facture)
                        // ->update(['date_update' => $currentDate]);

                        $insert_id_facture_notification1 = DB::connection('mysql2')->table('notification')->insertGetId([
                            'contenu_notification' => 'La facture a été créée',
                            'date_notification' => $currentDate,
                            'type' => 'facture'
                        ]);

                        DB::connection('mysql2')->table('facture_statut_notification')->insert([
                            'id_notification' => $insert_id_facture_notification1,
                            'date_statut' => $currentDate,
                            'num_facture' => $insert_id_facture,
                            'id_facture_statut' => 2
                        ]);

                        if ($paymentIntent['status'] == 'succeeded') {
                            $insert_id_facture_notification2 = DB::connection('mysql2')->table('notification')->insertGetId([
                                'contenu_notification' => 'La facture a été payée',
                                'date_notification' => $currentDate,
                                'type' => 'facture'
                            ]);

                            DB::connection('mysql2')->table('facture_statut_notification')->insert([
                                'id_notification' => $insert_id_facture_notification2,
                                'date_statut' => $currentDate,
                                'num_facture' => $insert_id_facture,
                                'id_facture_statut' => 6
                            ]);
                        } else if ($paymentIntent['status'] == 'requires_payment_method') {

                            $insert_id_facture_notification2 = DB::connection('mysql2')->table('notification')->insertGetId([
                                'contenu_notification' => 'Le paiement de la facture a échoué',
                                'date_notification' => $currentDate,
                                'type' => 'facture'
                            ]);

                            DB::connection('mysql2')->table('facture_statut_notification')->insert([
                                'id_notification' => $insert_id_facture_notification2,
                                'date_statut' => $currentDate,
                                'num_facture' => $insert_id_facture,
                                'id_facture_statut' => 3
                            ]);
                        } else if ($paymentIntent['status'] == 'canceled') {
                            $insert_id_facture_notification2 = DB::connection('mysql2')->table('notification')->insertGetId([
                                'contenu_notification' => 'Le paiement de la facture a été annulé',
                                'date_notification' => $currentDate,
                                'type' => 'facture'
                            ]);

                            DB::connection('mysql2')->table('facture_statut_notification')->insert([
                                'id_notification' => $insert_id_facture_notification2,
                                'date_statut' => $currentDate,
                                'num_facture' => $insert_id_facture,
                                'id_facture_statut' => 9
                            ]);
                        }


                        $events = $stripe->events->all(['type' => 'customer.discount.created']);
                        $events = substr($events, 24);
                        // error_log($events);
                        // $events = json_encode($events);
                        $events = json_decode($events, true);
                        foreach ($events["data"] as $eventDis) {
                            error_log($eventDis["data"]["object"]["checkout_session"]);
                            if ($eventDis["data"]["object"]["checkout_session"] == $checkout["id"]) {
                                $couponID = $eventDis["data"]["object"]["coupon"]["id"];
                                $coupon = $stripe->coupons->retrieve($couponID, []);
                                $remise = DB::connection('mysql2')->table('remise')
                                    ->where('id_stripe_remise', $couponID)
                                    ->first();
                                // $hist_remise = DB::connection('mysql2')->table('historique_remise')
                                // ->where('id_remise',$remise[0]->id_remise)
                                // ->latest()
                                // ->first();
                                $code = DB::connection('mysql2')->table('codes_promo')
                                    ->where('id_stripe_code', $eventDis["data"]["object"]["promotion_code"])
                                    ->first();

                                // if(isset($code->nb_utilisation)){
                                //     if($code->nb_utilisation > 0) {
                                DB::connection('mysql2')->table('codes_promo')
                                    ->where('id_code', $code->id_code)
                                    ->update([
                                        'nb_code' => $code->nb_code + 1,
                                    ]);
                                //     }
                                // }

                                DB::connection('mysql2')->table('factures_remise')
                                    ->insert([
                                        'id_remise' => $remise->id_remise,
                                        'num_facture' => $insert_id_facture
                                    ]);

                                //error_log($coupon);
                                break;
                            }
                        }

                        DB::connection('mysql2')->table('factures')
                            ->where('num_facture', $insert_id_facture)
                            ->update(['date_update' => $currentDate]);

                        //Création du pack_experience et produit services
                        foreach ($items as &$lineItem) {
                            $product = $lineItem['price']['product'];
                            $product = $stripe->products->retrieve($product, []);
                            $type_product = $product['metadata']['type'];
                            if ($product['metadata']['id_pack'] != null) {
                                $id_product = $product['metadata']['id_pack'];
                            }
                            if ($product['metadata']['id_produit'] != null) {
                                $id_product = $product['metadata']['id_produit'];
                            }
                            switch ($type_product) {
                                case 'pack':

                                    for ($q = 0; $q < $lineItem['quantity']; $q++) {

                                        if ($paymentIntent['status'] == 'succeeded') {

                                            $numExp = "";
                                            $numeroUnique = false;

                                            while (!$numeroUnique) {
                                                $numExp = $this->generateNumeroExperience();
                                                $numeroUnique = !DB::connection('mysql2')
                                                    ->table('experience')
                                                    ->where('numero_experience', $numExp)
                                                    ->exists();
                                            }

                                            //Création dossier exp
                                            // $sourceFolderId = '1SGYhhShuGOsMg4S-8OKgiiE83stlmvX3';
                                            // $destinationFolderId = getenv('DRIVE_EXPERIENCE');
                                            // $newFolderName = '' . $numExp . ' - ' . 'Exp ' . $nom . ' ' . $product['name'] . ' 1p';
                                            // $sourceFolder = $this->copyFolder($sourceFolderId, $destinationFolderId, $newFolderName, $drive);

                                            // Insertion d'un nouvel enregistrement dans la table "experience"
                                            $insert_id_exp = DB::connection('mysql2')
                                                ->table('experience')
                                                ->insertGetId([
                                                    'numero_experience' => $numExp,
                                                    'nom_experience' => 'Exp ' . $nom . ' ' . $product['name'] . ' 1p',
                                                    // 'url_experience_folder' => 'https://drive.google.com/drive/u/1/folders/' . $sourceFolder,
                                                    'date_creation' => $currentDate,
                                                    'date_update' => $currentDate
                                                ]);

                                            $pr = DB::connection('mysql2')->table('experience')->where('id_experience', $insert_id_exp)->select('id_projet')->first();
                                            if (empty($pr)) {
                                                $pr = DB::connection('mysql2')->table('projets')
                                                    ->insertGetId([
                                                        'nom' => 'Exp ' . $nom . ' ' . $product['name'] . ' 1p',
                                                        'description_courte' => '',
                                                        'description_detaille' => '',
                                                        'info_contributeur' => '',
                                                        'date_creation' => $currentDate,
                                                        'visibilite' => 'publique',
                                                        'id_type_projet' => 1,
                                                        'id_statut_projet' => 1
                                                    ]);

                                                DB::connection('mysql2')->table('contact_projets')
                                                    ->insert([
                                                        'id_contact' => $client,
                                                        'id_projet' => $pr,
                                                    ]);
                                                DB::connection('mysql2')->table('experience')
                                                    ->where('id_experience', $insert_id_exp)
                                                    ->update([
                                                        'id_projet' => $pr
                                                    ]);

                                                $cgnt = DB::connection('mysql2')->table('cagnottes')
                                                    ->insert([
                                                        'titre' => 'Cagnotte ' . 'Exp ' . $nom . ' ' . $product['name'] . ' 1p',
                                                        'montant_actuel' => 0,
                                                        'id_categorie' => 1,
                                                        'id_projet' => $pr,
                                                        'id_statut_cagnotte' => 1
                                                    ]);
                                            }

                                            $currentDate = date('Y-m-d H:i:s');

                                            $insert_id_facture_notification3 = DB::connection('mysql2')->table('notification')->insertGetId([
                                                'contenu_notification' => 'L\'expérience a été créée',
                                                'date_notification' => $currentDate,
                                                'type' => 'facture'
                                            ]);

                                            DB::connection('mysql2')->table('experience_statut_notification')->insert([
                                                'id_notification' => $insert_id_facture_notification3,
                                                'date_statut' => $currentDate,
                                                'id_experience' => $insert_id_exp,
                                                'id_statut_experience' => 1
                                            ]);

                                            // Insertion d'un nouvel enregistrement dans la table "contact_experience"
                                            DB::connection('mysql2')
                                                ->table('contact_experience')
                                                ->insert([
                                                    'id_experience' => $insert_id_exp,
                                                    'id_contact' => $client,
                                                    'profil' => 'Client'
                                                ]);
                                        }


                                        $id_liste_prix = DB::connection('mysql2')->table('liste_prix')
                                            ->select('id_liste_prix')
                                            ->where('id_pack', $id_product)
                                            ->whereIn('statut', ['Par defaut', 'Par Defaut', 'Par Défaut', 'Par défaut'])
                                            ->first();

                                        DB::connection('mysql2')
                                            ->table('pack_experience')
                                            ->insert([
                                                'nb_titres' => 1,
                                                'nb_participants' => 1,
                                                'id_pack' => $id_product,
                                                'num_facture' => $insert_id_facture,
                                                'id_experience' => $insert_id_exp,
                                                'id_liste_prix' => $id_liste_prix->id_liste_prix
                                            ]);
                                    }
                                    break;

                                case 'produits_services':

                                    $id_liste_prix = DB::connection('mysql2')->table('liste_prix')
                                        ->select('id_liste_prix')
                                        ->where('id_produit', $id_product)
                                        ->whereIn('statut', ['Par defaut', 'Par Defaut', 'Par Défaut', 'Par défaut'])
                                        ->first();

                                    DB::connection('mysql2')
                                        ->table('facture_produit_service')
                                        ->insert([
                                            'num_facture' => $insert_id_facture,
                                            'id_produit' => $id_product,
                                            'quantity' => $lineItem['quantity'],
                                            'id_liste_prix' => $id_liste_prix->id_liste_prix
                                        ]);
                                    break;
                            }
                            break;
                        }
                }

                break;

            default:
                // Unexpected event type
                error_log('Received unknown event type');
        }
    }
}
