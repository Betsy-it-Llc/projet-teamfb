<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use App\Models\experienceApp\Contact;
use App\Models\experienceApp\Interaction;
use App\Models\experienceApp\Partenaire;
use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use PHPUnit\TextUI\XmlConfiguration\Group;

class PartenaireController extends Controller
{

    //  Une fois on depasse 5 lignes par tableau Ca d'affiche
    public function index(Request $request)
    {
        $partenaire = new Partenaire;
        $partenaire->setConnection('mysql2');

        $perPage = $request->get('perPage') ?? 10; // par défaut 10 éléments par page

        $data = DB::connection('mysql2')->table('partenaire')
            ->join('contact', 'contact.id_contact', '=', 'partenaire.id_contact')
            // ------------yasser-------------
            ->select('partenaire.*', 'contact.*')
            ->selectRaw('partenaire.date_creation as partenaire_date_creation, contact.date_creation as contact_date_creation')
            ->orderByDesc('partenaire.id_contact')
            // ------------yasser-------------   
            ->paginate($perPage);
        // ----------------------------21.06.23------------------------------
        $multisearchnom = $request->get('multisearchnom');
        $multisearchtel = $request->get('multisearchtel');
        $multisearchprenom = $request->get('multisearchprenom');
        $multisearchremise = $request->get('multisearchremise');
        $multisearchtype = $request->get('multisearchtype');

        if (isset($multisearchnom) || isset($multisearchtel) || isset($multisearchprenom) || isset($multisearchremise) || isset($multisearchtype)) {
            $data = DB::connection('mysql2')->table('partenaire')
                ->join('contact', 'contact.id_contact', '=', 'partenaire.id_contact')
                ->select('partenaire.*', 'contact.*')
                ->selectRaw('partenaire.date_creation as partenaire_date_creation, contact.date_creation as contact_date_creation')
                ->orderByDesc('partenaire.id_contact')
                ->where('partenaire.type', '=', $multisearchtype)
                ->paginate($perPage);
        }

        $liste_type =  DB::connection('mysql2')->table('partenaire')
            ->select('type')
            ->distinct()
            ->get();
        // ----------------------------21.06.23------------------------------

        $con_notif = DB::connection('mysql2')->table('contact_notification')->get();


        $totalPartenaire = $data->total();
        return view('partenaires.index', compact('data', 'perPage', 'con_notif', 'totalPartenaire', 'liste_type'))
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
        $id_org = Entreprise::where('id_organisation', '>', 0)->pluck('id_organisation')->toArray();
        $nom_org =  Entreprise::where('id_organisation', '>', 0)->pluck('nom')->toArray();

        return view('partenaires.create', compact('id_con', 'nom_con', 'id_org', 'nom_org'));
    }

    // Processus de creation
    public function store(Request $request)
    {
        $request->validate([

            'id_cnt' => 'nullable|exists:mysql2.contact,id_contact',
            'Nom' => 'required_without:id_cnt',
            'Prénom' => 'required_without:id_cnt',
            'mail' => ['nullable', 'required_without_all:id_cnt,tel', 'email', Rule::unique('mysql2.contact', 'email')],
            'tel' => ['nullable', 'required_without_all:id_cnt,mail', 'numeric', 'digits:10', Rule::unique('mysql2.contact', 'tel')],
            'adress',
            'cp' => 'nullable|numeric|digits_between:3,5',
            'ville',
            'fonction',
            'entreprise' => 'nullable|exists:mysql2.organisation,id_organisation',
            'type',
        ]);

        $partenaire = "";

        if (is_null($request->id_cnt)) {

            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
            $current_date->setTimestamp($timestamp);
            $notif_text = 'Création d\'un nouveau contact le ' .  $current_date->format('Y-m-d H:i:s') . '';

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
                'date_update' => $current_date->format('Y-m-d H:i:s'),
            ]);
            $org = DB::connection('mysql2')->insert("INSERT INTO contact_entreprise (id_contact, type, id_organisation) VALUES (?,?,?)", [$con->id, $request->type, $request->entreprise]);

            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
            $current_date->setTimestamp($timestamp);
            $notif_text = 'Création d\'un nouveau partenaire associé au contact de ID ' . $con->id . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

