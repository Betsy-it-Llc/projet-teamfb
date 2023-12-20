<?php

namespace App\Http\Controllers;


use App\Models\experienceApp\Facture;
use DateTime;
use DateTimeZone;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PaiementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     * @return \Illuminate\Http\Response
     */
    //  Une fois on depasse 5 lignes par tableau Ca d'affiche
    public function index(Request $request)
    {
        $paiement = new Paiement;
        $paiement->setConnection('mysql2');

        // Récupération de la liste complète des paiements
        $liste = Paiement::on('mysql2')->get();

        // Récupération des statuts de paiement et de leur nombre
        $liste_statut_paiement = Paiement::on('mysql2')
            ->select('statut_paiement', DB::raw('COUNT(*) as count'))
            ->groupBy('statut_paiement')
            ->orderByDesc('date_echeance')
            ->get();

        $perPage = $request->get('perPage') ?? 10;

        // Préparation de la requête principale
        $query = Paiement::on('mysql2')
            ->join('contact', 'paiement.id_contact', '=', 'contact.id_contact')
            ->select('paiement.id_paiment', 'paiement.statut_paiement', 'paiement.prix', 'paiement.date_echeance', 'contact.nom', 'contact.prenom', 'contact.email', 'contact.tel', 'paiement.url_stripe_paiement')
            ->orderByDesc('id_paiment')
            ->orderByDesc('date_echeance');

        // Récupération et application des filtres multi-critères
        $multisearchnom = $request->get('multisearchnom');
        $multisearchtel = $request->get('multisearchtel');
        $multisearchprenom = $request->get('multisearchprenom');
        $multisearchmail = $request->get('multisearchmail');
        $multisearchstat = $request->get('multisearchstat');

        if ($multisearchnom) {
            $query->where('contact.nom', 'LIKE', '%' . $multisearchnom . '%');
        }
        if ($multisearchtel) {
            $query->where('contact.tel', 'LIKE', '%' . $multisearchtel . '%');
        }
        if ($multisearchprenom) {
            $query->where('contact.prenom', 'LIKE', '%' . $multisearchprenom . '%');
        }
        if ($multisearchmail) {
            $query->where('contact.email', 'LIKE', '%' . $multisearchmail . '%');
        }
        if ($multisearchstat) {
            $query->where('paiement.statut_paiement', 'LIKE', '%' . $multisearchstat . '%');
        }

        // Filtrage par période et statut
        $periode = $request->get('periode');
        $statut = $request->get('statut');

        if ($statut) {
            $query->where('paiement.statut_paiement', $statut);
        }

        if ($periode) {
            switch ($periode) {
                case 'semaine':
                    $weekStart = now()->startOfWeek()->format('Y-m-d');
                    $query->whereBetween('paiement.date_creation', [$weekStart, now()]);
                    break;
                case 'mois':
                    $monthStart = now()->startOfMonth()->format('Y-m-d');
                    $query->whereBetween('paiement.date_creation', [$monthStart, now()]);
                    break;
                case 'trimestre':
                    $trimesterStart = now()->firstOfQuarter()->format('Y-m-d');
                    $query->whereBetween('paiement.date_creation', [$trimesterStart, now()]);
                    break;
                case 'annee':
                    $yearStart = now()->startOfYear()->format('Y-m-d');
                    $query->whereBetween('paiement.date_creation', [$yearStart, now()]);
                    break;
            }
        }

        // Finaliser la requête avec pagination
        $DT = $query->paginate($perPage);

        $totalPaiement = $DT->total();

        // Renvoyer la vue avec les données
        return view('paiementss.index', compact('liste', 'DT', 'perPage', 'totalPaiement', 'liste_statut_paiement'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    // Recherche multi


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('factures.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->bon_cadeau === "oui" && isset($request->num_facture)) {
            DB::connection('mysql2')->table('factures')->insert(
                ['num_facture' => $request->num_facture,]
            );
        } else {
            $bon_cadeau = "non";
        }



        return redirect('/paiementss')
            ->with('success', '');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $paiement)
    {
        $modelpaiement = new Paiement;
        $modelpaiement->setConnection('mysql2');

        $num_paie = DB::connection('mysql2')->select('SELECT id_paiment FROM paiement');



        $url1 = (int) $paiement;


        foreach ($num_paie as $key => $value) {
            if ($url1 === $value->id_paiment) {
                $url = $url1;
            }
        }

        if (!isset($url)) {

            return redirect('/paiements');
        }

        $dbs = DB::connection('mysql2')->select('SELECT contact.url_contact_folder,contact.nom,contact.prenom,contact.id_contact,contact.email,
                    contact.tel,contact.code_postal,contact.adresse,contact.ville,paiement.id_paiment,
                    factures.num_facture,factures.nb_paiement,factures.prix_facture,
                    paiement.statut_paiement,paiement.libelle,paiement.prix,paiement.date_echeance, paiement.moyen_paiement, paiement.canal_paiement
        FROM paiement JOIN factures JOIN contact
        ON paiement.num_facture=factures.num_facture
        AND contact.id_contact=paiement.id_contact
        WHERE paiement.id_paiment=?
        ORDER BY paiement.date_echeance DESC;', [$url]);


        $texte_paiement = ' Le Paiement de ID ' . $dbs[0]->id_paiment . ' a été validé le ';
        $date_paiement = DB::connection('mysql2')->table('notification')
            ->where('contenu_notification', 'LIKE', '%' . $texte_paiement . '%')
            ->first();
        if (!is_null($date_paiement)) {
            $date_paiement = $date_paiement->date_notification;
        }
        $texte_emission = ' La facture de ID ' . $dbs[0]->num_facture . ' a été envoyé le ';
        $date_emission = DB::connection('mysql2')->table('notification')
            ->where('contenu_notification', 'LIKE', '%' . $texte_emission . '%')
            ->first();
        if (!is_null($date_emission)) {
            $date_emission = $date_emission->date_notification;
        }

        $clients = DB::connection('mysql2')->select(
            'SELECT DISTINCT contact.id_contact,contact.nom,contact.prenom
        FROM contact JOIN factures JOIN paiement
        ON factures.num_facture = paiement.num_facture
        AND paiement.id_contact=contact.id_contact
        WHERE factures.num_facture=?',
            [$dbs[0]->num_facture]
        );


        // -----------------------------------------
        $packs = DB::connection('mysql2')->table('factures')
            ->join('pack_experience', 'factures.num_facture', '=', 'pack_experience.num_facture')
            ->join('pack', 'pack_experience.id_pack', '=', 'pack.id_pack')
            ->join('experience', 'pack_experience.id_experience', '=', 'experience.id_experience')
            ->join('experience_statut_notification', 'pack_experience.id_experience', '=', 'experience_statut_notification.id_experience')
            ->join('experience_statut', 'experience_statut_notification.id_statut_experience', '=', 'experience_statut.id_statut_experience')
            ->where('pack_experience.num_facture', '=', $dbs[0]->num_facture)
            ->groupBy('pack.id_pack')
            ->get();

        if ($packs->isEmpty()) {
            $packs = DB::connection('mysql2')->table('factures')
                ->join('pack_experience', 'factures.num_facture', '=', 'pack_experience.num_facture')
                ->join('pack', 'pack_experience.id_pack', '=', 'pack.id_pack')
                ->where('pack_experience.num_facture', '=', $dbs[0]->num_facture)
                ->groupBy('pack.id_pack')
                ->get();
        }


        $produits = DB::connection('mysql2')->table('factures')
            ->join('facture_produit_service', 'factures.num_facture', '=', 'facture_produit_service.num_facture')
            ->join('produits_services', 'facture_produit_service.id_produit', '=', 'produits_services.id_produit')
            ->where('factures.num_facture', '=', $url)
            ->groupBy('produits_services.id_produit')
            ->get();

        // ------------------------------------------------------
        $paiementNotif = DB::connection('mysql2')->table('paiement')
            ->join('facture_statut_notification', 'facture_statut_notification.num_facture', '=', 'paiement.num_facture')
            ->where('paiement.num_facture', $dbs[0]->num_facture)
            ->join('notification', 'facture_statut_notification.id_notification', '=', 'notification.id_notification')
            ->join('facture_statut', 'facture_statut.id_facture_statut', '=', 'facture_statut_notification.id_facture_statut')
            ->orderByDesc('facture_statut_notification.id_notification')
            ->get();
        // -----------------

        // Exécutez la requête SHOW COLUMNS
        $columns = DB::connection('mysql2')->select('SHOW COLUMNS FROM paiement WHERE Field = "moyen_paiement"');

        if (!empty($columns)) {
            // Si des colonnes sont trouvées
            $enumValues = $columns[0]->Type;

            // Vérifiez que le Type est de type ENUM
            if (strpos($enumValues, 'enum') === 0) {
                // Le Type est de type ENUM, extrayez les valeurs
                $enum_values = explode("','", substr($enumValues, 6, -2));

                // Vous pouvez maintenant utiliser $enum_values pour obtenir les valeurs de l'énumération
                // Par exemple, pour afficher les valeurs :
                foreach ($enum_values as $value) {
                    echo $value . '<br>';
                }
            } else {
                // Le Type n'est pas de type ENUM, gérez cette situation
            }
        } else {
            // Aucune colonne trouvée, gérez cette situation
        }


        return view('paiementss.show', ['dbs' => $dbs, 'paiement' => $paiement, 'date_paiement' => $date_paiement, 'date_emission' => $date_emission, 'clients' => $clients, 'packs' => $packs, 'produits' => $produits, 'paiementNotif' => $paiementNotif, 'enum_values' => $enum_values]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $facture)
    {

        $num2 = (int) $facture;


        $numfactures = DB::connection('mysql2')->select('SELECT num_facture FROM factures');
        foreach ($numfactures as $numfacture => $rang) {
            if ($num2 === $rang->num_facture) {
                $nums = DB::connection('mysql2')->select('SELECT num_facture FROM factures WHERE num_facture=' . $num2);
            }
        }

        if (!isset($nums)) {

            return redirect('/paiements');
        }


        return view('factures.edit', ['nums' => $nums, 'facture' => $facture]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $factures)
    {
        $request->validate([
            'num_facture' => 'required',
            'description',
            'nb_experimentateur',
            'nb_chanson',
            'statut_facture',
            'prix_total',
            'id_stripe',
            'url_facture',
            'date_demande',
            'date_validation',
            'date_envoie',
            'date_paiement'
        ]);

        $factures->update($request->all());
        return redirect('/paiementss')
            ->with('success', '');
    }

    /**
     * Remove the specified resource from storage.
     *d
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Procesuus de la suppression de la facture
    public function destroy(Facture $factures)
    {
        $factures->delete();
        return redirect('/paiementss')
            ->with('success', '');
    }

    // Procesuus de la suppression plusieur groupe en meme temps
    public function deleteall_g(Request $request)
    {
        // $nums = $request->get('nums');
        // Facture::whereIn('num', $nums)->delete();
        // return redirect('facturs');
    }

    public function valid(Request $request)
    {

        return view('factures.validate');
    }

    public function mode_paiement(Request $request)
    {
        $paiement = $request->id_paiement;
        $mode_paiement = $request->mode_paiement;

        $pai = DB::connection('mysql2')->table('paiement')
            ->where('id_paiment', '=', $paiement)
            ->orderByDesc('paiement.date_echeance')
            ->first();

        if ($pai->statut_paiement == "Non payé") {

            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
            $current_date->setTimestamp($timestamp);
            $notif_text = ' Le Paiement de ID ' . $paiement . ' a été validé le ' .  $current_date->format('Y-m-d H:i:s') . '';

            $notification = DB::connection('mysql2')->table('notification')
                ->insertGetId([
                    'contenu_notification' => $notif_text,
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'facture'
                ]);

            $pai = DB::connection('mysql2')->table('paiement')
                ->where('id_paiment', '=', $paiement)
                ->update([
                    'statut_paiement' => 'Payé',
                    'date_update' => $current_date->format('Y-m-d H:i:s'),
                    'moyen_paiement' => $mode_paiement,
                    'canal_paiement' => 'Direct'

                ]);

            $pai = DB::connection('mysql2')->table('paiement')
                ->where('id_paiment', '=', $paiement)
                ->first();

            if (isset($pai->id_stripe_paiement)) {
                $stripe = new \Stripe\StripeClient(
                    env('STRIPE_SECRET')
                );
                $stripe->invoices->pay(
                    $pai->id_stripe_paiement,
                    ['paid_out_of_band' => true]
                );
            }
            $this->updateStatutInDatabase(6, $pai->num_facture);



            return redirect()->route('paiements.show', ['paiement' => $paiement])
                ->with('success', 'Le paiement a bien été validé');
        } else {
            return redirect('/paiementss')
                ->with('error', 'Erreur lors de la validation du paiement');
        }
    }


    public function deleteSelect(Request $request)
    {
        $ids = $request->input('paiements');
        DB::connection('mysql2')->table('paiement')->whereIn('id_paiment', $ids)->delete();

        return redirect()->route('paiementss.index')->with('success', 'Selection supprimée avec succes');
    }
    private function updateStatutInDatabase($id_facture, $num_facture)
    {
        DB::connection('mysql2')->update('
        UPDATE facture_statut_notification
        SET id_facture_statut = ?
        WHERE num_facture = ?', [$id_facture, $num_facture]);
    }
}
