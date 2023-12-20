<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use App\Models\experienceApp\Contact;
use App\Models\experienceApp\Interaction;
use App\Models\experienceApp\Intervenant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use PHPUnit\TextUI\XmlConfiguration\Group;

class IntervenantController extends Controller
{

    //  Une fois on depasse 5 lignes par tableau Ca d'affiche
    public function index(Request $request)
    {
        $intervenant = new Intervenant;
        $intervenant->setConnection('mysql2');

        $perPage = $request->get('perPage') ?? 10; // par défaut 10 éléments par page

        $data = DB::connection('mysql2')->table('intervenant')
            ->join('contact', 'contact.id_contact', '=', 'intervenant.id_contact')
            // ------------yasser-------------
            ->select('intervenant.*', 'contact.*')
            ->selectRaw('intervenant.date_creation as intervenant_date_creation, contact.date_creation as contact_date_creation')
            ->orderByDesc('intervenant.id_contact')
            // ------------yasser-------------        
            ->paginate($perPage);

        // ----------------------------21.06.23------------------------------
        $multisearchnom = $request->get('multisearchnom');
        $multisearchtel = $request->get('multisearchtel');
        $multisearchprenom = $request->get('multisearchprenom');
        $multisearchremise = $request->get('multisearchremise');
        $multisearchrole = $request->get('multisearchrole');

        if (isset($multisearchnom) || isset($multisearchtel) || isset($multisearchprenom) || isset($multisearchremise) || isset($multisearchrole)) {
            $data = DB::connection('mysql2')->table('intervenant')
                ->join('contact', 'contact.id_contact', '=', 'intervenant.id_contact')
                ->select('intervenant.*', 'contact.*')
                ->selectRaw('intervenant.date_creation as intervenant_date_creation, contact.date_creation as contact_date_creation')
                ->orderByDesc('intervenant.id_contact')
                ->where('intervenant.role_', '=', $multisearchrole)
                ->paginate($perPage);
        }

        $liste_role =  DB::connection('mysql2')->table('intervenant')
            ->select('role_')
            ->distinct()
            ->get();
        // ----------------------------21.06.23------------------------------


        $con_notif = DB::connection('mysql2')->table('contact_notification')->get();

        $totalIntervenant = $data->total();
        return view('intervenants.index', compact('data', 'perPage', 'con_notif', 'totalIntervenant', 'liste_role'))
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
        $id_con = Contact::get()->pluck('id_contact')->toArray();
        $nom_con =  Contact::get()->pluck('nom')->toArray();
        return view('intervenants.create', compact('id_con', 'nom_con'));
    }

