<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use Carbon\Carbon;
use App\Models\Panier;
use App\Models\Facture;
use App\Models\Paiement;
use App\Models\Entreprise;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\FactureStatut;
use App\Models\FacturesRemise;

use App\Models\PackExperience;
use Illuminate\Validation\Rule;
use App\Models\Reservationclient;
use Illuminate\Support\Facades\DB;
use App\Models\FactureProduitService;
use function PHPUnit\Framework\isNull;
use App\Models\experienceApp\Interaction;
use App\Models\FactureStatutNotification;
use PHPUnit\TextUI\XmlConfiguration\Group;

class ReservationclientController extends Controller
{

    public function index(Request $request)
    {
        // JM- enregistrer l'url en session, sert à la redirection de la page facture
        session()->put('url_precedente', url()->current());

        $perPage = $request->get('perPage') ?? 10;
        $statut = $request->get('statut');
        $periode = $request->get('periode');
        $liste_statut_facture = FactureStatut::get();
        $multisearchnom = $request->get('multisearchnom');
        $multisearchtel = $request->get('multisearchtel');
        $multisearchprenom = $request->get('multisearchprenom');
        $multisearchmail = $request->get('multisearchmail');
        $multisearchstat = $request->get('multisearchstat');

        $date = Facture::with([
            'notifications',
            'paiements.contact',
            'pack_experiences.experience.notifications.experience_statuts'
        ])->orderByDesc('date_creation')->groupBy('num_facture')->orderBy('date_creation');

        // Gérer la condition de période
        if ($periode === 'semaine') {
            $date->where('date_creation', '>=', Carbon::now()->subWeek());
        } elseif ($periode === 'mois') {
            $date->where('date_creation', '>=', Carbon::now()->subMonth());
        } elseif ($periode === 'trimestre') {
            $date->where('date_creation', '>=', Carbon::now()->subQuarter());
        } elseif ($periode === 'annee') {
            $date->where('date_creation', '>=', Carbon::now()->subYear());
        }

        $data = $date->paginate($perPage);

        // Compter le nombre de factures pour chaque période
        $count_periodeA = $statut === 'annulé' ? FactureStatutNotification::whereHas('facture_statut', function ($query) {
            $query->where('id_facture_statut', 9);
        })->count() : null;

        $count_periodeD = $statut === 'demandé' ? FactureStatutNotification::whereHas('facture_statut', function ($query) {
            $query->where('id_facture_statut', 1);
        })->count() : null;

        $count_periodeV = $statut === 'validé' ? FactureStatutNotification::whereHas('facture_statut', function ($query) {
            $query->where('id_facture_statut', 10);
        })->count() : null;

        $count_periodeP = $statut === 'payé' ? FactureStatutNotification::whereHas('facture_statut', function ($query) {
            $query->where('id_facture_statut', 6);
        })->count() : null;

        // KPI "Présenté" basé sur le statut d'expérience
        $count_periodePresenté = $statut === 'présenté' ? FactureStatutNotification::whereHas('pack_experiences.experience.notifications.experience_statuts', function ($query) {
            $query->where('id_statut_experience', 2);
        })->count() : null;

        // KPI "Commencé" basé sur le statut d'expérience
        $count_periodeCommencé = $statut === 'commencé' ? FactureStatutNotification::whereHas('pack_experiences.experience.notifications.experience_statuts', function ($query) {
            $query->whereIn('id_statut_experience', [3, 4, 5]);
        })->count() : null;

        // KPI "Terminé" basé sur le statut d'expérience
        $count_periodeTerminé = $statut === 'terminé' ? FactureStatutNotification::whereHas('pack_experiences.experience.notifications.experience_statuts', function ($query) {
            $query->where('id_statut_experience', 7);
        })->count() : null;

        // Condition de recherche supplémentaire
        if (isset($multisearchnom) || isset($multisearchtel) || isset($multisearchprenom) || isset($multisearchmail) || isset($multisearchstat)) {
            // Utilisez la méthode multisearch pour obtenir les données filtrées
            $data = $this->multisearch($request);
        }

        // Obtenez les statuts de facture
        $statut_facture = FactureStatutNotification::with('facture_statut')
            ->orderByDesc('id_notification')
            ->get();

        // Obtenez les dates de réservation pour le statut avec l'id 2
        $date_reservation = FactureStatutNotification::where('id_facture_statut', 2)
            ->orderBy('id_notification')
            ->get();

        $totalRes = $data->total();

        return view('reservationclient.index', compact(
            'data',
            'perPage',
            'statut_facture',
            'date_reservation',
            'totalRes',
            'liste_statut_facture',
            'count_periodeA',
            'count_periodeD',
            'count_periodeV',
            'count_periodeP',
            'count_periodePresenté',
            'count_periodeCommencé',
            'count_periodeTerminé'
        ))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function multisearch(Request $request)
    {
        $perPage = 10;
        $multisearchnom = $request->get('multisearchnom');
        $multisearchtel = $request->get('multisearchtel');
        $multisearchprenom = $request->get('multisearchprenom');
        $multisearchmail = $request->get('multisearchmail');
        $multisearchstat = $request->get('multisearchstat');

        $data = Facture::with([
            'paiements.contact',
            'facture_statut',
            'notifications',
        ])
            ->whereHas('paiements.contact', function ($query) use ($multisearchnom, $multisearchtel, $multisearchprenom, $multisearchmail) {
                if ($multisearchnom) {
                    $query->where('nom', 'LIKE', '%' . $multisearchnom . '%');
                }

                if ($multisearchtel) {
                    $query->where('tel', 'LIKE', '%' . $multisearchtel . '%');
                }

                if ($multisearchprenom) {
                    $query->where('prenom', 'LIKE', '%' . $multisearchprenom . '%');
                }

                if ($multisearchmail) {
                    $query->where('email', 'LIKE', '%' . $multisearchmail . '%');
                }
            })
            ->whereHas('notifications', function ($subQuery) use ($multisearchstat) {
                $subQuery->where('facture_statut_notification.id_facture_statut', '=', $multisearchstat);
            })
            ->paginate($perPage);

        return $data;
    }



    // Direction view create

    public function create()
    {
        return view('reservationclient.create');
    }

    // Processus de creation
    public function store(Request $request)
    {


        if ($request->bon_cadeau === "oui" && isset($request->Id_produit)) {
            DB::connection('mysql2')->table('produit_facture')->insert(
                ['Id_produit' => $request->Id_produit,]
            );
        } else {
            $bon_cadeau = "non";
        }

        // dd();

        DB::connection('mysql2')->table('contact')->insert(
            ['nom' => $request->nom, 'prenom' => $request->prenom, 'tel' => $request->tel, 'email' => $request->email, 'adresse' => $request->adresse, 'ville' => $request->ville, 'code_postale' => $request->code_postale]
        );



        DB::connection('mysql2')->table('factures')->insert(
            ['nb_chanson' => $request->nb_chanson, 'nb_experimentateur' => $request->nb_experimentateur, 'description' => $request->description]
        );

        return redirect()->route('reservationclient.index')
            ->with('success', '');
    }

    // Direction vers le view de details du groupe
    public function show(Request $request, $experience)
    {
        $reservation = new Reservationclient;
        $reservation->setConnection('mysql2');

        $num_res = DB::connection('mysql2')->select('SELECT num_facture FROM factures');

        //$urls = $request->fullUrl();
        // http: //127 .0.0. 1:800 0/res ervat ioncl ient. show? 1  (45 en local)
        // https ://te amfb. lalac hante .fr/r eserv ation clien t.sho w? 1  (52 en ligne)
        //dd($facture);
        $url1 = (int) $experience;


        foreach ($num_res as $key => $value) {
            if ($url1 === $value->num_facture) {
                $url = $url1;
            }
        }

        if (!isset($url)) {
            return redirect()->route('reservationclient.index');
        }
        $clients = DB::connection('mysql2')->select(
            'SELECT DISTINCT contact.id_contact,contact.nom,contact.prenom
        FROM contact JOIN factures JOIN paiement
        ON factures.num_facture = paiement.num_facture
        AND paiement.id_contact=contact.id_contact
        WHERE factures.num_facture=?',
            [$url]
        );
        //dump(['clients'=>$clients]);
        $taille = DB::connection('mysql2')->select('SELECT * from paiement where num_facture=?', [$url]);

        //dump(['taille'=>$taille]);


        $evenements = DB::connection('mysql2')->select('SELECT notification.contenu_notification,notification.date_notification,facture_statut_notification.date_statut
        FROM facture_statut_notification JOIN notification JOIN factures
        ON facture_statut_notification.id_notification=notification.id_notification
        AND facture_statut_notification.num_facture=factures.num_facture
        WHERE factures.num_facture=?
        ORDER BY facture_statut_notification.date_statut DESC
        ', [$url]);
        //dump(['evenements'=>$evenements]);

        /*$dbs = DB::connection('mysql2')->select('SELECT DISTINCT experience.id_experience, contact.id_contact, contact.nom, contact.prenom, contact.tel, contact.email, contact.adresse, contact.code_postal, contact.ville, experience.nom_experience, factures.num_facture, facture_statut.statut_facture, pack_experience.nb_titres, pack_experience.nb_participants, factures.prix_facture, paiement.id_paiment, paiement.libelle, paiement.prix, paiement.statut_paiement, produits_services.nom_produit, pack.nom as pnom,bon_cadeau.id_bonCadeau,bon_cadeau.titre,bon_cadeau.message,experience_statut.statut_experience
        FROM contact JOIN experience JOIN factures JOIN produits_services JOIN facture_produit_service JOIN facture_statut JOIN facture_statut_notification JOIN pack_experience JOIN paiement JOIN experience_statut JOIN experience_statut_notification JOIN contact_facture JOIN contact_experience JOIN pack JOIN bon_cadeau JOIN contents_experience
        JOIN (
                    SELECT num_facture, MAX(id_facture_statut) AS id_facture_statut
                    FROM facture_statut_notification
                    GROUP BY num_facture) AS fact_stat_notif ON factures.num_facture = fact_stat_notif.num_facture

        ON contact_facture.num_facture = factures.num_facture
        AND contact_facture.id_contact = contact.id_contact
        AND experience.id_experience = contact_experience.id_experience
        AND contact.id_contact = contact_experience.id_contact
        AND fact_stat_notif.id_facture_statut=facture_statut.id_facture_statut
        AND experience.id_experience=experience_statut_notification.id_experience
        AND experience_statut_notification.id_statut_experience=experience_statut.id_statut_experience
        AND paiement.num_facture=factures.num_facture
        AND facture_produit_service.num_facture=factures.num_facture
        AND facture_produit_service.id_produit=produits_services.id_produit
        AND pack.id_pack=pack_experience.id_pack
        AND experience.id_experience=contents_experience.id_experience
        WHERE factures.num_facture=?', [$url]);
        dd($dbs);
        if (empty($dbs))
        {
            return redirect()->route('reservationclient.index');
        }*/

        $con = DB::connection('mysql2')->selectOne('SELECT contact.id_contact,contact.tel,contact.nom,contact.prenom,contact.email,contact.adresse,contact.code_postal,contact.ville,contact.url_contact_folder
        FROM contact JOIN factures
        JOIN (
                    SELECT num_facture, MIN(id_paiment) AS id_paiment,id_contact
                    FROM paiement
                    GROUP BY num_facture
                ) AS p ON factures.num_facture = p.num_facture
                AND p.id_contact=contact.id_contact
            WHERE factures.num_facture=?
        ', [$url]);

        $paiements = DB::connection('mysql2')->select('SELECT *
        FROM paiement JOIN factures
        ON paiement.num_facture=factures.num_facture
        WHERE factures.num_facture=?', [$url]);

        /*$statut=DB::connection('mysql2')->selectOne('SELECT facture_statut.statut_facture,factures.prix_facture
        FROM facture_statut JOIN factures
        JOIN (
                    SELECT num_facture, MAX(id_facture_statut) AS id_facture_statut
                    FROM facture_statut_notification
                    GROUP BY num_facture) AS fact_stat_notif ON factures.num_facture = fact_stat_notif.num_facture
        AND fact_stat_notif.id_facture_statut=facture_statut.id_facture_statut
        WHERE factures.num_facture=?
        ',[$url]);*/

        $statut = DB::connection('mysql2')->table('facture_statut_notification')
            ->join('facture_statut', 'facture_statut_notification.id_facture_statut', '=', 'facture_statut.id_facture_statut')
            ->where('facture_statut_notification.num_facture', $url)
            ->orderByDesc('facture_statut_notification.id_notification')->first();

        $fact = DB::connection('mysql2')->table('factures')->where('factures.num_facture', $url)->first();

        $experiences = DB::connection('mysql2')->select('SELECT experience.id_experience,pack.nom,pack_experience.nb_titres,pack_experience.nb_participants,experience.nom_experience,bon_cadeau.id_bonCadeau,bon_cadeau.titre,pack_experience.num_facture,experience_statut.statut_experience,experience.numero_experience
        FROM experience JOIN pack_experience JOIN pack JOIN experience_statut
        LEFT JOIN contents_experience ON experience.id_experience = IFNULL(contents_experience.id_experience, "none")
        LEFT JOIN bon_cadeau ON IFNULL(contents_experience.id_content_experience, "none") = IFNULL(bon_cadeau.id_content_experience, "none")
        JOIN (
            SELECT id_experience, MAX(id_statut_experience) AS id_statut_experience
            FROM experience_statut_notification
            GROUP BY id_experience) AS exp_stat_notif ON pack_experience.id_experience = exp_stat_notif.id_experience
        AND pack.id_pack=pack_experience.id_pack
        AND pack_experience.id_experience=experience.id_experience
        AND exp_stat_notif.id_statut_experience=experience_statut.id_statut_experience
        WHERE pack_experience.num_facture=?
        GROUP BY pack_experience.id_pack_experience', [$url]);

        if (isNull($experiences)) {
            $prestations = DB::connection('mysql2')->table('pack_experience')
                ->join('pack', 'pack_experience.id_pack', '=', 'pack.id_pack')
                ->where('pack_experience.num_facture', '=', $url)
                ->get();
            $id_pack_exp = [];
            foreach ($prestations as $key => $value) {
                array_push($id_pack_exp, $value->id_pack_experience);
            }
            $prest_pack = DB::connection('mysql2')->table('autre_prestation_experience')
                ->join('produits_services', 'autre_prestation_experience.id_produit', '=', 'produits_services.id_produit')
                ->whereIn('id_pack_experience', $id_pack_exp)
                ->get();
            $fact_prod = DB::connection('mysql2')->table('facture_produit_service')
                ->join('produits_services', 'facture_produit_service.id_produit', '=', 'produits_services.id_produit')
                ->where('num_facture', '=', $url)
                ->get();
        } else {
            $prest_pack = null;
            $fact_prod = null;
        }

        $statut_experience = DB::connection('mysql2')->table('experience_statut_notification')
            ->join('experience_statut', 'experience_statut_notification.id_statut_experience', '=', 'experience_statut.id_statut_experience')
            ->orderByDesc('experience_statut_notification.id_notification')
            ->get();


        $id_exp = [];
        foreach ($experiences as $exp) {
            array_push($id_exp, $exp->id_experience);
        }

        $id_client = [];
        foreach ($clients as $cli) {
            array_push($id_client, $cli->id_contact);
        }

        $storytelling = DB::connection('mysql2')->table('storytelling')
            ->join('contents_experience', 'storytelling.id_content_experience', '=', 'contents_experience.id_content_experience')
            ->whereIn('contents_experience.id_experience', $id_exp)
            ->orderByDesc('contents_experience.date_heure')
            ->get();
        //dd($experiences);

        $interactions = DB::connection('mysql2')->table('interaction')
            ->whereIn('interaction.id_experience', $id_exp)
            ->orWhereIn('interaction.id_contact', $id_client)
            ->orderByDesc('interaction.date_heure')
            ->get();

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
        // -------------------------------------yasser--------------------------------------------------

        $experimentateurs = DB::connection('mysql2')->select(
            'SELECT contact.id_contact,contact.nom,contact.prenom,experience.id_experience,experience.nom_experience
        FROM contact JOIN contact_experience JOIN experience JOIN pack_experience JOIN factures
        ON contact_experience.id_experience=experience.id_experience
        AND contact_experience.id_contact=contact.id_contact
        AND pack_experience.id_experience=experience.id_experience
        AND pack_experience.num_facture=factures.num_facture
        WHERE factures.num_facture=?
        AND (contact_experience.profil="User" OR contact_experience.profil="Client-User")',
            [$url]
        );
        //dd($experimentateurs);


        $org = DB::connection('mysql2')->selectOne('SELECT contact_entreprise.type,contact_entreprise.id_organisation
        FROM contact_entreprise
        JOIN contact ON contact.id_contact = contact_entreprise.id_contact
        WHERE contact.id_contact=?', [$url]);

        $nom_org =  Entreprise::where('id_organisation', '>', 0)->pluck('nom')->toArray();
        $id_org = Entreprise::where('id_organisation', '>', 0)->pluck('id_organisation')->toArray();

        $description = DB::connection('mysql2')
            ->table('factures')
            ->where('num_facture', $url)
            ->value('description_lib');

        $totalpayment = 0;
        $totalStripe = 0;

        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );

        foreach ($paiements as $paiement) {
            // dd($paiement);
            $totalpayment += $paiement->prix;
            if (Str::startsWith($paiement->id_stripe_paiement, "in_")) {
                $sp = $stripe->invoices->retrieve(
                    $paiement->id_stripe_paiement,
                    []
                );
                $totalStripe += $sp["total"] / 100;
                // dd($totalStripe);
            }
            if (Str::startsWith($paiement->id_stripe_paiement, "pi_")) {
                $sp = $stripe->paymentIntents->retrieve(
                    $paiement->id_stripe_paiement,
                    []
                );
                $totalStripe += $sp["amount"] / 100;
                // dd($totalStripe);
            }
        }

        if ($totalpayment == $totalStripe && $totalStripe == $fact->prix_facture) {
            return view('reservationclient.show', compact(
                'taille',
                'evenements',
                'clients',
                'experience',
                'con',
                'paiements',
                'statut',
                'url',
                'experimentateurs',
                'experiences',
                'statut_experience',
                'fact',
                'storytelling',
                'interactions',
                'org',
                'nom_org',
                'id_org',
                'prestations',
                'prest_pack',
                'fact_prod',
                'les_tags_lier_avec_inter',
                'les_tags_lier_avec_story',
                'description'
            ))->with('success', "Les prix correspondent entre l'app et stripe");
        } else {
            return view('reservationclient.show', compact(
                'taille',
                'evenements',
                'clients',
                'experience',
                'con',
                'paiements',
                'statut',
                'url',
                'experimentateurs',
                'experiences',
                'statut_experience',
                'fact',
                'storytelling',
                'interactions',
                'org',
                'nom_org',
                'id_org',
                'prestations',
                'prest_pack',
                'fact_prod',
                'les_tags_lier_avec_inter',
                'les_tags_lier_avec_story',
                'description'
            ))->withErrors(['message' => "Les prix sont differents entre l'app et stripe"]);
        }
    }
    // Direction vers le view de la modification du groupe
    public function edit(Request $request, $experience)
    {
        //$id = $request->fullUrl();
        // http: //127 .0.0. 1:800 0/res ervat ioncl ient. edit? 1  (45 en local)
        // https ://te amfb. lalac hante .fr/r eserv ation clien t.edi t? 1  (52 en ligne)

        $id2 = (int) $experience;
        /*$id3 = (int) substr($id, 48, 2);
        $id4 = (int) substr($id, 48, 1);*/

        /*
        Changé méthode car on compare l'id d'une experience avec l'id d'un contact et donc il arrive pas à définir $ids
        Répris le code dans la méthode show pour saisir les infos réquises.
        Dans le cas où je n'ai pas compris correctement le fonctionnement de cette méthodes je laisse le code en commentaire pour pouvoir rétourner en arriére
        $idcontacts = DB::connection('mysql2')->select('SELECT id_contact FROM contact');
        foreach ($idcontacts as $idcontact => $rang) {
            if ($id2 === $rang->id_contact) {
                $ids = DB::connection('mysql2')->select('SELECT id_contact FROM contact WHERE id_contact=' . $id2);
            } elseif ($id3 === $rang->id_contact) {
                $ids = DB::connection('mysql2')->select('SELECT id_contact FROM contact WHERE id_contact=' . $id3);
            } elseif ($id4 === $rang->id_contact) {
                $ids = DB::connection('mysql2')->select('SELECT id_contact FROM contact WHERE id_contact=' . $id4);
            }
        }*/

        $id_exp = DB::connection('mysql2')->select('SELECT id_experience FROM experience');

        foreach ($id_exp as $key => $value) {
            if ($id2 === $value->id_experience) {
                $ids = $id2;
            }
        }
        if (!isset($ids)) {
            return redirect()->route('reservationclient.index');
        }
        $bons = DB::connection('mysql2')->select('SELECT * FROM produit_facture');


        $dbs = DB::connection('mysql2')->select('SELECT contact.id_contact,contact.nom, contact.prenom, contact.tel, contact.email, contact.adresse, contact.code_postale, contact.ville, experience.nom_experience, factures.num_facture, factures.statut_facture, factures.nb_chanson, factures.nb_experimentateur, factures.url_facture,factures.prix_total
        FROM contact JOIN experience JOIN factures JOIN contact_facture JOIN contact_experience
        ON contact_facture.num_facture = factures.num_facture
        AND contact_facture.id_contact = contact.id_contact
        AND experience.id_experience = contact_experience.id_experience
        AND contact.id_contact = contact_experience.id_contact

        WHERE experience.id_experience=?', [$ids]);
        // dd($dbs);
        if (empty($dbs)) {
            return redirect()->route('reservationclient.index');
        }

        // dd($id2);

        return view('reservationclient.edit', ['dbs' => $dbs, 'taille' => $taille, 'experience' => $experience]);
    }

    // Processus de modification du groupe
    public function update(Request $request, $reservationclient)
    {
        $request->validate([

            'id_experience' => 'required',
            'nom' => 'required',
            'prenom',
            'tel',
            'email',
            'statut_experience',
            'num_facture',
            'url_facture'
        ]);

        $reservationclient->update($request->all());
        return redirect()->route('reservationclient.index')
            ->with('success', '');
    }

    /**
     * Remove the specified resource from storage.
     *d
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Procesuus de la suppression de la facture
    public function destroy($facture)
    {

        $fact = DB::connection('mysql2')->table('factures')
            ->where('num_facture', $facture)
            ->get();

        $verifpaiements = DB::connection('mysql2')->table('paiement')
            ->where('num_facture', $facture)
            ->where('statut_paiement', 'Payé')
            ->get();

        if (!$verifpaiements->isEmpty()) {
            return redirect()->route('reservationclient.index')
                ->with('error', 'Erreur lors de la suppression');
        } else {


            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris')); //first argument "must" be a string
            $current_date->setTimestamp($timestamp); //adjust the object to correct timestamp
            $notif_text = ' Suppression de la ID ' . $facture . ' et de tous les entreés associé à cette facture dans plusieurs tables le ' .  $current_date->format('Y-m-d H:i:s') . '';

            $notification = DB::connection('mysql2')->table('notification')
                ->insert([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'interaction'
                ]);
            $transactionsReferencingPaiements = Transaction::where('id_paiment', $facture)->get();
            foreach ($transactionsReferencingPaiements as $transaction) {
                $transaction->delete();
            }
            DB::beginTransaction();

            // Supprimer les enregistrements liés dans transactions en utilisant les relations
            $paiement = Paiement::where('num_facture', $facture)->first();

            // Supprimez les transactions associées
            if ($paiement) {
                $paiement->transactions()->delete();

                // Ensuite, vous pouvez supprimer le paiement lui-même si nécessaire
                $paiement->delete();
            }

            $panier = Panier::where('num_facture', $facture)->first();

            // Supprimez les transactions associées
            if ($panier) {
                // Ensuite, vous pouvez supprimer le paiement lui-même si nécessaire
                $panier->delete();
            }
            
            $paiements = DB::connection('mysql2')->table('paiement')
                ->where('num_facture', $facture)
                ->delete();

            $pack_experience = DB::connection('mysql2')->table('pack_experience')
                ->where('num_facture', $facture)
                ->get();

            foreach ($pack_experience as $p) {
                $autres_prestations = DB::connection('mysql2')->table('autre_prestation_experience')
                    ->where('id_pack_experience', $p->id_pack_experience)
                    ->delete();
            }

            $pack_experience = DB::connection('mysql2')->table('pack_experience')
                ->where('num_facture', $facture)
                ->delete();

            $prest_fact = DB::connection('mysql2')->table('facture_produit_service')
                ->where('num_facture', $facture)
                ->delete();

            $fact_stat_notif = DB::connection('mysql2')->table('facture_statut_notification')
                ->where('num_facture', $facture)
                ->delete();

            $facture_remise = DB::connection('mysql2')->table('factures_remise')
                ->where('num_facture', $facture)
                ->delete();

            $fact = DB::connection('mysql2')->table('factures')
                ->where('num_facture', $facture)
                ->delete();

            return redirect()->route('reservationclient.index')
                ->with('success', 'La réservation a bien été supprimée');
        }
    }

    // Procesuus de la suppression plusieur groupe en meme temps
    public function deleteall_g(Request $request)
    {
        // $ids = $request->get('ids');
        // Client::whereIn('id', $ids)->delete();
        // return redirect('clients');
    }

    public function valid(Request $request, $experience)
    {

        return view('reservationclient.validate', ['experience' => $experience]);
    }

    public function valider(Request $request, $num_facture, $id_facture_statut)
    {
        if (($id_facture_statut == 2) || ($id_facture_statut == 1) || ($id_facture_statut == 11)) {
            $current_status = DB::connection('mysql2')->table('facture_statut')
                ->where('statut_facture', $id_facture_statut)
                ->first();

            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris')); //first argument "must" be a string
            $current_date->setTimestamp($timestamp); //adjust the object to correct timestamp
            $notif_text = ' La facture de ID ' . $num_facture . ' a été validé le ' .  $current_date->format('Y-m-d H:i:s') . '';

            $notification = DB::connection('mysql2')->table('notification')
                ->insertGetId([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'facture'
                ]);

            $fact_stat_notif = DB::connection('mysql2')->table('facture_statut_notification')
                ->insert([
                    'id_notification' => $notification,
                    'date_statut' => $current_date->format('Y-m-d H:i:s'),
                    'num_facture' => $num_facture,
                    'id_facture_statut' => 10
                ]);

            $paiements = DB::connection('mysql2')
                ->select('SELECT * FROM paiement WHERE num_facture = ' . $num_facture . '');

            //dd($paiements);

            foreach ($paiements as $pay) {
                $con = DB::connection('mysql2')->table('contact')
                    ->where('id_contact', $pay->id_contact)
                    ->first();

                $stripe = new \Stripe\StripeClient(
                    env('STRIPE_SECRET')
                );

                $price = $stripe->prices->create([
                    'unit_amount' => floatval($pay->prix) * 100,
                    'currency' => 'eur',
                    'product' => env('PRODUIT_PAIEMENT'),
                ]);

                //dd($price);

                $price = substr($price, 19);
                $price = json_decode($price, true);
                $date_echeance = strtotime('now + 5 days');
                $invoice = $stripe->invoices->create([
                    'customer' => $con->id_client_stripe,
                    'collection_method' => 'send_invoice',
                    'due_date' => $date_echeance,
                    'metadata' => [
                        'id_contact' => $con->id_contact,
                        'id_paiement' => $pay->id_paiment,
                        'num_facture' => $num_facture,
                        'libelle' => $pay->libelle
                    ]
                ]);

                $invoice = substr($invoice, 21);
                $invoice = json_decode($invoice, true);
                //dd($invoice);

                $up = DB::connection('mysql2')->table('paiement')
                    ->where('id_paiment', $pay->id_paiment)
                    ->update(['id_stripe_paiement' => $invoice['id'], 'date_update' => $current_date->format('Y-m-d H:i:s')]);

                $stripe->invoiceItems->create([
                    'customer' => $con->id_client_stripe,
                    'price' => $price['id'],
                    'invoice' => $invoice['id'],
                ]);
                // $stripe->invoices->sendInvoice(
                // $invoice['id'],
                // []
                // );
            }

            $url = 'https://discordapp.com/api/webhooks/1048269916849045544/7DPB-mDRZujlT-WbEedYC8mGJnkdr3I1zTlMtoFodIavpejYTrKAKR3SVBobArOZeIR_';
            $data = array(
                'content' => 'La facture a été validée'
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

            return redirect()->back()->with('success', 'La réservation a bien été validée');
        } else {
            return redirect()->back()->with('success', 'Erreur lors de la validation de la reservation');
        }
    }

    public function envoyer(Request $request, $num_facture, $id_facture_statut)
    {
        if ((($id_facture_statut >= 3) && ($id_facture_statut <= 6)) || ($id_facture_statut == 10)) {
            $current_status = DB::connection('mysql2')->table('facture_statut')
                ->where('statut_facture', $id_facture_statut)
                ->first();

            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris')); //first argument "must" be a string
            $current_date->setTimestamp($timestamp); //adjust the object to correct timestamp
            $notif_text = ' La facture de ID ' . $num_facture . ' a été envoyé le ' .  $current_date->format('Y-m-d H:i:s') . '';

            $notification = DB::connection('mysql2')->table('notification')
                ->insertGetId([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'facture'
                ]);

            $fact_stat_notif = DB::connection('mysql2')->table('facture_statut_notification')
                ->insert([
                    'id_notification' => $notification,
                    'date_statut' => $current_date->format('Y-m-d H:i:s'),
                    'num_facture' => $num_facture,
                    'id_facture_statut' => 3
                ]);
            $paiements = DB::connection('mysql2')
                ->select('SELECT * FROM paiement WHERE num_facture = ' . $num_facture . '');

            //dd($paiements);

            foreach ($paiements as $pay) {
                // $con=DB::connection('mysql2')->table('contact')
                //     ->where('id_contact',$pay->id_contact)
                //     ->first();

                $stripe = new \Stripe\StripeClient(
                    env('STRIPE_SECRET')
                );

                // $price = $stripe->prices->create([
                //     'unit_amount' => floatval($pay->prix)*100,
                //     'currency' => 'eur',
                //     'product' => env('PRODUIT_PAIEMENT'),
                //     ]);

                //dd($price);

                // $price = substr($price,19);
                // $price = json_decode($price,true);
                // $date_echeance = strtotime('now + 5 days');
                // $invoice=$stripe->invoices->create([
                //     'customer' => $con->id_client_stripe,
                //     'collection_method' => 'send_invoice',
                //     'due_date' => $date_echeance,
                //     'metadata' => [
                //         'id_contact' => $con->id_contact,
                //         'id_paiement' => $pay->id_paiment,
                //         'num_facture' => $num_facture,
                //         'libelle' => $pay->libelle
                //     ]
                //   ]);

                // $invoice = substr($invoice,21);
                // $invoice = json_decode($invoice,true);
                // //dd($invoice);

                // $up = DB::connection('mysql2')->table('paiement')
                // ->where('id_paiment', $pay->id_paiment)
                // ->update(['id_stripe_paiement' => $invoice['id']]);

                // $stripe->invoiceItems->create([
                //     'customer' => $con->id_client_stripe,
                //     'price' => $price['id'],
                //     'invoice' => $invoice['id'],
                //     ]);
                $stripe->invoices->sendInvoice(
                    $pay->id_stripe_paiement,
                    []
                );
                $url = 'https://discordapp.com/api/webhooks/1048269916849045544/7DPB-mDRZujlT-WbEedYC8mGJnkdr3I1zTlMtoFodIavpejYTrKAKR3SVBobArOZeIR_';
                $data = array(
                    'content' => 'La facture a été envoyé'
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
            }

            return redirect()->route('reservationclient.index')
                ->with('success', 'la reservation a bien ete envoyée #1');
        } else {
            return redirect()->route('reservationclient.index')
                ->with('error', 'Erreur lors de l\'envoi de la réservation');
        }
    }

    public function createInteraction(Request $request)
    {
        // dd($request);

        $request->validate([
            'id_exp' => 'nullable|exists:mysql2.experience,id_experience',
            'id_cnt' => 'required|exists:mysql2.contact,id_contact',
            'num_facture' => 'required|exists:mysql2.factures,num_facture',
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

        $id_experience = $request->id_exp;
        $id_contact = $request->id_cnt;
        $num_facture = $request->num_facture;
        $type_int = $request->type_int;
        $texte = $request->texte;
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



        // dd($request);
        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris')); //first argument "must" be a string
        $current_date->setTimestamp($timestamp); //adjust the object to correct timestamp
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
        // dd($interaction);
        return redirect()->route('reservationclient.show', ['experience' => $num_facture])
            ->with('success', 'Interaction créée avec succes');
    }

    public function createStorytelling(Request $request)
    {
        // dd($request);
        $request->validate([
            'id_exp' => 'required|exists:mysql2.experience,id_experience',
            'num_facture' => 'required|exists:mysql2.factures,num_facture',
            'desc_content',
            'desc_story' => 'required',
            // --------
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

        $id_experience = $request->id_exp;
        $num_facture = $request->num_facture;
        // $id_tag_story=$request->id_tag_story;
        $desc_content = $request->desc_content;
        $desc_story = $request->desc_story;
        // ------------------yasser-------------------
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
        // ------------------yasser-------------------

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris')); //first argument "must" be a string
        $current_date->setTimestamp($timestamp); //adjust the object to correct timestamp
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


        return redirect()->route('reservationclient.show', ['experience' => $num_facture])
            ->with('success', 'Storytelling créé avec succes');
    }

    public function destroyStorytelling($story, $num_facture)
    {

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris')); //first argument "must" be a string
        $current_date->setTimestamp($timestamp); //adjust the object to correct timestamp
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


        return redirect()->route('reservationclient.show', ['experience' => $num_facture])
            ->with('success', 'Storytelling supprimé avec succes');
    }

    public function destroyInteraction($interactionz, $num_facture)
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


        return redirect()->route('reservationclient.show', ['experience' => $num_facture])
            ->with('success', 'Interaction supprimée avec succes');
    }

    public function updateClient(Request $request, $id_contact)
    {
        $request->validate([
            'Nom' => 'required',
            'Prénom' => 'required',
            'mail' => ['nullable', 'required_without:tel', 'email', Rule::unique('mysql2.contact', 'email')->ignore($id_contact, 'id_contact')],
            'tel' => ['nullable', 'numeric', 'digits:10', Rule::unique('mysql2.contact', 'tel')->ignore($id_contact, 'id_contact'), 'required_without:mail'],
            'adress',
            'cp' => 'nullable|numeric|digits_between:3,5',
            'ville',
            'url',
            'entreprise' => 'nullable|exists:mysql2.organisation,id_organisation',
            'type',
            'num_facture' => 'required|exists:mysql2.factures,num_facture'
        ]);

        $num_facture = $request->num_facture;

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris')); //first argument "must" be a string
        $current_date->setTimestamp($timestamp); //adjust the object to correct timestamp
        $notif_text = 'Mise à jour du contact de ID ' . $id_contact . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';
        //$prix_paiement=((double) $facture->prix_facture)/((double) $request->nb_paiements);

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

                $org = DB::connection('mysql2')->insert("INSERT INTO contact_entreprise (id_contact, type, id_organisation) VALUES (?,?,?)", [$con->id_contact, $request->type, $request->entreprise]);
            }
            //$org=DB::connection('mysql2')->insert("INSERT INTO contact_entreprise (id_contact, id_organisation) VALUES (?,?)",[$con->id,$request->entreprise]);
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
            } else {



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

        return redirect()->route('reservationclient.show', ['experience' => $num_facture])
            ->with('success', '');
    }

    public function clientToExperimentateur(Request $request)
    {
        $id_experience = $request->input('id_experience');
        $num_facture = $request->input('num_facture');
        $id_contact = $request->input('id_contact');
        $count = DB::connection('mysql2')->table('contact_experience')
            ->where('id_contact', '=', $id_contact)
            ->where('id_experience', '=', $id_experience)
            ->where('profil', '=', 'Client')
            ->count();

        if ($count == 1) {

            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris')); //first argument "must" be a string
            $current_date->setTimestamp($timestamp); //adjust the object to correct timestamp
            $notif_text = 'Mise à jour du client associé au contact de ID ' . $id_contact . ' et à l\'experience de ID ' . $id_experience . ' pour le rendre un Client-User le ' .  $current_date->format('Y-m-d H:i:s') . '';

            $notification = DB::connection('mysql2')->table('notification')
                ->insertGetId([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'contact experience/experimentateur'
                ]);

            $con_exp = DB::connection('mysql2')->table('contact_experience')
                ->where('id_contact', '=', $id_contact)
                ->where('id_experience', '=', $id_experience)
                ->where('profil', '=', 'Client')
                ->update([
                    'profil' => 'Client-User'
                ]);

            return redirect()->route('experience.show', compact('id_experience', 'num_facture'))
                ->with('success', 'le client a bien été ajouté');
        } else {
            return redirect()->route('experience.show', compact('id_experience', 'num_facture'))
                ->with('error', 'le client n\'a pas été ajouté');
        }
    }


    public function deleteSelect(Request $request)
    {
        $numFactures = $request->input('factures');

        try {
            DB::beginTransaction();

            // Supprimer les enregistrements liés dans transactions en utilisant les relations
            Paiement::whereIn('num_facture', $numFactures)->each(function ($paiement) {
                $paiement->transactions()->delete();
            });

            // Supprimer les enregistrements liés dans facture_statut_notification
            FactureStatutNotification::whereIn('num_facture', $numFactures)->delete();

            // Supprimer les enregistrements liés dans pack_experience
            PackExperience::whereIn('num_facture', $numFactures)->delete();

            // Supprimer les enregistrements liés dans facture_produit_service
            FactureProduitService::whereIn('num_facture', $numFactures)->delete();

            // Supprimer les enregistrements liés dans paniers
            Panier::whereIn('num_facture', $numFactures)->delete();

            // Supprimer les enregistrements liés dans paiement
            Paiement::whereIn('num_facture', $numFactures)->delete();

            // Supprimer les enregistrements liés dans factures_remise
            FacturesRemise::whereIn('num_facture', $numFactures)->delete();

            // Ensuite, supprimer les factures
            Facture::whereIn('num_facture', $numFactures)->delete();

            DB::commit();

            return redirect()->route('reservationclient.index')->with('success', 'Sélection supprimée avec succès');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->route('reservationclient.index')->with('error', 'Une erreur s\'est produite lors de la suppression : ' . $e->getMessage());
        }
    }
}
