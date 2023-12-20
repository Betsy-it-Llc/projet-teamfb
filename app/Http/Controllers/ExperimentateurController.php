<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use App\Models\experienceApp\Contact;
use App\Models\Entreprise;
use App\Models\experienceApp\Interaction;
use Illuminate\Http\Request;
use App\Models\Experimentateur;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use PHPUnit\TextUI\XmlConfiguration\Group;

class ExperimentateurController extends Controller
{

    //  Une fois on depasse 5 lignes par tableau Ca d'affiche
    public function index(Request $request)
    {
        $experimentateur = new Experimentateur;
        $experimentateur->setConnection('mysql2');

        $perPage = $request->get('perPage') ?? 10; // par défaut 10 éléments par page


        $data = DB::connection('mysql2')->table('contact')
            ->join('contact_experience', 'contact_experience.id_contact', '=', 'contact.id_contact')
            ->join('experience', 'experience.id_experience', '=', 'contact_experience.id_experience')
            ->whereIn('contact_experience.profil', ["User", "Client-User"])
            ->paginate($perPage);



        $con_notif = DB::connection('mysql2')->table('contact_notification')->get();

        // ----------------------------21.06.23--------------------------------------------
        $multisearchnom = $request->get('multisearchnom');
        $multisearchtel = $request->get('multisearchtel');
        $multisearchprenom = $request->get('multisearchprenom');
        $multisearchmail = $request->get('multisearchmail');
        $multisearchstat = $request->get('multisearchstat');

        if (isset($multisearchnom) || isset($multisearchtel) || isset($multisearchprenom) || isset($multisearchmail) || isset($multisearchstat)) {
            $data = DB::connection('mysql2')->table('contact')
                ->join('contact_experience', 'contact_experience.id_contact', '=', 'contact.id_contact')
                ->join('experience', 'experience.id_experience', '=', 'contact_experience.id_experience')
                ->whereIn('contact_experience.profil', ["User", "Client-User"])
                ->where('contact_experience.personna', '=', $multisearchstat)
                ->paginate($perPage);
        }

        $liste_personna = DB::connection('mysql2')->table('contact_experience')
            ->select('personna')
            ->distinct()
            ->get();
        // ----------------------------21.06.23--------------------------------------------
        $totalExprmt = $data->total();
        return view('experimentateurs.index', compact('data', 'perPage', 'con_notif', 'totalExprmt', 'liste_personna'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function multisearch(Request $request)
    {

        $multisearchnom = $request->get('multisearchnom');
        $multisearchtel = $request->get('multisearchtel');
        $multisearchprenom = $request->get('multisearchprenom');
        $multisearchmail = $request->get('multisearchmail');
        $multisearchstat = $request->get('multisearchstat');
        $clients = DB::connection('mysql2')->table('contact')

            ->where('mail', 'LIKE', '%' . $multisearchmail . '%')
            ->where('statut', 'LIKE', '%' . $multisearchstat . '%')
            ->where('tel', 'LIKE', '%' . $multisearchtel . '%')
            ->where('prenom', 'LIKE', '%' . $multisearchprenom . '%')
            ->where('nom', 'LIKE', '%' . $multisearchnom . '%')
            ->paginate(20);

        return view('contacts.index', ['contact' => $clients]);
    }

    // Direction view create

    public function create()
    {
        return view('experimentateurs.create');
    }

    // Processus de creation
    public function store(Request $request)
    {
        /**$request->validate([

            'id_contact' => 'required',
            'nom',
            'prenom',
            'tel',
            'mail',
            'statut',
            'num_facture',
            'url_fact_stripe',
            'adresse',
            'CP',
            'ville'
        ]  );

        Contact::create($request->all());

        return redirect()->route('contacts.index')
            ->with('success', '');*/
    }

    // Direction vers le view de details du groupe
    public function show(Request $request, $experimentateur)
    {

        $modelexperimentateur = new Experimentateur;
        $modelexperimentateur->setConnection('mysql2');

        $id_user = DB::connection('mysql2')->select('SELECT id_contact FROM contact_experience');


        $url1 = (int) $experimentateur;
        $url = $url1;

        foreach ($id_user as $key => $value) {
            if ($url1 === $value->id_contact) {
                $url = $url1;
            }
        }

        $con = DB::connection('mysql2')->selectOne('SELECT  contact.id_contact,contact.tel,contact.nom,contact.prenom,contact.email,contact.adresse,contact.code_postal,contact.ville,contact_entreprise.type,organisation.num_cse,contact_experience.profil,contact_experience.personna
        FROM contact JOIN contact_experience
        LEFT JOIN contact_entreprise ON contact.id_contact = IFNULL(contact_entreprise.id_contact, "none")
        LEFT JOIN organisation ON IFNULL(contact_entreprise.id_organisation, "none") = IFNULL(organisation.id_organisation, "none")
        AND contact.id_contact = contact_experience.id_contact
        WHERE contact.id_contact=? AND contact_experience.profil IN ("User","Client-User")', [$url]);


        $evenements = DB::connection('mysql2')->select('SELECT contact_notification.date_creation,notification.contenu_notification
        FROM contact JOIN contact_notification JOIN notification
        ON contact.id_contact=contact_notification.id_contact
        AND notification.id_notification=contact_notification.id_notification
        WHERE contact.id_contact=?', [$url]);

        $nb_fact = DB::connection('mysql2')->selectOne('SELECT COUNT(*) as facts
        FROM contact JOIN paiement JOIN factures
        ON paiement.num_facture=factures.num_facture
        AND paiement.id_contact=contact.id_contact
        WHERE contact.id_contact=?', [$url]);


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

        $interactions = DB::connection('mysql2')->select('SELECT interaction.id_interaction,interaction.date_heure,interaction.texte,interaction.type_interaction,interaction.id_contact
        FROM interaction JOIN contact
        ON interaction.id_contact=contact.id_contact
        WHERE contact.id_contact=?
        ORDER BY interaction.date_heure DESC', [$url]);

        $experiences = DB::connection('mysql2')->select('SELECT  contact_experience.id_contact, experience.id_experience, experience.nom_experience, experience.numero_experience, contact_experience.profil,factures.num_facture,pack_experience.id_pack_experience,experience_statut.statut_experience,exp_stat_notif.date_statut,factures.prix_facture
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

        $storytelling = DB::connection('mysql2')->select('SELECT storytelling.id_storytelling, storytelling.description, contents_experience.date_heure 
        FROM storytelling JOIN contents_experience JOIN experience JOIN contact_experience
        ON storytelling.id_content_experience=contents_experience.id_content_experience
        AND contents_experience.id_experience=experience.id_experience
        AND contact_experience.id_experience=experience.id_experience
        WHERE contact_experience.id_contact=?
        ORDER BY contents_experience.date_heure DESC', [$url]);

        $id_exps = [];

        foreach ($experiences as $exp) {
            array_push($id_exps, $exp->id_experience);
        }

        $exps = implode(',', $id_exps);
        $contacts_liees = DB::connection('mysql2')->select('SELECT contact.id_contact,contact.nom,contact.prenom
        FROM contact 
        LEFT JOIN contact_experience ON IFNULL(contact_experience.id_contact, "none") = contact.id_contact
        WHERE contact_experience.id_experience IN (?) ', [$exps]);


        $entreprise = DB::connection('mysql2')->selectOne('SELECT organisation.id_organisation,organisation.nom,organisation.email,organisation.adresse,organisation.code_postal,organisation.ville,organisation.num_cse,organisation.description,organisation.tel
        FROM organisation JOIN contact_entreprise JOIN contact
        ON organisation.id_organisation=contact_entreprise.id_organisation
        AND contact_entreprise.id_contact=contact.id_contact
        WHERE contact.id_contact=?', [$url]);

        $remises = DB::connection('mysql2')->table('remise')->get();


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
        // ----------tags_storytelling--------------
        // -------------------------------------yasser--------------------------------------------------

        // recupération des tags personas
        $personas = DB::connection('mysql2')->select('SELECT  persona.tag
        FROM contact 
        LEFT JOIN contact_persona ON contact.id_contact=IFNULL(contact_persona.id_contact,"none")
        LEFT JOIN persona ON persona.id_persona=IFNULL(contact_persona.id_persona,"none")
        WHERE contact.id_contact=?  ', [$url]);
        

        return view('experimentateurs.show', compact('con', 'evenements', 'nb_fact', 'total_exp', 'exp_vecu', 'interactions', 'experiences', 'storytelling', 'contacts_liees', 'entreprise', 'remises', 'les_tags_lier_avec_inter', 'les_tags_lier_avec_story','personas'));
    }

    // Direction vers le view de la modification du groupe
    public function edit($id_contact)
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

        $con = DB::connection('mysql2')->select('SELECT id_contact,tel,nom,prenom,email,adresse,code_postal,ville,url_contact_folder
        from contact 
        WHERE id_contact=?', [$url]);

        $org = DB::connection('mysql2')->selectOne('SELECT contact_entreprise.type,contact_entreprise.id_organisation
        FROM contact_entreprise
        JOIN contact ON contact.id_contact = contact_entreprise.id_contact
        WHERE contact.id_contact=?', [$url]);

        $nom_org =  Entreprise::where('id_organisation', '>', 0)->pluck('nom')->toArray();
        $id_org = Entreprise::where('id_organisation', '>', 0)->pluck('id_organisation')->toArray();

        return view('experimentateurs.edit', compact('con', 'nom_org', 'id_org', 'org'));
    }

    // Processus de modification du groupe
    public function update(Request $request, $id_contact)
    {
        //dd($request);
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

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $notif_text = 'Mise à jour du contact de ID ' . $id_contact . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
            ->insert([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'contact'
            ]);

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
                'url_contact_folder' => $request->entreprise,
                'date_update' => $current_date->format('Y-m-d H:i:s'),
            ]);

        $con = DB::connection('mysql2')->table('contact')
            ->where('id_contact', $id_contact)
            ->first();
        $entreprise_con = DB::connection('mysql2')->table('contact_entreprise')
            ->where('id_contact', $con->id_contact)
            ->first();

        if (is_null($entreprise_con)) {
            if (!is_null($request->entreprise)) {
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

                $org = DB::connection('mysql2')->insert("INSERT INTO contact_entreprise (id_contact, type, id_organisation) VALUES (?,?,?)", [$con->id_contact, $request->type, $request->entreprise]);
            }
        } else {
            if (!is_null($request->entreprise)) {

                $org = DB::connection('mysql2')->table('contact_entreprise')
                    ->where('id_contact', $con->id_contact)
                    ->update([
                        'type' => $request->type,
                        'id_organisation' => $request->entreprise
                    ]);
                $org = DB::connection('mysql2')->table('contact_entreprise')->where('id_contact', $con->id_contact)->first();

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



                $timestamp = time();
                $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
                $current_date->setTimestamp($timestamp);
                $notif_text = 'Suppression du contact_entreprise de ID ' . $entreprise_con->id_organisation . ' liée au contact de ID ' . $con->id_contact . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

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

        return redirect()->route('experimentateurs.show', ['id_contact' => $con->id_contact])
            ->with('success', 'La mise a jour a bien été effectuée !');
    }

    // Procesuus de la suppression du groupe
    public function destroy($id_contact, $id_experience)
    {


        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $notif_text = 'Suppression du contact_experience associé à l\'experimentateur de ID ' . $id_contact . ' et à l\'experience de ID ' . $id_experience . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

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


        return redirect()->route('experimentateurs.index')
            ->with('success', 'L\'experimentateur a bien été supprimé ');
    }

    // Procesuus de la suppression plusieur groupe en meme temps
    public function deleteall_g(Request $request)
    {
        // $ids = $request->get('ids');
        // Client::whereIn('id', $ids)->delete();
        // return redirect('clients');
    }
    public function createInteraction(Request $request)
    {
        $request->validate([
            'id_exp' => 'nullable|exists:mysql2.experience,id_experience',
            'id_contact' => 'required|exists:mysql2.contact,id_contact',
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
        $id_experience = $request->id_exp;
        $id_contact = $request->id_contact;
        $type_int = $request->type_int;
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
                'type_interaction' => $type_int,
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
        return redirect()->route('experimentateurs.show', ['id_contact' => $id_contact])
            ->with('success', 'L\'intéraction a bien été ajoutée');
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

        return redirect()->route('experimentateurs.show', ['id_contact' => $id_contact])
            ->with('success', 'Le storytelling a bien été ajouté');
    }

    public function destroyStorytelling($story, $id_contact)
    {
        // dd('test');
        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $notif_text = 'Suppression du storytelling de ID ' . $story . ' et du content experience associé le ' .  $current_date->format('Y-m-d H:i:s') . '';

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
        // --------------suppression des tags ----------
        DB::connection('mysql2')->table('tag_storytelling')
            ->where('id_storytelling', $story)
            ->delete();
        // --------------suppression des tags ----------
        $content = DB::connection('mysql2')->table('contents_experience')
            ->where('id_content_experience', '=', $id_content)
            ->delete();

        return redirect()->route('experimentateurs.show', ['id_contact' => $id_contact])
            ->with('success', 'Le storytelling a bien été supprimé !');
    }

    public function destroyInteraction($interactionz, $id_contact)
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

        return redirect()->route('experimentateurs.show', ['id_contact' => $id_contact])
            ->with('success', 'L\'interaction a bien été supprimée !');
    }

    public function deleteSelect(Request $request)
    {
        $ids = $request->input('experimentateurs');
        DB::connection('mysql2')->table('contact')->whereIn('id_contact', $ids)->delete();

        return redirect()->route('experimentateurs.index')->with('success', 'Selection supprimée avec succes');
    }
}
