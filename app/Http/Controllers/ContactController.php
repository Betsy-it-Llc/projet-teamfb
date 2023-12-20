<?php

namespace App\Http\Controllers;

require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Models\Contact as ModelsContact;
use DateTime;
use DateTimeZone;
use Google\Client;
use App\Models\experienceApp\Contact;
use App\Models\experienceApp\Codepromo;
use Google\Auth\OAuth2;
use Google\Service\Drive;
use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Google\Service\Drive\DriveFile;
use Illuminate\Database\Query\JoinClause;
use PHPUnit\TextUI\XmlConfiguration\Group;
use Carbon\Carbon;
use Google_Service_Drive_DriveFile;

class ContactController extends Controller
{

    //  Une fois on depasse 5 lignes par tableau Ca d'affiche
    public function index(Request $request)
    {
        $contact = new Contact;
        $contact->setConnection('mysql2');
        $perPage = $request->get('perPage') ?? 10; // par défaut 10 éléments par page
        $data = DB::connection('mysql2')->table('contact')
        ->select('contact.*', 'contact_experience.profil')
        ->leftjoin('contact_experience', 'contact.id_contact', '=', 'contact_experience.id_contact')
        ->groupBy('contact.id_contact');

        
        $profil = $request->get('profil');
        $periode = $request->get('periode');

        if ($periode == 'semaine') {
            // Ajouter la condition de la période "Semaine"
            $data->whereBetween('contact.date_creation', [Carbon::now()->subWeek(), Carbon::now()]);
        } elseif ($periode == 'mois') {
            // Ajouter la condition de la période "Mois"
            $data->whereBetween('contact.date_creation', [Carbon::now()->subMonth(), Carbon::now()]);
        } elseif ($periode == 'trimestre') {
            // Ajouter la condition de la période "Trimestre"
            $data->whereBetween('contact.date_creation', [Carbon::now()->subQuarter(), Carbon::now()]);
        } elseif ($periode == 'annee') {
            // Ajouter la condition de la période "Année"
            $data->whereBetween('contact.date_creation', [Carbon::now()->subYear(), Carbon::now()]);
        }
        $data = $data->orderBy('contact.id_contact', 'DESC');
        
        $data_counter = $data->paginate(10000);
        $data = $data->paginate($perPage);
        
        //dd($data,$data_counter);
        
        // ->get();

        // dd($data);

        // on peut s'enpasser avec une jointure
        // $con_experience = DB::connection('mysql2')->table('contact_experience')->get();

        $con_notif = DB::connection('mysql2')->table('contact_notification')->get();
        // --------------------21.06.23----------------------------------------------
        $multisearchnom = $request->get('multisearchnom');
        $multisearchtel = $request->get('multisearchtel');
        $multisearchprenom = $request->get('multisearchprenom');
        $multisearchremise = $request->get('multisearchremise');
        $multisearchprofile = $request->get('multisearchprofile');

        if (isset($multisearchnom) || isset($multisearchtel) || isset($multisearchprenom) || isset($multisearchremise) || isset($multisearchprofile)) {
        $data = DB::connection('mysql2')->table('contact')
            ->select('contact.*', 'contact_experience.profil')
            ->join('contact_experience', 'contact.id_contact', '=', 'contact_experience.id_contact')
            ->groupBy('contact.id_contact')
            ->where('contact_experience.profil','=',$multisearchprofile);

            if ($periode == 'semaine') {
                // Ajouter la condition de la période "Semaine"
                $data->whereBetween('contact.date_creation', [Carbon::now()->subWeek(), Carbon::now()]);
            } elseif ($periode == 'mois') {
                // Ajouter la condition de la période "Mois"
                $data->whereBetween('contact.date_creation', [Carbon::now()->subMonth(), Carbon::now()]);
            } elseif ($periode == 'trimestre') {
                // Ajouter la condition de la période "Trimestre"
                $data->whereBetween('contact.date_creation', [Carbon::now()->subQuarter(), Carbon::now()]);
            } elseif ($periode == 'annee') {
                // Ajouter la condition de la période "Année"
                $data->whereBetween('contact.date_creation', [Carbon::now()->subYear(), Carbon::now()]);
            }
            $data= $data->orderByDesc('contact.id_contact');
            $data_counter = $data->paginate(10000);
            $data = $data->paginate($perPage);
        }
        //-------------------------------------------------------------------------------------
        $liste_profile = DB::connection('mysql2')->table('contact_experience')
        ->select('profil')
        ->distinct()
        ->get();

        $totalContact = $data->total();
        
        //-------------------------------------------------------------------------------------
        
        if ($profil == 'intervenant') {
            // Requête pour le profil "Intervenant"
            $query = DB::connection('mysql2')
                ->table('intervenant')
                ->select('intervenant.*','contact.tel','contact.nom','contact.prenom','contact.email','contact.adresse','contact.code_postal','contact.ville','contact.url_contact_folder','contact.id_client_stripe','contact.url_client_stripe','contact_experience.profil')
                ->leftJoin('contact', 'intervenant.id_contact', '=', 'contact.id_contact')
                ->leftJoin('contact_experience', 'contact.id_contact', '=', 'contact_experience.id_contact')
                ->groupBy('intervenant.id_contact');

            if ($periode == 'semaine') {
                // Ajouter la condition de la période "Semaine"
                $query->whereBetween('contact.date_creation', [Carbon::now()->subWeek(), Carbon::now()]);
            } elseif ($periode == 'mois') {
                // Ajouter la condition de la période "Mois"
                $query->whereBetween('contact.date_creation', [Carbon::now()->subMonth(), Carbon::now()]);
            } elseif ($periode == 'trimestre') {
                // Ajouter la condition de la période "Trimestre"
                $query->whereBetween('contact.date_creation', [Carbon::now()->subQuarter(), Carbon::now()]);
            } elseif ($periode == 'annee') {
                // Ajouter la condition de la période "Année"
                $query->whereBetween('contact.date_creation', [Carbon::now()->subYear(), Carbon::now()]);
            }
            
            $data = $query->paginate($perPage);
            $data_counter = $query->paginate(10000);
            //dd($data_counter);


        } elseif ($profil == 'partenaire') {
            // Requête pour le profil "Partenaire"
            $query = DB::connection('mysql2')
                ->table('partenaire')
                ->leftJoin('contact', 'partenaire.id_contact', '=', 'contact.id_contact')
                ->leftJoin('contact_experience', 'contact.id_contact', '=', 'contact_experience.id_contact')
                ->groupBy('partenaire.id_contact');

            if ($periode == 'semaine') {
                // Ajouter la condition de la période "Semaine"
                $query->whereBetween('contact.date_creation', [Carbon::now()->subWeek(), Carbon::now()]);
            } elseif ($periode == 'mois') {
                // Ajouter la condition de la période "Mois"
                $query->whereBetween('contact.date_creation', [Carbon::now()->subMonth(), Carbon::now()]);
            } elseif ($periode == 'trimestre') {
                // Ajouter la condition de la période "Trimestre"
                $query->whereBetween('contact.date_creation', [Carbon::now()->subQuarter(), Carbon::now()]);
            } elseif ($periode == 'annee') {
                // Ajouter la condition de la période "Année"
                $query->whereBetween('contact.date_creation', [Carbon::now()->subYear(), Carbon::now()]);
            }
            
            $data = $query->paginate($perPage);
            $data_counter = $query->paginate(10000);

        }elseif ($profil == 'prospect') {
            // Requête pour le profil "Prospect"
            $query = DB::connection('mysql2')
                ->table('contact')
                ->select('contact.*','contact_experience.profil')
                ->leftJoin('contact_experience', 'contact.id_contact', '=', 'contact_experience.id_contact')
                ->leftJoin('partenaire', 'contact.id_contact', '=', 'partenaire.id_contact')
                ->leftJoin('intervenant', 'contact.id_contact', '=', 'intervenant.id_contact')
                ->whereNull('contact_experience.id_contact')
                ->orWhere('contact_experience.id_contact', '')
                ->whereNull('partenaire.id_contact')
                ->orWhere('partenaire.id_contact', '')
                ->whereNull('intervenant.id_contact')
                ->orWhere('intervenant.id_contact', '');
                

            if ($periode == 'semaine') {
                // Ajouter la condition de la période "Semaine"
                $query->whereBetween('contact.date_creation', [Carbon::now()->subWeek(), Carbon::now()]);
            } elseif ($periode == 'mois') {
                // Ajouter la condition de la période "Mois"
                $query->whereBetween('contact.date_creation', [Carbon::now()->subMonth(), Carbon::now()]);
            } elseif ($periode == 'trimestre') {
                // Ajouter la condition de la période "Trimestre"
                $query->whereBetween('contact.date_creation', [Carbon::now()->subQuarter(), Carbon::now()]);
            } elseif ($periode == 'annee') {
                // Ajouter la condition de la période "Année"
                $query->whereBetween('contact.date_creation', [Carbon::now()->subYear(), Carbon::now()]);
            }
            
            $data = $query->groupBy('contact.id_contact')->paginate($perPage);
            $data_counter = $query->paginate(10000);
            //dd($data_counter);

        } elseif ($profil == 'client') {
            // Requête pour le profil "Client"
            $query = DB::connection('mysql2')
                ->table('contact_experience')
                ->join('contact', 'contact_experience.id_contact', '=', 'contact.id_contact')
                ->where('contact_experience.profil', 'Client');
                
            if ($periode == 'semaine') {
                // Ajouter la condition de la période "Semaine"
                $query->whereBetween('contact.date_creation', [Carbon::now()->subWeek(), Carbon::now()]);
            } elseif ($periode == 'mois') {
                // Ajouter la condition de la période "Mois"
                $query->whereBetween('contact.date_creation', [Carbon::now()->subMonth(), Carbon::now()]);
            } elseif ($periode == 'trimestre') {
                // Ajouter la condition de la période "Trimestre"
                $query->whereBetween('contact.date_creation', [Carbon::now()->subQuarter(), Carbon::now()]);
            } elseif ($periode == 'annee') {
                // Ajouter la condition de la période "Année"
                $query->whereBetween('contact.date_creation', [Carbon::now()->subYear(), Carbon::now()]);
            }
            
            $data = $query->groupBy('contact.id_contact')->paginate($perPage);
            $data_counter = $query->paginate(10000);
            //dd($data_counter);


        }elseif ($profil == 'user') {
            // Requête pour le profil "Client"
            $query = DB::connection('mysql2')
                ->table('contact_experience')
                ->join('contact', 'contact_experience.id_contact', '=', 'contact.id_contact')
                ->where('contact_experience.profil', 'User');

            if ($periode == 'semaine') {
                // Ajouter la condition de la période "Semaine"
                $query->whereBetween('contact.date_creation', [Carbon::now()->subWeek(), Carbon::now()]);
            } elseif ($periode == 'mois') {
                // Ajouter la condition de la période "Mois"
                $query->whereBetween('contact.date_creation', [Carbon::now()->subMonth(), Carbon::now()]);
            } elseif ($periode == 'trimestre') {
                // Ajouter la condition de la période "Trimestre"
                $query->whereBetween('contact.date_creation', [Carbon::now()->subQuarter(), Carbon::now()]);
            } elseif ($periode == 'annee') {
                // Ajouter la condition de la période "Année"
                $query->whereBetween('contact.date_creation', [Carbon::now()->subYear(), Carbon::now()]);
            }

            $data = $query->groupBy('contact.id_contact')->paginate($perPage);
            $data_counter = $query->paginate(10000);

        }elseif ($profil == 'client-user') {
            // Requête pour le profil "Client"
            $query = DB::connection('mysql2')
                ->table('contact_experience')
                ->join('contact', 'contact_experience.id_contact', '=', 'contact.id_contact')
                ->where('contact_experience.profil', 'client-user');

            if ($periode == 'semaine') {
                // Ajouter la condition de la période "Semaine"
                $query->whereBetween('contact.date_creation', [Carbon::now()->subWeek(), Carbon::now()]);
            } elseif ($periode == 'mois') {
                // Ajouter la condition de la période "Mois"
                $query->whereBetween('contact.date_creation', [Carbon::now()->subMonth(), Carbon::now()]);
            } elseif ($periode == 'trimestre') {
                // Ajouter la condition de la période "Trimestre"
                $query->whereBetween('contact.date_creation', [Carbon::now()->subQuarter(), Carbon::now()]);
            } elseif ($periode == 'annee') {
                // Ajouter la condition de la période "Année"
                $query->whereBetween('contact.date_creation', [Carbon::now()->subYear(), Carbon::now()]);
            }

            $data = $query->groupBy('contact.id_contact')->paginate($perPage);
            $data_counter = $query->paginate(10000);

        }
        //dd($data);
        $count_intervenant= 0;
        $count_partenaire= 0;
        $count_prospect= 0;
        $count_client= 0;
        $count_exp = 0;
        $count_client_exp = 0;

        //dd($data_counter);
        foreach ($data_counter as $item) {
            if (isset($item->id_intervenant_)) {
                $count_intervenant++;
            } elseif (isset($item->id_partenaire)) {
                $count_partenaire++;
            } 
            elseif (isset($item->profil) && $item->profil == 'Client') {
                $count_client++;
            } elseif (isset($item->profil) && $item->profil == 'User') {
                $count_exp++;
            } elseif (isset($item->profil) && $item->profil == 'Client-User') {
                $count_client_exp++;
            }
            else {
                $count_prospect++;
            }
        }
        //dd($count_intervenant);
    
          //dd($count_client);
          //$totalProduit = $data->total();

     /*$data = Contact::sortable()->paginate($perPage);

        $value = session('id_contact');  // Stocker la variable dans la session de la table campagne*/
        return view('contacts.index', 
        compact(
            'data',
            'perPage',
            'con_notif',
            'totalContact',
            'liste_profile',
            'count_intervenant',
            'count_partenaire',
            'count_prospect',
            'count_client',
            'count_exp',
            'count_client_exp',
            ))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    // public function multisearch(Request $request)
    // {

    //     $multisearchnom = $request->get('multisearchnom');
    //     $multisearchtel = $request->get('multisearchtel');
    //     $multisearchprenom = $request->get('multisearchprenom');
    //     $multisearchmail = $request->get('multisearchmail');
    //     $perPage = $request->get('perPage') ?? 10; // par défaut 10 éléments par page

    //     $data = DB::connection('mysql2')->table('contact')

    //         ->where('email', 'LIKE', '%' . $multisearchmail . '%')
    //         ->where('tel', 'LIKE', '%' . $multisearchtel . '%')
    //         ->where('prenom', 'LIKE', '%' . $multisearchprenom . '%')
    //         ->where('nom', 'LIKE', '%' . $multisearchnom . '%')
    //         ->paginate($perPage);

    //     //dump($data);

    //     $con_experience = DB::connection('mysql2')->table('contact_experience')->get();
    //     $con_notif = DB::connection('mysql2')->table('contact_notification')->get();


    //     return view('contacts.index',compact('data', 'perPage','con_experience','con_notif'))
    //     ->with('i', (request()->input('page', 1) - 1) * 5);
    // }

    // Direction view create

    public function create()
    {
        session_start();
        $clientDrive = new \Google_Client();
        $clientDrive->setAuthConfig(__DIR__ . '/../../Google/google_credentials.json');
        $clientDrive->addScope(\Google_Service_Drive::DRIVE);

        if (isset($_GET['code'])) {
            $token = $clientDrive->fetchAccessTokenWithAuthCode($_GET['code']);
            //$clientDrive->setAccessToken($token);
            // Stocker le jeton d'accès dans la session pour une utilisation future
            $access_token = json_encode($token);
            file_put_contents(__DIR__ . '/../../Google/google_access_token.json', $access_token);
            $_SESSION['access_token'] = $token;
            //dd($_SESSION['access_token']);
        }

        $id_org = Entreprise::where('id_organisation' ,'>' ,1)->pluck('id_organisation')->toArray();
        $nom_org =  Entreprise::where('id_organisation' ,'>' ,1)->pluck('nom')->toArray();
        //dd($nom_org);
        return view('contacts.create',compact('id_org','nom_org'));
    }

    public function getToken(){
        session_start();
        // Si l'utilisateur a donné son consentement et a autorisé l'accès à son compte Google Drive,
        // Google redirigera l'utilisateur vers la page de rappel OAuth2 avec un code d'autorisation.
        // Échangez ce code contre un jeton d'accès OAuth2 en utilisant la méthode fetchAccessTokenWithAuthCode().
        // dd($_SESSION['clientDrive']);
        // $clientDrive = $_SESSION['clientDrive'];
        // dd($_GET['code']);
        if (isset($_GET['code'])) {
            //$token = $clientDrive->fetchAccessTokenWithAuthCode($_GET['code']);
            //$clientDrive->setAccessToken($token);
            // Stocker le jeton d'accès dans la session pour une utilisation future
            $_SESSION['access_code'] = $_GET['code'];
            // dd($_SESSION['access_token']);
        }
        return redirect()->route('contacts.create')
            ->with('success', 'Token obtenue avec succes');
    }

    public function copyFolder($sourceFolderId, $destinationFolderId, $newFolderName,$service){
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
                $this->copyFolder($file->getId(), $newFolderId, $file->getName(),$service);
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

    // Processus de creation
    public function store(Request $request)
    {
        session_start();

        //Creation du dossier Client
        $clientDrive = new \Google_Client();
        //$clientDrive->setApplicationName('Laravel');
        //$authConfig = file_get_contents(__DIR__ . '/../../Google/google_credentials.json');
        //$clientDrive->setAuthConfig(json_decode($authConfig, true));
        $clientDrive->setAuthConfig(__DIR__ . '/../../Google/google_credentials.json');
        $clientDrive->addScope(\Google_Service_Drive::DRIVE);
        $clientDrive->setAccessType('offline');

        // Redirect the user to the consent page to authorize your application
        //if (!isset($_SESSION['access_token'])||$_SESSION['access_token']==null) {
            //$redirect_uri = 'http://localhost:8000/contacts.create';
            //$clientDrive->setRedirectUri($redirect_uri);
            //$auth_url = $clientDrive->createAuthUrl();
            //header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
            //exit();
        //} else {
        // Exchange authorization code for an access token
        //$token = $clientDrive->fetchAccessTokenWithAuthCode($_GET['code']);
        //dd($_SESSION['access_token']);
        $clientDrive->setAccessToken(file_get_contents(__DIR__ . '/../../Google/google_access_token.json'));//$_SESSION['access_token']

        // Use the access token to make API requests
        $drive = new \Google_Service_Drive($clientDrive);
        //}

        /*$drive = new \Google_Service_Drive($clientDrive);
        // ID du dossier à copier
        $sourceFolderId = '1VJNakGz85nh-HYt_HyeooFpB4HQYPrED';

        // ID du dossier parent de la copie
        $destinationFolderId = getenv('DRIVE_CLIENT');

        // Copier le dossier
        $folderMetadata = new \Google_Service_Drive_DriveFile([
            'name' =>$con->id_contact.' - '.$request->Prénom.' '.$request->Nom,
            'parents' => [$destinationFolderId]
        ]);
        $sourceFolder = $drive->files->copy($sourceFolderId, $folderMetadata);*/



        /*$_SESSION['clientDrive'] = $clientDrive;
        //dd($_SESSION['clientDrive']);
        //dd($_SESSION['access_token']);
        if (isset($_SESSION['access_code'])) {
            // Si oui, utiliser le jeton d'accès stocké dans la session
            $_SESSION['access_token'] = $clientDrive->fetchAccessTokenWithAuthCode($_SESSION['access_code']);
            $clientDrive->setAccessToken($_SESSION['access_token']);
            $drive = new \Google_Service_Drive($clientDrive);
        } else {
            // Si non, rediriger l'utilisateur vers la page de connexion Google
            $redirect_uri = 'http://localhost:8000/getToken';//.http_build_query($clientDrive);
            $clientDrive->setRedirectUri($redirect_uri);
            $auth_url = $clientDrive->createAuthUrl();
            header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
            exit();
        }*/

        //dd($_SERVER['HTTP_HOST']);
        //dd($request);
        $request->validate([
            'avatar',
            'Nom' => 'required',
            'Prénom' => 'required',
            'mail' => ['nullable','required_without:tel','email','unique:mysql2.contact,email'],
            'tel' => 'nullable|numeric|digits:10|unique:mysql2.contact,tel|required_without:mail',
            'adress',
            'cp' => 'nullable|numeric|digits_between:3,5',
            'ville',
            'url',
            'entreprise'=>'nullable|exists:mysql2.organisation,id_organisation',
            'type'
        ]);
        //dd($request);
        //Contact::create($request->all());


        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris')); //first argument "must" be a string
        $current_date->setTimestamp($timestamp); //adjust the object to correct timestamp
        $notif_text = 'Creation d\'un nouveau contact le ' .  $current_date->format('Y-m-d H:i:s') . '';
        //$prix_paiement=((double) $facture->prix_facture)/((double) $request->nb_paiements);

        $notification = DB::connection('mysql2')->table('notification')
            ->insertGetId([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'contact'
            ]);

        $con = Contact::create([
            'nom'=>$request->Nom,
            'prenom'=>$request->Prénom,
            'email'=>$request->mail,
            'tel'=>$request->tel,
            'adresse'=>$request->adress,
            'code_postal'=>$request->cp,
            'ville'=>$request->ville,
            'url_contact_folder'=>$request->entreprise,
            'date_creation'=>$current_date->format('Y-m-d H:i:s'),
            'date_update'=>$current_date->format('Y-m-d H:i:s'),
        ]);
        $con_notif = DB::connection('mysql2')->table('contact_notification')
        ->insert([
            'id_notification'=>$notification,
            'date_creation'=>$current_date->format('Y-m-d H:i:s'),
            'id_contact'=>$con->id
        ]);

        if(!is_null($request->entreprise))
        {
            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris')); //first argument "must" be a string
            $current_date->setTimestamp($timestamp); //adjust the object to correct timestamp
            $notif_text = 'Creation d\'un nouveau contact_entreprise liée au contact de ID ' . $con->id . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';
            //$prix_paiement=((double) $facture->prix_facture)/((double) $request->nb_paiements);

            $notification = DB::connection('mysql2')->table('notification')
                ->insert([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'contact entreprise'
                ]);
            /************************************************************Oumayma************************************************************************ */
            $org = $request->entreprise;

            // Vérification si l'id_organisation est une valeur valide en recherchant dans la table organisation
            $isValidOrganisation = DB::connection('mysql2')->table('organisation')
                ->where('id_organisation', $org)
                ->exists();

            // Si l'id_organisation n'est pas valide, On définie $org à null
            if (!$isValidOrganisation) {
                $org = null;
            }

            DB::connection('mysql2')->insert("INSERT INTO contact_entreprise (id_contact, type, id_organisation) VALUES (?,?,?)", [$con->id, $request->type, $org]);

            //$org=DB::connection('mysql2')->insert("INSERT INTO contact_entreprise (id_contact, type, id_organisation) VALUES (?,?,?)",[$con->id,$request->type,$request->entreprise]);
            //$org=DB::connection('mysql2')->insert("INSERT INTO contact_entreprise (id_contact, id_organisation) VALUES (?,?)",[$con->id,$request->entreprise]);
        }

        // ID du dossier à copier
       /* $sourceFolderId = '1VJNakGz85nh-HYt_HyeooFpB4HQYPrED';

        // ID du dossier parent de la copie
        $destinationFolderId = getenv('DRIVE_CLIENT');
        $newFolderName = ''.$con->id.' - '.$request->Nom.' '.$request->Prénom.'';
        // Copier le dossier
        $sourceFolder = $this->copyFolder($sourceFolderId, $destinationFolderId,$newFolderName,$drive);
        DB::connection('mysql2')
            ->table('contact')
            ->where('contact.id_contact', '=', $con->id)
            ->update([
                'date_update' => $current_date->format('Y-m-d H:i:s'),
                'url_contact_folder' => 'https://drive.google.com/drive/u/1/folders/' . $sourceFolder
            ]);*/

        //  $folderMetadata = new \Google_Service_Drive_DriveFile([
        //     'name' =>$con->id_contact.' - '.$request->Prénom.' '.$request->Nom,
        //     'parents' => [$destinationFolderId]
        // ]);
        // $sourceFolder = $drive->files->copy($sourceFolderId, $folderMetadata);

        /*$stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );
        $client = $stripe->customers->create([
            'address'=>[
                'line1'=>$request->adress,
                'postal_code'=>$request->cp,
                'city'=>$request->ville,
            ],
            'phone'=>$request->tel,
            'email'=>$request->mail,
            'name'=>$request->Prénom.' '.$request->Nom,
            'metadata' =>
                [
                    'id_contact'=>$con->id,
                    'type'=>$request->type,
                    'id_organisation'=>$request->id_organisation
                ]
        ]);

        $client = substr($client,22);
        //dd($client);

        $client = json_decode($client,true);
        //dd($client);

       /* $con->update([
            'id_client_stripe'=>$client['id'],
        ])
        ->where('id_contact','=',$con->id);*/

        /*$timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris')); //first argument "must" be a string
        $current_date->setTimestamp($timestamp); //adjust the object to correct timestamp
        $notif_text = 'Mise à jour liée à stripe du contact de ID ' . $con->id . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';
        //$prix_paiement=((double) $facture->prix_facture)/((double) $request->nb_paiements);

        $notification = DB::connection('mysql2')->table('notification')
            ->insert([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'contact'
            ]);

        DB::connection('mysql2')
            ->update('UPDATE contact SET contact.id_client_stripe="'.$client['id'].'", contact.url_client_stripe="https://dashboard.stripe.com/test/customers/'.$client['id'].'", contact.date_update="' . $current_date->format('Y-m-d H:i:s') . '" WHERE contact.id_contact='.$con->id.'');*/

        return redirect()->route('contacts.show',['contact'=>$con->id])
            ->with('success', 'Contact ajouté avec succes');
    }

    // Direction vers le view de details du groupe
    public function show(Request $request,$contact)
    {

        $modelcontact = new Contact;
        //$contact_e = Contact::with('codePromos')->find($contact);
        //$codePromos = $contact_e->codePromos;
        $modelcontact->setConnection('mysql2');

        $id_con = DB::connection('mysql2')->select('SELECT id_contact FROM contact');

        //
        // http: //127 .0.0. 1:800 0/res ervat ioncl ient. show? 1  (45 en local)
        // https ://te amfb. lalac hante .fr/r eserv ation clien t.sho w? 1  (52 en ligne)
        $url1 = (int) $contact;
        $url = $url1;

        foreach ($id_con as $key => $value) {
            if ($url1 === $value->id_contact) {
                $url = $url1;
            }
        }
        $code=DB::connection('mysql2')->select('SELECT cp.*
        FROM contact c
        JOIN contact_code_promo ccp ON c.id_contact = ccp.id_contact
        JOIN codes_promo cp ON ccp.id_code = cp.id_code
        WHERE c.id_contact = ?;
        ',[$contact]);

        $con= DB::connection('mysql2')->selectOne('SELECT  contact.id_contact,contact.tel,contact.nom,contact.prenom,contact.email,contact.adresse,contact.code_postal,contact.ville,contact_entreprise.type,contact_entreprise.id_organisation,organisation.num_cse,contact_experience.profil,contact_experience.personna
        FROM contact
        LEFT JOIN contact_entreprise ON contact.id_contact = IFNULL(contact_entreprise.id_contact, "none")
        LEFT JOIN organisation ON IFNULL(contact_entreprise.id_organisation, "none") = IFNULL(organisation.id_organisation, "none")
        LEFT JOIN contact_experience ON IFNULL(contact_experience.id_contact, "none") = contact.id_contact
        WHERE contact.id_contact=?',[$url]);
        //$contact= DB::connection('mysql2')->selectOne('SELECT * FROM contact WHERE id_contact=?',[$url]);

        $evenements= DB::connection('mysql2')->select('SELECT contact_notification.date_creation,notification.contenu_notification
        FROM contact JOIN contact_notification JOIN notification
        ON contact.id_contact=contact_notification.id_contact
        AND notification.id_notification=contact_notification.id_notification
        WHERE contact.id_contact=?
        ORDER BY contact_notification.date_creation DESC',[$url]);

        $nb_fact=DB::connection('mysql2')->selectOne('SELECT COUNT(*) as facts
        FROM contact JOIN paiement JOIN factures
        ON paiement.num_facture=factures.num_facture
        AND paiement.id_contact=contact.id_contact
        WHERE contact.id_contact=?',[$url]);


        $total_exp=DB::connection('mysql2')->selectOne('SELECT COUNT(*) as exp
        FROM contact JOIN contact_experience JOIN experience
        ON contact_experience.id_contact=contact.id_contact
        AND contact_experience.id_experience=experience.id_experience
        WHERE contact.id_contact=?
        AND (contact_experience.profil="Client" OR contact_experience.profil="Client-User")',[$url]);


        $exp_vecu=DB::connection('mysql2')->selectOne('SELECT COUNT(*) as exp
        FROM contact JOIN contact_experience JOIN experience
        ON contact_experience.id_contact=contact.id_contact
        AND contact_experience.id_experience=experience.id_experience
        WHERE contact.id_contact=?
        AND (contact_experience.profil="User" OR contact_experience.profil="Client-User")',[$url]);

        $interactions= DB::connection('mysql2')->select('SELECT interaction.id_interaction,interaction.date_heure,interaction.texte,interaction.type_interaction,interaction.id_contact
        FROM interaction JOIN contact
        ON interaction.id_contact=contact.id_contact
        WHERE contact.id_contact=?
        ORDER BY interaction.date_heure DESC',[$url]);

        // //Ilham
        $personas = DB::connection('mysql2')
        ->select('SELECT persona.id_persona, persona.tag, contact_persona.id_contact
        FROM persona
        JOIN contact_persona ON persona.id_persona = contact_persona.id_persona
        WHERE contact_persona.id_contact = ?
        ORDER BY persona.id_persona DESC', [$url]);
        // //Ilham

        $storytelling=DB::connection('mysql2')->select('SELECT storytelling.id_storytelling, storytelling.description, contents_experience.date_heure
        FROM storytelling JOIN contents_experience JOIN experience JOIN contact_experience
        ON storytelling.id_content_experience=contents_experience.id_content_experience
        AND contents_experience.id_experience=experience.id_experience
        AND contact_experience.id_experience=experience.id_experience
        WHERE contact_experience.id_contact=?
        ORDER BY contents_experience.date_heure DESC',[$url]);

       $experiences=DB::connection('mysql2')->select('SELECT  contact_experience.id_contact, experience.id_experience, experience.nom_experience, experience.numero_experience, contact_experience.profil,factures.num_facture,pack_experience.id_pack_experience
        FROM contact_experience JOIN experience JOIN pack_experience JOIN factures
        ON contact_experience.id_experience=experience.id_experience
        AND experience.id_experience=pack_experience.id_experience
        AND pack_experience.num_facture=factures.num_facture
        WHERE contact_experience.id_contact=?  ',[$url]);


        $statut_experience = DB::connection('mysql2')->table('experience_statut_notification')
        ->join('experience_statut','experience_statut_notification.id_statut_experience','=','experience_statut.id_statut_experience')
        ->orderByDesc('experience_statut_notification.id_notification')
        ->get();

        //dd($experiences);

        $id_exps=[];

        foreach ($experiences as $exp)
        {
            array_push($id_exps,$exp->id_experience);
        }

        $exps = implode(',', $id_exps);
        $id_orgs=[];
        if(!empty($con->id_organisation))
            array_push($id_orgs,$con->id_organisation);
        $orgs = implode(',', $id_orgs);

        $contacts_liees = DB::connection('mysql2')->select('SELECT contact.id_contact,contact.nom,contact.prenom
        FROM contact
        LEFT JOIN contact_entreprise ON contact.id_contact = IFNULL(contact_entreprise.id_contact, "none")
        LEFT JOIN organisation ON IFNULL(contact_entreprise.id_organisation, "none") = IFNULL(organisation.id_organisation, "none")
        LEFT JOIN contact_experience ON IFNULL(contact_experience.id_contact, "none") = contact.id_contact
        WHERE (contact_experience.id_experience IN (?)) OR (contact_entreprise.id_organisation IN (?))',[$exps,$orgs]);
        //dd($contacts_liees);
        $entreprise = DB::connection('mysql2')->table('contact')
        ->join('contact_entreprise','contact.id_contact','=','contact_entreprise.id_contact')
        ->join('organisation','organisation.id_organisation','=','contact_entreprise.id_organisation')
        ->where('contact.id_contact',$url)
        ->select('contact.id_contact','contact_entreprise.type','organisation.id_organisation','organisation.adresse','organisation.nom','organisation.email','organisation.tel','organisation.code_postal','organisation.ville','organisation.num_cse')
        ->first();
/*
        $code = DB::connection('mysql2')->table('contact')
        ->join('contact_entreprise','contact.id_contact','=','contact_entreprise.id_contact')
        ->join('organisation','organisation.id_organisation','=','contact_entreprise.id_organisation')
        ->where('contact.id_contact',$url)
        ->select('contact.id_contact','contact_entreprise.type','organisation.id_organisation','organisation.adresse','organisation.nom','organisation.email','organisation.tel','organisation.code_postal','organisation.ville','organisation.num_cse')
        ->first();
*/
        $remises=DB::connection('mysql2')->table('remise')->get();

        // -------------------------------------yasser--------------------------------------------------
        // ----------tags_interaction--------------
        $les_tags_lier_avec_inter = DB::connection('mysql2')->table('tag_interaction')
            ->join('interaction_tag', 'tag_interaction.id_tag_interaction', '=', 'interaction_tag.id_tag_interaction')
            ->orderByDesc('tag_interaction.id_tag_interaction')
            // ->groupBy('tag_interaction.tag')
            ->get();
            // dd($les_tags_avec_liaison);
        // ----------tags_interaction--------------
        // ----------tags_storytelling--------------
        $les_tags_lier_avec_story = DB::connection('mysql2')->table('tag_story')
            ->join('tag_storytelling', 'tag_story.id_tag_story', '=', 'tag_storytelling.id_tag_story')
            ->orderByDesc('tag_story.id_tag_story')
            // ->groupBy('tag_interaction.tag')
            ->get();
            // dd($les_tags_lier_avec_story);
        // ----------tags_storytelling--------------
        // ----------tags_persona--------------
        // $les_tags_lier_avec_persona = DB::connection('mysql2')->table('tag_persona')
        //     ->join('tag_persona', 'tag_persona.id_tag_persona', '=', 'tag_persona.id_tag_persona')
        //     ->orderByDesc('tag_persona.id_tag_persona')
        //     // ->groupBy('tag_interaction.tag')
        //     ->get();

        // ----------tags_persona--------------
        // -------------------------------------yasser--------------------------------------------------

        // dd($entreprise);
        return view('contacts.show',[
            'code'=>$code,
            'con'=>$con,
            'contact'=>$contact,
            'evenements'=>$evenements,
            'nb_fact'=>$nb_fact,
            'total_exp'=>$total_exp,
            'exp_vecu'=>$exp_vecu,
            'interactions'=>$interactions,
            'storytelling'=>$storytelling,
            'experiences'=>$experiences,
            'contacts_liees'=>$contacts_liees,
            'entreprise'=>$entreprise,
            'remises'=>$remises,
            'les_tags_lier_avec_inter'=>$les_tags_lier_avec_inter,
            'les_tags_lier_avec_story'=>$les_tags_lier_avec_story,
            'statut_experience'=>$statut_experience,
            'personas'=>$personas
        ]);

    }

    // Direction vers le view de la modification du groupe
    public function edit($contact)
    {
        $modelContact = Contact::where('id_contact', $contact)->firstOrFail();

    

        $id_con = DB::connection('mysql2')->select('SELECT id_contact FROM contact');

        //
        // http: //127 .0.0. 1:800 0/res ervat ioncl ient. show? 1  (45 en local)
        // https ://te amfb. lalac hante .fr/r eserv ation clien t.sho w? 1  (52 en ligne)
        $url1 = (int) $contact;
        $url = $url1;

        foreach ($id_con as $key => $value) {
            if ($url1 === $value->id_contact) {
                $url = $url1;
            }
        }

        $con= DB::connection('mysql2')->select('SELECT id_contact,tel,nom,prenom,email,adresse,code_postal,ville,url_contact_folder
        from contact
        WHERE id_contact=?',[$url]);

        $org= DB::connection('mysql2')->selectOne('SELECT contact_entreprise.type,contact_entreprise.id_organisation
        FROM contact_entreprise
        JOIN contact ON contact.id_contact = contact_entreprise.id_contact
        WHERE contact.id_contact=?',[$url]);

        $nom_org =  Entreprise::where('id_organisation' ,'>' ,0)->pluck('nom')->toArray();
        $id_org = Entreprise::where('id_organisation' ,'>' ,0)->pluck('id_organisation')->toArray();

        return view('contacts.edit', compact('con','nom_org','id_org','org','modelContact'));

    }

    // Processus de modification du groupe
    public function update(Request $request, $contact)
    {
         //dd($request);
         $request->validate([
            'avatar',
            'Nom' => 'required',
            'Prénom' => 'required',
            'mail' => ['nullable','required_without:tel','email',Rule::unique('mysql2.contact', 'email')->ignore($contact, 'id_contact')],
            'tel' => ['nullable','numeric','digits:10',Rule::unique('mysql2.contact', 'tel')->ignore($contact, 'id_contact'),'required_without:mail'],
            'adress',
            'cp' => 'nullable|numeric|digits_between:3,5',
            'ville',
            'url',
            'entreprise'=>'nullable|exists:mysql2.organisation,id_organisation',
            'type'
        ]);
        //dd($request);
        //Contact::create($request->all());

        /* $con = Contact::update([
            'nom'=>$request->Nom,
            'prenom'=>$request->Prénom,
            'email'=>$request->mail,
            'tel'=>$request->tel,
            'adresse'=>$request->adress,
            'CP'=>$request->cp,
            'ville'=>$request->ville,
            'url_contact_folder'=>$request->entreprise
        ]);*/


        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris')); //first argument "must" be a string
        $current_date->setTimestamp($timestamp); //adjust the object to correct timestamp
        $notif_text = 'Mise à jour du contact de ID ' . $contact . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';
        //$prix_paiement=((double) $facture->prix_facture)/((double) $request->nb_paiements);

        $notification = DB::connection('mysql2')->table('notification')
            ->insert([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'contact'
            ]);

        $con=DB::connection('mysql2')->table('contact')
            ->where('id_contact',$contact)
            ->update([
            'nom'=>$request->Nom,
            'prenom'=>$request->Prénom,
            'email'=>$request->mail,
            'tel'=>$request->tel,
            'adresse'=>$request->adress,
            'code_postal'=>$request->cp,
            'ville'=>$request->ville,
            'url_contact_folder'=>$request->url,
            'date_update' => $current_date->format('Y-m-d H:i:s'),
            ]);

        // $clientDrive = new \Google_Client();
        // $clientDrive->setAuthConfig(__DIR__ . '/../../Google/google_credentials.json');
        // $clientDrive->addScope(\Google_Service_Drive::DRIVE);
        // $clientDrive->setAccessType('offline');
        // $clientDrive->setAccessToken(file_get_contents(__DIR__ . '/../../Google/google_access_token.json'));//$_SESSION['access_token']
        // $drive = new \Google_Service_Drive($clientDrive);


        $con = DB::connection('mysql2')->table('contact')
            ->where('id_contact',$contact)
            ->first();
        $entreprise_con = DB::connection('mysql2')->table('contact_entreprise')
            ->where('id_contact',$con->id_contact)
            ->first();

        if(is_null($entreprise_con))
        {
            if(!is_null($request->entreprise))
            {
                $timestamp = time();
                $current_date = new DateTime("now", new DateTimeZone('Europe/Paris')); //first argument "must" be a string
                $current_date->setTimestamp($timestamp); //adjust the object to correct timestamp
                $notif_text = 'Creation d\'un nouveau contact_entreprise liée au contact de ID ' . $con->id_contact . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';
                //$prix_paiement=((double) $facture->prix_facture)/((double) $request->nb_paiements);

                $notification = DB::connection('mysql2')->table('notification')
                    ->insert([
                        'contenu_notification' => $notif_text,
                        'date_notification' => $current_date->format('Y-m-d H:i:s'),
                        'type' => 'contact entreprise'
                    ]);
                    /*******************************************************Oumayma******************************************************************* */
                    $org = $request->entreprise;

                    // Vérification si $org est NULL
                    if (is_null($org)) {
                        // Si $org est NULL, insértion d'une valeur NULL pour la colonne id_organisation
                        $query = "INSERT INTO contact_entreprise (id_contact, type, id_organisation) VALUES (?, ?, NULL)";
                        $params = [$con->id_contact, $request->type];
                    } else {
                        // Si $org n'est pas NULL, utilisation sa valeur
                        $query = "INSERT INTO contact_entreprise (id_contact, type, id_organisation) VALUES (?, ?, ?)";
                        $params = [$con->id_contact, $request->type, $org];
                    }

                    DB::connection('mysql2')->insert($query, $params);            }
                //$org=DB::connection('mysql2')->insert("INSERT INTO contact_entreprise (id_contact, type, id_organisation) VALUES (?,?,?)",[$con->id_contact,$request->type,$request->entreprise]);

            //$org=DB::connection('mysql2')->insert("INSERT INTO contact_entreprise (id_contact, id_organisation) VALUES (?,?)",[$con->id,$request->entreprise]);
        }
        else
        {
            if(!is_null($request->entreprise))
            {

                $org=DB::connection('mysql2')->table('contact_entreprise')
                    ->where('id_contact',$con->id_contact)
                    ->update([
                        'type' => $request->type,
                        'id_organisation' => $request->entreprise
                    ]);
                $org = DB::connection('mysql2')->table('contact_entreprise')->where('id_contact',$con->id_contact)->first();

                $timestamp = time();
                $current_date = new DateTime("now", new DateTimeZone('Europe/Paris')); //first argument "must" be a string
                $current_date->setTimestamp($timestamp); //adjust the object to correct timestamp
                $notif_text = 'Mise à jour du contact_entreprise de ID ' . $entreprise_con->id_organisation . ' liée au contact de ID ' . $con->id_contact . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';
                //$prix_paiement=((double) $facture->prix_facture)/((double) $request->nb_paiements);

                $notification = DB::connection('mysql2')->table('notification')
                    ->insert([
                        'contenu_notification' => $notif_text,
                        'date_notification' => $current_date->format('Y-m-d H:i:s'),
                        'type' => 'contact entreprise'
                    ]);
            }
            else
            {



                $timestamp = time();
                $current_date = new DateTime("now", new DateTimeZone('Europe/Paris')); //first argument "must" be a string
                $current_date->setTimestamp($timestamp); //adjust the object to correct timestamp
                $notif_text = 'Suppression du contact_entreprise de ID ' . $entreprise_con->id_organisation . ' liée au contact de ID ' . $con->id_contact . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';
                //$prix_paiement=((double) $facture->prix_facture)/((double) $request->nb_paiements);

                $notification = DB::connection('mysql2')->table('notification')
                    ->insert([
                        'contenu_notification' => $notif_text,
                        'date_notification' => $current_date->format('Y-m-d H:i:s'),
                        'type' => 'contact entreprise'
                    ]);

                $org=DB::connection('mysql2')->table('contact_entreprise')
                    ->where('id_contact',$con->id_contact)
                    ->delete();
            }
        }

        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
          );

        if (isset($con->id_client_stripe)) {
            $client = $stripe->customers->update(
                $con->id_client_stripe,
                [
                'address'=>[
                    'line1'=>$request->adress,
                    'postal_code'=>$request->cp,
                    'city'=>$request->ville,
                ],
                'phone'=>$request->tel,
                'email'=>$request->mail,
                'name'=>$request->Prénom.' '.$request->Nom,
                'metadata' =>
                    [
                        'id_contact'=>$con->id_contact,
                        'type'=>$request->type,
                        'id_organisation'=>$request->id_organisation
                    ]
            ]);
        }

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

        if(($con->url_contact_folder!=null)&&($con->url_contact_folder!="")){
            $id_folder = substr($con->url_contact_folder, 43);
            $fileMetadata = new Google_Service_Drive_DriveFile([
                'name' => $con->id_contact.' - '.$con->nom.' '.$con->prenom,
                'mimeType' => 'application/vnd.google-apps.folder'
            ]);
            // dd($id_folder);
            $drive->files->update($id_folder, $fileMetadata, ['fields' => 'id,name']);
        }

        return redirect()->route('contacts.show',['contact'=>$con->id_contact])
        ->with('success', 'La mise a jour a été effectuée avec succes');
    }

    // Procesuus de la suppression du groupe
    public function destroy($contact)
    {

        $con_interaction= DB::connection('mysql2')->table('interaction')
        ->where('id_contact',$contact)
        ->get();

        $con_experience=DB::connection('mysql2')->table('contact_experience')
        ->where('id_contact',$contact)
        ->get();

        $con_paiement=DB::connection('mysql2')->table('paiement')
        ->where('id_contact',$contact)
        ->get();

        $con = DB::connection('mysql2')->table('contact')
        ->where('id_contact',$contact)
        ->get();

        if(($con_interaction->isEmpty())&&($con_experience->isEmpty())&&($con_paiement->isEmpty()))
        {
            if($con[0]->id_client_stripe!=null){
                $stripe = new \Stripe\StripeClient(
                    env('STRIPE_SECRET')
                );
                $stripe->customers->delete(
                    $con[0]->id_client_stripe,
                    []
                );
            }

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

        if(($con[0]->url_contact_folder!=null)&&($con[0]->url_contact_folder!="")){
            $id_folder = substr($con[0]->url_contact_folder, 43);
            // dd($id_folder);
            $drive->files->delete($id_folder);
        }

            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris')); //first argument "must" be a string
            $current_date->setTimestamp($timestamp); //adjust the object to correct timestamp
            $notif_text = 'Suppression du contact de ID ' . $contact . ' et de tous les entrées associées dans con_entreprise,con_intervenant et con_partenaire le ' .  $current_date->format('Y-m-d H:i:s') . '';
            //$prix_paiement=((double) $facture->prix_facture)/((double) $request->nb_paiements);

            $notification = DB::connection('mysql2')->table('notification')
                ->insert([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'contact'
                ]);

            $con_entreprise= DB::connection('mysql2')->table('contact_entreprise')
            ->where('id_contact',$contact)
            ->delete();

            $con_intervenant=DB::connection('mysql2')->table('intervenant')
            ->where('id_contact',$contact)
            ->delete();

            $con_partenaire=DB::connection('mysql2')->table('partenaire')
            ->where('id_contact',$contact)
            ->delete();

            $con_notif = DB::connection('mysql2')->table('contact_notification')
            ->where('id_contact',$contact)
            ->delete();

            $con = DB::connection('mysql2')->table('contact')
            ->where('id_contact',$contact)
            ->delete();



            return redirect()->route('contacts.index')
                ->with('success', 'Contact supprimé avec succes');
        }
        else
        {
            return redirect()->route('contacts.index')
                ->with('errors','Impossible supprimer un contact qui a effectuées des actions');
        }
    }

    // Procesuus de la suppression plusieur groupe en meme temps
    public function deleteall_g(Request $request)
    {
        // $ids = $request->get('ids');
        // Client::whereIn('id', $ids)->delete();
        // return redirect('clients');
    }
    //Ilham Continue ton code
    public function createPersonna(Request $request)
{
    $request->validate([
        'id_exp'=>'nullable|exists:mysql2.experience,id_experience',
        'id_contact'=> 'required|exists:mysql2.contact,id_contact',
        // 'type_persona',
        // 'texte' => 'required'
        'tag' => 'required'
    ]);

    $id_experience=$request->id_exp;
    $id_contact=$request->id_contact;
    // $type_persona=$request->type_persona;
    // $texte=$request->texte;
    $selected_tag = $request->input('tag');

    $timestamp = time();
    $current_date = new DateTime("now", new DateTimeZone('Europe/Paris')); //first argument "must" be a string
    $current_date->setTimestamp($timestamp); //adjust the object to correct timestamp
    if(is_null($id_experience))
    {
        $notif_text = 'Creation d\'une nouvelle interaction associé au contact de ID ' . $id_contact . ' le '.  $current_date->format('Y-m-d H:i:s') . '';
    }
    else
    {
        $notif_text = 'Creation d\'une nouvelle interaction associé à l\'experience de ID ' . $id_experience . ' et au contact de ID ' . $id_contact . ' le '.  $current_date->format('Y-m-d H:i:s') . '';
    }


    $notification = DB::connection('mysql2')->table('notification')
        ->insert([
            // 'contenu_notification' => $notif_text,
            'date_notification' => $current_date->format('Y-m-d H:i:s'),
            'type' => 'persona'
        ]);

        $persona = DB::connection('mysql2')->table('persona')
            ->insertGetId([
                // 'tag' => $request->input('tag'),
                'tag' => $selected_tag,

            ]);

        $contact_persona = DB::connection('mysql2')->table('contact_persona')
            ->insert([
                'id_contact' => $id_contact,
                'id_persona' => $persona,
            ]);

    return redirect()->back()
        ->with('contact',$id_contact)
        ->with('success', 'Personna créée avec succès');
}


    //Ilham

    public function createInteraction(Request $request)
    {
        $request->validate([
            'id_exp'=>'nullable|exists:mysql2.experience,id_experience',
            'id_contact'=> 'required|exists:mysql2.contact,id_contact',
            'type_int',
            'texte' => 'required'
        ]);

        $id_experience=$request->id_exp;
        $id_contact=$request->id_contact;
        $type_int=$request->type_int;
        $texte=$request->texte;

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris')); //first argument "must" be a string
        $current_date->setTimestamp($timestamp); //adjust the object to correct timestamp
        if(is_null($id_experience))
        {
            $notif_text = 'Creation d\'une nouvelle interaction associé au contact de ID ' . $id_contact . ' le '.  $current_date->format('Y-m-d H:i:s') . '';
        }
        else
        {
            $notif_text = 'Creation d\'une nouvelle interaction associé à l\'experience de ID ' . $id_experience . ' et au contact de ID ' . $id_contact . ' le '.  $current_date->format('Y-m-d H:i:s') . '';
        }


        $notification = DB::connection('mysql2')->table('notification')
            ->insert([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'interaction'
            ]);

        $interaction = DB::connection('mysql2')->table('interaction')
        ->insert([
            'date_heure'=>$current_date->format('Y-m-d H:i:s'),
            'texte'=>$texte,
            'type_interaction'=>$type_int,
            'id_contact'=>$id_contact,
            'id_experience'=>$id_experience
        ]);

        return redirect()->route('contacts.show',['contact'=>$id_contact])
        ->with('success','Interaction créée avec succes');
    }
//vien ici
    public function createStorytelling(Request $request)
    {
        $request->validate([
            'id_exp'=>'required|exists:mysql2.experience,id_experience',
            'id_contact'=> 'required|exists:mysql2.contact,id_contact',
            'desc_content',
            'desc_story'=>'required',
            // --------
            'le_tag_1'=> 'nullable|exists:mysql2.tag_story,id_tag_story',
            'le_tag_2'=> 'nullable|exists:mysql2.tag_story,id_tag_story',
            'le_tag_3'=> 'nullable|exists:mysql2.tag_story,id_tag_story',
            'le_tag_4'=> 'nullable|exists:mysql2.tag_story,id_tag_story',
            'le_tag_5'=> 'nullable|exists:mysql2.tag_story,id_tag_story',
             // nouveau
             'nouveau_tag_1'=> 'nullable|',
             'nouveau_tag_2'=> 'nullable|',
             'nouveau_tag_3'=> 'nullable|',
             'nouveau_tag_4'=> 'nullable|',
             'nouveau_tag_5'=> 'nullable|',
        ]);
        // ------------------yasser-------------------
        // -les tags- il y a 5 au maximum.
        $le_tag_1=$request->le_tag_1;
        $le_tag_2=$request->le_tag_2;
        $le_tag_3=$request->le_tag_3;
        $le_tag_4=$request->le_tag_4;
        $le_tag_5=$request->le_tag_5;
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
        $nouveau_tag_1=$request->nouveau_tag_1;
        $nouveau_tag_2=$request->nouveau_tag_2;
        $nouveau_tag_3=$request->nouveau_tag_3;
        $nouveau_tag_4=$request->nouveau_tag_4;
        $nouveau_tag_5=$request->nouveau_tag_5;
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

        $id_experience=$request->id_exp;
        $id_contact=$request->id_contact;
        $desc_content=$request->desc_content;
        $desc_story=$request->desc_story;

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris')); //first argument "must" be a string
        $current_date->setTimestamp($timestamp); //adjust the object to correct timestamp
        $notif_text = 'Creation d\'un nouveau content experience de type storytelling associé à l\'experience de ID ' . $id_experience . ' le '.  $current_date->format('Y-m-d H:i:s') . '';


        $notification = DB::connection('mysql2')->table('notification')
            ->insert([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'content experience/storytelling'
            ]);
        $content = DB::connection('mysql2')->table('contents_experience')
        ->insertGetId([
            'date_heure'=>$current_date->format('Y-m-d H:i:s'),
            'date_update'=>$current_date->format('Y-m-d H:i:s'),
            'description_'=>$desc_content,
            'type'=>'storytelling',
            'id_experience'=>$id_experience
        ]);
        $storytelling = DB::connection('mysql2')->table('storytelling')
        ->insertGetId([
            'id_content_experience'=>$content,
            'description'=>$desc_story,
            'date_creation'=>$current_date->format('Y-m-d H:i:s'),
            'date_update'=>$current_date->format('Y-m-d H:i:s'),
        ]);

        // -----------associer avec le tag selected--------
        foreach ($tags as $tag) {
            DB::connection('mysql2')->table('tag_storytelling')
            ->insertGetId([
                'id_storytelling'=>	$storytelling,
                'id_tag_story'=>	$tag,
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
                'id_storytelling'=>	$storytelling,
                'id_tag_story'=>	$tagId,
            ]);
        }
        // ---------------

        return redirect()->route('contacts.show',['contact'=>$id_contact])
        ->with('success','Storytelling créé avec succes');
    }

    // -----------------yasser : destroyStorytelling------------------------
    public function destroyStorytelling($story,$contact)
    {

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris')); //first argument "must" be a string
        $current_date->setTimestamp($timestamp); //adjust the object to correct timestamp
        $notif_text = 'Suppression du storytelling de ID ' . $story . ' et du content experience associé le ' .  $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
        ->insertGetId([
            'contenu_notification' => $notif_text,
            'date_notification' => $current_date->format('Y-m-d H:i:s'),
            'type' => 'content experience/storytelling'
        ]);

        // --------------suppression des tags ----------
        DB::connection('mysql2')->table('tag_storytelling')
        ->where('id_storytelling', $story)
        ->delete();
        // --------------suppression des tags ----------
        $storytelling = DB::connection('mysql2')->table('storytelling')
        ->where('id_storytelling','=',$story)
        ->first();

        $id_content = $storytelling->id_content_experience;

        $storytelling = DB::connection('mysql2')->table('storytelling')
        ->where('id_storytelling','=',$story)
        ->delete();

        $content = DB::connection('mysql2')->table('contents_experience')
        ->where('id_content_experience','=',$id_content)
        ->delete();

        return redirect()->route('contacts.show',['contact'=>$contact])
        ->with('success','');
    }

    public function createCodeParrain(Request $request) {

        $request->validate([
            'id_remise'=>'required|exists:mysql2.remise,id_remise',
            'code'=>'required',
            'nb_utilisation' => 'required|numeric|integer'
        ]);


        $id_coupon = DB::connection('mysql2')
                        ->select('SELECT remise.id_stripe_remise AS id FROM remise WHERE remise.id_remise ='.$request->id_remise);

        //dd($id_coupon);

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris')); //first argument "must" be a string
        $current_date->setTimestamp($timestamp); //adjust the object to correct timestamp
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
        //dd($code);
        $code = substr($code,26);

        $code = json_decode($code,true);

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris')); //first argument "must" be a string
        $current_date->setTimestamp($timestamp); //adjust the object to correct timestamp
        $notif_text = ' Mise à jour liée à stripe du code promo de ID ' . $cod->id_code . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
        ->insertGetId([
            'contenu_notification' => $notif_text,
            'date_notification' => $current_date->format('Y-m-d H:i:s'),
            'type' => 'code promo'
        ]);

        DB::connection('mysql2')
            ->update('UPDATE codes_promo SET codes_promo.code="'.$code['code'].'", codes_promo.id_stripe_code="'.$code['id'].'", codes_promo.url_stripe_code="https://dashboard.stripe.com/test/promotion_codes/'.$code['id'].'",codes_promo.date_update="' . $current_date->format('Y-m-d H:i:s') . '" WHERE codes_promo.id_code='.$cod->id_code.'');

            $id_code = $cod->id_code;

            DB::connection('mysql2')
                ->table('parrainage')
                ->insert([
                    'id_code' => $id_code
                ]);

          return redirect()->route('codespromo.show',['id_remise'=>$cod->id_code])
            ->with('success', 'Le code promo a bien été ajouté');
    }

    public function deleteSelect(Request $request){
        $ids = $request->input('contacts');
        DB::connection('mysql2')->table('contact')->whereIn('id_contact', $ids)->delete();
        return redirect()->route('contacts.index')->with('success','Selection supprimée avec succes');
        }

}