            $notification = DB::connection('mysql2')->table('notification')
                ->insertGetId([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'partenaire'
                ]);

            $part = DB::connection('mysql2')->insert("INSERT INTO partenaire(fonction, type, id_contact, date_creation, date_update) VALUES (?,?,?,?,?)", [$request->fonction, $request->type, $con->id, $current_date->format('Y-m-d H:i:s'), $current_date->format('Y-m-d H:i:s')]);

            $partenaire = DB::connection('mysql2')->selectOne('SELECT MAX(id_partenaire) as id_partenaire FROM partenaire')->id_partenaire;
        } else {

            $con = DB::connection('mysql2')->selectOne('SELECT * FROM contact WHERE id_contact=?', [$request->id_cnt]);
            $count = DB::connection('mysql2')->selectOne('SELECT COUNT(id_contact) as cnt FROM partenaire WHERE id_contact=?', [$con->id_contact]);

            if ($count->cnt == 0) {

                $timestamp = time();
                $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
                $current_date->setTimestamp($timestamp);
                $notif_text = 'Création d\'un nouveau partenaire associé au contact de ID ' . $con->id_contact . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

                $notification = DB::connection('mysql2')->table('notification')
                    ->insertGetId([
                        'contenu_notification' => $notif_text,
                        'date_notification' => $current_date->format('Y-m-d H:i:s'),
                        'type' => 'partenaire'
                    ]);

                $part = DB::connection('mysql2')->insert("INSERT INTO partenaire( fonction, type, id_contact, date_creation,date_update) VALUES (?,?,?,?,?)", [$request->fonction, $request->type, $con->id_contact, $current_date->format('Y-m-d H:i:s'), $current_date->format('Y-m-d H:i:s')]);
                $partenaire = DB::connection('mysql2')->selectOne('SELECT MAX(id_partenaire) as id_partenaire FROM partenaire')->id_partenaire;
            } else {
                return redirect()->route('partenaires.index')
                    ->with('error', 'Erreur lors de l\'ajout du partenaire');
            }
        }
        return redirect()->route('partenaires.show', ['id_partenaire' => $partenaire])
            ->with('success', 'Partenaire ajouté avec succes');
    }

    // Direction vers le view de details du groupe
    public function show(Request $request, $partenaire)
    {

        $modelpartenaire = new Partenaire;
        $modelpartenaire->setConnection('mysql2');

        $id_par = DB::connection('mysql2')->select('SELECT id_partenaire FROM partenaire');


        $url1 = (int) $partenaire;
        $url = $url1;

        foreach ($id_par as $key => $value) {
            if ($url1 === $value->id_partenaire) {
                $url = $url1;
            }
        }


        $con = DB::connection('mysql2')->selectOne('SELECT  contact.id_contact,contact.tel,contact.nom,contact.prenom,contact.email,contact.adresse,contact.code_postal,contact.ville,partenaire.type,partenaire.fonction,partenaire.id_partenaire,contact.description
        FROM contact JOIN partenaire
        ON partenaire.id_contact=contact.id_contact
        WHERE partenaire.id_partenaire=?', [$url]);



        $id_con = $con->id_contact;
        $description = DB::connection('mysql2')
            ->table('partenaire')
            ->where('id_contact', $id_con)
            ->value('description');
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

        $experiences = DB::connection('mysql2')->select('SELECT  contact_experience.id_contact, experience.id_experience, experience.nom_experience, contact_experience.profil,factures.num_facture,pack_experience.id_pack_experience,experience_statut.statut_experience,experience.numero_experience
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

        $storytelling = DB::connection('mysql2')->select('SELECT  storytelling.id_storytelling, storytelling.description, contents_experience.date_heure 
        FROM storytelling JOIN contents_experience JOIN experience JOIN contact_experience
        ON storytelling.id_content_experience=contents_experience.id_content_experience
        AND contents_experience.id_experience=experience.id_experience
        AND contact_experience.id_experience=experience.id_experience
        WHERE contact_experience.id_contact=?
        ORDER BY contents_experience.date_heure DESC', [$id_con]);

        $idremises = DB::connection('mysql2')->select('SELECT DISTINCT remise.id_remise
        FROM contact JOIN parrainage JOIN codes_promo JOIN remise JOIN factures_remise
        JOIN(
            SELECT factures_remise.id_remise, COUNT(*) AS numRemises
            FROM factures_remise
            GROUP BY factures_remise.id_remise) cRem ON cRem.id_remise = factures_remise.id_remise
        
        AND parrainage.id_parrainage=contact.id_parrainage
        AND parrainage.id_code=codes_promo.id_code
        AND codes_promo.id_remise=remise.id_remise
        AND factures_remise.id_remise=remise.id_remise
        WHERE contact.id_contact=?', [$id_con]);

        $id_rem = [];

        foreach ($idremises as $rem) {
            array_push($id_rem, $rem->id_remise);
        }

        $rems = implode(',', $id_rem);

        $codes = DB::connection('mysql2')->select('SELECT DISTINCT remise.id_remise,remise.nom_remise,remise.type_remise,remise.taux,remise.montant,remise.date_debut,remise.date_fin,codes_promo.code,codes_promo.nb_utilisation,cRem.numRemises
        FROM codes_promo JOIN remise JOIN factures_remise
        JOIN(
            SELECT factures_remise.id_remise, COUNT(*) AS numRemises
            FROM factures_remise
            GROUP BY factures_remise.id_remise) cRem ON cRem.id_remise = factures_remise.id_remise
        AND codes_promo.id_remise=remise.id_remise
        AND factures_remise.id_remise=remise.id_remise
        WHERE remise.id_remise IN (?)', [$rems]);

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

        return view('partenaires.show', compact('con', 'interactions', 'nb_fact', 'total_exp', 'exp_vecu', 'experiences', 'entreprise', 'storytelling', 'codes', 'url', 'description', 'les_tags_lier_avec_story', 'les_tags_lier_avec_inter'));
    }

    // Direction vers le view de la modification du groupe
    public function edit($partenaire)
    {
        $modelpartenaire = new Partenaire;
        $modelpartenaire->setConnection('mysql2');

        $id_par = DB::connection('mysql2')->select('SELECT id_partenaire FROM partenaire');

        $url1 = (int) $partenaire;
        $url = $url1;

        foreach ($id_par as $key => $value) {
            if ($url1 === $value->id_partenaire) {
                $url = $url1;
            }
        }
        $con = DB::connection('mysql2')->selectOne('SELECT  contact.id_contact,contact.tel,contact.nom,contact.prenom,contact.email,contact.adresse,contact.code_postal,contact.ville,partenaire.type,partenaire.fonction
        FROM contact JOIN partenaire
        ON partenaire.id_contact=contact.id_contact
        WHERE partenaire.id_partenaire=?', [$url]);

        //JM fix destiné au composant livewire dans la vue
        $modelContact = Contact::join('partenaire', 'partenaire.id_contact', '=', 'contact.id_contact')
        ->where('partenaire.id_partenaire', $url)
        ->firstOrfail();

        $id_con = Contact::get()->pluck('id_contact')->toArray();
        $nom_con =  Contact::get()->pluck('nom')->toArray();

        $org = DB::connection('mysql2')->selectOne('SELECT contact_entreprise.type,contact_entreprise.id_organisation
        FROM contact_entreprise
        JOIN contact ON contact.id_contact = contact_entreprise.id_contact
        WHERE contact.id_contact=?', [$url]);

        $nom_org =  Entreprise::where('id_organisation', '>', 0)->pluck('nom')->toArray();
        $id_org = Entreprise::where('id_organisation', '>', 0)->pluck('id_organisation')->toArray();

        return view('partenaires.edit', compact('con', 'id_con', 'nom_con', 'nom_org', 'id_org','modelContact'));
    }

    // Processus de modification du groupe
    public function update(Request $request)
    {

        $request->validate([

            'id_cnt' => 'exists:mysql2.contact,id_contact',
            'Nom' => 'required_without:id_cnt',
            'Prénom' => 'required_without:id_cnt',
            'mail' => ['nullable', 'required_without:tel', 'email', Rule::unique('mysql2.contact', 'email')->ignore($request->id_cnt, 'id_contact')],
            'tel' => ['nullable', 'required_without:mail', 'numeric', 'digits:10', Rule::unique('mysql2.contact', 'tel')->ignore($request->id_cnt, 'id_contact')],
            'adress',
            'cp' => 'nullable|numeric|digits_between:3,5',
            'ville',
            'fonction',
            'entreprise' => 'nullable|exists:mysql2.organisation,id_organisation',
            'type',
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
                'url_contact_folder' => $request->url_contact_folder,
                'date_update' => $current_date->format('Y-m-d H:i:s')
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

        $part = DB::connection('mysql2')->table('partenaire')
            ->where('id_contact', $id_contact)
            ->update([
                'fonction' => $request->fonction,
                'type' => $request->type,
                'date_update' => $current_date->format('Y-m-d H:i:s')
            ]);

        $pertenaire = DB::connection('mysql2')->selectOne('SELECT id_partenaire FROM partenaire WHERE id_contact=?', [$con->id_contact])->id_partenaire;

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $notif_text = 'Mise à jour du partenaire de ID ' . $pertenaire . ' associé au contact de ID ' . $id_contact . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
            ->insertGetId([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'partenaire'
            ]);

        return redirect()->route('partenaires.show', ["id_partenaire" => $pertenaire])
            ->with('success', 'La mise a jour a bien été effectuée');
    }

    // Procesuus de la suppression du groupe
    public function destroy($partenaire)
    {

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $notif_text = 'Mise à jour du partenaire de ID ' . $partenaire . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
            ->insertGetId([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'partenaire'
            ]);

        $part = DB::connection('mysql2')->table('partenaire')
            ->where('id_partenaire', $partenaire)
            ->delete();
        return redirect()->route('partenaires.index')
            ->with('success', 'Partenaire supprimé avec succes');
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
            'id_partenaire' => 'required|exists:mysql2.partenaire,id_partenaire',
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
        $id_partenaire = $request->id_partenaire;
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

        return redirect()->route('partenaires.show', ['id_partenaire' => $id_partenaire])
            ->with('success', 'Interaction créée avec succes');
    }

    public function createStorytelling(Request $request)
    {
        $request->validate([
            'id_exp' => 'required|exists:mysql2.experience,id_experience',
            'id_contact' => 'required|exists:mysql2.contact,id_contact',
            'id_partenaire' => 'required|exists:mysql2.partenaire,id_partenaire',
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
        $id_partenaire = $request->id_partenaire;
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
        return redirect()->route('partenaires.show', ['id_partenaire' => $id_partenaire])
            ->with('success', 'Storytelling créé avec succes');
    }
    // ---------------yasser---------------
    // destroyInteraction
    public function destroyInteraction($interactionz, $id_partenaire)
    {
        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
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

        return redirect()->route('partenaires.show', ['id_partenaire' => $id_partenaire])
            ->with('success', '');
    }
    //--------------------------destroyStorytelling-----------------

    public function destroyStorytelling($story, $id_partenaire)
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

        return redirect()->route('entreprises.show', ['id_partenaire' => $id_partenaire])
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

        DB::connection('mysql2')->table('partenaire')
            ->where('id_contact', $id_contact)
            ->update([
                'description' => $description,
                'date_update' => $current_date->format('Y-m-d H:i:s')
            ]);

        $partenaire = DB::connection('mysql2')->selectOne('SELECT id_partenaire FROM partenaire WHERE id_contact=?', [$id_contact])->id_partenaire;

        return redirect()->route('partenaires.show', [
            "id_partenaire" => $partenaire,
            "id_contact" => $id_contact,
        ])
            ->with('success', 'La mise à jour de la description a bien été effectuée');
    }

    public function deleteSelect(Request $request)
    {
        $ids = $request->input('partenaires');
        DB::connection('mysql2')->table('partenaire')->whereIn('id_partenaire', $ids)->delete();
        return redirect()->route('partenaires.index')->with('success', 'Selection supprimée avec succes');
    }
}