    // Processus de creation
    public function store(Request $request)
    {
        $request->validate([

            'id_cnt' => 'nullable|exists:mysql2.contact,id_contact',
            'role',
            'Nom' => 'required_without:id_cnt',
            'Prénom' => 'required_without:id_cnt',
            'mail' => ['nullable', 'required_without_all:id_cnt,tel', 'email', Rule::unique('mysql2.contact', 'email')],
            'tel' => ['nullable', 'required_without_all:id_cnt,mail', 'numeric', 'digits:10', Rule::unique('mysql2.contact', 'tel')],
            'adress',
            'cp' => 'nullable|numeric|digits_between:3,5',
            'ville',
            'tarif_fixe' => 'nullable|numeric',
            'tarif_horaire' => 'nullable|numeric'
        ]);
        $intervenant = "";
        if (is_null($request->id_cnt)) {
            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
            $current_date->setTimestamp($timestamp);
            $notif_text = 'Creation d\'un nouveau contact le ' .  $current_date->format('Y-m-d H:i:s') . '';

            $notification = DB::connection('mysql2')->table('notification')
                ->insertGetId([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'contact'
                ]);

            $con = Contact::create([
                'nom' => $request->Nom,
                'prenom' => $request->Prénom,
                'mail' => $request->mail,
                'tel' => $request->tel,
                'adresse' => $request->adress,
                'CP' => $request->cp,
                'ville' => $request->ville,
                'date_creation' => $current_date->format('Y-m-d H:i:s'),
                'date_update' => $current_date->format('Y-m-d H:i:s')
            ]);

            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
            $current_date->setTimestamp($timestamp);
            $notif_text = 'Creation d\'un nouveau intervenant associé au contact de ID ' . $con->id . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

            $notification = DB::connection('mysql2')->table('notification')
                ->insertGetId([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'intervenant'
                ]);

            $int = DB::connection('mysql2')->insert("INSERT INTO intervenant( ville_intervention, role_, id_contact, date_creation, date_update) VALUES (?,?,?,?,?)", [$request->ville, $request->role, $con->id, $current_date->format('Y-m-d H:i:s'), $current_date->format('Y-m-d H:i:s')]);
            $intervenant = DB::connection('mysql2')->selectOne('SELECT MAX(id_intervenant_) as id_intervenant FROM intervenant')->id_intervenant;
        } else {

            $con = DB::connection('mysql2')->selectOne('SELECT * FROM contact WHERE id_contact=?', [$request->id_cnt]);
            $count = DB::connection('mysql2')->selectOne('SELECT COUNT(id_contact) as cnt FROM intervenant WHERE id_contact=?', [$con->id_contact]);

            if ($count->cnt == 0) {
                $timestamp = time();
                $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
                $current_date->setTimestamp($timestamp);
                $notif_text = 'Creation d\'un nouveau intervenant associé au contact de ID ' . $con->id_contact . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

                $notification = DB::connection('mysql2')->table('notification')
                    ->insertGetId([
                        'contenu_notification' => $notif_text,
                        'date_notification' => $current_date->format('Y-m-d H:i:s'),
                        'type' => 'intervenant'
                    ]);

                $int = DB::connection('mysql2')->insert("INSERT INTO intervenant( ville_intervention, role_, id_contact, date_creation, date_update) VALUES (?,?,?,?,?)", [$request->ville, $request->role, $con->id_contact, $current_date->format('Y-m-d H:i:s'), $current_date->format('Y-m-d H:i:s')]);
                $intervenant = DB::connection('mysql2')->selectOne('SELECT MAX(id_intervenant_) as id_intervenant FROM intervenant')->id_intervenant;
            } else {
                return redirect()->route('intervenants.index')
                    ->with('error', 'Erreur lors de l\'ajout de l\'intervenant');
            }
        }

        return redirect()->route('intervenants.show', ["id_intervenant_" => $intervenant])
            ->with('success', 'Intervenant ajouté avec succes');
    }

