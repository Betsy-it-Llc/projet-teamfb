<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use App\Models\Entreprise;
use App\Models\experienceApp\Remise;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;


class EntrepriseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $entreprise = new Entreprise;
        $entreprise->setConnection('mysql2');

        $perPage = $request->get('perPage') ?? 10; // par défaut 10 éléments par page

        $data = DB::connection('mysql2')->table('organisation')->orderByDesc('organisation.id_organisation')->paginate($perPage);

        $value = session('id_organisation');  // Stocker la variable dans la session de la table campagne
        $totalEntreprise = DB::connection('mysql2')->table('organisation')->orderByDesc('organisation.id_organisation')->count();

        return view('entreprises.index', compact('data', 'perPage', 'totalEntreprise'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('entreprises.create');
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
            'avatar',
            'Nom' => 'required',
            'mail' => ['nullable', 'required_without:tel', 'email', 'unique:mysql2.contact,email'],
            'tel' => 'nullable|numeric|digits:10|unique:mysql2.contact,tel|required_without:mail',
            'adress',
            'cp' => 'nullable|numeric|digits_between:3,5',
            'ville',
            'num_cse',
            'description'
        ]);

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris')); //first argument "must" be a string
        $current_date->setTimestamp($timestamp); //adjust the object to correct timestamp
        $notif_text = ' Creation d\'une nouvelle entreprise le ' .  $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
            ->insertGetId([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'entreprise'
            ]);

        $entreprise = Entreprise::create([
            'nom' => $request->Nom,
            'tel' => $request->tel,
            'email' => $request->mail,
            'adresse' => $request->adress,
            'code_postal' => $request->cp,
            'ville' => $request->ville,
            'num_cse' => $request->num_cse,
            'description' => $request->description,
            'date_creation' => $current_date->format('Y-m-d H:i:s'),
            'date_update' => $current_date->format('Y-m-d H:i:s'),
        ]);

        return redirect()->route('entreprises.show', ['id_organisation' => $entreprise->id_organisation])
            ->with('success', 'Entreprise ajoutée avec succes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id_organisation)
    {
        $org = new Entreprise();
        $org->setConnection('mysql2');

        //dump($request);
        $url1 = (int) $id_organisation;
        $url = $url1;

        $id_pack = DB::connection('mysql2')->select('SELECT id_organisation FROM organisation');

        foreach ($id_pack as $key => $value) {
            if ($url1 === $value->id_organisation) {
                $url = $url1;
            }
        }

        $organisation = DB::connection('mysql2')->selectOne('SELECT id_organisation,nom,tel,email,adresse,code_postal,ville,num_cse,description
        FROM organisation
        WHERE id_organisation=?', [$url]);
        //dd($organisation);
        $con = DB::connection('mysql2')->select('SELECT contact.nom,contact.prenom,contact_experience.profil,contact.id_contact
        FROM organisation JOIN contact_entreprise JOIN contact
        JOIN (
                    SELECT id_organisation, MIN(id_contact) AS id_contact,type
                    FROM contact_entreprise
                    GROUP BY id_organisation
                ) AS ce ON organisation.id_organisation = ce.id_organisation
        JOIN contact_experience ON contact_experience.id_contact = contact.id_contact
        AND ce.id_contact=contact.id_contact
        WHERE organisation.id_organisation=?', [$url]);
        // dd($con);
        $remises = DB::connection('mysql2')->select('SELECT DISTINCT remise.id_remise,remise.nom_remise,remise.type_remise,remise.taux,remise.montant,remise.date_debut,remise.date_fin,codes_promo.code,codes_promo.nb_utilisation,cRem.numRemises
        FROM organisation JOIN contact_entreprise JOIN contact JOIN parrainage JOIN codes_promo JOIN remise JOIN factures_remise
        JOIN(
            SELECT factures_remise.id_remise, COUNT(*) AS numRemises
            FROM factures_remise
            GROUP BY factures_remise.id_remise) cRem ON cRem.id_remise = factures_remise.id_remise
        AND organisation.id_organisation=contact_entreprise.id_organisation
        AND contact_entreprise.id_contact=contact.id_contact
        AND parrainage.id_parrainage=contact.id_parrainage
        AND parrainage.id_code=codes_promo.id_code
        AND codes_promo.id_remise=remise.id_remise
        AND factures_remise.id_remise=remise.id_remise
        WHERE organisation.id_organisation=?', [$url]);
        // dd($remises);
        $experiences = DB::connection('mysql2')->select('SELECT  contact_experience.id_contact, experience.id_experience,contact_experience.profil,factures.num_facture,pack_experience.id_pack_experience,experience_statut.statut_experience,experience.numero_experience
        FROM contact_experience JOIN experience JOIN pack_experience JOIN factures JOIN contact_entreprise JOIN contact
        JOIN (
            SELECT id_experience, MAX(id_statut_experience) AS id_statut_experience
            FROM experience_statut_notification
            GROUP BY id_experience) AS exp_stat_notif ON pack_experience.id_experience = exp_stat_notif.id_experience
        JOIN experience_statut ON experience_statut.id_statut_experience=exp_stat_notif.id_statut_experience
        AND contact_experience.id_experience=experience.id_experience
        AND experience.id_experience=pack_experience.id_experience
        AND pack_experience.num_facture=factures.num_facture
        AND contact_entreprise.id_contact=contact.id_contact
        AND contact.id_contact=contact_experience.id_contact
        WHERE contact_entreprise.id_organisation=?  ', [$url]);

        $listePaye = ["Paye"];
        $listeEnregistre = ["Enregistré", "Speech"];
        $listeCommence = ["Pré-Expérience", "Record date", "Livraison"];
        $listeTermine = ["Succes"];

        $paye = 0;
        $enregistre = 0;
        $commence = 0;
        $termine = 0;

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

        $factures = DB::connection('mysql2')->select('SELECT factures.num_facture,factures.prix_facture,facture_statut.statut_facture,fac_stat_notif.date_statut
        FROM factures JOIN facture_statut JOIN paiement JOIN contact JOIN contact_entreprise
        JOIN (
            SELECT num_facture, MAX(id_facture_statut) AS id_facture_statut,date_statut
            FROM facture_statut_notification
            GROUP BY num_facture) AS fac_stat_notif ON factures.num_facture = fac_stat_notif.num_facture
        AND paiement.num_facture=factures.num_facture
        AND fac_stat_notif.id_facture_statut=facture_statut.id_facture_statut
        AND contact.id_contact=paiement.id_contact
        AND contact.id_contact=contact_entreprise.id_contact
        WHERE contact_entreprise.id_organisation=?
        GROUP BY factures.num_facture', [$url]);

        $paiements = DB::connection('mysql2')->select('SELECT factures.num_facture,paiement.id_paiment,paiement.prix,paiement.statut_paiement
        FROM factures JOIN paiement JOIN contact JOIN contact_entreprise
        ON paiement.num_facture=factures.num_facture
        AND paiement.id_contact=contact.id_contact
        AND contact.id_contact=contact_entreprise.id_contact
        WHERE contact_entreprise.id_organisation=?', [$url]);

        $nb_fact = DB::connection('mysql2')->selectOne('SELECT COUNT(*) as facts
        FROM contact JOIN paiement JOIN factures JOIN contact_entreprise
        ON paiement.num_facture=factures.num_facture
        AND paiement.id_contact=contact.id_contact
        AND contact.id_contact=contact_entreprise.id_contact
        WHERE contact_entreprise.id_organisation=?', [$url]);


        $total_exp = DB::connection('mysql2')->selectOne('SELECT COUNT(*) as exp
        FROM contact JOIN contact_experience JOIN experience JOIN contact_entreprise
        ON contact_experience.id_contact=contact.id_contact
        AND contact_experience.id_experience=experience.id_experience
        AND contact.id_contact=contact_entreprise.id_contact
        WHERE contact_entreprise.id_organisation=?
        AND (contact_experience.profil="Client" OR contact_experience.profil="Client-User")', [$url]);


        $exp_vecu = DB::connection('mysql2')->selectOne('SELECT COUNT(*) as exp
        FROM contact JOIN contact_experience JOIN experience JOIN contact_entreprise
        ON contact_experience.id_contact=contact.id_contact
        AND contact_experience.id_experience=experience.id_experience
        AND contact.id_contact=contact_entreprise.id_contact
        WHERE contact_entreprise.id_organisation=?
        AND (contact_experience.profil="User" OR contact_experience.profil="Client-User")', [$url]);

        $storytelling = DB::connection('mysql2')->select('SELECT DISTINCT storytelling.id_storytelling, storytelling.description, contents_experience.date_heure 
        FROM storytelling JOIN contents_experience JOIN experience JOIN contact_experience JOIN contact JOIN contact_entreprise
        ON storytelling.id_content_experience=contents_experience.id_content_experience
        AND contents_experience.id_experience=experience.id_experience
        AND contact_experience.id_experience=experience.id_experience
        AND contact_experience.id_contact=contact.id_contact
        AND contact_entreprise.id_contact=contact.id_contact
        WHERE contact_entreprise.id_organisation=?
        ORDER BY contents_experience.date_heure DESC', [$url]);


        $beneficiaires =  $con = DB::connection('mysql2')->select('SELECT contact.nom,contact.prenom,contact.id_contact,contact.tel,contact.email,contact_experience.profil,cn.date_creation
        FROM organisation JOIN contact_entreprise JOIN contact
        JOIN (
                    SELECT id_notification, MIN(date_creation) AS date_creation,id_contact
                    FROM contact_notification
                    GROUP BY id_contact
                ) AS cn ON cn.id_contact = contact.id_contact

        JOIN contact_experience ON IFNULL(contact_experience.id_contact, "none") = contact.id_contact
        AND contact_entreprise.id_contact=contact.id_contact
        AND organisation.id_organisation = contact_entreprise.id_organisation
        WHERE organisation.id_organisation=?', [$url]);

        $evenements = DB::connection('mysql2')->select('SELECT DISTINCT notification.contenu_notification,notification.date_notification,experience_statut_notification.date_statut
        FROM experience_statut_notification JOIN notification JOIN experience JOIN contact_experience JOIN contact JOIN contact_entreprise
        ON experience_statut_notification.id_notification=notification.id_notification
        AND experience_statut_notification.id_experience=experience.id_experience
        AND experience.id_experience=contact_experience.id_experience
        AND contact.id_contact=contact_experience.id_contact
        AND contact.id_contact=contact_entreprise.id_contact
        WHERE contact_entreprise.id_organisation=?
        ORDER BY experience_statut_notification.date_statut
        ', [$url]);
        // ---------------yasser----------------
        $contact_principal = DB::connection('mysql2')
            ->select('SELECT contact.id_contact, contact.nom, contact.prenom 
                FROM  contact_entreprise
                JOIN contact
                ON contact_entreprise.id_contact =contact.id_contact 
                WHERE contact_entreprise.id_organisation = ?
        ', [$url]);

        $rem_org_liee = DB::connection('mysql2')->table('organisation')
            ->join('remise_entreprise', 'remise_entreprise.id_organisation', '=', 'organisation.id_organisation')
            ->join('remise', 'remise.id_remise', '=', 'remise_entreprise.id_remise')
            ->join('historique_remise', 'historique_remise.id_remise', '=', 'remise_entreprise.id_remise')
            ->leftJoin('codes_promo', 'codes_promo.id_remise', '=', 'remise.id_remise')
            ->where('remise_entreprise.id_organisation', $url)
            ->get();

        $allRem = DB::connection('mysql2')->table('remise')
            ->join('historique_remise', 'historique_remise.id_remise', '=', 'remise.id_remise')
            ->get();

        return view('entreprises.show', compact(
            'organisation',
            'con',
            'remises',
            'experiences',
            'paye',
            'enregistre',
            'commence',
            'termine',
            'factures',
            'paiements',
            'nb_fact',
            'total_exp',
            'exp_vecu',
            'storytelling',
            'beneficiaires',
            'evenements',
            'contact_principal',
            'rem_org_liee',
            'allRem'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($entreprise)
    {

        $modelent = new Entreprise;
        $modelent->setConnection('mysql2');

        $id_ent = DB::connection('mysql2')->select('SELECT id_organisation FROM organisation');

        //
        $url1 = (int) $entreprise;
        $url = $url1;

        foreach ($id_ent as $key => $value) {
            if ($url1 === $value->id_organisation) {
                $url = $url1;
            }
        }

        $ent = DB::connection('mysql2')->select('SELECT id_organisation,tel,nom,email,adresse,code_postal,ville,num_cse,description
        from organisation 
        WHERE id_organisation=?', [$url]);
        return view('entreprises.edit', compact('ent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_organisation)
    {

        $request->validate([
            'avatar',
            'Nom' => 'required',
            'mail' => ['nullable', 'required_without:tel', 'email', Rule::unique('mysql2.organisation', 'email')->ignore($id_organisation, 'id_organisation')],
            'tel' => ['nullable', 'numeric', 'digits:10', Rule::unique('mysql2.organisation', 'tel')->ignore($id_organisation, 'id_organisation'), 'required_without:mail'],
            'adress',
            'cp' => 'nullable|numeric|digits_between:3,5',
            'ville',
            'num_cse' => 'required',
            'description'
        ]);

        $entreprise = Entreprise::find($id_organisation);

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris')); //first argument "must" be a string
        $current_date->setTimestamp($timestamp); //adjust the object to correct timestamp
        $notif_text = ' Mise à jour de l\'entreprise de ID ' . $id_organisation . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
            ->insertGetId([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'entreprise'
            ]);

        $entreprise->update([
            'nom' => $request->Nom,
            'tel' => $request->tel,
            'email' => $request->mail,
            'adresse' => $request->adress,
            'code_postal' => $request->cp,
            'ville' => $request->ville,
            'num_cse' => $request->num_cse,
            'description' => $request->description,
            'date_update' => $current_date->format('Y-m-d H:i:s'),
        ]);

        return redirect()->route('entreprises.show', ['id_organisation' => $entreprise->id_organisation])
            ->with('success', 'La mise a jour a bien été effectuée');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_organisation)
    {

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $notif_text = ' Suppression de l\'entreprise de ID ' . $id_organisation . ' et tous les entrés associées dans la table contact_entreprise le ' .  $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
            ->insertGetId([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'entreprise'
            ]);

        $con_entreprise = DB::connection('mysql2')->table('contact_entreprise')
            ->where('id_organisation', $id_organisation)
            ->delete();

        $entreprise = DB::connection('mysql2')->table('organisation')
            ->where('id_organisation', $id_organisation)
            ->delete();

        return redirect()->route('entreprises.index')
            ->with('success', 'Entreprise supprimée avec succes');
    }

    // -------------------------yasser : destroyStorytelling --------------------------
    public function destroyStorytelling($story, $id_organisation)
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

        return redirect()->route('entreprises.show', ['id_organisation' => $id_organisation])
            ->with('success', '');
    }

    public function insertRemise(Request $request)
    {
        $request->validate([
            'id_org' => 'required|nullable',
            'id_remise' => 'required|exists:mysql2.remise,id_remise',
        ]);

        $id_org = $request->id_org;
        $id_remise = $request->input('id_remise');

        try {
            // Tentative d'insertion dans la table remise_entreprise
            DB::connection('mysql2')->table('remise_entreprise')->insert([
                'id_remise' => $id_remise,
                'id_organisation' => $id_org,
            ]);

            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
            $current_date->setTimestamp($timestamp);
            $notif_text = 'Association de la remise de ID ' . $id_remise . ' avec l\'entreprise de ID ' . $id_org . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

            $notification = DB::connection('mysql2')->table('notification')
                ->insertGetId([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'remise entreprise'
                ]);

            return redirect()->route('entreprises.show', ['id_organisation' => $id_org])
                ->with('success', 'La remise a bien été ajoutée.');
        } catch (QueryException $e) {
            return redirect()->route('entreprises.show', ['id_organisation' => $id_org])
                ->with('error', 'Une erreur s\'est produite lors de l\'ajout de la remise.');
        }
    }



    public function createRemise(Request $request)
    {
        $id_org = $request->input('id_organisation');
        $request->validate([
            'nom_remise',
            'type_remise',
            'taux',
            'montant',
            'date_debut',
            'date_fin'
        ]);

        if ((date('Y-m-d') >= date('Y-m-d', strtotime($request->date_debut))) && (date('Y-m-d') <= date('Y-m-d', strtotime($request->date_fin)))) {
            $statut = "actif";
        } else {
            $statut = "inactif";
        }

        if (!is_null($request->taux)) {
            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
            $current_date->setTimestamp($timestamp);
            $notif_text = ' Creation d\'une nouvelle remise le ' .  $current_date->format('Y-m-d H:i:s') . '';

            $notification = DB::connection('mysql2')->table('notification')
                ->insertGetId([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'remise'
                ]);


            $date_debut = new DateTime();
            $date_debut = $date_debut->createFromFormat('Y-m-d', $request->date_debut);
            $date_debut->setTime(0, 0, 0, 0);

            $date_fin = new DateTime();
            $date_fin = $date_fin->createFromFormat('Y-m-d', $request->date_fin);
            $date_fin->setTime(0, 0, 0, 0);

            $rem = Remise::create([
                'nom_remise' => $request->nom_remise,
                'type_remise' => $request->type_remise,
                'taux' => $request->taux,
                'montant' => $request->montant,
                'date_debut' => $date_debut->format('Y-m-d H:i:s'),
                'date_fin' => $date_fin->format('Y-m-d H:i:s'),
                'statut' => $statut,
                'date_creation' => $current_date->format('Y-m-d H:i:s'),
                'date_update' => $current_date->format('Y-m-d H:i:s'),
            ]);

            $stripe = new \Stripe\StripeClient(
                env('STRIPE_SECRET')
            );
            $remise = $stripe->coupons->create([
                'percent_off' => floatval($request->taux),
                'duration' => 'repeating',
                'duration_in_months' => 3,
                'name' => $request->nom_remise,
                'metadata' =>
                [
                    'type_remise' => $request->type_remise,
                    'statut' => $statut,
                    'id_remise' => $rem->id_remise,
                ]
            ]);
        } elseif (!is_null($request->montant)) {

            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
            $current_date->setTimestamp($timestamp);
            $notif_text = ' Creation d\'une nouvelle remise le ' .  $current_date->format('Y-m-d H:i:s') . '';

            $notification = DB::connection('mysql2')->table('notification')
                ->insertGetId([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'remise'
                ]);

            $date_debut = new DateTime();
            $date_debut = $date_debut->createFromFormat('Y-m-d', $request->date_debut);
            $date_debut->setTime(0, 0, 0, 0);

            $date_fin = new DateTime();
            $date_fin = $date_fin->createFromFormat('Y-m-d', $request->date_fin);
            $date_fin->setTime(0, 0, 0, 0);

            $rem = Remise::create([
                'nom_remise' => $request->nom_remise,
                'type_remise' => $request->type_remise,
                'taux' => $request->taux,
                'montant' => $request->montant,
                'date_debut' => $date_debut->format('Y-m-d H:i:s'),
                'date_fin' => $date_fin->format('Y-m-d H:i:s'),
                'statut' => $statut
            ]);

            $stripe = new \Stripe\StripeClient(
                env('STRIPE_SECRET')
            );
            $remise = $stripe->coupons->create([
                'amount_off' => floatval($request->montant) * 100,
                'currency' => 'eur',
                'duration' => 'repeating',
                'duration_in_months' => 3,
                'name' => $request->nom_remise,
                'metadata' =>
                [
                    'type_remise' => $request->type_remise,
                    'statut' => $statut,
                    'id_remise' => $rem->id_remise,
                ]
            ]);
        } else {
            return redirect()->route('remises.index')
                ->with('error', ' Erreur lors de l\'ajout de la remise');
        }

        $remise = substr($remise, 20);

        $remise = json_decode($remise, true);

        DB::connection('mysql2')
            ->update('UPDATE remise SET remise.id_stripe_remise="' . $remise['id'] . '", remise.url_stripe_remise="https://dashboard.stripe.com/test/coupons/' . $remise['id'] . '", remise.date_update="' . $current_date->format('Y-m-d H:i:s') . '" WHERE remise.id_remise=' . $rem->id_remise . '');


        return redirect()->route('entreprises.show', ['id_organisation' => $id_org])
            ->with('success', 'Remise créée avec succes !');
    }

    public function deleteSelect(Request $request)
    {
        $ids = $request->input('entreprises');
        DB::connection('mysql2')->table('organisation')->whereIn('id_organisation', $ids)->delete();
        return redirect()->route('entreprises.index')->with('success', 'Selection supprimée avec succes');
    }

    public function createCodeCSE($request){

        $num = $this->generateNumeroCSE();
        $taux=$request->taux;
        $montant=$request->montant;
        $id_organisation=$request->id_organisation;

        $org = DB::connection('mysql2')
        ->table('organisation')
        ->where('id_organisation', $id_organisation)
        ->first();

       $rem_id = DB::connection('mysql2')->table('remise')->insertGetId([
            'nom_remise'=>'Remise CSE '.$org->nom,
            'type_remise'=>'CSE',
            'taux'=>$taux??null,
            'montant'=>$montant??null,
            'date_creation'=>new DateTime("now", new DateTimeZone('Europe/Paris')),
            'date_modification'=>new DateTime("now", new DateTimeZone('Europe/Paris')),
            'statut'=>'actif'
        ]);

       $cod_id = DB::connection('mysql2')->table('code_promos')->insertGetId([
            'remise_id'=>$rem_id,
            'code'=>$num,
            'created_at'=>new DateTime("now", new DateTimeZone('Europe/Paris')),
            'updated_at'=>new DateTime("now", new DateTimeZone('Europe/Paris')),
        ]);

        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );
        
        $coupon = $stripe->coupons->create([
            'amount_off' => floatval($montant) * 100??null,
            'percent_off' => floatval($taux)??null,
            'duration' => 'forever',
            'name' => 'Remise CSE '.$org->nom,
            'metadata' =>
                [
                    'type_remise' => 'CSE',
                    'statut' => 'actif',
                    'id_remise' => $rem_id,
                ]
        ]);

        DB::connection('mysql2')
        ->table('remise')->where('id_remise',$rem_id)
        ->update([
            'id_stripe_remise'=>$coupon['id'],
            'url_stripe_remise'=>getenv('URL_STRIPE').'coupons/'.$coupon['id']
        ]);

        $code = $stripe->promotionCodes->create([
            'coupon'=>$coupon['id'],
            'code'=>$num,
            'metadata' =>
            [
                'id_code' => $cod_id,
                'id_remise' => $rem_id
            ]
        ]);
        
        DB::connection('mysql2')
        ->table('code_promos')->where('id_code',$cod_id)
        ->update([
            'id_stripe_code'=>$code['id'],
            'url_stripe_code'=>getenv('URL_STRIPE').'promotion_codes/'.$code['id']
        ]);

    }
    public function generateNumeroCSE() {
        $string = '';
        $chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
          for($i=0; $i<8; $i++){
              $string .= $chars[rand(0, strlen($chars)-1)];
            }
        return $string;
    }
}
