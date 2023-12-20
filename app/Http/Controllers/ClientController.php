<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use App\Models\Client;
use Stripe\StripeClient;
use App\Models\Entreprise;
use App\Models\Partenaire;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use App\Models\ContactExperience;
use Illuminate\Support\Facades\DB;
use App\Models\ContactNotification;
use Google_Service_Drive_DriveFile;
use App\Models\experienceApp\Contact;
use App\Models\experienceApp\Paiement;
use App\Models\experienceApp\Codepromo;
use App\Models\experienceApp\Interaction;
use App\Models\experienceApp\ContactCodePromo;


class clientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Création d'une nouvelle instance de Client et définition de la connexion à utiliser
        $client = new Client;
        $client->setConnection('mysql2');

        // Définition du nombre d'éléments par page, par défaut à 10 si non spécifié
        $perPage = $request->get('perPage') ?? 10;

        // Requête de base pour récupérer les contacts distincts
        $query = Contact::select('contact.id_contact', 'contact.tel', 'contact.nom', 'contact.prenom', 'contact.email', 'contact.adresse', 'contact.code_postal', 'contact.ville', 'contact.url_client_stripe', 'contact_experience.profil', 'contact_experience.id_experience')
        ->leftJoin('contact_experience', 'contact.id_contact', '=', 'contact_experience.id_contact')
        ->whereIn('contact_experience.profil', ['Client', 'Client-User', 'User'])
        ->orWhere(function ($query) {
            $query->whereExists(function ($query) {
                $query->from('paiement')
                    ->whereColumn('paiement.id_contact', 'contact.id_contact')
                    ->where('paiement.statut_paiement', '=', 'Payé');
            })
            ->orWhereNull('contact_experience.id_contact');
        })
        ->orderByDesc('contact.date_creation')
        ->get();

        // Récupération de toutes les notifications de contact
        $con_notif = ContactNotification::get();

        // Stockage de la valeur 'id_contact' dans la session
        $value = session('id_contact');

        $profil = $request->get('profil');
        $periode = $request->get('periode');

        $query = Contact::select('contact.id_contact', 'contact.tel', 'contact.nom', 'contact.prenom', 'contact.email', 'contact.adresse', 'contact.code_postal', 'contact.ville', 'contact.url_client_stripe', 'contact_experience.profil', 'contact_experience.id_experience') // Ajout de la colonne "profil" et "id_experience"
            ->leftJoin('contact_experience', 'contact.id_contact', '=', 'contact_experience.id_contact');

        // Conditions pour la période
        if ($periode == 'semaine') {
            $query->whereBetween('contact.date_creation', [Carbon::now()->subWeek(), Carbon::now()]);
        } elseif ($periode == 'mois') {
            $query->whereBetween('contact.date_creation', [Carbon::now()->subMonth(), Carbon::now()]);
        } elseif ($periode == 'trimestre') {
            $query->whereBetween('contact.date_creation', [Carbon::now()->subQuarter(), Carbon::now()]);
        } elseif ($periode == 'annee') {
            $query->whereBetween('contact.date_creation', [Carbon::now()->subYear(), Carbon::now()]);
        }

        // Filtrer par profil
        if ($profil) {
            $query->where('contact_experience.profil', $profil);
        }

        $data = $query->orderByDesc('contact.date_creation')->paginate($perPage);
        $data_counter = $query->paginate(10000);

        $query->orderBy('contact.id_contact', 'DESC');

        if ($profil == 'intervenant') {
            // Requête pour le profil "Intervenant"
            $query = DB::connection('mysql2')
                ->table('intervenant')
                ->select('intervenant.*', 'contact.tel', 'contact.nom', 'contact.prenom', 'contact.email', 'contact.adresse', 'contact.code_postal', 'contact.ville', 'contact.url_contact_folder', 'contact.id_client_stripe', 'contact.url_client_stripe', 'contact_experience.profil', 'contact_experience.id_experience')
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
            $query = Partenaire::leftJoin('contact', 'partenaire.id_contact', '=', 'contact.id_contact')
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
        
            // Exécutez la requête
            $results = $query->get();

        } elseif ($profil == 'prospect') {
            // Requête pour le profil "Prospect"
            $query = Contact::select('contact.*', 'contact_experience.profil', 'contact_experience.id_experience')
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

            // Exécutez la requête
            $data = $query->paginate($perPage);
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


        } elseif ($profil == 'client') {
            // Requête pour le profil "Client"
            $query = ContactExperience::join('contact', 'contact_experience.id_contact', '=', 'contact.id_contact')
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
        
            // Exécutez la requête
            $data = $query->groupBy('contact.id_contact')->paginate($perPage);
            $data_counter = $query->paginate(10000);
        
        
        } elseif ($profil == 'client-user') {
            // Requête pour le profil "Client"
            $query = ContactExperience::join('contact', 'contact_experience.id_contact', '=', 'contact.id_contact')
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
        
            // Exécutez la requête
            $data = $query->groupBy('contact.id_contact')->paginate($perPage);
            $data_counter = $query->paginate(10000);
        }

        $data_counter = $query->paginate(10000);
        $data = $query->paginate($perPage);

        // Réinitialisation des compteurs
        $count_intervenant = 0;
        $count_partenaire = 0;
        $count_prospect = 0;
        $count_client = 0;
        $count_exp = 0;
        $count_client_exp = 0;

        // Calcul des compteurs en fonction des résultats
        foreach ($data_counter as $item) {
            if (isset($item->id_intervenant_)) {
                $count_intervenant++;
            } elseif (isset($item->id_partenaire)) {
                $count_partenaire++;
            } elseif (isset($item->profil) && $item->profil == 'Client') {
                $count_client++;
            } elseif (isset($item->profil) && $item->profil == 'User') {
                $count_exp++;
            } elseif (isset($item->profil) && $item->profil == 'Client-User') {
                $count_client_exp++;
            } else {
                $count_prospect++;
            }
        }

        // Récupération de la liste des profils distincts
        $liste_profile = ContactExperience::distinct()
        ->pluck('profil');