    // Direction vers le view de details du groupe
    public function show(Request $request, $intervenant)
    {

        $modelintervenant = new Intervenant;
        $modelintervenant->setConnection('mysql2');

        $id_par = DB::connection('mysql2')->select('SELECT id_intervenant_ FROM intervenant');

        $url1 = (int) $intervenant;
        $url = $url1;

        foreach ($id_par as $key => $value) {
            if ($url1 === $value->id_intervenant_) {
                $url = $url1;
            }
        }


        $con = DB::connection('mysql2')->selectOne('SELECT  contact.id_contact,contact.tel,contact.nom,contact.prenom,contact.email,contact.adresse,contact.code_postal,contact.ville,id_intervenant_
        FROM contact JOIN intervenant
        ON intervenant.id_contact=contact.id_contact
        WHERE intervenant.id_intervenant_=?', [$url]);



        $id_con = $con->id_contact;
        $descript = DB::connection('mysql2')
            ->table('intervenant')
            ->where('id_contact', $id_con)
            ->first()->description;

        $con_entreprise = DB::connection('mysql2')->selectOne('SELECT  contact_entreprise.type,organisation.num_cse,intervenant.role_
        FROM contact JOIN intervenant
        JOIN contact_entreprise ON contact.id_contact = IFNULL(contact_entreprise.id_contact, "none")
        JOIN organisation ON IFNULL(contact_entreprise.id_organisation, "none") = IFNULL(organisation.id_organisation, "none")
        AND intervenant.id_contact=contact.id_contact
        WHERE intervenant.id_intervenant_=?', [$url]);




        $prof = DB::connection('mysql2')->selectOne('SELECT contact_experience.profil
        FROM contact
        JOIN contact_experience ON contact.id_contact = contact_experience.id_contact
        WHERE contact.id_contact=?', [$id_con]);

        if (!is_null($prof)) {
            $profil = $prof->profil;
        } else {
            $profil = "";
        }

        $interactions = DB::connection('mysql2')->select('SELECT interaction.id_interaction,interaction.date_heure,interaction.texte,interaction.type_interaction,interaction.id_contact
        FROM interaction JOIN contact
        ON interaction.id_contact=contact.id_contact
        WHERE contact.id_contact=?
        ORDER BY interaction.date_heure DESC', [$id_con]);

        $nb_fact = DB::connection('mysql2')->selectOne('SELECT COUNT(*) as facts
        FROM contact JOIN paiement JOIN factures
        ON paiement.num_facture=factures.num_facture
        AND paiement.id_contact=contact.id_contact
        WHERE contact.id_contact=?', [$id_con]);


        $total_exp = DB::connection('mysql2')->selectOne('SELECT COUNT(*) as exp
        FROM contact JOIN contact_experience JOIN experience
        ON contact_experience.id_contact=contact.id_contact
        AND contact_experience.id_experience=experience.id_experience
        WHERE contact.id_contact=?
        AND (contact_experience.profil="Client" OR contact_experience.profil="Client-User")', [$id_con]);


        $exp_vecu = DB::connection('mysql2')->selectOne('SELECT COUNT(*) as exp
       FROM contact JOIN contact_experience JOIN experience
       ON contact_experience.id_contact=contact.id_contact
       AND contact_experience.id_experience=experience.id_experience
       WHERE contact.id_contact=?
       AND (contact_experience.profil="User" OR contact_experience.profil="Client-User")', [$id_con]);

        $experiences = DB::connection('mysql2')->select('SELECT  contact_experience.id_contact, experience.id_experience, experience.nom_experience, contact_experience.profil,factures.num_facture,pack_experience.id_pack_experience,experience_statut.statut_experience,experience.numero_experience,factures.prix_facture
        FROM contact_experience JOIN experience JOIN pack_experience JOIN factures
        JOIN (
            SELECT id_experience, MAX(id_statut_experience) AS id_statut_experience
            FROM experience_statut_notification
            GROUP BY id_experience) AS exp_stat_notif ON pack_experience.id_experience = exp_stat_notif.id_experience
        JOIN experience_statut ON experience_statut.id_statut_experience=exp_stat_notif.id_statut_experience
        AND contact_experience.id_experience=experience.id_experience
        AND experience.id_experience=pack_experience.id_experience
        AND pack_experience.num_facture=factures.num_facture
        WHERE contact_experience.id_contact=?  ', [$id_con]);

        $entreprise = DB::connection('mysql2')->selectOne('SELECT organisation.id_organisation,organisation.nom,organisation.email,organisation.adresse,organisation.code_postal,organisation.ville,organisation.num_cse,organisation.description,organisation.tel
        FROM organisation JOIN contact_entreprise JOIN contact
        ON organisation.id_organisation=contact_entreprise.id_organisation
        AND contact_entreprise.id_contact=contact.id_contact
        WHERE contact.id_contact=?', [$id_con]);

        $storytelling = DB::connection('mysql2')->select('SELECT storytelling.id_storytelling, storytelling.description, contents_experience.date_heure 
        FROM storytelling JOIN contents_experience JOIN experience JOIN contact_experience
        ON storytelling.id_content_experience=contents_experience.id_content_experience
        AND contents_experience.id_experience=experience.id_experience
        AND contact_experience.id_experience=experience.id_experience
        WHERE contact_experience.id_contact=?
        ORDER BY contents_experience.date_heure DESC', [$id_con]);

        $id_exps = [];

        foreach ($experiences as $exp) {
            array_push($id_exps, $exp->id_experience);
        }

        $exps = implode(',', $id_exps);

        if (empty($exps)) {
            $contacts_liees = [];
        } else {
            $contacts_liees = DB::connection('mysql2')->select('SELECT DISTINCT contact.id_contact,contact.nom,contact.prenom
            FROM contact 
            JOIN contact_experience ON contact_experience.id_contact = contact.id_contact
            WHERE contact_experience.id_experience IN (' . $exps . ')');
        }

        // -------------------------------------yasser--------------------------------------------------
        // ----------tags_interaction--------------
        $les_tags_lier_avec_inter = DB::connection('mysql2')->table('tag_interaction')
            ->join('interaction_tag', 'tag_interaction.id_tag_interaction', '=', 'interaction_tag.id_tag_interaction')
            ->orderByDesc('tag_interaction.id_tag_interaction')
            ->get();
        // ----------tags_interaction--------------
        // ----------tags_storytelling--------------
        $les_tags_lier_avec_story = DB::connection('mysql2')->table('tag_story')
            ->join('tag_storytelling', 'tag_story.id_tag_story', '=', 'tag_storytelling.id_tag_story')
            ->orderByDesc('tag_story.id_tag_story')
            ->get();
        // ----------tags_storytelling--------------
        // -------------------------------------yasser--------------------------------------------------


        return view('intervenants.show', compact('con', 'profil', 'interactions', 'nb_fact', 'total_exp', 'exp_vecu', 'experiences', 'entreprise', 'storytelling', 'contacts_liees', 'con_entreprise', 'url', 'descript', 'les_tags_lier_avec_inter', 'les_tags_lier_avec_story'));
    }

    // Direction vers le view de la modification du groupe
    public function edit($intervenant)
    {

        $modelintervenant = new Intervenant;
        $modelintervenant->setConnection('mysql2');

        $id_par = DB::connection('mysql2')->select('SELECT id_intervenant_ FROM intervenant');

        $url1 = (int) $intervenant;
        $url = $url1;

        foreach ($id_par as $key => $value) {
            if ($url1 === $value->id_intervenant_) {
                $url = $url1;
            }
        }


        $con = DB::connection('mysql2')->selectOne('SELECT  contact.id_contact,tel,nom,prenom,email,adresse,code_postal,ville,role_,intervenant.id_intervenant_
        FROM contact JOIN intervenant
        ON intervenant.id_contact=contact.id_contact
        WHERE intervenant.id_intervenant_=?', [$url]);

        //JM fix
        $modelContact = Contact::select('contact.id_contact', 'tel', 'nom', 'prenom', 'email', 'adresse', 'code_postal', 'ville', 'role_', 'intervenant.id_intervenant_')
        ->join('intervenant', 'intervenant.id_contact', '=', 'contact.id_contact')
        ->where('intervenant.id_intervenant_', $url)
        ->firstOrfail();

        $id_con = Contact::get()->pluck('id_contact')->toArray();
        $nom_con =  Contact::get()->pluck('nom')->toArray();
        return view('intervenants.edit', compact('con', 'id_con', 'nom_con', 'url','modelContact'));
    }

    // Processus de modification du groupe
    public function update(Request $request)
    {

        $request->validate([

            'id_cnt' => 'exists:mysql2.contact,id_contact',
            'role',
            'Nom' => 'required',
            'Prénom' => 'required',
            'mail' => ['nullable', 'required_without:tel', 'email', Rule::unique('mysql2.contact', 'email')->ignore($request->id_cnt, 'id_contact')],
            'tel' => ['nullable', 'required_without:mail', 'numeric', 'digits:10', Rule::unique('mysql2.contact', 'tel')->ignore($request->id_cnt, 'id_contact')],
            'adress',
            'cp' => 'nullable|numeric|digits_between:3,5',
            'ville',
            'tarif_fixe' => 'nullable|numeric',
            'tarif_horaire' => 'nullable|numeric'
        ]);
        $id_contact = $request->id_cnt;

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $notif_text = 'Mise à jour du contact de ID ' . $id_contact . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
            ->insertGetId([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'intervenant'
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
                'url_contact_folder' => $request->url_contact_folder,
                'date_update' => $current_date->format('Y-m-d H:i:s')
            ]);

        $con = DB::connection('mysql2')->table('contact')
            ->where('id_contact', $id_contact)
            ->first();



        $int = DB::connection('mysql2')->table('intervenant')
            ->where('id_contact', $id_contact)
            ->update([
                'ville_intervention' => $request->ville,
                'role_' => $request->role,
                'date_update' => $current_date->format('Y-m-d H:i:s')
            ]);

        $intervenant = DB::connection('mysql2')->selectOne('SELECT id_intervenant_ as id_intervenant FROM intervenant WHERE id_contact=?', [$con->id_contact])->id_intervenant;

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $notif_text = 'Mise à jour de l\'intervenant de ID ' . $intervenant . ' associé au contact de ID ' . $con->id_contact . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
            ->insertGetId([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'intervenant'
            ]);

        return redirect()->route('intervenants.show', ["id_intervenant_" => $intervenant])
            ->with('success', 'Mise a jour effectué avec succes');
    }

    // Procesuus de la suppression du groupe
    public function destroy($intervenant)
    {

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $notif_text = 'Suppression de l\'intervenant de ID ' . $intervenant . '  le ' .  $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
            ->insertGetId([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'intervenant'
            ]);

        $int = DB::connection('mysql2')->table('intervenant')
            ->where('id_intervenant_', $intervenant)
            ->delete();

        return redirect()->route('intervenants.index')
            ->with('success', 'Intervenant supprimé avec succes');
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
            'id_intervenant' => 'required|exists:mysql2.intervenant,id_intervenant_',
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
        $id_intervenant = $request->id_intervenant;
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
        return redirect()->route('intervenants.show', ['id_intervenant_' => $id_intervenant])
            ->with('success', 'Interaction créée avec succes');
    }

    public function createStorytelling(Request $request)
    {
        $request->validate([
            'id_exp' => 'required|exists:mysql2.experience,id_experience',
            'id_contact' => 'required|exists:mysql2.contact,id_contact',
            'id_intervenant' => 'required|exists:mysql2.intervenant,id_intervenant_',
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
        $id_intervenant = $request->id_intervenant;
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
                'date_update' => $current_date->format('Y-m-d H:i:s')
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

        return redirect()->route('intervenants.show', ['id_intervenant_' => $id_intervenant])
            ->with('success', 'Storytelling créé avec succes');
    }
    // ---------------------------yasser : destroyInteraction ------------
    public function destroyInteraction($interactionz, $id_partenaire)
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

        return redirect()->route('intervenants.show', ['id_intervenant_' => $id_partenaire])
            ->with('success', '');
    }
    //--------------------------destroyStorytelling-----------------

    public function destroyStorytelling($story, $id_intervenant_)
    {

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
        // --------------suppression des tags ----------
        DB::connection('mysql2')->table('tag_storytelling')
            ->where('id_storytelling', $story)
            ->delete();
        // --------------suppression des tags ----------
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

        return redirect()->route('intervenants.show', ['id_intervenant_' => $id_intervenant_])
            ->with('success', '');
    }
    public function updatedesc(Request $request)
    {
        $request->validate([
            'id_contact' => 'exists:mysql2.contact,id_contact',
            'description'
        ]);

        $id_contact = $request->id_contact;
        $description = $request->description;

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);

        DB::connection('mysql2')->table('intervenant')
            ->where('id_contact', $id_contact)
            ->update([
                'description' => $description,
                'date_update' => $current_date->format('Y-m-d H:i:s')
            ]);

        $intervenant = DB::connection('mysql2')->selectOne('SELECT id_intervenant_ FROM intervenant WHERE id_contact=?', [$id_contact])->id_intervenant_;


        return redirect()->route('intervenants.show', [
            "id_intervenant_" => $intervenant,
            "id_contact" => $id_contact,
        ])
            ->with('success', 'La mise à jour de la description a bien été effectuée');
    }

    public function deleteSelect(Request $request)
    {
        $ids = $request->input('intervenants');
        DB::connection('mysql2')->table('intervenant')->whereIn('id_intervenant_', $ids)->delete();
        return redirect()->route('intervenants.index')->with('success', 'Selection supprimée avec succes');
    }
}