//////////////requêtes auparavant en "DB" changés en eloquent par JM jusqu'ici/////////////
        // Total des contacts
        $totalCount = $data->total();

        return view(
            'clients.index',
            compact(
                'data',
                'perPage',
                'con_notif',
                'totalCount',
                'liste_profile',
                'count_intervenant',
                'count_partenaire',
                'count_prospect',
                'count_client',
                'count_exp',
                'count_client_exp',
                'profil' // Ajout de la variable profil
            )
        )->with('i', ($request->input('page', 1) - 1) * 5);
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Initialisation : Si l'id_contact est fourni dans la requête
        if (isset($request->id_contact)) {
            // On l'insère dans la table 'contact' de la base de données
            DB::connection('mysql2')->table('contact')->insert(
                ['id_contact' => $request->id_contact,]
            );
        } else {
            // Si aucun contact n'est fourni, un message d'erreur est affiché
            echo "Pas de contact";
        }

        //Insertion des données du client dans la table contact
        DB::connection('mysql2')->table('contact')->insert(
            [
                'nom' => $request->nom, 'prenom' => $request->prenom, 'tel' => $request->tel, 'email' => $request->email,
                'adresse' => $request->adresse, 'ville' => $request->ville, 'code_postale' => $request->code_postale
            ]
        );

        // Liaison du contact avec son experience dans la table contact_experience
        DB::connection('mysql2')->table('contact_experience')->insert(
            ['id_experience' => $request->id_experience, 'id_contact' => $request->id_contact, 'type' => $request->type]
        );
        // Redirection vers la page d'index des clients avec un message de succès
        return redirect()->route('clients.index')
            ->with('success', '');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id_contact)
    {
        $client = new Client;
        $client->setConnection('mysql2');

        // Récupération des expériences
        $id_exp = DB::connection('mysql2')->select('SELECT id_contact FROM contact_experience');

        // Récupération de l'id du contact dont on verra les informations
        $url1 = (int) $id_contact;
        // Ilham
        $url = $url1;
        //Ilham

        // foreach ($id_exp as $key => $value) {

        //     if ($url1 === $value->id_contact) {

        //         $url = $url1;

        //     }}

        if (!isset($url)) {
            return redirect()->route('clients.index');
        }

        // Récupération des donnée du contact
        // $con = DB::connection('mysql2')->selectOne('SELECT  contact.id_contact,contact.tel,contact.nom,contact.prenom,contact.email,contact.adresse,contact.code_postal,contact.ville,contact_entreprise.type,organisation.num_cse,contact_experience.profil,contact_experience.personna,contact.url_contact_folder
        // FROM contact
        // LEFT JOIN contact_entreprise ON contact.id_contact = IFNULL(contact_entreprise.id_contact, "none")
        // LEFT JOIN organisation ON IFNULL(contact_entreprise.id_organisation, "none") = IFNULL(organisation.id_organisation, "none")
        // JOIN contact_experience ON contact.id_contact = contact_experience.id_contact
        // WHERE contact.id_contact=?
        // ORDER BY contact.date_creation DESC', [$url]);
        //Ilham
        $con = DB::connection('mysql2')->selectOne('SELECT  contact.id_contact,contact.tel,contact.nom,contact.prenom,contact.email,contact.adresse,contact.code_postal,contact.ville,contact_entreprise.type,organisation.num_cse,contact_experience.profil,contact_experience.personna, contact.url_contact_folder,persona.tag
        FROM contact JOIN contact_experience
        LEFT JOIN contact_persona ON contact.id_contact=IFNULL(contact_persona.id_contact,"none")
        LEFT JOIN persona ON persona.id_persona=IFNULL(contact_persona.id_persona,"none")
        LEFT JOIN contact_entreprise ON contact.id_contact = IFNULL(contact_entreprise.id_contact, "none")
        LEFT JOIN organisation ON IFNULL(contact_entreprise.id_organisation, "none") = IFNULL(organisation.id_organisation, "none")
        AND contact.id_contact = contact_experience.id_contact
        WHERE contact.id_contact=? AND contact_experience.profil IN ("User","Client-User")', [$url]);
        //Ilham


        // recupération des tags personas
        $personas = DB::connection('mysql2')->select('SELECT  persona.tag
        FROM contact 
        LEFT JOIN contact_persona ON contact.id_contact=IFNULL(contact_persona.id_contact,"none")
        LEFT JOIN persona ON persona.id_persona=IFNULL(contact_persona.id_persona,"none")
        WHERE contact.id_contact=?  ', [$url]);


        // Récupération des intéractions liées au contact
        $interactions = DB::connection('mysql2')->select('SELECT interaction.id_interaction,interaction.date_heure,interaction.texte,interaction.type_interaction,interaction.id_contact
        FROM interaction JOIN contact
        ON interaction.id_contact=contact.id_contact
        WHERE contact.id_contact=?
        ORDER BY interaction.date_heure DESC', [$url]);

        // Récupération des events liées au contact
        // $evenements = DB::connection('mysql2')->select(
        // 'SELECT contact_notification.date_creation,notification.contenu_notification
        // FROM contact JOIN contact_notification JOIN notification
        // ON contact.id_contact=contact_notification.id_contact
        // AND notification.id_notification=contact_notification.id_notification
        // WHERE contact.id_contact=?
        // ORDER BY contact_notification.date_creation DESC',
        //     [$url]
        // );
        //Ilham
        $evenements = DB::connection('mysql2')->select('SELECT contact_notification.date_creation,notification.contenu_notification
        FROM contact JOIN contact_notification JOIN notification
        ON contact.id_contact=contact_notification.id_contact
        AND notification.id_notification=contact_notification.id_notification
        WHERE contact.id_contact=?', [$url]);
        //Ilham

        // Récupération du nombre de paiement lié au contact
        $nb_fact = DB::connection('mysql2')->selectOne('SELECT COUNT(*) as facts
        FROM contact JOIN paiement JOIN factures
        ON paiement.num_facture=factures.num_facture
        AND paiement.id_contact=contact.id_contact
        WHERE contact.id_contact=?', [$url]);

        // Récupération des expériences liées au contact
        $total_exp = DB::connection('mysql2')->selectOne('SELECT COUNT(*) as exp
        FROM contact JOIN contact_experience JOIN experience
        ON contact_experience.id_contact=contact.id_contact
        AND contact_experience.id_experience=experience.id_experience
        WHERE contact.id_contact=?
        AND (contact_experience.profil="Client" OR contact_experience.profil="Client-User")', [$url]);


        $exp_vecu = DB::connection('mysql2')->selectOne('SELECT COUNT(*) as exp
        FROM contact JOIN contact_experience JOIN experience
        ON contact_experience.id_contact=contact.id_contact
        AND contact_experience.id_experience=experience.id_experience
        WHERE contact.id_contact=?
        AND (contact_experience.profil="User" OR contact_experience.profil="Client-User")', [$url]);

        // Récupération des storys liées au contact
        $storytelling = DB::connection('mysql2')->select('SELECT storytelling.id_storytelling,storytelling.description, contents_experience.date_heure
        FROM storytelling JOIN contents_experience JOIN experience JOIN contact_experience
        ON storytelling.id_content_experience=contents_experience.id_content_experience
        AND contents_experience.id_experience=experience.id_experience
        AND contact_experience.id_experience=experience.id_experience
        WHERE contact_experience.id_contact=?
        ORDER BY contents_experience.date_heure DESC', [$url]);




        $experiences = DB::connection('mysql2')->select('SELECT  contact_experience.id_contact, experience.id_experience,contact_experience.profil,factures.num_facture,pack_experience.id_pack_experience,experience_statut.statut_experience,experience.numero_experience,experience.nom_experience
        FROM contact_experience JOIN experience JOIN pack_experience JOIN factures
        JOIN (
            SELECT id_experience, date_statut, MAX(id_statut_experience) AS id_statut_experience
            FROM experience_statut_notification
            GROUP BY id_experience) AS exp_stat_notif ON pack_experience.id_experience = exp_stat_notif.id_experience
        JOIN experience_statut ON experience_statut.id_statut_experience=exp_stat_notif.id_statut_experience
        AND contact_experience.id_experience=experience.id_experience
        AND experience.id_experience=pack_experience.id_experience
        AND pack_experience.num_facture=factures.num_facture
        WHERE contact_experience.id_contact=?  ', [$url]);
        //Ilham
        // $id_exps = [];

        // foreach ($experiences as $exp) {
        //     array_push($id_exps, $exp->id_experience);
        // }

        // $exps = implode(',', $id_exps);
        // $contacts_liees = DB::connection('mysql2')->select('SELECT contact.id_contact,contact.nom,contact.prenom
        // FROM contact
        // LEFT JOIN contact_experience ON IFNULL(contact_experience.id_contact, "none") = contact.id_contact
        // WHERE contact_experience.id_experience IN (?) ', [$exps]);
        //Ilham

        // Liste des statuts des expérience
        $listePaye = ["Paye"];
        $listeEnregistre = ["Enregistré", "Speech"];
        $listeCommence = ["Pré-Expérience", "Record date", "Livraison"];
        $listeTermine = ["Succes"];

        $paye = 0;
        $enregistre = 0;
        $commence = 0;
        $termine = 0;

        // Pour chaque experience on va mettre a jour le count de chaque statut
        foreach ($experiences as $exp) {
            $stat = $exp->statut_experience;
            if (in_array($stat, $listePaye)) {
                $paye++;
            } elseif (in_array($stat, $listeEnregistre)) {
                $enregistre++;
            } elseif (in_array($stat, $listeCommence)) {
                $commence++;
            } elseif (in_array($stat, $listeTermine)) {
                $termine++;
            }
        }

        // Récupération des factures liées ou contact
        $factures = DB::connection('mysql2')->select('SELECT factures.num_facture,factures.prix_facture,facture_statut.statut_facture,fac_stat_notif.date_statut
        FROM factures JOIN facture_statut JOIN paiement
        JOIN (
            SELECT num_facture, MAX(id_facture_statut) AS id_facture_statut,date_statut
            FROM facture_statut_notification
            GROUP BY num_facture) AS fac_stat_notif ON factures.num_facture = fac_stat_notif.num_facture
        AND paiement.num_facture=factures.num_facture
        AND fac_stat_notif.id_facture_statut=facture_statut.id_facture_statut
        WHERE paiement.id_contact=?
        GROUP BY factures.num_facture', [$url]);

        // Récupération des paiement liées au contact
        $paiements = DB::connection('mysql2')->select('SELECT factures.num_facture,paiement.id_paiment,paiement.prix,paiement.statut_paiement,paiement.date_echeance
        FROM factures JOIN paiement
        ON paiement.num_facture=factures.num_facture
        WHERE paiement.id_contact=?', [$url]);

        // Récupération de l'entreprise liée au contact
        $entreprise = DB::connection('mysql2')->table('contact')
            ->join('contact_entreprise', 'contact.id_contact', '=', 'contact_entreprise.id_contact')
            ->join('organisation', 'organisation.id_organisation', '=', 'contact_entreprise.id_organisation')
            ->where('contact.id_contact', $url)
            ->first();
        //ILHAM
        // $entreprise = DB::connection('mysql2')->selectOne('SELECT organisation.id_organisation,organisation.nom,organisation.email,organisation.adresse,organisation.code_postal,organisation.ville,organisation.num_cse,organisation.description,organisation.tel
        // FROM organisation JOIN contact_entreprise JOIN contact
        // ON organisation.id_organisation=contact_entreprise.id_organisation
        // AND contact_entreprise.id_contact=contact.id_contact
        // WHERE contact.id_contact=?', [$url]);
        //ILHAM

        // Récupération des remises
        $remises = DB::connection('mysql2')->table('remise')->get();

        // -------------------------------------yasser---------------------------------
        // ----------tags_interaction--------------
        $les_tags_lier_avec_inter = DB::connection('mysql2')->table('tag_interaction')
            ->join('interaction_tag', 'tag_interaction.id_tag_interaction', '=', 'interaction_tag.id_tag_interaction')
            ->orderByDesc('tag_interaction.id_tag_interaction')
            // ->groupBy('tag_interaction.tag')
            ->get();

        // ----------tags_interaction--------------
        // ----------tags_storytelling--------------
        $les_tags_lier_avec_story = DB::connection('mysql2')->table('tag_story')
            ->join('tag_storytelling', 'tag_story.id_tag_story', '=', 'tag_storytelling.id_tag_story')
            ->orderByDesc('tag_story.id_tag_story')
            ->get();

        // ----------tags_storytelling--------------
        // -------------------------------------yasser--------------------------------------------------
        //Redirection vers la paeg show
        return view('clients.show', compact(
            'con',
            'id_contact',
            'interactions',
            'evenements',
            'nb_fact',
            'total_exp',
            'exp_vecu',
            'storytelling',
            'experiences',
            'paye',
            'enregistre',
            'commence',
            'termine',
            'factures',
            'paiements',
            'entreprise',
            'remises',
            'les_tags_lier_avec_inter',
            'les_tags_lier_avec_story',
            'personas'
        ));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id_contact)
    {

        $modelcontact = new Contact;
        $modelcontact->setConnection('mysql2');

        $id_con = DB::connection('mysql2')->select('SELECT id_contact FROM contact');

        $url1 = (int) $id_contact;
        $url = $url1;

        foreach ($id_con as $key => $value) {
            if ($url1 === $value->id_contact) {
                $url = $url1;
            }
        }

        // Récupération du contact a modifier
        $con = DB::connection('mysql2')->select('SELECT id_contact,tel,nom,prenom,email,adresse,code_postal,ville,url_contact_folder
        from contact
        WHERE id_contact=?
        ORDER BY contact.date_creation DESC', [$url]);

        // Récupération de l'entreprise liée au contact
        $org = DB::connection('mysql2')->selectOne('SELECT contact_entreprise.type,contact_entreprise.id_organisation
        FROM contact_entreprise
        JOIN contact ON contact.id_contact = contact_entreprise.id_contact
        WHERE contact.id_contact=?', [$url]);

        $nom_org =  Entreprise::where('id_organisation', '>', 1)->pluck('nom')->toArray();
        $id_org = Entreprise::where('id_organisation', '>', 1)->pluck('id_organisation')->toArray();

        return view('clients.edit', compact('con', 'nom_org', 'id_org', 'org'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_contact)
    {
        //Validation des données de la requete d'update
        $request->validate([
            'avatar',
            'Nom' => 'required',
            'Prénom' => 'required',
            'mail' => ['nullable', 'required_without:tel', 'email', Rule::unique('mysql2.contact', 'email')->ignore($id_contact, 'id_contact')],
            'tel' => ['nullable', 'numeric', 'digits:10', Rule::unique('mysql2.contact', 'tel')->ignore($id_contact, 'id_contact'), 'required_without:mail'],
            'adress',
            'cp' => 'nullable|numeric|digits_between:3,5',
            'ville',
            'url',
            'entreprise' => 'nullable|exists:mysql2.organisation,id_organisation',
            'type'
        ]);


        // Mise en place des informations de la notification de mise a jour
        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $notif_text = 'Mise à jour du contact de ID ' . $id_contact . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

        // Insertion de la notification dans la table notification
        $notification = DB::connection('mysql2')->table('notification')
            ->insert([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'contact'
            ]);

        // Mise a jour des données du contact
        $con = DB::connection('mysql2')->table('contact')
            ->where('id_contact', $id_contact)
            ->update([
                'nom' => $request->Nom,
                'prenom' => $request->Prénom,
                'email' => $request->mail,
                'tel' => $request->tel,
                'adresse' => $request->adress,
                'code_postal' => $request->cp,
                'ville' => $request->ville,
                'url_contact_folder' => $request->url,
                'date_update' => $current_date->format('Y-m-d H:i:s'),
            ]);
        // Récupéraiton de id_contact + donnée de contact_entreprise
        $con = DB::connection('mysql2')->table('contact')
            ->where('id_contact', $id_contact)
            ->first();
        $entreprise_con = DB::connection('mysql2')->table('contact_entreprise')
            ->where('id_contact', $con->id_contact)
            ->first();

        // Si le contact n'est pas lié a une entreprise et que la requete renvoie des données d'entreprise
        if (is_null($entreprise_con)) {
            if (!is_null($request->entreprise)) {
                // Mise en place de notification pour la liaison du contact a l'entreprise
                $timestamp = time();
                $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
                $current_date->setTimestamp($timestamp);
                $notif_text = 'Creation d\'un nouveau contact_entreprise liée au contact de ID ' . $con->id_contact . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';
                $notification = DB::connection('mysql2')->table('notification')
                    ->insert([
                        'contenu_notification' => $notif_text,
                        'date_notification' => $current_date->format('Y-m-d H:i:s'),
                        'type' => 'contact entreprise'
                    ]);

                //Insertion du contact dans la table contact_entreprise
                //$org = DB::connection('mysql2')->insert("INSERT INTO contact_entreprise (id_contact, type, id_organisation) VALUES (?,?,?)", [$con->id_contact, $request->type, $request->entreprise]);
                /***************************************************Oumayma*********************************************************** */
                $org = DB::connection('mysql2')->insert("INSERT INTO contact_entreprise (id_contact, type, id_organisation)
                VALUES (?,?,?)
                WHERE id_organisation > 0", [$con->id_contact, $request->type, $request->entreprise]);
            }
        } else {
            // Sinon si le contact est déja lié a une entreprise
            if (!is_null($request->entreprise)) {
                // Mise a jour du contact dans la table contact_entreprise
                $org = DB::connection('mysql2')->table('contact_entreprise')
                    ->where('id_contact', $con->id_contact)
                    ->update([
                        'type' => $request->type,
                        'id_organisation' => $request->entreprise
                    ]);
                $org = DB::connection('mysql2')->table('contact_entreprise')->where('id_contact', $con->id_contact)->first();

                // Mise en place de la notification de maj du contact de l'entreprise
                $timestamp = time();
                $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
                $current_date->setTimestamp($timestamp);
                $notif_text = 'Mise à jour du contact_entreprise de ID ' . $entreprise_con->id_organisation . ' liée au contact de ID ' . $con->id_contact . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';
                $notification = DB::connection('mysql2')->table('notification')
                    ->insert([
                        'contenu_notification' => $notif_text,
                        'date_notification' => $current_date->format('Y-m-d H:i:s'),
                        'type' => 'contact entreprise'
                    ]);
            } else {


                // Sinon on supprime les données du contact dans contact_entreprise + notification de suppresion
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

                $org = DB::connection('mysql2')->table('contact_entreprise')
                    ->where('id_contact', $con->id_contact)
                    ->delete();
            }
        }
        // Update du client dans Stripe
        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );

        $client = $stripe->customers->update(
            $con->id_client_stripe,
            [
                'address' => [
                    'line1' => $request->adress,
                    'postal_code' => $request->cp,
                    'city' => $request->ville,
                ],
                'phone' => $request->tel,
                'email' => $request->mail,
                'name' => $request->Prénom . ' ' . $request->Nom,
                'metadata' =>
                [
                    'id_contact' => $con->id_contact,
                    'type' => $request->type,
                    'id_organisation' => $request->id_organisation
                ]
            ]
        );

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

        if (($con->url_contact_folder != null) && ($con->url_contact_folder != "")) {
            $id_folder = substr($con->url_contact_folder, 43);
            $fileMetadata = new Google_Service_Drive_DriveFile([
                'name' => $con->id_contact . ' - ' . $con->nom . ' ' . $con->prenom,
                'mimeType' => 'application/vnd.google-apps.folder'
            ]);
            // dd($id_folder);
            $drive->files->update($id_folder, $fileMetadata, ['fields' => 'id,name']);
        }

        //Redirection vers la page du client modifié
        return redirect()->route('clients.show', ['id_contact' => $con->id_contact])
            ->with('success', 'La mise a jour a bien été réalisée');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_contact, $id_experience)
    {
        // Récupérations des donénes de facture,expérience et paiement liées au contact
        $pack_experience = DB::connection('mysql2')->table('pack_experience')
            ->where('id_experience', $id_experience)
            ->first();

        $facture = $pack_experience->num_facture;

        $fact = DB::connection('mysql2')->table('factures')
            ->where('num_facture', $facture)
            ->get();

        //Vérification des paiement du contact
        $verifpaiementscon = DB::connection('mysql2')->table('paiement')
            ->where('num_facture', $facture)
            ->where('statut_paiement', 'Payé')
            ->where('id_contact', $id_contact)
            ->get();
        if (!$verifpaiementscon->isEmpty()) {
            return redirect()->route('clients.index')
                ->with('error', 'Erreur lors de la suppression');
        } else {
            $verifpayements = DB::connection('mysql2')->table('paiement')
                ->where('num_facture', $facture)
                ->where('statut_paiement', 'Payé')
                ->first();
            if (is_null($verifpayements)) {
                //théoriquement impossible car l'experience dévrait être crée lors du prémier payement
                return redirect()->route('clients.index')
                    ->with('error', '');
            } else {
                $new_client = $verifpayements->id_contact;

                $timestamp = time();
                $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
                $current_date->setTimestamp($timestamp);
                $notif_text = ' Mise à jour des paiements du client de ID ' . $id_contact . ' pour les assigner au client de id ' . $new_client . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

                $notification = DB::connection('mysql2')->table('notification')
                    ->insert([
                        'contenu_notification' => $notif_text,
                        'date_notification' => $current_date->format('Y-m-d H:i:s'),
                        'type' => 'paiement'
                    ]);

                $paiements = DB::connection('mysql2')->table('paiement')
                    ->where('num_facture', $facture)
                    ->where('id_contact', $id_contact)
                    ->update([
                        'id_contact' => $new_client,
                        'date_update' => $current_date->format('Y-m-d H:i:s'),
                    ]);


                $timestamp = time();
                $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
                $current_date->setTimestamp($timestamp);
                $notif_text = 'Suppression du contact_experience associé au client de ID ' . $id_contact . ' et à l\'experience de ID ' . $id_experience . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

                $notification = DB::connection('mysql2')->table('notification')
                    ->insert([
                        'contenu_notification' => $notif_text,
                        'date_notification' => $current_date->format('Y-m-d H:i:s'),
                        'type' => 'contact experience'
                    ]);

                $con_experience = DB::connection('mysql2')->table('contact_experience')
                    ->where('id_contact', $id_contact)
                    ->where('id_experience', $id_experience)
                    ->delete();

                return redirect()->route('clients.index')
                    ->with('success', 'Le client a bien été supprimé');
            }

            return redirect()->route('reservationclient.index')
                ->with('success', '');
        }


        return redirect()->route('clients.index')
            ->with('success', '');
    }

    public function createInteraction(Request $request)
    {
        $request->validate([
            'id_exp' => 'nullable|exists:mysql2.experience,id_experience',
            'id_contact' => 'required|exists:mysql2.contact,id_contact',
            // 'type_int',
            'texte' => 'required',
            // --------------------
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
        // -------------------yasser---------------------------
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

        // -------------------yasser---------------------------

        $id_experience = $request->id_exp;
        $id_contact = $request->id_contact;
        $texte = $request->texte;

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        if (is_null($id_experience)) {
            $notif_text = 'Creation d\'une nouvelle interaction associé au contact de ID ' . $id_contact . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';
        } else {
            $notif_text = 'Creation d\'une nouvelle interaction associé à l\'experience de ID ' . $id_experience . ' et au contact de ID ' . $id_contact . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';
        }


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
                'id_contact' => $id_contact,
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
        return redirect()->route('clients.show', ['id_contact' => $id_contact])
            ->with('success', 'Interaction ajoutée avec succes');
    }

    public function createStorytelling(Request $request)
    {
        $request->validate([
            'id_exp' => 'required|exists:mysql2.experience,id_experience',
            'id_contact' => 'required|exists:mysql2.contact,id_contact',
            'desc_content',
            'desc_story' => 'required',
            // ------
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

        // -----------------yasser------------------
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
        // -----------------yasser------------------


        $id_experience = $request->id_exp;
        $id_contact = $request->id_contact;
        $desc_content = $request->desc_content;
        $desc_story = $request->desc_story;


        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
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
        // dd($nouveau_tags);
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

        return redirect()->route('clients.show', ['id_contact' => $id_contact])
            ->with('success', 'Storytelling créé avec succes');
    }
    // --------------------------------------------------------------------
    public function destroyInteraction($interactionz, $id_contact)
    {
        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris')); //first argument "must" be a string
        $current_date->setTimestamp($timestamp); //adjust the object to correct timestamp
        $notif_text = 'Suppression de l\'interaction ID ' . $interactionz . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';
        //$prix_paiement=((double) $facture->prix_facture)/((double) $request->nb_paiements);

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

        return redirect()->route('clients.show', ['id_contact' => $id_contact])
            ->with('success', '');
    }
    // -------------------------destroyStorytelling----------------------
    public function destroyStorytelling($story, $id_contact)
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

        return redirect()->route('clients.show', ['id_contact' => $id_contact])
            ->with('success', '');
    }

    public function createCodeParrain(Request $request, $contact)
    {
        $this->validateRequest($request);

        $id_coupon = $this->getIdCoupon($request->id_remise);

        $current_date = $this->getCurrentDate();

        $notif_text = $this->createNotification($current_date);

        $notificationId = $this->insertNotification($notif_text, $current_date);

        $cod = $this->createCodePromo($request, $current_date);

        $stripe_code = $this->createStripeCode($id_coupon[0]->id, $request, $cod);

        $this->updatePromoCodeInDatabase($stripe_code, $current_date, $cod->id_code);

        $url = (int) $contact;

        $this->createPivotContactCodePromo($cod->id_code, $url);

        $id_code = $cod->id_code;

        DB::connection('mysql2')
            ->table('parrainage')
            ->insert([
                'id_code' => $id_code
            ]);

        return redirect()->route('codespromo.show', ['id_code' => $cod->id_code])
            ->with('success', 'Le code promo a bien été ajouté');
    }
    // creation d'un code promo
    public function createCode(Request $request, $contact)
    {
        $this->validateRequest($request);


        $id_coupon = $this->getIdCoupon($request->id_remise);

        $current_date = $this->getCurrentDate();

        $notif_text = $this->createNotification($current_date);

        $notificationId = $this->insertNotification($notif_text, $current_date);

        $cod = $this->createCodePromo($request, $current_date);

        $stripe_code = $this->createStripeCode($id_coupon[0]->id, $request, $cod);

        $this->updatePromoCodeInDatabase($stripe_code, $current_date, $cod->id_code);

        $url = (int) $contact;
        //dd($contact,$url,$cod->id_code);

        $this->createPivotContactCodePromo($cod->id_code, $url);
        //dd($this->updatePivotInDatabase($cod->id_code,$url));

        return redirect()->route('codespromo.show', ['id_code' => $cod->id_code])
            ->with('success', 'Le code promo a bien été ajouté');
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'id_remise' => 'required|exists:mysql2.remise,id_remise',
            'code' => 'required',
            'nb_utilisation' => 'required|numeric|integer'
        ]);
    }

    private function getIdCoupon($id_remise)
    {
        return DB::connection('mysql2')
            ->select('SELECT remise.id_stripe_remise AS id FROM remise WHERE remise.id_remise =' . $id_remise);
    }

    private function getCurrentDate()
    {
        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        return $current_date;
    }

    private function createNotification($current_date)
    {
        return ' Creation d\'un nouvel code promo le ' . $current_date->format('Y-m-d H:i:s') . '';
    }

    private function insertNotification($notif_text, $current_date)
    {
        return DB::connection('mysql2')->table('notification')
            ->insertGetId([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i;s'),
                'type' => 'code promo'
            ]);
    }

    private function createCodePromo(Request $request, $current_date)
    {
        return Codepromo::create([
            'id_remise' => $request->id_remise,
            'code' => $request->code,
            'nb_utilisation' => $request->nb_utilisation,
            'nb_code' => 0,
            'date_creation' => $current_date->format('Y-m-d H:i;s'),
            'date_update' => $current_date->format('Y-m-d H:i;s'),
        ]);
    }

    private function createStripeCode($id_coupon, $request, $cod)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET'));

        $stripe_code = $stripe->promotionCodes->create([
            'coupon' => $id_coupon,
            'code' => $request->code,
            'max_redemptions' => $request->nb_utilisation,
            'metadata' => [
                'id_code' => $cod->id_code,
                'id_remise' => $request->id_remise
            ]
        ]);

        return $stripe_code;
    }

    private function updatePromoCodeInDatabase($code, $current_date, $id_code)
    {
        DB::connection('mysql2')->update('
        UPDATE codes_promo
        SET code = ?,
            id_stripe_code = ?,
            url_stripe_code = ?,
            date_update = ?
        WHERE id_code = ?', [
            $code['code'],
            $code['id'],
            'https://dashboard.stripe.com/test/promotion_codes/' . $code['id'],
            $current_date->format('Y-m-d H:i:s'),
            $id_code
        ]);
    }
    private function updatePivotInDatabase($id_code, $contact)
    {
        DB::connection('mysql2')->update('
        UPDATE contact_code_promo
        SET id_contact = ?
        WHERE id_code = ?', [$contact, $id_code]);
    }
    private function createPivotContactCodePromo($id_code, $id_contact)
    {
        return ContactCodePromo::create([
            'id_code' => $id_code,
            'id_contact' => $id_contact,
        ]);
    }

    public function deleteSelect(Request $request)
    {
        $ids = $request->input('clients');
        DB::connection('mysql2')->table('contact')->whereIn('id_contact', $ids)->delete();

        return redirect()->route('clients.index')->with('success', 'Selection supprimée avec succes');
    }
}
