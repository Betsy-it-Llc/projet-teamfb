<?php

namespace App\Http\Controllers;

use App\Models\ContactExperience;
use DateTime;
use DateTimeZone;
use App\Models\experienceApp\Pack;
use App\Models\Notification;
use App\Models\experienceApp\Remise;
use App\Models\experienceApp\Contact;
use App\Models\experienceApp\Facture;
use App\Models\experienceApp\ListePrix;
use App\Models\Sortable;
use App\Models\experienceApp\Codepromo;
use App\Models\Entreprise;
use App\Models\experienceApp\Experience;
use App\Models\experienceApp\ExperienceStatutNotification;
use App\Models\experienceApp\PackExperience;
use Illuminate\Http\Request;
use App\Models\experienceApp\ProduitService;
use App\Models\FactureStatutNotification;
use App\Models\Paiement;
use Illuminate\Support\Str;
use Twilio\Rest\Client as Twilio;
use Illuminate\Support\Facades\DB;
use App\Models\FactureStatut;


use function PHPUnit\Framework\isNull;
use Illuminate\Database\Query\Builder;
use function PHPUnit\Framework\isEmpty;
use Carbon\Carbon;
use SplFileObject;

class FactureController extends Controller
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
        session()->put('url_precedente', url()->current());

        $perPage = $request->get('perPage') ?? 10;

        // Récupération de toutes les factures
        $list = Facture::on('mysql2')->get();

        // Requête Eloquent pour obtenir des informations sur les factures, les paiements et les contacts
        $query = Facture::on('mysql2')
            ->join('paiement', 'factures.num_facture', '=', 'paiement.num_facture')
            ->join('contact', 'paiement.id_contact', '=', 'contact.id_contact')
            ->select('factures.*', 'paiement.*', 'contact.*');

        // Filtres multi-critères
        $multisearchnom = $request->get('multisearchnom');
        $multisearchtel = $request->get('multisearchtel');
        $multisearchprenom = $request->get('multisearchprenom');
        $multisearchmail = $request->get('multisearchmail');
        $multisearchstat = $request->get('multisearchstat');

        // Application des filtres multi-critères
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
            $query->where('factures.statut_facture', 'LIKE', '%' . $multisearchstat . '%');
        }

        // Filtrage avancé
        $statut = $request->get('statut');
        $periode = $request->get('periode');


        if ($statut) {
            // Appliquer des filtres basés sur le statut
            $query->whereHas('facture_statut', function ($q) use ($statut) {
                $q->where('statut', $statut);
            });
        }


        // Filtrage par période
        if ($periode) {
            switch ($periode) {
                case 'semaine':
                    $query->where('factures.date_creation', '>=', Carbon::now()->subWeek());
                    break;
                case 'mois':
                    $query->where('factures.date_creation', '>=', Carbon::now()->subMonth());
                    break;
                case 'trimestre':
                    $query->where('factures.date_creation', '>=', Carbon::now()->subQuarter());
                    break;
                case 'annee':
                    $query->where('factures.date_creation', '>=', Carbon::now()->subYear());
                    break;
            }
        }


        // Finaliser la requête avec pagination
        $data = $query->paginate($perPage);


        // Autres requêtes converties en Eloquent
        $liste_statut_facture = FactureStatut::on('mysql2')->get();
        $dates_echeance = Facture::on('mysql2')
            ->join('paiement', 'factures.num_facture', '=', 'paiement.num_facture')
            ->where('paiement.statut_paiement', '=', 'Non payé')
            ->select('factures.*', 'paiement.date_echeance')
            ->get();

        $totalFac = $data->total();

        $statut_facture = FactureStatutNotification::on('mysql2')
            ->with('facture_statut')
            ->orderByDesc('id_notification')
            ->get();

        $date_reservation = FactureStatutNotification::on('mysql2')
            ->where('id_facture_statut', '=', 2)
            ->orderBy('id_notification')
            ->get();

        // Renvoyer la vue avec les données
        return view('factures.index', compact('data', 'list', 'perPage', 'statut_facture', 'date_reservation', 'totalFac', 'dates_echeance', 'liste_statut_facture'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    // ----------------------------------------------------------------------
    public function create(Request $request)
    {

        //Initialisation de la variable qui retient en memoire les clients de la facture
        if (!isset($request->id_contacts)) {
            $id_contacts = [];
        } else {
            $id_contacts = ($request->id_contacts);
        }

        //Initialisation de la variable qui retient en memoire les prestations qui ne sont pas liée à des packs
        if (!isset($request->id_autre_prest)) {
            $id_autre_prest = [];
        } else {
            $id_autre_prest = ($request->id_autre_prest);
        }
        //Initialisation de la variable qui retient en memoire les packs et les produits liée à ces packs
        if (!isset($request->packs_experience)) {
            $packs_experience = [];
        } else {
            $packs_experience = ($request->packs_experience);
        }
        //Initialisation de la variable qui retient en memoire toutes les informations liée au paiements
        if (!isset($request->paiements)) {
            $paiements['nb_echeances'] = 1;
            $paiements['nb_clients'] = 1;
            $paiements['nb_paiements'] = 1;
            $paiements['paiements'] = [];
        } else {
            $paiements = ($request->paiements);
        }
        //Initialisation de la variable qui retient en memoire la remise à appliquer à la facture
        if (!isset($request->fact_rem)) {
            $fact_rem = -1;
        } else {
            $fact_rem = ($request->fact_rem);
        }
        //Initialisation de la variable qui retient en memoire la description de la facture
        if (!isset($request->desc_fact)) {
            $desc_fact = "";
        } else {
            $desc_fact = $request->desc_fact;
        }

        /*Initialisation de la variable qui retient en memoire le nombre de fois que le code promo selectionné a été utilisé
        implementé par Yasser pour imposer le nombre d'utilisation limité d'un code promo*/
        if (!isset($request->id_code_used)) {
            $id_code_used = -1;
        } else {
            $id_code_used = $request->id_code_used;
        }

        //initialisation de plusieurs variables utils pour les pop-ups dans la page factures.create

        $id_org = Entreprise::where('id_organisation', '>', 0)->pluck('id_organisation')->toArray();
        $nom_org =  Entreprise::where('id_organisation', '>', 0)->pluck('nom')->toArray();

        $id_pack = Pack::where('id_pack', '>', 0)->where('statut', '!=', 'inactif')->where('statut', '!=', 'archivé')->pluck('id_pack')->toArray();
        $nom_pack = Pack::where('id_pack', '>', 0)->where('statut', '!=', 'inactif')->where('statut', '!=', 'archivé')->pluck('nom')->toArray();

        $id_prod = ProduitService::where('id_produit', '>', 0)->where('statut', '!=', 'inactif')->where('statut', '!=', 'archivé')->pluck('id_produit')->toArray();
        $nom_prod = ProduitService::where('id_produit', '>', 0)->where('statut', '!=', 'inactif')->where('statut', '!=', 'archivé')->pluck('nom_produit')->toArray();

        $id_code = Codepromo::where('id_code', '>', 0)->pluck('id_code')->toArray();
        $nom_code =  Codepromo::where('id_code', '>', 0)->pluck('code')->toArray();

        $codes_promo = DB::connection('mysql2')->table('codes_promo')->get();

        $id_remise = Remise::where('id_remise', '>', 0)->pluck('id_remise')->toArray();
        $nom_remise =  Remise::where('id_remise', '>', 0)->pluck('nom_remise')->toArray();

        $id_con = DB::connection('mysql2')->select('SELECT id_contact,nom,prenom FROM contact');

        /*$listecontacts= DB::connection('mysql2')->select('SELECT  contact.id_contact,contact.tel,contact.nom,contact.prenom,contact.email,contact.adresse,contact.code_postal,contact.ville,contact_entreprise.type,contact_entreprise.id_organisation,organisation.num_cse
        FROM contact
        LEFT JOIN contact_entreprise ON contact.id_contact = IFNULL(contact_entreprise.id_contact, "none")
        LEFT JOIN organisation ON IFNULL(contact_entreprise.id_organisation, "none") = IFNULL(organisation.id_organisation, "none")
        WHERE contact.id_contact IN (?)',[$imploded_id_contacts]);*/

        $listecontacts = DB::connection('mysql2')->table('contact')
            ->whereIn('contact.id_contact', $id_contacts)
            ->get();
        $contactscse = DB::connection('mysql2')->table('contact')
            ->join('contact_entreprise', 'contact.id_contact', '=', 'contact_entreprise.id_contact')
            ->join('organisation', 'organisation.id_organisation', '=', 'contact_entreprise.id_organisation')
            ->whereIn('contact.id_contact', $id_contacts)
            ->where('contact_entreprise.id_organisation', '>', 0)
            ->get();

        //Verification de la remise appliqué à la facture et si elle s'applique seulement à certains produits ou packs
        if ($request->fact_rem > 0) {
            $remise = DB::connection('mysql2')->table('remise')
                ->where('id_remise', $request->fact_rem)
                ->first();

            $count_pack_rem = DB::connection('mysql2')->table('packs_remise')
                ->where('id_remise', $remise->id_remise)
                ->count();

            $count_prod_rem = DB::connection('mysql2')->table('produit_service_remise')
                ->where('id_remise', $remise->id_remise)
                ->count();
        } else {
            $count_pack_rem = -1;

            $count_prod_rem = -1;
        }

        //Initialisation des variables pour rétenir tous les ids des packs et produits liées pour faciliter des réquêtes SQL plus tard
        $idpacks = [];
        $id_prodprestation = [];

        //Initialisation des variables outils pour definir les prix des participants et des titres
        $prix_participants = 0;
        $prix_titres = 0;
        $SEUIL = 9;
        $ENFANT = 35;
        $ENFANTSEUIL = 25;
        $ADULT = 40;
        $ADULTSEUIL = 35;
        $TITRE = 85;


        $montant_originel = 0;
        $montant_remise = 0;

        //Calcul des prix des partipants pour chaque pack
        foreach ($packs_experience as $p) {

            array_push($idpacks, $p['id_pack']);
            $ad = $p['nb_adults'];
            $en = $p['nb_enfants'];
            $ti = $p['nb_titres'];
            //S'il y a des participants supplementaires
            if (($ad > 0) || ($en > 0)) {
                //et on a une remise qui s'applique à au moins un produit (n'importe si present dans la facture)
                if (($count_prod_rem > 0) && ($fact_rem > 0)) {
                    $part_rem = DB::connection('mysql2')->table('produit_service_remise')
                        ->where('id_remise', $remise->id_remise)
                        ->where('id_produit', '=', 5)
                        ->first();
                    //Si cette remise s'applique au participants supplementaires
                    if (!is_null($part_rem)) {

                        $participant_remise = DB::connection('mysql2')->table('historique_remise')
                            ->where('id_historique_remise', '=', $part_rem->id_historique_remise)
                            ->first();
                        //Si la remise applique en réduction de x%
                        if ((isset($participant_remise->taux)) && (!is_null($participant_remise->taux))) {
                            //Si des enfants participent à l'expérience
                            if ($en > 0) {
                                $rem_enf = $ENFANT - ($ENFANT * ($participant_remise->taux / 100));

                                if ($rem_enf < 0) {
                                    $rem_enf = 0;
                                }

                                $rem_enf_seuil = $ENFANTSEUIL - ($ENFANTSEUIL * ($participant_remise->taux / 100));

                                if ($rem_enf_seuil < 0) {
                                    $rem_enf_seuil = 0;
                                }
                                if ($en > $SEUIL) {
                                    $prix_participants += ($rem_enf * $SEUIL) + ($rem_enf_seuil * ($en - $SEUIL));
                                } else {
                                    $prix_participants += ($rem_enf * $en);
                                }
                            }
                            //Si des adults participent à l'expérience
                            if ($ad > 0) {
                                $ad--;
                                $rem_ad = $ADULT - ($ADULT * ($participant_remise->taux / 100));

                                if ($rem_ad < 0) {
                                    $rem_ad = 0;
                                }

                                $rem_ad_seuil = $ADULTSEUIL - ($ADULTSEUIL * ($participant_remise->taux / 100));

                                if ($rem_ad_seuil < 0) {
                                    $rem_ad_seuil = 0;
                                }
                                if ($ad > $SEUIL) {
                                    $prix_participants += ($rem_ad * $SEUIL) + ($rem_ad_seuil * ($ad - $SEUIL));
                                } else {
                                    $prix_participants += ($rem_ad * $ad);
                                }
                            }

                            $prix_participants = round($prix_participants, 2);
                            if ($prix_participants < 0) {
                                $prix_participants = 0;
                            }
                        }
                        //Sinon si la remise applique un reduction de -x €
                        elseif ((isset($participant_remise->montant)) && (!is_null($participant_remise->montant))) {
                            //Si des enfants participent à l'expérience
                            if ($en > 0) {
                                $rem_enf = $ENFANT - $participant_remise->montant;

                                if ($rem_enf < 0) {
                                    $rem_enf = 0;
                                }

                                $rem_enf_seuil = $ENFANTSEUIL - $participant_remise->montant;

                                if ($rem_enf_seuil < 0) {
                                    $rem_enf_seuil = 0;
                                }

                                if ($en > $SEUIL) {
                                    $prix_participants += ($rem_enf * $SEUIL) + ($rem_enf_seuil * ($en - $SEUIL));
                                } else {
                                    $prix_participants += ($rem_enf * $en);
                                }
                            }
                            //Si des adults participent à l'expérience
                            if ($ad > 0) {
                                $ad--;

                                $rem_ad = $ADULT - $participant_remise->montant;

                                if ($rem_ad < 0) {
                                    $rem_ad = 0;
                                }

                                $rem_ad_seuil = $ADULTSEUIL - $participant_remise->montant;

                                if ($rem_ad_seuil < 0) {
                                    $rem_ad_seuil = 0;
                                }

                                if ($ad > $SEUIL) {
                                    $prix_participants += ($rem_ad * $SEUIL) + ($rem_ad_seuil * ($ad - $SEUIL));
                                } else {
                                    $prix_participants += ($rem_ad * $ad);
                                }
                            }

                            $prix_participants = round($prix_participants, 2);
                            if ($prix_participants < 0) {
                                $prix_participants = 0;
                            }
                        }
                        //Si la remise n'a ni un taux ni un montant à appliquer
                        else {
                            // théoriquement impossible mais inclu pour pouvoir assurer avec le elseif que ce passe seulement si on a un taux ou un montant
                        }
                    }
                    //Sinon la remise ne s'applique pas au participants supplementaires
                    else {
                        if ($en > 0) {

                            if ($en > $SEUIL) {
                                $prix_participants += ($ENFANT * $SEUIL) + ($ENFANTSEUIL * ($en - $SEUIL));
                            } else {
                                $prix_participants += ($ENFANT * $en);
                            }
                        }
                        if ($ad > 0) {
                            $ad--;
                            if ($ad > $SEUIL) {
                                $prix_participants += ($ADULT * $SEUIL) + ($ADULTSEUIL * ($ad - $SEUIL));
                            } else {
                                $prix_participants += ($ADULT * $ad);
                            }
                        }
                    }
                }
                //Sinon on a pas une remise qui s'applique à un produit
                else {
                    if ($en > 0) {

                        if ($en > $SEUIL) {
                            $prix_participants += ($ENFANT * $SEUIL) + ($ENFANTSEUIL * ($en - $SEUIL));
                        } else {
                            $prix_participants += ($ENFANT * $en);
                        }
                    }
                    if ($ad > 0) {
                        $ad--;
                        if ($ad > $SEUIL) {
                            $prix_participants += ($ADULT * $SEUIL) + ($ADULTSEUIL * ($ad - $SEUIL));
                        } else {
                            $prix_participants += ($ADULT * $ad);
                        }
                    }
                }
            }




            //Si on a une remise qui s'applique à au moins un produit (n'importe si present dans la facture)
            if (($count_prod_rem > 0) && ($fact_rem > 0)) {
                $tit_rem = DB::connection('mysql2')->table('produit_service_remise')
                    ->where('id_remise', $remise->id_remise)
                    ->where('id_produit', '=', 4)
                    ->first();

                //et si la remise s'applique au titres supplementaires
                if (!is_null($tit_rem)) {
                    $titre_remise = DB::connection('mysql2')->table('historique_remise')
                        ->where('id_historique_remise', '=', $tit_rem->id_historique_remise)
                        ->first();

                    //Si la remise applique en réduction de x%
                    if ((isset($titre_remise->taux)) && (!is_null($titre_remise->taux))) {
                        $rem_tit = $TITRE - ($TITRE * ($titre_remise->taux / 100));

                        if ($rem_tit < 0) {
                            $rem_tit = 0;
                        }

                        $prix_titres += ($ti - 1) * $rem_tit;

                        $prix_titres = round($prix_titres, 2);
                        if ($prix_titres < 0) {
                            $prix_titres = 0;
                        }
                    }
                    //Si la remise applique en réduction de x%
                    elseif ((isset($titre_remise->montant)) && (!is_null($titre_remise->montant))) {
                        $rem_tit = $TITRE - $titre_remise->montant;

                        if ($rem_tit < 0) {
                            $rem_tit = 0;
                        }

                        $prix_titres += ($ti - 1) * $rem_tit;

                        $prix_titres = round($prix_titres, 2);
                        if ($prix_titres < 0) {
                            $prix_titres = 0;
                        }
                    }

                    //Si la remise n'a ni un taux ni un montant à appliquer
                    else {
                        // théoriquement impossible mais inclu pour pouvoir assurer avec le elseif que ce passe seulement si on a un taux ou un montant
                    }
                }
                //Sinon la remise ne s'applique pas au titres supplementaires
                else {
                    $prix_titres += ($ti - 1) * $TITRE;
                }
            }
            //Sinon on a pas une remise qui s'applique à un produit
            else {
                $prix_titres += ($ti - 1) * $TITRE;
            }


            if (!isset($p['id_prest'])) {
                array_push($id_prodprestation, null);
            } else {
                array_push($id_prodprestation, $p['id_prest']);
            }
        }

        //Initialisation des variables qui retiennent les packs et les produits et en plus les prix par défaut des ces packs et produits

        $listepacks = DB::connection('mysql2')->table('pack')
            ->whereIn('pack.id_pack', $idpacks)
            ->get();

        $prix_packs = DB::connection('mysql2')->table('liste_prix')
            ->whereIn('liste_prix.id_pack', $idpacks)
            ->where('liste_prix.statut', '=', 'Par défaut')
            ->orWhere(function (Builder $query) use ($idpacks) {
                $query->whereIn('liste_prix.id_pack', $idpacks)
                    ->where('liste_prix.statut', '=', 'Par defaut');
            })
            ->get();

        $packsprestation = DB::connection('mysql2')->table('produits_services')
            ->whereIn('produits_services.id_produit', $id_prodprestation)
            ->get();

        $prix_packsprestation = DB::connection('mysql2')->table('liste_prix')
            ->whereIn('liste_prix.id_produit', $id_prodprestation)
            ->where('liste_prix.statut', '=', 'Par défaut')
            ->orWhere(function (Builder $query) use ($id_prodprestation) {
                $query->whereIn('liste_prix.id_produit', $id_prodprestation)
                    ->where('liste_prix.statut', '=', 'Par defaut');
            })
            ->get();


        $autres_prestations = DB::connection('mysql2')->table('produits_services')
            ->whereIn('produits_services.id_produit', $id_autre_prest)
            ->get();

        $prix_autres_prestation = DB::connection('mysql2')->table('liste_prix')
            ->whereIn('liste_prix.id_produit', $id_autre_prest)
            ->where('liste_prix.statut', '=', 'Par défaut')
            ->orWhere(function (Builder $query) use ($id_autre_prest) {
                $query->whereIn('liste_prix.id_produit', $id_autre_prest)
                    ->where('liste_prix.statut', '=', 'Par defaut');
            })
            ->get();


        /*
            id_autre_prest
            packs_experience
        */

        //Si on a une remise qui s'applique à un pack (n'importe si pas présent dans la facture)
        if (($count_pack_rem > 0) && ($fact_rem > 0)) {
            $pack_hist_remise = DB::connection('mysql2')->table('packs_remise')
                ->join('historique_remise', 'historique_remise.id_historique_remise', '=', 'packs_remise.id_historique_remise')
                ->where('packs_remise.id_remise', $remise->id_remise)
                ->get();

            //Si la remise s'applique au moins à un pack présent dans la facture
            if (!$pack_hist_remise->isEmpty()) {
                $prod_hist_remise = DB::connection('mysql2')->table('produit_service_remise')
                    ->join('historique_remise', 'historique_remise.id_historique_remise', '=', 'produit_service_remise.id_historique_remise')
                    ->where('produit_service_remise.id_remise', $remise->id_remise)
                    ->get();

                foreach ($packs_experience as $pack) {
                    //Verification pour assurer qu'on peut utiliser la variable liste prix pour saisir les prix du pack
                    if (!$prix_packs->isEmpty()) {
                        $p = $listepacks->firstWhere('id_pack', $pack['id_pack']);
                        $montant_originel += $prix_packs->reverse()->firstWhere('id_pack', $p->id_pack)->prix;

                        $p_hist_rem = $pack_hist_remise->firstWhere('id_pack', $p->id_pack);

                        //Si la remise s'applique à ce pack on ajoute aux prix total sous remise le prix du pack avec la remise appliqué
                        if (!is_null($p_hist_rem)) {
                            if ((isset($p_hist_rem->taux)) && (!is_null($p_hist_rem->taux))) {
                                $r_p = $prix_packs->reverse()->firstWhere('id_pack', $p->id_pack)->prix;

                                $montant_remise += $r_p - ($r_p * ($p_hist_rem->taux / 100));
                                $montant_remise = round($montant_remise, 2);
                                if ($montant_remise < 0) {
                                    $montant_remise = 0;
                                }
                            } elseif ((isset($p_hist_rem->montant)) && (!is_null($p_hist_rem->montant))) {
                                $r_p = $prix_packs->reverse()->firstWhere('id_pack', $p->id_pack)->prix;

                                $montant_remise += $r_p - $p_hist_rem->montant;
                                $montant_remise = round($montant_remise, 2);
                                if ($montant_remise < 0) {
                                    $montant_remise = 0;
                                }
                            } else {
                                $montant_remise += $prix_packs->reverse()->firstWhere('id_pack', $p->id_pack)->prix;
                            }
                        }
                        //Sinon la remise ne s'applique pas à ce pack et on ajoute le prix sans réductions
                        else {
                            $montant_remise += $prix_packs->reverse()->firstWhere('id_pack', $p->id_pack)->prix;
                        }

                        //Si le pack a un produit associé
                        if (isset($pack['id_prest'])) {
                            $pr = $packsprestation->firstWhere('id_produit', $pack['id_prest']);
                            $montant_originel += $prix_packsprestation->reverse()->firstWhere('id_produit', $pr->id_produit)->prix;

                            $p_hist_rem = $prod_hist_remise->firstWhere('id_produit', $pr->id_produit);

                            //Si la remise s'applique à ce produit on ajoute aux prix total sous remise le prix du pack avec la remise appliqué
                            if (!is_null($p_hist_rem)) {
                                if ((isset($p_hist_rem->taux)) && (!is_null($p_hist_rem->taux))) {
                                    $r_p = $prix_packsprestation->reverse()->firstWhere('id_produit', $pr->id_produit)->prix;

                                    $montant_remise += $r_p - ($r_p * ($p_hist_rem->taux / 100));
                                    $montant_remise = round($montant_remise, 2);
                                    if ($montant_remise < 0) {
                                        $montant_remise = 0;
                                    }
                                } elseif ((isset($p_hist_rem->montant)) && (!is_null($p_hist_rem->montant))) {
                                    $r_p = $prix_packsprestation->reverse()->firstWhere('id_produit', $pr->id_produit)->prix;

                                    $montant_remise += $r_p - $p_hist_rem->montant;
                                    $montant_remise = round($montant_remise, 2);
                                    if ($montant_remise < 0) {
                                        $montant_remise = 0;
                                    }
                                } else {
                                    $montant_remise += $prix_packsprestation->reverse()->firstWhere('id_produit', $pr->id_produit)->prix;
                                }
                            } else {
                                $montant_remise += $prix_packsprestation->reverse()->firstWhere('id_produit', $pr->id_produit)->prix;
                            }
                        }
                    }
                    /*Il y a quelque chose qui ne me convainque pas de cet else mais il est passé assez longtemps de ne me pas rappéler la raison précise, ça pourrait démander de réexaminer s'il y a besoin de cet else et/ou s'il est dans le bon endroit*/ else {
                        foreach ($packs_experience as $pack) {
                            //Verification pour assurer qu'on peut utiliser la variable liste prix pour saisir les prix du pack
                            if (!$prix_packs->isEmpty()) {
                                $p = $listepacks->firstWhere('id_pack', $pack['id_pack']);
                                $montant_originel += $prix_packs->reverse()->firstWhere('id_pack', $p->id_pack)->prix;
                                $montant_remise += $prix_packs->reverse()->firstWhere('id_pack', $p->id_pack)->prix;

                                //Si le pack a un produit associé
                                if (isset($pack['id_prest'])) {
                                    $pr = $packsprestation->firstWhere('id_produit', $pack['id_prest']);
                                    $montant_originel += $prix_packsprestation->reverse()->firstWhere('id_produit', $pr->id_produit)->prix;

                                    $p_hist_rem = $prod_hist_remise->firstWhere('id_produit', $pr->id_produit);

                                    //Si la remise s'applique à ce produit on ajoute aux prix total sous remise le prix du pack avec la remise appliqué
                                    if (!is_null($p_hist_rem)) {
                                        if ((isset($p_hist_rem->taux)) && (!is_null($p_hist_rem->taux))) {
                                            $r_p = $prix_packsprestation->reverse()->firstWhere('id_produit', $pr->id_produit)->prix;

                                            $montant_remise += $r_p - ($r_p * ($p_hist_rem->taux / 100));
                                            $montant_remise = round($montant_remise, 2);
                                            if ($montant_remise < 0) {
                                                $montant_remise = 0;
                                            }
                                        } elseif ((isset($p_hist_rem->montant)) && (!is_null($p_hist_rem->montant))) {
                                            $r_p = $prix_packsprestation->reverse()->firstWhere('id_produit', $pr->id_produit)->prix;

                                            $montant_remise += $r_p - $p_hist_rem->montant;
                                            $montant_remise = round($montant_remise, 2);
                                            if ($montant_remise < 0) {
                                                $montant_remise = 0;
                                            }
                                        } else {
                                            $montant_remise += $prix_packsprestation->reverse()->firstWhere('id_produit', $pr->id_produit)->prix;
                                        }
                                    } else {
                                        $montant_remise += $prix_packsprestation->reverse()->firstWhere('id_produit', $pr->id_produit)->prix;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        //Sinon si la remise d'applique à un produit (n'importe s'il n'es tpas présent dans la facture)
        elseif (($count_prod_rem > 0) && ($fact_rem > 0)) {

            foreach ($packs_experience as $pack) {
                //Verification pour assurer qu'on peut utiliser la variable liste prix pour saisir les prix du pack
                if (!$prix_packs->isEmpty()) {
                    $p = $listepacks->firstWhere('id_pack', $pack['id_pack']);
                    $montant_originel += $prix_packs->reverse()->firstWhere('id_pack', $p->id_pack)->prix;
                    $montant_remise += $prix_packs->reverse()->firstWhere('id_pack', $p->id_pack)->prix;

                    $prod_hist_remise = DB::connection('mysql2')->table('produit_service_remise')
                        ->join('historique_remise', 'historique_remise.id_historique_remise', '=', 'produit_service_remise.id_historique_remise')
                        ->where('produit_service_remise.id_remise', $remise->id_remise)
                        ->get();


                    //Si le pack a un produit associé
                    if (isset($pack['id_prest'])) {

                        $pr = $packsprestation->firstWhere('id_produit', $pack['id_prest']);
                        $montant_originel += $prix_packsprestation->reverse()->firstWhere('id_produit', $pr->id_produit)->prix;

                        $p_hist_rem = $prod_hist_remise->firstWhere('id_produit', $pr->id_produit);

                        //Si la remise s'applique à ce produit on ajoute aux prix total sous remise le prix du pack avec la remise appliqué
                        if (!is_null($p_hist_rem)) {

                            if ((isset($p_hist_rem->taux)) && (!is_null($p_hist_rem->taux))) {
                                $r_p = $prix_packsprestation->reverse()->firstWhere('id_produit', $pr->id_produit)->prix;

                                $montant_remise += $r_p - ($r_p * ($p_hist_rem->taux / 100));
                                $montant_remise = round($montant_remise, 2);
                                if ($montant_remise < 0) {
                                    $montant_remise = 0;
                                }
                            } elseif ((isset($p_hist_rem->montant)) && (!is_null($p_hist_rem->montant))) {
                                $r_p = $prix_packsprestation->reverse()->firstWhere('id_produit', $pr->id_produit)->prix;

                                $montant_remise += $r_p - $p_hist_rem->montant;
                                $montant_remise = round($montant_remise, 2);
                                if ($montant_remise < 0) {
                                    $montant_remise = 0;
                                }
                            } else {
                                $montant_remise += $prix_packsprestation->reverse()->firstWhere('id_produit', $pr->id_produit)->prix;
                            }
                        } else {
                            $montant_remise += $prix_packsprestation->reverse()->firstWhere('id_produit', $pr->id_produit)->prix;
                        }
                    }
                }
            }
        }
        //Sinon si la remise ne s'applique à aucun produit et aucun pack
        else {
            foreach ($packs_experience as $pack) {
                if (!$prix_packs->isEmpty()) {
                    $p = $listepacks->firstWhere('id_pack', $pack['id_pack']);
                    $montant_originel += $prix_packs->reverse()->firstWhere('id_pack', $p->id_pack)->prix;
                    $montant_remise += $prix_packs->reverse()->firstWhere('id_pack', $p->id_pack)->prix;

                    if (isset($pack['id_prest'])) {
                        $pr = $packsprestation->firstWhere('id_produit', $pack['id_prest']);
                        $montant_originel += $prix_packsprestation->reverse()->firstWhere('id_produit', $pr->id_produit)->prix;
                        $montant_remise += $prix_packsprestation->reverse()->firstWhere('id_produit', $pr->id_produit)->prix;
                    }
                }
            }
        }


        /*foreach($packsprestation as $p)
        {
            if(!$prix_packsprestation->isEmpty())
            {
                $montant_originel+=$prix_packsprestation->reverse()->firstWhere('id_produit',$p->id_produit)->prix;
            }
        }*/

        //Sinon si la remise d'applique à un produit (n'importe s'il n'es tpas présent dans la facture)
        if (($count_prod_rem > 0) && ($fact_rem > 0)) {

            $prod_hist_remise = DB::connection('mysql2')->table('produit_service_remise')
                ->join('historique_remise', 'historique_remise.id_historique_remise', '=', 'produit_service_remise.id_historique_remise')
                ->where('produit_service_remise.id_remise', $remise->id_remise)
                ->get();

            //Si la remise s'applique à un des produits présents dans la facture
            if (!$prod_hist_remise->isEmpty()) {
                foreach ($id_autre_prest as $id_a_prest) {

                    //Verification pour assurer qu'on peut utiliser la variable liste prix pour saisir les prix du produit
                    if (!$prix_autres_prestation->isEmpty()) {
                        $p = $autres_prestations->firstWhere('id_produit', $id_a_prest);

                        $montant_originel += $prix_autres_prestation->reverse()->firstWhere('id_produit', $p->id_produit)->prix;

                        $p_hist_rem = $prod_hist_remise->firstWhere('id_produit', $p->id_produit);

                        //Si la remise s'applique à ce produit on ajoute aux prix total sous remise le prix du pack avec la remise appliqué
                        if (!is_null($p_hist_rem)) {
                            if ((isset($p_hist_rem->taux)) && (!is_null($p_hist_rem->taux))) {
                                $r_p = $prix_autres_prestation->reverse()->firstWhere('id_produit', $p->id_produit)->prix;

                                $montant_remise += $r_p - ($r_p * ($p_hist_rem->taux / 100));
                                $montant_remise = round($montant_remise, 2);
                                if ($montant_remise < 0) {
                                    $montant_remise = 0;
                                }
                            } elseif ((isset($p_hist_rem->montant)) && (!is_null($p_hist_rem->montant))) {
                                $r_p = $prix_autres_prestation->reverse()->firstWhere('id_produit', $p->id_produit)->prix;

                                $montant_remise += $r_p - $p_hist_rem->montant;
                                $montant_remise = round($montant_remise, 2);
                                if ($montant_remise < 0) {
                                    $montant_remise = 0;
                                }
                            } else {
                                // nothing happens
                            }
                        } else {
                            $montant_remise += $prix_autres_prestation->reverse()->firstWhere('id_produit', $p->id_produit)->prix;
                        }
                    }
                }
            } //Sinon la remise ne s'applique pas à ce produit
            else {
                foreach ($id_autre_prest as $id_a_prest) {
                    if (!$prix_autres_prestation->isEmpty()) {
                        $p = $autres_prestations->firstWhere('id_produit', $id_a_prest);

                        $montant_originel += $prix_autres_prestation->reverse()->firstWhere('id_produit', $p->id_produit)->prix;
                    }
                }
            }
        }
        //Sinon la remise ne s'applique à aucun produit
        else {
            foreach ($id_autre_prest as $id_a_prest) {
                if (!$prix_autres_prestation->isEmpty()) {
                    $p = $autres_prestations->firstWhere('id_produit', $id_a_prest);

                    $montant_originel += $prix_autres_prestation->reverse()->firstWhere('id_produit', $p->id_produit)->prix;
                }
            }
        }

        //Ajout au montant total des prix des participants et des titres

        $montant_originel += $prix_participants + $prix_titres;
        $montant_originel = round($montant_originel, 2);
        $montant_remise += $prix_participants + $prix_titres;
        $montant_remise = round($montant_remise, 2);
        //$montant_remise=$montant_originel;

        /*Verifications finale pour vérifier si on doit appliquer la remise à la globalité de la facture (remise selectioné mais non associé à des packs et des produits) ,
        ou si on ne doit pas appliquer une remise ou prendre le montant qu'on a calculé précedamment parce que la remise s'applique à des produits présents dans la facture*/

        //Si on a une remise que ne s'applique à aucun produit et à aucun pack on applique la rémise à la totalité de la facture
        if (($request->fact_rem > 0) && ($count_prod_rem <= 0) && ($count_pack_rem <= 0)) {
            $montant_remise = $montant_originel;


            $remise = DB::connection('mysql2')->table('remise')
                ->where('id_remise', $request->fact_rem)
                ->first();

            $latest_remise = DB::connection('mysql2')->table('historique_remise')
                ->where('id_remise', $remise->id_remise)
                ->orderByDesc('id_historique_remise')
                ->first();


            if ((isset($latest_remise->taux)) && (!is_null($latest_remise->taux))) {
                $montant_remise = $montant_originel - ($montant_originel * ($latest_remise->taux / 100));
                $montant_remise = round($montant_remise, 2);
                if ($montant_remise < 0) {
                    $montant_remise = 0;
                }
            } elseif ((isset($latest_remise->montant)) && (!is_null($latest_remise->montant))) {
                $montant_remise = $montant_originel - $latest_remise->montant;
                $montant_remise = round($montant_remise, 2);
                if ($montant_remise < 0) {
                    $montant_remise = 0;
                }
            } else {
                return redirect()->route('factures.create', compact('id_contacts', 'id_autre_prest', 'packs_experience', 'paiements', 'desc_fact', 'id_code_used'))
                    ->with('error', 'Erreur lors de la création de la facture');
            }
        }
        /*Cette verification vérifie qu'on a une remise mais qu'on a pas d'entrées dans la table liste prix
        Si je me rappelle correctement cette partie à été crée quand on avait seulement un produit et pack avec une entrée dans liste_prix
        cet if est à réverifier et si j'e ne me rappelle pas correctemtn est à réexaminer complétement*/ elseif (($request->fact_rem > 0) && (($prix_packs->isEmpty()) && ($prix_packsprestation->isEmpty()) && ($prix_autres_prestation->isEmpty()))) {

            $montant_remise = $montant_originel;
        }
        //Si on a pas une remise on applique pas une remise
        elseif ($request->fact_rem < 0) {

            $montant_remise = $montant_originel;
        } else {
            // nothing happens? Inséré pendants mes test à réexaminer

        }

        //    ----------------------------------------
        $all_orga = Entreprise::all();


        return view('factures.create', [
            'id_con' => $id_con, 'id_contacts' => $id_contacts, 'listecontacts' => $listecontacts, 'contactscse' => $contactscse, 'id_org' => $id_org, 'nom_org' => $nom_org,
            'id_pack' => $id_pack, 'nom_pack' => $nom_pack, 'id_prod' => $id_prod, 'nom_prod' => $nom_prod, 'id_autre_prest' => $id_autre_prest, 'packs_experience' => $packs_experience,
            'autres_prestations' => $autres_prestations, 'montant_originel' => $montant_originel, 'montant_remise' => $montant_remise, 'id_remise' => $id_remise, 'nom_remise' => $nom_remise, 'id_code' => $id_code, 'nom_code' => $nom_code,
            'paiements' => $paiements, 'listepacks' => $listepacks, 'packsprestation' => $packsprestation, 'autres_prestations' => $autres_prestations, 'fact_rem' => $fact_rem, 'desc_fact' => $desc_fact, 'codes_promo' => $codes_promo, 'all_orga' => $all_orga, 'id_code_used' => $id_code_used,
            'prix_packs' => $prix_packs, 'prix_packsprestation' => $prix_packsprestation, 'prix_autres_prestation' => $prix_autres_prestation
        ]);
    }
    // ------------------------------------------------------------------------




    /**
     * Inserts an existing contact in the facture.create page
     *
     * @return \Illuminate\Http\Response
     */
    public function insertExistingContact(Request $request)
    {
        // dd($request);
        $request->validate([
            'id_contacts' => 'required|nullable',
            'id_contacts.*' => 'distinct|different:id_cnt',
            'id_autre_prest' => 'required|nullable',
            'packs_experience' => 'required|nullable',
            'paiements' => 'required|nullable',
            'fact_rem' => 'required|nullable',
            'desc_fact' => 'sometimes|string|nullable',
            'id_cnt' => 'required|exists:mysql2.contact,id_contact|not_in:id_contacts',

        ]);
        $id_stripeVerif  = DB::connection('mysql2')->select('SELECT id_client_stripe FROM contact WHERE id_contact=' . $request->id_cnt . '');
        if (empty($id_stripeVerif[0]->id_client_stripe)) {
            $con = DB::connection('mysql2')->select('SELECT * FROM contact WHERE id_contact=' . $request->id_cnt . '');

            $stripe = new \Stripe\StripeClient(
                env('STRIPE_SECRET')
            );
            $client = $stripe->customers->create([
                'address' => [
                    'line1' => $con[0]->adresse,
                    'postal_code' => $con[0]->code_postal,
                    'city' => $con[0]->ville,
                ],
                'phone' => $con[0]->tel,
                'email' => $con[0]->email,
                'name' => $con[0]->prenom . ' ' . $con[0]->nom,
                'metadata' =>
                [
                    'id_contact' => $con[0]->id_contact
                ]
            ]);

            $client = substr($client, 22);

            $client = json_decode($client, true);


            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
            $current_date->setTimestamp($timestamp);
            $notif_text = ' Mise à jour liée à stripe du contact de ID ' . $con[0]->id_contact . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

            $notification = DB::connection('mysql2')->table('notification')
                ->insertGetId([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'produit'
                ]);

            DB::connection('mysql2')
                ->update('UPDATE contact SET contact.id_client_stripe="' . $client['id'] . '", contact.url_client_stripe="https://dashboard.stripe.com/test/customers/' . $client['id'] . '", contact.date_update="' . $current_date->format('Y-m-d H:i:s') . '" WHERE contact.id_contact=' . $request->id_cnt . '');
            error_log('client Ok');
        }


        $id_contacts = unserialize($request->id_contacts);
        array_push($id_contacts, $request->id_cnt);

        $id_autre_prest = unserialize($request->id_autre_prest);
        $packs_experience = unserialize($request->packs_experience);
        $paiements = unserialize($request->paiements);
        $fact_rem = $request->fact_rem;
        $desc_fact = $request->desc_fact;
        $id_code_used = $request->id_code_used;

        return redirect()->route('factures.create', compact('id_contacts', 'id_autre_prest', 'packs_experience', 'paiements', 'fact_rem', 'desc_fact', 'id_code_used'))
            ->with('success', 'Contact ajouté avec succes');
    }

    /**
     * Creates a new contanct and then inserts it in the facture.create page
     *
     * @return \Illuminate\Http\Response
     */

    public function insertNewContact(Request $request)
    {
        $request->validate([
            'avatar',
            'id_contacts' => 'required|nullable',
            'id_contacts.*' => 'distinct|different:id_cnt',
            'Nom' => 'required',
            'Prénom' => 'required',
            'mail' => ['nullable', 'required_without:tel', 'email', 'unique:mysql2.contact,email'],
            'tel' => 'nullable|numeric|digits:10|unique:mysql2.contact,tel|required_without:mail',
            'adress',
            'cp' => 'nullable|numeric|digits_between:3,5',
            'ville',
            'url',
            'entreprise' => 'nullable|exists:mysql2.organisation,id_organisation',
            'type',
            'id_autre_prest' => 'required|nullable',
            'desc_fact' => 'sometimes|string|nullable',
            'packs_experience' => 'required|nullable',
            'paiements' => 'required|nullable',
            'fact_rem' => 'required|nullable'
        ]);

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $notif_text = ' Creation d\'un nouveau contact le ' .  $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
            ->insertGetId([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'contact'
            ]);


        $con = Contact::create([
            'nom' => $request->Nom,
            'prenom' => $request->Prénom,
            'email' => $request->mail,
            'tel' => $request->tel,
            'adresse' => $request->adress,
            'code_postal' => $request->cp,
            'ville' => $request->ville,
            'url_contact_folder' => $request->entreprise,
            'date_creation' => $current_date->format('Y-m-d H:i:s'),
            'date_update' => $current_date->format('Y-m-d H:i:s'),
        ]);
        /***********************************************Oumayma********************************************************* */
        if (!is_null($request->entreprise)) {
            $org = $request->entreprise;
            // Vérification d'id_organisation s'est une valeur valide avant l'insertion
            $isValidOrganisation = DB::connection('mysql2')->table('organisation')
                ->where('id_organisation', $org)
                ->exists();

            if (!$isValidOrganisation) {
                $org = null;
            }
        } else {
            $org = null;
        }

        DB::connection('mysql2')->insert("INSERT INTO contact_entreprise (id_contact, type, id_organisation) VALUES (?, ?, ?)", [$con->id, $request->type, $org]);

        /*
        if(!is_null($request->entreprise))
        {
            $org=DB::connection('mysql2')->insert("INSERT INTO contact_entreprise (id_contact, type, id_organisation) VALUES (?,?,?)",[$con->id,$request->type,$request->entreprise]);
        }

*/
        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );
        $client = $stripe->customers->create([
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
        ]);

        $client = substr($client, 22);

        $client = json_decode($client, true);

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $notif_text = ' Mise à jour liée à stripe du contact de ID ' . $con->id_contact . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
            ->insertGetId([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'produit'
            ]);

        DB::connection('mysql2')
            ->update('UPDATE contact SET contact.id_client_stripe="' . $client['id'] . '", contact.url_client_stripe="https://dashboard.stripe.com/test/customers/' . $client['id'] . '",contact.date_update="' . $current_date->format('Y-m-d H:i:s') . '" WHERE contact.id_contact=' . $con->id . '');

        $id_contacts = unserialize($request->id_contacts);
        array_push($id_contacts, $con->id);

        $id_autre_prest = unserialize($request->id_autre_prest);
        $packs_experience = unserialize($request->packs_experience);
        $paiements = unserialize($request->paiements);
        $fact_rem = $request->fact_rem;
        $desc_fact = $request->desc_fact;
        $id_code_used = $request->id_code_used;


        return redirect()->route('factures.create', compact('id_contacts', 'id_autre_prest', 'packs_experience', 'paiements', 'fact_rem', 'desc_fact', 'id_code_used'))
            ->with('success', 'Contact ajouté avec succes');
    }

    /**
     * Inserts an existing autre prestation in the facture.create page
     *
     * @return \Illuminate\Http\Response
     */
    public function insertExistingAutrePrestation(Request $request)
    {
        $request->validate([
            'id_contacts' => 'required|nullable',
            'id_contacts.*' => 'distinct|different:id_cnt',
            'id_autre_prest' => 'required|nullable',
            'packs_experience' => 'required|nullable',
            'id_prest' => 'required|exists:mysql2.produits_services,id_produit|not_in:id_autre_prest',
            'paiements' => 'required|nullable',
            'desc_fact' => 'sometimes|string|nullable',
            'fact_rem' => 'required|nullable'
        ]);
        $id_contacts = unserialize($request->id_contacts);
        $packs_experience = unserialize($request->packs_experience);


        $id_autre_prest = unserialize($request->id_autre_prest);
        array_push($id_autre_prest, $request->id_prest);

        $paiements = unserialize($request->paiements);
        $fact_rem = $request->fact_rem;
        $desc_fact = $request->desc_fact;
        $id_code_used = $request->id_code_used;

        return redirect()->route('factures.create', compact('id_contacts', 'id_autre_prest', 'packs_experience', 'paiements', 'fact_rem', 'desc_fact', 'id_code_used'))
            ->with('success', 'Prestation ajoutée avec succes');
    }


    /**
     * Creats a new autre prestation and then inserts it in the facture.create page
     *
     * @return \Illuminate\Http\Response
     */
    public function insertNewAutrePrestation(Request $request)
    {
        $request->validate([
            'id_contacts' => 'required|nullable',
            'id_autre_prest' => 'required|nullable',
            'desc_fact' => 'sometimes|string|nullable',
            'packs_experience' => 'required|nullable',
            'paiements' => 'required|nullable',
            'fact_rem' => 'required|nullable',
            'nom_produit' => 'required|',
            'prix' => 'required|numeric|min:0',
            'categorie' => 'nullable',
            'abstract',
            'description' => 'required|string|'
        ]);

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $notif_text = ' Creation d\'un nouveau produit le ' .  $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
            ->insertGetId([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'produit'
            ]);

        $prod = ProduitService::create([
            'nom_produit' => $request->nom_produit,
            'prix' => $request->prix,
            'categorie' => $request->categorie,
            'abstract' => $request->abstract,
            'description' => $request->description,
            'statut' => 'actif',
            'date_creation' => $current_date->format('Y-m-d H:i:s'),
            'date_update' => $current_date->format('Y-m-d H:i:s'),
        ]);

        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );

        $produit = $stripe->products->create([
            'name' => $request->nom_produit,
            'description' => $request->description,
            'default_price_data' =>
            [
                'currency' => 'eur',
                'unit_amount' => intval($request->prix) * 100
            ],
            'metadata' =>
            [
                'abstract' => $request->abstract,
                'id_produit' => $prod->id_produit,
                'statut' => 'actif',
                'categorie' => $request->categorie,
                'type' => 'produit'
            ]
        ]);

        $produit = substr($produit, 21);

        $produit = json_decode($produit, true);


        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $notif_text = ' Mise à jour liée à stripe du produit de ID ' . $prod->id_produit . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
            ->insertGetId([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'produit'
            ]);

        DB::connection('mysql2')
            ->update('UPDATE produits_services SET produits_services.id_stripe_produit="' . $produit['id'] . '", produits_services.url_stripe_produit="https://dashboard.stripe.com/test/products/' . $produit['id'] . '",produits_services.date_update="' . $current_date->format('Y-m-d H:i:s') . '" WHERE produits_services.id_produit=' . $prod->id_produit . '');


        $id_contacts = unserialize($request->id_contacts);
        $packs_experience = unserialize($request->packs_experience);


        $id_autre_prest = unserialize($request->id_autre_prest);
        $paiements = unserialize($request->paiements);
        $fact_rem = $request->fact_rem;
        $desc_fact = $request->desc_fact;
        $id_code_used = $request->id_code_used;

        return redirect()->route('factures.create', compact('id_contacts', 'id_autre_prest', 'packs_experience', 'paiements', 'fact_rem', 'desc_fact', 'id_code_used'))
            ->with('success', 'Prestation ajoutée avec succes');
    }


    /**
     * Insert a pack experience in the facture.create page
     *
     * @return \Illuminate\Http\Response
     */

    public function insertPackExperience(Request $request)
    {
        $request->validate([
            'id_contacts' => 'required|nullable',
            'id_autre_prest' => 'required|nullable',
            'desc_fact' => 'sometimes|string|nullable',
            'packs_experience' => 'required|nullable',
            'id_pack' => 'required|exists:mysql2.pack,id_pack',
            'nb_titres' => 'required|numeric|integer|min:0',
            'nb_adults' => 'required|numeric|integer|min:0',
            'nb_enfants' => 'required|numeric|integer|min:0',
            'paiements' => 'required|nullable',
            'fact_rem' => 'required|nullable',
            'id_prest' => 'nullable|exists:mysql2.produits_services,id_produit'
        ]);

        $pack_exp['id_pack'] = $request->id_pack;
        $pack_exp['nb_titres'] = $request->nb_titres;
        $pack_exp['nb_adults'] = $request->nb_adults;
        $pack_exp['nb_enfants'] = $request->nb_enfants;
        $pack_exp['nb_participants'] = $request->nb_adults + $request->nb_enfants;
        $pack_exp['id_prest'] = $request->id_prest;

        $id_contacts = unserialize($request->id_contacts);
        $id_autre_prest = unserialize($request->id_autre_prest);

        $packs_experience = unserialize($request->packs_experience);
        array_push($packs_experience, $pack_exp);

        $paiements = unserialize($request->paiements);
        $fact_rem = $request->fact_rem;
        $desc_fact = $request->desc_fact;
        $id_code_used = $request->id_code_used;

        return redirect()->route('factures.create', compact('id_contacts', 'id_autre_prest', 'packs_experience', 'paiements', 'fact_rem', 'desc_fact', 'id_code_used'))
            ->with('success', 'Le pack a bien été ajouté');
    }

    /**
     * Create a new pack
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function createPack(Request $request)
    {
        $request->validate([
            'id_contacts' => 'required|nullable',
            'id_autre_prest' => 'required|nullable',
            'desc_fact' => 'sometimes|string|nullable',
            'packs_experience' => 'required|nullable',
            'fact_rem' => 'required|nullable',
            'nom' => 'required',
            'prix' => 'required|numeric',
            'abstract',
            'paiements' => 'required|nullable',
            'description' => 'required|string'
        ]);

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $notif_text = ' Creation d\'un nouveau pack le ' .  $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection(',mysql2')->table('notification')
            ->insertGetId([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'pack'
            ]);

        $pac = Pack::create([
            'nom' => $request->nom,
            'prix' => $request->prix,
            'abstract' => $request->abstract,
            'description' => $request->description,
            'statut' => 'actif',
            'date_creation' => $current_date->format('Y-m-d H:i:s'),
            'date_update' => $current_date->format('Y-m-d H:i:s'),
        ]);


        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );
        $pack = $stripe->products->create([
            'name' => $request->nom,
            'description' => $request->description,
            'default_price_data' =>
            [
                'currency' => 'eur',
                'unit_amount' => intval($request->prix) * 100
            ],
            'metadata' =>
            [
                'abstract' => $request->abstract,
                'id_pack' => $pac->id_pack,
                'statut' => 'actif',
                'type' => 'pack'
            ]
        ]);

        $pack = substr($pack, 21);

        $pack = json_decode($pack, true);

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $notif_text = ' Misa à jour liée à stripe du pack de ID ' . $pack['id'] . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
            ->insertGetId([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'pack'
            ]);

        DB::connection('mysql2')
            ->update('UPDATE pack SET pack.id_stripe_pack="' . $pack['id'] . '", pack.url_stripe_pack="https://dashboard.stripe.com/test/products/' . $pack['id'] . '", pack.date_update="'  . $current_date->format('Y-m-d H:i:s') . '" WHERE pack.id_pack=' . $pac->id_pack . '');


        $id_contacts = unserialize($request->id_contacts);
        $id_autre_prest = unserialize($request->id_autre_prest);

        $packs_experience = unserialize($request->packs_experience);
        $paiements = unserialize($request->paiements);
        $fact_rem = $request->fact_rem;
        $desc_fact = $request->desc_fact;
        $id_code_used = $request->id_code_used;

        return redirect()->route('factures.create', compact('id_contacts', 'id_autre_prest', 'packs_experience', 'paiements', 'fact_rem', 'desc_fact', 'id_code_used'))
            ->with('success', 'Le pack a bien été créé');
    }

    public function setupPaiements(Request $request)
    {
        $request->validate([
            'nb_echeances' => 'required|numeric|integer|min:1',
            'nb_clients' => 'required|numeric|integer|min:1|lte:verif_nb_client',
            'verif_nb_client' => 'required|numeric|integer|min:1',
            'id_contacts' => 'required|nullable',
            'id_autre_prest' => 'required|nullable',
            'desc_fact' => 'sometimes|string|nullable',
            'paiements' => 'required|nullable',
            'packs_experience' => 'required|nullable',
            'fact_rem' => 'required|nullable'
        ]);

        $paiements['nb_echeances'] = $request->nb_echeances;
        $paiements['nb_clients'] = $request->nb_clients;
        $paiements['nb_paiements'] = $request->nb_clients * $request->nb_echeances;
        $paiements['paiements'] = [];

        $id_contacts = unserialize($request->id_contacts);
        $id_autre_prest = unserialize($request->id_autre_prest);

        $packs_experience = unserialize($request->packs_experience);
        $fact_rem = $request->fact_rem;
        $desc_fact = $request->desc_fact;
        $id_code_used = $request->id_code_used;

        return redirect()->route('factures.create', compact('id_contacts', 'id_autre_prest', 'packs_experience', 'paiements', 'fact_rem', 'desc_fact', 'id_code_used'))
            ->with('success', 'Le paiement a bien été enregistré');
    }

    public function insertPaiements(Request $request)
    {
        $request->validate([
            'id_contacts' => 'required|nullable',
            'id_autre_prest' => 'required|nullable',
            'desc_fact' => 'sometimes|string|nullable',
            'paiements' => 'required|nullable',
            'packs_experience' => 'required|nullable',
            'fact_rem' => 'required|nullable',
            'date_fin' => 'required|array',
            'date_fin.*' => 'required|date',
            'id_cnt' => 'required|array',
            'id_cnt.*' => 'required|exists:mysql2.contact,id_contact',
            'prix' => 'required|array',
            'prix.*' => 'required|numeric|min:0',
            'montant_remise' => 'required|numeric|min:0'
        ]);

        $id_contacts = unserialize($request->id_contacts);
        $id_autre_prest = unserialize($request->id_autre_prest);
        $paiements = unserialize($request->paiements);
        $packs_experience = unserialize($request->packs_experience);
        $fact_rem = $request->fact_rem;
        $desc_fact = $request->desc_fact;
        $id_code_used = $request->id_code_used;



        $verif_paiement = 0;
        $paiements['paiements'] = [];
        if (round(array_sum($request->prix), 2) != $request->montant_remise) {

            return redirect()->route('factures.create', compact('id_contacts', 'id_autre_prest', 'packs_experience', 'paiements', 'fact_rem', 'desc_fact', 'id_code_used'))
                ->with('error', 'paiement invalide car non correspondant au montant ' . round(array_sum($request->prix), 0) . ' ' . $request->montant_remise . '');
        }
        for ($i = 0; $i < $paiements['nb_paiements']; $i++) {
            $pay['date_fin'] = $request->date_fin[$i];
            $pay['id_contact'] = $request->id_cnt[$i];
            $pay['prix'] = round($request->prix[$i], 2);
            array_push($paiements['paiements'], $pay);
        }

        return redirect()->route('factures.create', compact('id_contacts', 'id_autre_prest', 'packs_experience', 'paiements', 'fact_rem', 'desc_fact', 'id_code_used'))
            ->with('success', 'Echéances enregistrée avec succes');
    }


    public function createRemise(Request $request)
    {
        $request->validate([
            'id_contacts' => 'required|nullable',
            'id_autre_prest' => 'required|nullable',
            'desc_fact' => 'sometimes|string|nullable',
            'paiements' => 'required|nullable',
            'packs_experience' => 'required|nullable',
            'fact_rem' => 'required|nullable',
            'nom_remise' => 'required',
            'type_remise',
            'taux' => 'required_without:montant|numeric|prohibited_unless:montant,null|nullable',
            'montant' => 'required_without:taux|numeric|prohibited_unless:taux,null|nullable',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut'
        ]);

        $id_contacts = unserialize($request->id_contacts);
        $id_autre_prest = unserialize($request->id_autre_prest);

        $packs_experience = unserialize($request->packs_experience);
        $paiements = unserialize($request->paiements);
        $fact_rem = $request->fact_rem;
        $desc_fact = $request->desc_fact;
        $id_code_used = $request->id_code_used;


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
                'date_creation' => $current_date->format('Y-m-d H:i:s'),
                'date_update' => $current_date->format('Y-m-d H:i:s'),
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
            return redirect()->route('factures.create', compact('id_contacts', 'id_autre_prest', 'packs_experience', 'paiements', 'fact_rem', 'desc_fact', 'id_code_used'))
                ->with('error', 'Erreur lors de la creation de la remise');
        }

        $remise = substr($remise, 20);

        $remise = json_decode($remise, true);

        DB::connection('mysql2')
            ->update('UPDATE remise SET remise.id_stripe_remise="' . $remise['id'] . '", remise.url_stripe_remise="https://dashboard.stripe.com/test/coupons/' . $remise['id'] . '", remise.date_update="'  . $current_date->format('Y-m-d H:i:s') . '" WHERE remise.id_remise=' . $rem->id_remise . '');

        return redirect()->route('factures.create', compact('id_contacts', 'id_autre_prest', 'packs_experience', 'paiements', 'fact_rem', 'desc_fact', 'id_code_used'))
            ->with('success', 'La remise a bien été créé');
    }

    public function insertRemise(Request $request)
    {
        $request->validate([
            'id_contacts' => 'required|nullable',
            'id_autre_prest' => 'required|nullable',
            'desc_fact' => 'sometimes|string|nullable',
            'packs_experience' => 'required|nullable',
            'paiements' => 'required|nullable',
            'fact_rem' => 'required|nullable',
            'id_remise' => 'exists:mysql2.remise,id_remise|nullable',

        ]);
        $id_contacts = unserialize($request->id_contacts);
        $id_autre_prest = unserialize($request->id_autre_prest);
        $paiements = unserialize($request->paiements);
        $desc_fact = $request->desc_fact;
        $id_code_used = $request->id_code_used;

        $packs_experience = unserialize($request->packs_experience);
        if (is_null($request->id_remise)) {
            $fact_rem = -1;
        } else {
            $fact_rem = $request->id_remise;
        }
        return redirect()->route('factures.create', compact('id_contacts', 'id_autre_prest', 'packs_experience', 'paiements', 'fact_rem', 'desc_fact', 'id_code_used'))
            ->with('success', 'La remise a bien été ajoutée');
    }

    public function insertCode(Request $request)
    {
        $request->validate([
            'id_contacts' => 'required|nullable',
            'id_autre_prest' => 'required|nullable',
            'desc_fact' => 'sometimes|string|nullable',
            'packs_experience' => 'required|nullable',
            'paiements' => 'required|nullable',
            'fact_rem' => 'required|nullable',
            'id_code' => 'exists:mysql2.codes_promo,id_code|nullable',
        ]);

        $id_contacts = unserialize($request->id_contacts);
        $id_autre_prest = unserialize($request->id_autre_prest);
        $paiements = unserialize($request->paiements);
        $desc_fact = $request->desc_fact;

        $packs_experience = unserialize($request->packs_experience);

        if (!is_null($request->id_code)) {
            $result = DB::connection('mysql2')->table('codes_promo')
                ->select('nb_utilisation', 'statut_code')
                ->where('id_code', $request->id_code)
                ->first();


            if ($result->nb_utilisation == 0 || $result->statut_code == 'inactif') {
                $fact_rem = -1;
                $id_code_used = -1;
                return redirect()->route('factures.create', compact('id_contacts', 'id_autre_prest', 'packs_experience', 'paiements', 'fact_rem', 'desc_fact', 'id_code_used'))
                    ->with('error', 'Le code promo n\'est pas valide.');
            } else {

                $remise = DB::connection('mysql2')->table('remise')
                    ->join('codes_promo', 'codes_promo.id_remise', '=', 'remise.id_remise')
                    ->where('codes_promo.id_code', $request->id_code)
                    ->first();

                $fact_rem = $remise->id_remise;
                $id_code_used = $request->id_code;
            }
        } else {
            $fact_rem = -1;
        }
        return redirect()->route('factures.create', compact('id_contacts', 'id_autre_prest', 'packs_experience', 'paiements', 'fact_rem', 'desc_fact', 'id_code_used'))
            ->with('success', 'Le code promo a bien été ajouté');
    }

    public function createCode(Request $request)
    {
        $request->validate([
            'id_contacts' => 'required|nullable',
            'id_autre_prest' => 'required|nullable',
            'desc_fact' => 'sometimes|string|nullable',
            'packs_experience' => 'required|nullable',
            'paiements' => 'required|nullable',
            'fact_rem' => 'required|nullable',
            'id_remise' => 'required|exists:mysql2.remise,id_remise',
            'code' => 'required',
            'nb_utilisation' => 'required|numeric|integer'
        ]);

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $notif_text = ' Creation d\'un nouveau code promo associé à la remise de ID ' . $request->id_remise . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
            ->insertGetId([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'code promo'
            ]);

        $cod = Codepromo::create([
            'id_remise' => $request->id_remise,
            'code' => $request->code,
            'nb_utilisation' => $request->nb_utilisation,
            'nb_code' => 0,
            'date_creation' => $current_date->format('Y-m-d H:i:s'),
            'date_updare' => $current_date->format('Y-m-d H:i:s'),
        ]);

        $id_coupon = DB::connection('mysql2')
            ->select('SELECT remise.id_stripe_remise AS id FROM remise WHERE remise.id_remise =' . $request->id_remise);


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
        $code = substr($code, 26);

        $code = json_decode($code, true);


        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $notif_text = ' Mise à jour liée à stripe du code promo de ID ' . $cod->id_code . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
            ->insertGetId([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'code promo'
            ]);

        DB::connection('mysql2')
            ->update('UPDATE codes_promo SET codes_promo.code="' . $code['code'] . '", codes_promo.id_stripe_code="' . $code['id'] . '", codes_promo.url_stripe_code="https://dashboard.stripe.com/test/promotion_codes/' . $code['id'] . '", pack.date_update="'  . $current_date->format('Y-m-d H:i:s') . '" WHERE codes_promo.id_code=' . $cod->id_code . '');

        $id_contacts = unserialize($request->id_contacts);
        $id_autre_prest = unserialize($request->id_autre_prest);
        $paiements = unserialize($request->paiements);

        $packs_experience = unserialize($request->packs_experience);
        $fact_rem = $request->id_remise;
        $desc_fact = $request->desc_fact;
        return redirect()->route('factures.create', compact('id_contacts', 'id_autre_prest', 'packs_experience', 'paiements', 'fact_rem', 'desc_fact'))
            ->with('success', 'Le code promo a bien été créé');
    }

    public function cancelRemise(Request $request)
    {
        $request->validate([
            'id_contacts' => 'required|nullable',
            'id_autre_prest' => 'required|nullable',
            'desc_fact' => 'sometimes|string|nullable',
            'packs_experience' => 'required|nullable',
            'paiements' => 'required|nullable',
            'fact_rem' => 'required|nullable',

        ]);
        $id_contacts = unserialize($request->id_contacts);
        $id_autre_prest = unserialize($request->id_autre_prest);
        $paiements = unserialize($request->paiements);
        $packs_experience = unserialize($request->packs_experience);
        $desc_fact = $request->desc_fact;

        $fact_rem = -1;

        return redirect()->route('factures.create', compact('id_contacts', 'id_autre_prest', 'packs_experience', 'paiements', 'fact_rem', 'desc_fact'))
            ->with('success', 'La remise a bien été annulée');
    }

    public function insertDescription(Request $request)
    {
        $request->validate([
            'id_contacts' => 'required|nullable',
            'id_autre_prest' => 'required|nullable',
            'desc_fact' => 'sometimes|string|nullable',
            'packs_experience' => 'required|nullable',
            'paiements' => 'required|nullable',
            'fact_rem' => 'required|nullable',
            'description_facture' => 'sometimes|nullable|string'
        ]);

        $id_contacts = unserialize($request->id_contacts);
        $id_autre_prest = unserialize($request->id_autre_prest);
        $paiements = unserialize($request->paiements);
        $packs_experience = unserialize($request->packs_experience);
        $desc_fact = $request->description_facture;
        $fact_rem = $request->fact_rem;
        $id_code_used = $request->id_code_used;

        return redirect()->route('factures.create', compact('id_contacts', 'id_autre_prest', 'packs_experience', 'paiements', 'fact_rem', 'desc_fact', 'id_code_used'))
            ->with('success', 'La description de la facture a bien été enregistrée');
    }

    public function removeContact(Request $request, $id_con)
    {
        $request->validate([
            'id_contacts' => 'required|nullable',
            'id_autre_prest' => 'required|nullable',
            'desc_fact' => 'sometimes|string|nullable',
            'packs_experience' => 'required|nullable',
            'paiements' => 'required|nullable',
            'fact_rem' => 'required|nullable',
        ]);
        $id_contacts = unserialize($request->id_contacts);
        $id_autre_prest = unserialize($request->id_autre_prest);
        $paiements = unserialize($request->paiements);

        $packs_experience = unserialize($request->packs_experience);
        $fact_rem = $request->fact_rem;
        $desc_fact = $request->desc_fact;
        $con_index = array_search($id_con, $id_contacts);
        $id_code_used = $request->id_code_used;


        array_splice($id_contacts, $con_index, 1);

        return redirect()->route('factures.create', compact('id_contacts', 'id_autre_prest', 'packs_experience', 'paiements', 'fact_rem', 'desc_fact', 'id_code_used'))
            ->with('success', 'Le contact a bien été retiré');
    }

    public function removePackExperience(Request $request)
    {
        $request->validate([
            'id_contacts' => 'required|nullable',
            'id_autre_prest' => 'required|nullable',
            'desc_fact' => 'sometimes|string|nullable',
            'packs_experience' => 'required|nullable',
            'paiements' => 'required|nullable',
            'fact_rem' => 'required|nullable',
            'pack_index' => 'required_without:pack_prest_index|numeric|prohibited_unless:pack_prest_index,null|nullable',
            'pack_prest_index' => 'required_without:pack_index|numeric|prohibited_unless:pack_index,null|nullable'
        ]);
        $id_contacts = unserialize($request->id_contacts);
        $id_autre_prest = unserialize($request->id_autre_prest);
        $paiements = unserialize($request->paiements);

        $packs_experience = unserialize($request->packs_experience);
        $fact_rem = $request->fact_rem;
        $desc_fact = $request->desc_fact;

        $pack_index = $request->pack_index;
        $pack_prest_index = $request->pack_prest_index;
        $id_code_used = $request->id_code_used;

        if (!is_null($pack_index)) {
            array_splice($packs_experience, $pack_index, 1);
        } elseif (!is_null($pack_prest_index)) {
            unset($packs_experience[$pack_prest_index]['id_prest']);
        } else {
            return redirect()->route('factures.create', compact('id_contacts', 'id_autre_prest', 'packs_experience', 'paiements', 'fact_rem', 'desc_fact', 'id_code_used'))
                ->with('error', 'Erreur lors du retrait du pack');
        }

        return redirect()->route('factures.create', compact('id_contacts', 'id_autre_prest', 'packs_experience', 'paiements', 'fact_rem', 'desc_fact', 'id_code_used'))
            ->with('success', 'Le pack a été retiré avec succes');
    }

    public function removeAutrePrestation(Request $request)
    {
        $request->validate([
            'id_contacts' => 'required|nullable',
            'id_autre_prest' => 'required|nullable',
            'desc_fact' => 'sometimes|string|nullable',
            'packs_experience' => 'required|nullable',
            'paiements' => 'required|nullable',
            'fact_rem' => 'required|nullable',
            'prest_index' => 'required'
        ]);
        $id_contacts = unserialize($request->id_contacts);
        $id_autre_prest = unserialize($request->id_autre_prest);
        $paiements = unserialize($request->paiements);

        $packs_experience = unserialize($request->packs_experience);
        $fact_rem = $request->fact_rem;
        $desc_fact = $request->desc_fact;
        array_splice($id_autre_prest, $request->prest_index, 1);
        $id_code_used = $request->id_code_used;


        return redirect()->route('factures.create', compact('id_contacts', 'id_autre_prest', 'packs_experience', 'paiements', 'fact_rem', 'desc_fact', 'id_code_used'))
            ->with('success', 'La prestation a bien été retirée');
    }

    /**
     * Store a newly created resource in storage with the statuts 'Brouillon'.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeBrouillon(Request $request)
    {
        /*$request->date_envoie, 'date_paiement'=> $request->date_paiement]
        );*/

        $request->validate([
            'id_contacts' => 'required|nullable',
            'id_autre_prest' => 'required|nullable',
            'desc_fact' => 'sometimes|string|nullable',
            'packs_experience' => 'required|nullable',
            'paiements' => 'required|nullable',
            'fact_rem' => 'required|nullable',
            'description_facture',
            'montant_remise' => 'required|numeric'

        ]);

        $id_contacts = unserialize($request->id_contacts);
        $id_autre_prest = unserialize($request->id_autre_prest);
        $packs_experience = unserialize($request->packs_experience);
        $paiements = unserialize($request->paiements);
        $fact_rem = $request->fact_rem;

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);

        // ---------------------------------------yasser--------------------------------------
        $id_code_used = $request->id_code_used;
        if (isset($id_code_used) && $id_code_used != -1) {
            $result = DB::connection('mysql2')->table('codes_promo')
                ->select('nb_utilisation')
                ->where('id_code', $id_code_used)
                ->first();
            if ($result->nb_utilisation == 0) {
                $id_code_used = -1;
            } else {
                DB::connection('mysql2')->table('codes_promo')
                    ->where('id_code', $request->id_code_used)
                    ->update([
                        'nb_utilisation' => DB::raw('nb_utilisation - 1'),
                        'nb_code' => DB::raw('nb_code + 1'),
                        'date_update' => $current_date->format('Y-m-d H:i:s')
                    ]);
            }
        }
        // ---------------------------------------yasser--------------------------------------
        if ($request->desc_fact == $request->description_facture) {
            $description = $request->desc_fact;
        } else {
            $description = $request->description_facture;
        }


        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);

        $remise = DB::connection('mysql2')->table('historique_remise')
            ->where('id_remise', $fact_rem)
            ->orderByDesc('id_historique_remise')
            ->first();

        //Verification de la présence d'un id_historique_remise pour pouvoir bien liée les packs, produit ou la facture au taux et montant que la remise utilise à la création de la facture pour garantir la fiabilité des données dans le temps
        if ((!is_null($remise)) && (isset($remise->id_historique_remise))) {
            $id_historique_remise = $remise->id_historique_remise;
        } else {
            $id_historique_remise = null;
        }

        //Initialisations des tableau qui retiennent les ids de tous le spacks et produits pour pouvoir les utiliser dans autres réquêtes SQL

        $liste_id_packs = [];
        $liste_id_prest_pack = [];

        foreach ($packs_experience as $pp) {
            array_push($liste_id_packs, $pp['id_pack']);

            if (isset($pp['id_prest'])) {
                array_push($liste_id_prest_pack, $pp['id_prest']);
            }
        }

        //Vérifier si certains produit ou packs de lma facture sont liées à la remise

        $count_pack_rem = DB::connection('mysql2')->table('packs_remise')
            ->where('id_remise', $fact_rem)
            ->whereIn('id_pack', $liste_id_packs)
            ->get();

        $count_prod_rem = DB::connection('mysql2')->table('produit_service_remise')
            ->where('id_remise', $fact_rem)
            ->whereIn('id_produit', $liste_id_prest_pack)
            ->orWhereIn('id_produit', $id_autre_prest)
            ->get();

        //Si on a une remise qui ne s'applique pas à un pack ou une remise on va insérer l'id_historique_remise dans la table facture pour répresenter que la remise vient appliqué directement à la facture

        if (($fact_rem > 0) && ($count_pack_rem->isEmpty()) && ($count_prod_rem->isEmpty())) {
            $facture = Facture::create([
                'description_lib' => $description,
                'prix_facture' => $request->montant_remise,
                'nb_paiement' => $request->nb_paiements,
                'statut_facture' => '',
                'nb_paiement' => $paiements['nb_paiements'],
                'canal_reservation' => 'App experience',
                'id_historique_remise' => $id_historique_remise
            ]);
        } else {
            $facture = Facture::create([
                'description_lib' => $description,
                'prix_facture' => $request->montant_remise,
                'nb_paiement' => $request->nb_paiements,
                'statut_facture' => '',
                'nb_paiement' => $paiements['nb_paiements'],
                'canal_reservation' => 'App experience',
            ]);
        }




        $notif_text = 'Creation de la Facture ' . $facture->num_facture . ' le ' . $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
            ->insert([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'facture'
            ]);
        $latest_notification = DB::connection('mysql2')->selectOne('SELECT id_notification FROM notification ORDER BY id_notification DESC');

        //Asiignation à la facture du statut "Brouillon"

        $stat = DB::connection('mysql2')->insert('INSERT INTO facture_statut_notification(id_notification,date_statut, num_facture, id_facture_statut) VALUES (?,?,?,11)', [$latest_notification->id_notification, $current_date->format('Y-m-d H:i:s'), $facture->num_facture]);



        //Si on une remise on va insérer une entrée dans la table factures_remise pour représenter le fait qu'on  a appliqué une remise à la réservation'
        if ($fact_rem > 0) {
            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
            $current_date->setTimestamp($timestamp);
            $notif_text = 'Association de la Facture ' . $facture->num_facture . 'avec la remise de ID ' . $fact_rem . ' le ' . $current_date->format('Y-m-d H:i:s') . '';

            $notification = DB::connection('mysql2')->table('notification')
                ->insert([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'factures remise'
                ]);


            $remise = DB::connection('mysql2')->table('historique_remise')
                ->where('id_remise', $fact_rem)
                ->orderByDesc('id_historique_remise')
                ->first();

            if (!is_null($remise)) {
                $facture_remise = DB::connection('mysql2')->table('factures_remise')
                    ->insert([
                        'num_facture' => $facture->num_facture,
                        'id_remise' => $fact_rem,

                    ]);
            }
        }


        $con_count = [];

        $date_echeance = strtotime('+1 day');

        $date_ecart = strtotime("+1 month") - $date_echeance;
        $loop_count = 1;

        $count_paiements = [];

        //Insertion des paiements dans la BDD
        foreach ($paiements['paiements'] as $pay) {
            $date_echeance = new DateTime();
            $date_echeance = $date_echeance->createFromFormat('Y-m-d', $pay['date_fin']);
            $date_echeance->setTime(0, 0, 0, 0);

            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
            $current_date->setTimestamp($timestamp);

            if (!in_array($pay['id_contact'], $count_paiements)) {
                $pai_num = 1;
            } else {
                $pai_num = array_count_values($count_paiements)[$pay['id_contact']] + 1;
            }



            $con = DB::connection('mysql2')->table('contact')
                ->where('id_contact', $pay['id_contact'])
                ->first();
            $libelle = 'Paiement N° ' . $pai_num . ' de ' . $con->prenom . ' ' . $con->nom . '';
            $prix_paiement = $pay['prix'];
            $id_paiement = DB::connection('mysql2')
                ->table('paiement')
                ->insertGetId([
                    'libelle' => $libelle,
                    'prix' => $prix_paiement,
                    'statut_paiement' => 'Non Payé',
                    'num_facture' => $facture->num_facture,
                    'id_contact' => $con->id_contact,
                    'date_echeance' => $date_echeance->format('Y-m-d H:i:s'),
                    'date_creation' => $current_date->format('Y-m-d H:i:s'),
                    'date_update' => $current_date->format('Y-m-d H:i:s'),
                ]);

            array_push($count_paiements, $pay['id_contact']);


            $notif_text = 'Creation du paiement ID ' . $id_paiement . ' pour la facture ID' . $facture->num_facture . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

            $notification = DB::connection('mysql2')->table('notification')
                ->insert([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'paiement'
                ]);
        }


        //Insertion des packs experiences et produits associés aux packs dans la bdd
        foreach ($packs_experience as $pp) {
            $pack = Pack::find($pp['id_pack']);

            $prix_pack = DB::connection('mysql2')->table('liste_prix')
                ->where('liste_prix.id_pack', '=', $pack->id_pack)
                ->where('liste_prix.statut', '=', 'Par défaut')
                ->orWhere(function (Builder $query) use ($pack) {
                    $query->where('liste_prix.id_pack', '=', $pack->id_pack)
                        ->where('liste_prix.statut', '=', 'Par defaut');
                })
                ->first();

            if ((!is_null($prix_pack)) && (isNull($prix_pack->id_produit)) && (!empty($prix_pack->id_pack))) {
                $id_prix_pack = $prix_pack->id_liste_prix;
            } else {
                $id_prix_pack = null;
            }

            //Vérifier si la remise s'applique au pack et donc si on doit insérer ou pas l'id_historique_remise dans la table pack_experience
            if ($fact_rem > 0) {
                $pack_rem = DB::connection('mysql2')->table('packs_remise')
                    ->where('id_remise', $fact_rem)
                    ->where('id_pack', $pack->id_pack)
                    ->first();

                if ((!is_null($pack_rem)) && (!empty($pack_rem->id_historique_remise))) {
                    $id_hist_rem = $pack_rem->id_historique_remise;
                } else {
                    $id_hist_rem = null;
                }
                $pack_exp = DB::connection('mysql2')->insert('INSERT INTO pack_experience(nb_titres, nb_participants, id_pack, num_facture, id_liste_prix, id_historique_remise) VALUES (?,?,?,?,?,?)', [$pp['nb_titres'], $pp['nb_participants'], $pack->id_pack, $facture->num_facture, $id_prix_pack, $id_hist_rem]);
            } else {
                $pack_exp = DB::connection('mysql2')->insert('INSERT INTO pack_experience(nb_titres, nb_participants, id_pack, num_facture, id_liste_prix) VALUES (?,?,?,?,?)', [$pp['nb_titres'], $pp['nb_participants'], $pack->id_pack, $facture->num_facture, $id_prix_pack]);
            }



            if (isset($pp['id_prest'])) {
                $produit = ProduitService::find($pp['id_prest']);
                $latest_pack = DB::connection('mysql2')->selectOne('SELECT id_pack_experience FROM pack_experience ORDER BY id_pack_experience DESC');


                $prix_packsprestation = DB::connection('mysql2')->table('liste_prix')
                    ->where('liste_prix.id_produit', '=', $produit->id_produit)
                    ->where('liste_prix.statut', '=', 'Par défaut')
                    ->orWhere(function (Builder $query) use ($produit) {
                        $query->where('liste_prix.id_produit', '=', $produit->id_produit)
                            ->where('liste_prix.statut', '=', 'Par defaut');
                    })
                    ->first();


                if ((!is_null($prix_packsprestation)) && (!empty($prix_packsprestation->id_produit)) && (isNull($prix_packsprestation->id_pack))) {
                    $id_prix_pack_prest = $prix_packsprestation->id_liste_prix;
                } else {
                    $id_prix_pack_prest = null;
                }


                $timestamp = time();
                $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
                $current_date->setTimestamp($timestamp);
                $notif_text = ' Creation d\' pack_experience associé à la facture de ID ' . $facture->num_facture . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

                $notification = DB::connection('mysql2')->table('notification')
                    ->insertGetId([
                        'contenu_notification' => $notif_text,
                        'date_notification' => $current_date->format('Y-m-d H:i:s'),
                        'type' => 'pack experience'
                    ]);

                $notif_text = ' Creation d\'une autre prestation  associé àu pack_experience de ID ' . $latest_pack->id_pack_experience . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

                $notification = DB::connection('mysql2')->table('notification')
                    ->insertGetId([
                        'contenu_notification' => $notif_text,
                        'date_notification' => $current_date->format('Y-m-d H:i:s'),
                        'type' => 'autre prestation'
                    ]);

                //Vérifier si la remise s'applique au produit et donc si on doit insérer ou pas l'id_historique_remise dans la table autre_prestation_experience
                if ($fact_rem > 0) {

                    $prod_rem = DB::connection('mysql2')->table('produit_service_remise')
                        ->where('id_remise', $fact_rem)
                        ->where('id_produit', $produit->id_produit)
                        ->first();

                    if ((!is_null($prod_rem)) && (!empty($prod_rem->id_historique_remise))) {
                        $id_hist_rem = $prod_rem->id_historique_remise;
                    } else {
                        $id_hist_rem = null;
                    }
                    $autres_prestations = DB::connection('mysql2')->insert('INSERT INTO autre_prestation_experience(id_produit, id_pack_experience, id_liste_prix, id_historique_remise) VALUES (?,?,?,?)', [$produit->id_produit, $latest_pack->id_pack_experience, $id_prix_pack_prest, $id_hist_rem]);
                } else {
                    $autres_prestations = DB::connection('mysql2')->insert('INSERT INTO autre_prestation_experience(id_produit, id_pack_experience, id_liste_prix) VALUES (?,?,?)', [$produit->id_produit, $latest_pack->id_pack_experience, $id_prix_pack_prest]);
                }
            }
        }

        //Insertion des produits non associés au packs dans la BDD
        if (!is_null($id_autre_prest)) {
            $checked_once = [];
            foreach ($id_autre_prest as $ap) {
                if (!in_array($ap, $checked_once)) {
                    $prest = ProduitService::find($ap);
                    $quantity =  array_count_values($id_autre_prest)[$ap] ?? 1;


                    $prix_autresprestation = DB::connection('mysql2')->table('liste_prix')
                        ->where('liste_prix.id_produit', '=', $prest->id_produit)
                        ->where('liste_prix.statut', '=', 'Par défaut')
                        ->orWhere(function (Builder $query) use ($prest) {
                            $query->where('liste_prix.id_produit', '=', $prest->id_produit)
                                ->where('liste_prix.statut', '=', 'Par defaut');
                        })
                        ->first();

                    if ((!is_null($prix_autresprestation)) && (!empty($prix_autresprestation->id_produit)) && (isNull($prix_autresprestation->id_pack))) {
                        $id_prix_autres_prest = $prix_autresprestation->id_liste_prix;
                    } else {
                        $id_prix_autres_prest = null;
                    }

                    $timestamp = time();
                    $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
                    $current_date->setTimestamp($timestamp);
                    $notif_text = ' Creation d\' facture_produit_service associé à la facture de ID ' . $facture->num_facture . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

                    $notification = DB::connection('mysql2')->table('notification')
                        ->insertGetId([
                            'contenu_notification' => $notif_text,
                            'date_notification' => $current_date->format('Y-m-d H:i:s'),
                            'type' => 'facture produit service'
                        ]);

                    //Vérifier si la remise s'applique au produit et donc si on doit insérer ou pas l'id_historique_remise dans la table facture_produit_service
                    if ($fact_rem > 0) {

                        $prod_rem = DB::connection('mysql2')->table('produit_service_remise')
                            ->where('id_remise', $fact_rem)
                            ->where('id_produit', $prest->id_produit)
                            ->first();

                        if ((!is_null($prod_rem)) && (!empty($prod_rem->id_historique_remise))) {
                            $id_hist_rem = $prod_rem->id_historique_remise;
                        } else {
                            $id_hist_rem = null;
                        }
                        $prest_fact = DB::connection('mysql2')->insert("INSERT INTO facture_produit_service(num_facture, id_produit, quantity, id_liste_prix, id_historique_remise) VALUES (?,?,?,?,?)", [$facture->num_facture, $prest->id_produit, $quantity, $id_prix_autres_prest, $id_hist_rem]);
                    } else {
                        $prest_fact = DB::connection('mysql2')->insert("INSERT INTO facture_produit_service(num_facture, id_produit, quantity, id_liste_prix) VALUES (?,?,?,?)", [$facture->num_facture, $prest->id_produit, $quantity, $id_prix_autres_prest]);
                    }
                }
                array_push($checked_once, $ap);
            }
        }

        $url = getenv('DISCORD_WEBHOOK');
        $data = array(
            'content' => 'Creation de la Facture ' . $facture->num_facture . ' le ' . $current_date->format('Y-m-d H:i:s') . ''
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

        //CONNECTION à TWILIO
        /*$account_sid = getenv('TWILIO_ACCOUNT_SID');
        $auth_token = getenv('TWILIO_AUTH_TOKEN');

        $twilio_number = "+15419318069"; //"+15419318069"

        $clientTwilio = new Twilio($account_sid, $auth_token);

        $clientTwilio->messages->create(
            // Where to send a text message (your cell phone?)
            '+33687668279',
            array(
                'from' => $twilio_number,
                'body' => 'Creation de la Facture ' . $facture->num_facture . ' le ' . $current_date->format('Y-m-d H:i:s') . ''
            )
        );*/
        $this->updateStatutInDatabase(3, $facture->num_facture);

        // JM - Redirection vers l'url d'ou l'on est venu (reservation ou factures)
        return redirect()->to(session()->get('url_precedente'))
            ->with('success', 'La facture a bien été créée');
    }

    /**
     * Store a newly created resource in storage and uses the method valider.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->validate([
            'id_contacts' => 'required|nullable',
            'id_autre_prest' => 'required|nullable',
            'desc_fact' => 'sometimes|string|nullable',
            'packs_experience' => 'required|nullable',
            'paiements' => 'required|nullable',
            'fact_rem' => 'required|nullable',
            'description_facture',
            'montant_remise' => 'required|numeric'

        ]);

        $id_contacts = unserialize($request->id_contacts);
        $id_autre_prest = unserialize($request->id_autre_prest);
        $packs_experience = unserialize($request->packs_experience);
        $paiements = unserialize($request->paiements);
        $fact_rem = $request->fact_rem;

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);

        // ---------------------------------------yasser--------------------------------------
        $id_code_used = $request->id_code_used;
        if (isset($id_code_used) && $id_code_used != -1) {
            $result = DB::connection('mysql2')->table('codes_promo')
                ->select('nb_utilisation')
                ->where('id_code', $id_code_used)
                ->first();
            if ($result->nb_utilisation == 0) {
                $id_code_used = -1;
            } else {
                DB::connection('mysql2')->table('codes_promo')
                    ->where('id_code', $request->id_code_used)
                    ->update([
                        'nb_utilisation' => DB::raw('nb_utilisation - 1'),
                        'nb_code' => DB::raw('nb_code + 1'),
                        'date_update' => $current_date->format('Y-m-d H:i:s'),
                    ]);
            }
        }
        // ---------------------------------------yasser--------------------------------------

        if ($request->desc_fact == $request->description_facture) {
            $description = $request->desc_fact;
        } else {
            $description = $request->description_facture;
        }

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);

        $remise = DB::connection('mysql2')->table('historique_remise')
            ->where('id_remise', $fact_rem)
            ->orderByDesc('id_historique_remise')
            ->first();

        if ((!is_null($remise)) && (isset($remise->id_historique_remise))) {
            $id_historique_remise = $remise->id_historique_remise;
        } else {
            $id_historique_remise = null;
        }


        $liste_id_packs = [];
        $liste_id_prest_pack = [];

        foreach ($packs_experience as $pp) {
            array_push($liste_id_packs, $pp['id_pack']);

            if (isset($pp['id_prest'])) {
                array_push($liste_id_prest_pack, $pp['id_prest']);
            }
        }

        $count_pack_rem = DB::connection('mysql2')->table('packs_remise')
            ->where('id_remise', $fact_rem)
            ->whereIn('id_pack', $liste_id_packs)
            ->get();

        $count_prod_rem = DB::connection('mysql2')->table('produit_service_remise')
            ->where('id_remise', $fact_rem)
            ->whereIn('id_produit', $liste_id_prest_pack)
            ->orWhereIn('id_produit', $id_autre_prest)
            ->get();

        if (($fact_rem > 0) && ($count_pack_rem->isEmpty()) && ($count_prod_rem->isEmpty())) {

            $facture = Facture::create([
                'description_lib' => $description,
                'prix_facture' => $request->montant_remise,
                'nb_paiement' => $request->nb_paiements,
                'statut_facture' => '',
                'nb_paiement' => $paiements['nb_paiements'],
                'date_creation' => $current_date->format('Y-m-d H:i:s'),
                'date_update' => $current_date->format('Y-m-d H:i:s'),
                'canal_reservation' => 'App experience',
                'id_historique_remise' => $id_historique_remise
            ]);
        } else {

            $facture = Facture::create([
                'description_lib' => $description,
                'prix_facture' => $request->montant_remise,
                'nb_paiement' => $request->nb_paiements,
                'statut_facture' => '',
                'nb_paiement' => $paiements['nb_paiements'],
                'date_creation' => $current_date->format('Y-m-d H:i:s'),
                'date_update' => $current_date->format('Y-m-d H:i:s'),
                'canal_reservation' => 'App experience',
            ]);
        }




        $notif_text = 'Creation de la Facture ' . $facture->num_facture . ' le ' . $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
            ->insert([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H-i-s'),
                'type' => 'facture'
            ]);
        $latest_notification = DB::connection('mysql2')->selectOne('SELECT id_notification FROM notification ORDER BY id_notification DESC');

        $stat = DB::connection('mysql2')->insert('INSERT INTO facture_statut_notification(id_notification,date_statut, num_facture, id_facture_statut) VALUES (?,?,?,2)', [$latest_notification->id_notification, $current_date->format('Y-m-d H-i-s'), $facture->num_facture]);

        if ($fact_rem > 0) {
            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
            $current_date->setTimestamp($timestamp);
            $notif_text = 'Association de la Facture ' . $facture->num_facture . 'avec la remise de ID ' . $fact_rem . ' le ' . $current_date->format('Y-m-d H:i:s') . '';
            //$prix_paiement=((double) $facture->prix_facture)/((double) $request->nb_paiements);

            $notification = DB::connection('mysql2')->table('notification')
                ->insert([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'factures remise'
                ]);


            $remise = DB::connection('mysql2')->table('historique_remise')
                ->where('id_remise', $fact_rem)
                ->orderByDesc('id_historique_remise')
                ->first();

            if (!is_null($remise)) {
                $facture_remise = DB::connection('mysql2')->table('factures_remise')
                    ->insert([
                        'num_facture' => $facture->num_facture,
                        'id_remise' => $fact_rem,

                    ]);
            }
        }

        $con_count = [];

        $date_echeance = strtotime('+1 day');

        $date_ecart = strtotime("+1 month") - $date_echeance;
        $loop_count = 1;

        $count_paiements = [];

        foreach ($paiements['paiements'] as $pay) {

            $date_echeance = new DateTime();
            $date_echeance = $date_echeance->createFromFormat('Y-m-d', $pay['date_fin']);
            $date_echeance->setTime(0, 0, 0, 0);

            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
            $current_date->setTimestamp($timestamp);


            if (!in_array($pay['id_contact'], $count_paiements)) {
                $pai_num = 1;
            } else {
                $pai_num = array_count_values($count_paiements)[$pay['id_contact']] + 1;
            }

            $con = DB::connection('mysql2')->table('contact')
                ->where('id_contact', $pay['id_contact'])
                ->first();
            $libelle = 'Paiement N° ' . $pai_num . ' de ' . $con->prenom . ' ' . $con->nom . '';
            $prix_paiement = $pay['prix'];
            $id_paiement = DB::connection('mysql2')
                ->table('paiement')
                ->insertGetId([
                    'libelle' => $libelle,
                    'prix' => $prix_paiement,
                    'statut_paiement' => 'Non Payé',
                    'num_facture' => $facture->num_facture,
                    'id_contact' => $con->id_contact,
                    'date_echeance' => $date_echeance->format('Y-m-d H:i:s'),
                    'date_creation' => $current_date->format('Y-m-d H:i:s'),
                    'date_update' => $current_date->format('Y-m-d H:i:s'),
                ]);

            array_push($count_paiements, $pay['id_contact']);


            $notif_text = 'Creation du paiement ID ' . $id_paiement . ' pour la facture ID' . $facture->num_facture . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

            $notification = DB::connection('mysql2')->table('notification')
                ->insert([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'paiement'
                ]);

            $date_echeance = strtotime($pay['date_fin']);


            $stripe = new \Stripe\StripeClient(
                env('STRIPE_SECRET')
            );

            /**/

            $invoice = $stripe->invoices->create([
                'customer' => $con->id_client_stripe,
                'collection_method' => 'send_invoice',
                'due_date' => $date_echeance,
                'description' => $description,
                'metadata' => [
                    'id_contact' => $con->id_contact,
                    'id_paiement' => $id_paiement,
                    'num_facture' => $facture->num_facture,
                    'libelle' => $libelle
                ]
            ]);

            $invoice = substr($invoice, 21);
            $invoice = json_decode($invoice, true);

            if ($paiements['nb_paiements'] == 1) {
                foreach ($packs_experience as $pp) {
                    $pack = Pack::find($pp['id_pack']);
                    $product_pack = $stripe->products->retrieve($pack->id_stripe_pack, []);
                    $stripe->invoiceItems->create([
                        'customer' => $con->id_client_stripe,
                        'price' => $product_pack->default_price,
                        'invoice' => $invoice['id'],
                    ]);
                    if ($pp['nb_titres'] > 1) {
                        $product_titre = $stripe->products->retrieve(getenv('PRODUIT_TITRE'), []);
                        $stripe->invoiceItems->create([
                            'customer' => $con->id_client_stripe,
                            'price' => $product_titre->default_price,
                            'invoice' => $invoice['id'],
                            'quantity' => $pp['nb_titres'] - 1
                        ]);
                    }

                    if ($pp['nb_participants'] > 1) {
                        $product_part = $stripe->products->retrieve(getenv('PRODUIT_PARTICIPANT'), []);
                        $stripe->invoiceItems->create([
                            'customer' => $con->id_client_stripe,
                            'price' => $product_part->default_price,
                            'invoice' => $invoice['id'],
                            'quantity' => $pp['nb_participants'] - 1
                        ]);
                    }

                    if (isset($pp['id_prest'])) {
                        $produit = ProduitService::find($pp['id_prest']);
                        $product_prod = $stripe->products->retrieve($produit->id_stripe_produit, []);
                        $stripe->invoiceItems->create([
                            'customer' => $con->id_client_stripe,
                            'price' => $product_prod->default_price,
                            'invoice' => $invoice['id'],
                        ]);
                    }
                }

                if (!is_null($id_autre_prest)) {
                    $checked_once = [];
                    foreach ($id_autre_prest as $ap) {
                        if (!in_array($ap, $checked_once)) {
                            $prest = ProduitService::find($ap);
                            $product_prest = $stripe->products->retrieve($prest->id_stripe_produit, []);
                            $stripe->invoiceItems->create([
                                'customer' => $con->id_client_stripe,
                                'price' => $product_prest->default_price,
                                'invoice' => $invoice['id'],
                            ]);
                        }
                    }
                }

                //Application d'une remise
                $remrem = DB::connection('mysql2')->table('remise')->where('id_remise', $fact_rem)->get()->first();
                if (!is_null($remrem)) {
                    $stripe->invoices->update(
                        $invoice['id'],
                        [
                            'discounts' => [
                                ['coupon' => $remrem->id_stripe_remise]
                            ]
                        ]
                    );
                }
            } else {
                $price = $stripe->prices->create([
                    'unit_amount' => floatval($prix_paiement) * 100,
                    'currency' => 'eur',
                    'product' => env('PRODUIT_PAIEMENT'),
                ]);


                $price = substr($price, 19);
                $price = json_decode($price, true);
                $stripe->invoiceItems->create([
                    'customer' => $con->id_client_stripe,
                    'price' => $price['id'],
                    'invoice' => $invoice['id'],
                ]);
            }

            $stripe->invoices->finalizeInvoice(
                $invoice['id'],
                []
            );

            $up = DB::connection('mysql2')->table('paiement')
                ->where('id_paiment', $id_paiement)
                ->update([
                    'id_stripe_paiement' => $invoice['id'],
                    'date_update' => $current_date->format('Y-m-d H:i:s')
                ]);
        }



        foreach ($packs_experience as $pp) {
            $pack = Pack::find($pp['id_pack']);

            $prix_pack = DB::connection('mysql2')->table('liste_prix')
                ->where('liste_prix.id_pack', '=', $pack->id_pack)
                ->where('liste_prix.statut', '=', 'Par défaut')
                ->orWhere(function (Builder $query) use ($pack) {
                    $query->where('liste_prix.id_pack', '=', $pack->id_pack)
                        ->where('liste_prix.statut', '=', 'Par defaut');
                })
                ->first();

            if ((!is_null($prix_pack)) && (isNull($prix_pack->id_produit)) && (!empty($prix_pack->id_pack))) {
                $id_prix_pack = $prix_pack->id_liste_prix;
            } else {
                $id_prix_pack = null;
            }

            if ($fact_rem > 0) {
                $pack_rem = DB::connection('mysql2')->table('packs_remise')
                    ->where('id_remise', $fact_rem)
                    ->where('id_pack', $pack->id_pack)
                    ->first();

                if ((!is_null($pack_rem)) && (!empty($pack_rem->id_historique_remise))) {
                    $id_hist_rem = $pack_rem->id_historique_remise;
                } else {
                    $id_hist_rem = null;
                }
                $pack_exp = DB::connection('mysql2')->insert('INSERT INTO pack_experience(nb_titres, nb_participants, id_pack, num_facture, id_liste_prix, id_historique_remise) VALUES (?,?,?,?,?,?)', [$pp['nb_titres'], $pp['nb_participants'], $pack->id_pack, $facture->num_facture, $id_prix_pack, $id_hist_rem]);
            } else {
                $pack_exp = DB::connection('mysql2')->insert('INSERT INTO pack_experience(nb_titres, nb_participants, id_pack, num_facture, id_liste_prix) VALUES (?,?,?,?,?)', [$pp['nb_titres'], $pp['nb_participants'], $pack->id_pack, $facture->num_facture, $id_prix_pack]);
            }


            if (isset($pp['id_prest'])) {
                $produit = ProduitService::find($pp['id_prest']);
                $latest_pack = DB::connection('mysql2')->selectOne('SELECT id_pack_experience FROM pack_experience ORDER BY id_pack_experience DESC');

                $prix_packsprestation = DB::connection('mysql2')->table('liste_prix')
                    ->where('liste_prix.id_produit', '=', $produit->id_produit)
                    ->where('liste_prix.statut', '=', 'Par défaut')
                    ->orWhere(function (Builder $query) use ($produit) {
                        $query->where('liste_prix.id_produit', '=', $produit->id_produit)
                            ->where('liste_prix.statut', '=', 'Par defaut');
                    })
                    ->first();


                if ((!is_null($prix_packsprestation)) && (!empty($prix_packsprestation->id_produit)) && (isNull($prix_packsprestation->id_pack))) {
                    $id_prix_pack_prest = $prix_packsprestation->id_liste_prix;
                } else {
                    $id_prix_pack_prest = null;
                }

                $timestamp = time();
                $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
                $current_date->setTimestamp($timestamp);
                $notif_text = ' Creation d\' pack_experience associé à la facture de ID ' . $facture->num_facture . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

                $notification = DB::connection('mysql2')->table('notification')
                    ->insertGetId([
                        'contenu_notification' => $notif_text,
                        'date_notification' => $current_date->format('Y-m-d H:i:s'),
                        'type' => 'pack experience'
                    ]);

                $notif_text = ' Creation d\'une autre prestation  associé àu pack_experience de ID ' . $latest_pack->id_pack_experience . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

                $notification = DB::connection('mysql2')->table('notification')
                    ->insertGetId([
                        'contenu_notification' => $notif_text,
                        'date_notification' => $current_date->format('Y-m-d H:i:s'),
                        'type' => 'autre prestation'
                    ]);

                if ($fact_rem > 0) {

                    $prod_rem = DB::connection('mysql2')->table('produit_service_remise')
                        ->where('id_remise', $fact_rem)
                        ->where('id_produit', $produit->id_produit)
                        ->first();

                    if ((!is_null($prod_rem)) && (!empty($prod_rem->id_historique_remise))) {
                        $id_hist_rem = $prod_rem->id_historique_remise;
                    } else {
                        $id_hist_rem = null;
                    }
                    $autres_prestations = DB::connection('mysql2')->insert('INSERT INTO autre_prestation_experience(id_produit, id_pack_experience, id_liste_prix, id_historique_remise) VALUES (?,?,?,?)', [$produit->id_produit, $latest_pack->id_pack_experience, $id_prix_pack_prest, $id_hist_rem]);
                    //Try tache EA 418 ronny
                    DB::connection('mysql2')->table('facture_produit_service')
                        ->where('id_produit', $produit->id_produit)
                        ->where('num_facture', $facture->num_factuce)
                        ->increment('quantity', 1);
                } else {
                    $autres_prestations = DB::connection('mysql2')->insert('INSERT INTO autre_prestation_experience(id_produit, id_pack_experience, id_liste_prix) VALUES (?,?,?)', [$produit->id_produit, $latest_pack->id_pack_experience, $id_prix_pack_prest]);
                    //Try tache EA 418 ronny
                    DB::connection('mysql2')->table('facture_produit_service')
                        ->where('id_produit', $produit->id_produit)
                        ->where('num_facture', $facture->num_factuce)
                        ->increment('quantity', 1);
                }
            }
        }

        if (!is_null($id_autre_prest)) {
            $checked_once = [];

            foreach ($id_autre_prest as $ap) {
                if (!in_array($ap, $checked_once)) {
                    $prest = ProduitService::find($ap);
                    $quantity =  array_count_values($id_autre_prest)[$ap] ?? 1;

                    $prix_autresprestation = DB::connection('mysql2')->table('liste_prix')
                        ->where('liste_prix.id_produit', '=', $prest->id_produit)
                        ->where('liste_prix.statut', '=', 'Par défaut')
                        ->orWhere(function (Builder $query) use ($prest) {
                            $query->where('liste_prix.id_produit', '=', $prest->id_produit)
                                ->where('liste_prix.statut', '=', 'Par defaut');
                        })
                        ->first();

                    if ((!is_null($prix_autresprestation)) && (!empty($prix_autresprestation->id_produit)) && (isNull($prix_autresprestation->id_pack))) {
                        $id_prix_autres_prest = $prix_autresprestation->id_liste_prix;
                    } else {
                        $id_prix_autres_prest = null;
                    }

                    $timestamp = time();
                    $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
                    $current_date->setTimestamp($timestamp);
                    $notif_text = ' Creation d\' facture_produit_service associé à la facture de ID ' . $facture->num_facture . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

                    $notification = DB::connection('mysql2')->table('notification')
                        ->insertGetId([
                            'contenu_notification' => $notif_text,
                            'date_notification' => $current_date->format('Y-m-d H:i:s'),
                            'type' => 'facture produit service'
                        ]);

                    if ($fact_rem > 0) {

                        $prod_rem = DB::connection('mysql2')->table('produit_service_remise')
                            ->where('id_remise', $fact_rem)
                            ->where('id_produit', $prest->id_produit)
                            ->first();

                        if ((!is_null($prod_rem)) && (!empty($prod_rem->id_historique_remise))) {
                            $id_hist_rem = $prod_rem->id_historique_remise;
                        } else {
                            $id_hist_rem = null;
                        }
                        //Try tache EA 418 ronny
                        $existingRow = DB::connection('mysql2')->table('facture_produit_service')
                            ->where('num_facture', $facture->num_facture)
                            ->where('id_produit', $prest->id_produit)
                            ->first();

                        if ($existingRow) {
                            DB::connection('mysql2')->table('facture_produit_service')
                                ->where('num_facture', $facture->num_facture)
                                ->where('id_produit', $prest->id_produit)
                                ->increment('quantity', 1);
                        } else {
                            $prest_fact = DB::connection('mysql2')->insert("INSERT INTO facture_produit_service(num_facture, id_produit, quantity, id_liste_prix, id_historique_remise) VALUES (?,?,?,?,?)", [$facture->num_facture, $prest->id_produit, $quantity, $id_prix_autres_prest, $id_hist_rem]);
                        }
                    } else {
                        //Try tache EA 418 ronny
                        $existingRow = DB::connection('mysql2')->table('facture_produit_service')
                            ->where('num_facture', $facture->num_facture)
                            ->where('id_produit', $prest->id_produit)
                            ->first();

                        if ($existingRow) {
                            DB::connection('mysql2')->table('facture_produit_service')
                                ->where('num_facture', $facture->num_facture)
                                ->where('id_produit', $prest->id_produit)
                                ->increment('quantity', 1);
                        } else {
                            $prest_fact = DB::connection('mysql2')->insert("INSERT INTO facture_produit_service(num_facture, id_produit, quantity, id_liste_prix) VALUES (?,?,?,?)", [$facture->num_facture, $prest->id_produit, $quantity, $id_prix_autres_prest]);
                        }
                    }
                }
                array_push($checked_once, $ap);
            }
        }

        $url = getenv('DISCORD_WEBHOOK');
        $data = array(
            'content' => 'Creation de la Facture ' . $facture->num_facture . ' le ' . $current_date->format('Y-m-d H:i:s') . ''
        );
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'POST',
                'content' => json_encode($data),
            ),
        );
        $context  = stream_context_create($options);
        /*
        $result = file_get_contents($url, false, $context);
        if ($result === false) {
            // Gérer l'erreur de l'envoi du message
        } else {
            // Message envoyé avec succès
        }
        */
        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $notif_text = ' La facture de ID ' . $facture->num_facture . ' a été validé le ' .  $current_date->format('Y-m-d H:i:s') . '';

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
                'num_facture' => $facture->num_facture,
                'id_facture_statut' => 10
            ]);



        $url = getenv('DISCORD_WEBHOOK');
        $data = array(
            'content' => ' La facture de ID ' . $facture->num_facture . ' a été validé le ' .  $current_date->format('Y-m-d H:i:s') . ''
        );
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'POST',
                'content' => json_encode($data),
            ),
        );
        $context  = stream_context_create($options);
        /*
                $result = file_get_contents($url, false, $context);
                if ($result === false) {
                    // Gérer l'erreur de l'envoi du message
                } else {
                    // Message envoyé avec succès
                }
                */
        // //CONNECTION à TWILIO
        /*$account_sid = getenv('TWILIO_ACCOUNT_SID');
        $auth_token = getenv('TWILIO_AUTH_TOKEN');

        $twilio_number = "+15419318069"; //"+15419318069"

        $clientTwilio = new Twilio($account_sid, $auth_token);

        $clientTwilio->messages->create(
            // Where to send a text message (your cell phone?)
            '+33687668279',
            array(
                'from' => $twilio_number,
                'body' => ' La facture de ID ' . $facture->num_facture . ' a été validé le ' .  $current_date->format('Y-m-d H:i:s') . ''
            )
        );*/
        // JM - Redirection vers l'url d'ou l'on est venu (reservation ou factures)
        return redirect()->to(session()->get('url_precedente'))
            ->with('success', 'La facture a bien ete validée');
    }
    /************************************Oumayma************************************* */

    public function updateDescreption(Request $request, $num_facture)
    {
        $request->validate([
            "description_lib" => "required",
        ]);

        $dbs = Facture::find($num_facture);
        $dbs->description_lib = $request->input('description_lib');
        $dbs->save();

        return redirect()->route('factures.show', ['facture' => $num_facture])
            ->with("factures.show", "La description a été modifiée avec succès !");
    }



    /**
     * Store a newly created resource in storage and uses the method valider.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAndEnvoyer(Request $request)
    {

        $request->validate([
            'id_contacts' => 'required|nullable',
            'id_autre_prest' => 'required|nullable',
            'desc_fact' => 'sometimes|string|nullable',
            'packs_experience' => 'required|nullable',
            'paiements' => 'required|nullable',
            'fact_rem' => 'required|nullable',
            'description_facture',
            'montant_remise' => 'required|numeric'

        ]);

        $id_contacts = unserialize($request->id_contacts);
        $id_autre_prest = unserialize($request->id_autre_prest);
        $packs_experience = unserialize($request->packs_experience);
        $paiements = unserialize($request->paiements);
        $fact_rem = $request->fact_rem;


        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);

        // ---------------------------------------yasser--------------------------------------
        $id_code_used = $request->id_code_used;
        if (isset($id_code_used) && $id_code_used != -1) {
            $result = DB::connection('mysql2')->table('codes_promo')
                ->select('nb_utilisation')
                ->where('id_code', $id_code_used)
                ->first();
            if ($result->nb_utilisation == 0) {
                $id_code_used = -1;
            } else {
                DB::connection('mysql2')->table('codes_promo')
                    ->where('id_code', $request->id_code_used)
                    ->update([
                        'nb_utilisation' => DB::raw('nb_utilisation - 1'),
                        'nb_code' => DB::raw('nb_code + 1'),
                        'date_update' => $current_date->format('Y-m-d H:i:s'),
                    ]);
            }
        }
        // ---------------------------------------yasser--------------------------------------
        if ($request->desc_fact == $request->description_facture) {
            $description = $request->desc_fact;
        } else {
            $description = $request->description_facture;
        }

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);


        $remise = DB::connection('mysql2')->table('historique_remise')
            ->where('id_remise', $fact_rem)
            ->orderByDesc('id_historique_remise')
            ->first();

        if ((!is_null($remise)) && (isset($remise->id_historique_remise))) {
            $id_historique_remise = $remise->id_historique_remise;
        } else {
            $id_historique_remise = null;
        }

        $liste_id_packs = [];
        $liste_id_prest_pack = [];

        foreach ($packs_experience as $pp) {
            array_push($liste_id_packs, $pp['id_pack']);

            if (isset($pp['id_prest'])) {
                array_push($liste_id_prest_pack, $pp['id_prest']);
            }
        }

        $count_pack_rem = DB::connection('mysql2')->table('packs_remise')
            ->where('id_remise', $fact_rem)
            ->whereIn('id_pack', $liste_id_packs)
            ->get();

        $count_prod_rem = DB::connection('mysql2')->table('produit_service_remise')
            ->where('id_remise', $fact_rem)
            ->whereIn('id_produit', $liste_id_prest_pack)
            ->orWhereIn('id_produit', $id_autre_prest)
            ->get();

        if (($fact_rem > 0) && ($count_pack_rem->isEmpty()) && ($count_prod_rem->isEmpty())) {

            $facture = Facture::create([
                'description_lib' => $description,
                'prix_facture' => $request->montant_remise,
                'nb_paiement' => $request->nb_paiements,
                'statut_facture' => '',
                'nb_paiement' => $paiements['nb_paiements'],
                'date_creation' => $current_date->format('Y-m-d H:i:s'),
                'date_update' => $current_date->format('Y-m-d H:i:s'),
                'canal_reservation' => 'App experience',
                'id_historique_remise' => $id_historique_remise
            ]);
        } else {

            $facture = Facture::create([
                'description_lib' => $description,
                'prix_facture' => $request->montant_remise,
                'nb_paiement' => $request->nb_paiements,
                'statut_facture' => '',
                'nb_paiement' => $paiements['nb_paiements'],
                'date_creation' => $current_date->format('Y-m-d H:i:s'),
                'date_update' => $current_date->format('Y-m-d H:i:s'),
                'canal_reservation' => 'App experience',
            ]);
        }





        $notif_text = 'Creation de la Facture ' . $facture->num_facture . ' le ' . $current_date->format('Y-m-d H:i:s') . '';

        $notification = DB::connection('mysql2')->table('notification')
            ->insert([
                'contenu_notification' => $notif_text,
                'date_notification' => $current_date->format('Y-m-d H:i:s'),
                'type' => 'facture'
            ]);
        $latest_notification = DB::connection('mysql2')->selectOne('SELECT id_notification FROM notification ORDER BY id_notification DESC');

        $stat = DB::connection('mysql2')->insert('INSERT INTO facture_statut_notification(id_notification,date_statut, num_facture, id_facture_statut) VALUES (?,?,?,2)', [$latest_notification->id_notification, $current_date->format('Y-m-d H:i:s'), $facture->num_facture]);

        if ($fact_rem > 0) {
            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
            $current_date->setTimestamp($timestamp);
            $notif_text = 'Association de la Facture ' . $facture->num_facture . 'avec la remise de ID ' . $fact_rem . ' le ' . $current_date->format('Y-m-d H:i:s') . '';

            $notification = DB::connection('mysql2')->table('notification')
                ->insert([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'factures remise'
                ]);


            $remise = DB::connection('mysql2')->table('historique_remise')
                ->where('id_remise', $fact_rem)
                ->orderByDesc('id_historique_remise')
                ->first();

            if (!is_null($remise)) {
                $facture_remise = DB::connection('mysql2')->table('factures_remise')
                    ->insert([
                        'num_facture' => $facture->num_facture,
                        'id_remise' => $fact_rem,

                    ]);
            }
        }


        $con_count = [];
        $date_echeance = strtotime('+1 day');

        $date_ecart = strtotime("+1 month") - $date_echeance;
        $loop_count = 1;

        $count_paiements = [];


        foreach ($paiements['paiements'] as $pay) {

            $date_echeance = new DateTime();
            $date_echeance = $date_echeance->createFromFormat('Y-m-d', $pay['date_fin']);
            $date_echeance->setTime(0, 0, 0, 0);

            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
            $current_date->setTimestamp($timestamp);


            if (!in_array($pay['id_contact'], $count_paiements)) {
                $pai_num = 1;
            } else {
                $pai_num = array_count_values($count_paiements)[$pay['id_contact']] + 1;
            }

            $con = DB::connection('mysql2')->table('contact')
                ->where('id_contact', $pay['id_contact'])
                ->first();
            $libelle = 'Paiement N° ' . $pai_num . ' de ' . $con->prenom . ' ' . $con->nom . '';
            $prix_paiement = $pay['prix'];
            $id_paiement = DB::connection('mysql2')
                ->table('paiement')
                ->insertGetId([
                    'libelle' => $libelle,
                    'prix' => $prix_paiement,
                    'statut_paiement' => 'Non Payé',
                    'num_facture' => $facture->num_facture,
                    'id_contact' => $con->id_contact,
                    'date_echeance' => $date_echeance->format('Y-m-d H:i:s'),
                    'date_creation' => $current_date->format('Y-m-d H:i:s'),
                    'date_update' => $current_date->format('Y-m-d H:i:s'),
                ]);

            array_push($count_paiements, $pay['id_contact']);


            $notif_text = 'Creation du paiement ID ' . $id_paiement . ' pour la facture ID' . $facture->num_facture . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

            $notification = DB::connection('mysql2')->table('notification')
                ->insert([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'paiement'
                ]);

            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
            $current_date->setTimestamp($timestamp);
            $notif_text = ' La facture de ID ' . $facture->num_facture . ' a été validé le ' .  $current_date->format('Y-m-d H:i:s') . '';

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
                    'num_facture' => $facture->num_facture,
                    'id_facture_statut' => 10
                ]);

            $url = getenv('DISCORD_WEBHOOK');
            $data = array(
                'content' => ' La facture de ID ' . $facture->num_facture . ' a été validé le ' .  $current_date->format('Y-m-d H:i:s') . ''
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

            $date_echeance = strtotime($pay['date_fin']);

            $stripe = new \Stripe\StripeClient(
                env('STRIPE_SECRET')
            );

            /**/

            $invoice = $stripe->invoices->create([
                'customer' => $con->id_client_stripe,
                'collection_method' => 'send_invoice',
                'due_date' => $date_echeance,
                'description' => $description,
                'metadata' => [
                    'id_contact' => $con->id_contact,
                    'id_paiement' => $id_paiement,
                    'num_facture' => $facture->num_facture,
                    'libelle' => $libelle
                ]
            ]);

            $invoice = substr($invoice, 21);
            $invoice = json_decode($invoice, true);

            if ($paiements['nb_paiements'] == 1) {
                foreach ($packs_experience as $pp) {
                    $pack = Pack::find($pp['id_pack']);
                    $product_pack = $stripe->products->retrieve($pack->id_stripe_pack, []);
                    $stripe->invoiceItems->create([
                        'customer' => $con->id_client_stripe,
                        'price' => $product_pack->default_price,
                        'invoice' => $invoice['id'],
                    ]);
                    if ($pp['nb_titres'] > 1) {
                        $product_titre = $stripe->products->retrieve(getenv('PRODUIT_TITRE'), []);
                        $stripe->invoiceItems->create([
                            'customer' => $con->id_client_stripe,
                            'price' => $product_titre->default_price,
                            'invoice' => $invoice['id'],
                            'quantity' => $pp['nb_titres'] - 1
                        ]);
                    }

                    if ($pp['nb_participants'] > 1) {
                        $product_part = $stripe->products->retrieve(getenv('PRODUIT_PARTICIPANT'), []);
                        $stripe->invoiceItems->create([
                            'customer' => $con->id_client_stripe,
                            'price' => $product_part->default_price,
                            'invoice' => $invoice['id'],
                            'quantity' => $pp['nb_participants'] - 1
                        ]);
                    }

                    if (isset($pp['id_prest'])) {
                        $produit = ProduitService::find($pp['id_prest']);
                        $product_prod = $stripe->products->retrieve($produit->id_stripe_produit, []);
                        $stripe->invoiceItems->create([
                            'customer' => $con->id_client_stripe,
                            'price' => $product_prod->default_price,
                            'invoice' => $invoice['id'],
                        ]);
                    }
                }

                if (!is_null($id_autre_prest)) {
                    $checked_once = [];
                    foreach ($id_autre_prest as $ap) {
                        if (!in_array($ap, $checked_once)) {
                            $prest = ProduitService::find($ap);
                            $product_prest = $stripe->products->retrieve($prest->id_stripe_produit, []);
                            $stripe->invoiceItems->create([
                                'customer' => $con->id_client_stripe,
                                'price' => $product_prest->default_price,
                                'invoice' => $invoice['id'],
                            ]);
                        }
                    }
                }
            } else {
                $price = $stripe->prices->create([
                    'unit_amount' => floatval($prix_paiement) * 100,
                    'currency' => 'eur',
                    'product' => env('PRODUIT_PAIEMENT'),
                ]);


                $price = substr($price, 19);
                $price = json_decode($price, true);
                $stripe->invoiceItems->create([
                    'customer' => $con->id_client_stripe,
                    'price' => $price['id'],
                    'invoice' => $invoice['id'],
                ]);
            }

            $stripe->invoices->sendInvoice(
                $invoice['id'],
                []
            );

            $up = DB::connection('mysql2')->table('paiement')
                ->where('id_paiment', $id_paiement)
                ->update([
                    'id_stripe_paiement' => $invoice['id'],
                    'date_update' => $current_date->format('Y-m-d H:i:s')
                ]);
        }



        foreach ($packs_experience as $pp) {
            $pack = Pack::find($pp['id_pack']);

            $prix_pack = DB::connection('mysql2')->table('liste_prix')
                ->where('liste_prix.id_pack', '=', $pack->id_pack)
                ->where('liste_prix.statut', '=', 'Par défaut')
                ->orWhere(function (Builder $query) use ($pack) {
                    $query->where('liste_prix.id_pack', '=', $pack->id_pack)
                        ->where('liste_prix.statut', '=', 'Par defaut');
                })
                ->first();

            if ((!is_null($prix_pack)) && (isNull($prix_pack->id_produit)) && (!empty($prix_pack->id_pack))) {
                $id_prix_pack = $prix_pack->id_liste_prix;
            } else {
                $id_prix_pack = null;
            }

            if ($fact_rem > 0) {
                $pack_rem = DB::connection('mysql2')->table('packs_remise')
                    ->where('id_remise', $fact_rem)
                    ->where('id_pack', $pack->id_pack)
                    ->first();

                if ((!is_null($pack_rem)) && (!empty($pack_rem->id_historique_remise))) {
                    $id_hist_rem = $pack_rem->id_historique_remise;
                } else {
                    $id_hist_rem = null;
                }
                $pack_exp = DB::connection('mysql2')->insert('INSERT INTO pack_experience(nb_titres, nb_participants, id_pack, num_facture, id_liste_prix, id_historique_remise) VALUES (?,?,?,?,?,?)', [$pp['nb_titres'], $pp['nb_participants'], $pack->id_pack, $facture->num_facture, $id_prix_pack, $id_hist_rem]);
            } else {
                $pack_exp = DB::connection('mysql2')->insert('INSERT INTO pack_experience(nb_titres, nb_participants, id_pack, num_facture, id_liste_prix) VALUES (?,?,?,?,?)', [$pp['nb_titres'], $pp['nb_participants'], $pack->id_pack, $facture->num_facture, $id_prix_pack]);
            }

            if (isset($pp['id_prest'])) {
                $produit = ProduitService::find($pp['id_prest']);
                $latest_pack = DB::connection('mysql2')->selectOne('SELECT id_pack_experience FROM pack_experience ORDER BY id_pack_experience DESC');


                $prix_packsprestation = DB::connection('mysql2')->table('liste_prix')
                    ->where('liste_prix.id_produit', '=', $produit->id_produit)
                    ->where('liste_prix.statut', '=', 'Par défaut')
                    ->orWhere(function (Builder $query) use ($produit) {
                        $query->where('liste_prix.id_produit', '=', $produit->id_produit)
                            ->where('liste_prix.statut', '=', 'Par defaut');
                    })
                    ->first();


                if ((!is_null($prix_packsprestation)) && (!empty($prix_packsprestation->id_produit)) && (isNull($prix_packsprestation->id_pack))) {
                    $id_prix_pack_prest = $prix_packsprestation->id_liste_prix;
                } else {
                    $id_prix_pack_prest = null;
                }


                $timestamp = time();
                $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
                $current_date->setTimestamp($timestamp);
                $notif_text = ' Creation d\' pack_experience associé à la facture de ID ' . $facture->num_facture . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

                $notification = DB::connection('mysql2')->table('notification')
                    ->insertGetId([
                        'contenu_notification' => $notif_text,
                        'date_notification' => $current_date->format('Y-m-d H:i:s'),
                        'type' => 'pack experience'
                    ]);

                $notif_text = ' Creation d\'une autre prestation  associé àu pack_experience de ID ' . $latest_pack->id_pack_experience . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

                $notification = DB::connection('mysql2')->table('notification')
                    ->insertGetId([
                        'contenu_notification' => $notif_text,
                        'date_notification' => $current_date->format('Y-m-d H:i:s'),
                        'type' => 'autre prestation'
                    ]);

                if ($fact_rem > 0) {

                    $prod_rem = DB::connection('mysql2')->table('produit_service_remise')
                        ->where('id_remise', $fact_rem)
                        ->where('id_produit', $produit->id_produit)
                        ->first();

                    if ((!is_null($prod_rem)) && (!empty($prod_rem->id_historique_remise))) {
                        $id_hist_rem = $prod_rem->id_historique_remise;
                    } else {
                        $id_hist_rem = null;
                    }
                    $autres_prestations = DB::connection('mysql2')->insert('INSERT INTO autre_prestation_experience(id_produit, id_pack_experience, id_liste_prix, id_historique_remise) VALUES (?,?,?,?)', [$produit->id_produit, $latest_pack->id_pack_experience, $id_prix_pack_prest, $id_hist_rem]);
                } else {
                    $autres_prestations = DB::connection('mysql2')->insert('INSERT INTO autre_prestation_experience(id_produit, id_pack_experience, id_liste_prix) VALUES (?,?,?)', [$produit->id_produit, $latest_pack->id_pack_experience, $id_prix_pack_prest]);
                }
            }
        }

        if (!is_null($id_autre_prest)) {
            $checked_once = [];

            foreach ($id_autre_prest as $ap) {

                if (!in_array($ap, $checked_once)) {
                    $prest = ProduitService::find($ap);
                    $quantity =  array_count_values($id_autre_prest)[$ap] ?? 1;

                    $prix_autresprestation = DB::connection('mysql2')->table('liste_prix')
                        ->where('liste_prix.id_produit', '=', $prest->id_produit)
                        ->where('liste_prix.statut', '=', 'Par défaut')
                        ->orWhere(function (Builder $query) use ($prest) {
                            $query->where('liste_prix.id_produit', '=', $prest->id_produit)
                                ->where('liste_prix.statut', '=', 'Par defaut');
                        })
                        ->first();

                    if ((!is_null($prix_autresprestation)) && (!empty($prix_autresprestation->id_produit)) && (isNull($prix_autresprestation->id_pack))) {
                        $id_prix_autres_prest = $prix_autresprestation->id_liste_prix;
                    } else {
                        $id_prix_autres_prest = null;
                    }

                    $timestamp = time();
                    $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
                    $current_date->setTimestamp($timestamp);
                    $notif_text = ' Creation d\' facture_produit_service associé à la facture de ID ' . $facture->num_facture . ' le ' .  $current_date->format('Y-m-d H:i:s') . '';

                    $notification = DB::connection('mysql2')->table('notification')
                        ->insertGetId([
                            'contenu_notification' => $notif_text,
                            'date_notification' => $current_date->format('Y-m-d H:i:s'),
                            'type' => 'facture produit service'
                        ]);

                    if ($fact_rem > 0) {

                        $prod_rem = DB::connection('mysql2')->table('produit_service_remise')
                            ->where('id_remise', $fact_rem)
                            ->where('id_produit', $prest->id_produit)
                            ->first();

                        if ((!is_null($prod_rem)) && (!empty($prod_rem->id_historique_remise))) {
                            $id_hist_rem = $prod_rem->id_historique_remise;
                        } else {
                            $id_hist_rem = null;
                        }
                        $prest_fact = DB::connection('mysql2')->insert("INSERT INTO facture_produit_service(num_facture, id_produit, quantity, id_liste_prix, id_historique_remise) VALUES (?,?,?,?,?)", [$facture->num_facture, $prest->id_produit, $quantity, $id_prix_autres_prest, $id_hist_rem]);
                    } else {
                        $prest_fact = DB::connection('mysql2')->insert("INSERT INTO facture_produit_service(num_facture, id_produit, quantity, id_liste_prix) VALUES (?,?,?,?)", [$facture->num_facture, $prest->id_produit, $quantity, $id_prix_autres_prest]);
                    }
                }
                array_push($checked_once, $ap);
            }
        }





        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);
        $notif_text = ' La facture de ID ' . $facture->num_facture . ' a été envoyé le ' .  $current_date->format('Y-m-d H:i:s') . '';

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
                'num_facture' => $facture->num_facture,
                'id_facture_statut' => 3
            ]);

        $url = getenv('DISCORD_WEBHOOK');
        $data = array(
            'content' => ' La facture de ID ' . $facture->num_facture . ' a été envoyé le ' .  $current_date->format('Y-m-d H:i:s') . ''
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

        //CONNECTION à TWILIO
        /*$account_sid = getenv('TWILIO_ACCOUNT_SID');
        $auth_token = getenv('TWILIO_AUTH_TOKEN');

        $twilio_number = "+15419318069"; //"+15419318069"

        $clientTwilio = new Twilio($account_sid, $auth_token);

        $clientTwilio->messages->create(
            // Where to send a text message (your cell phone?)
            '+33687668279',
            array(
                'from' => $twilio_number,
                'body' => ' La facture de ID ' . $facture->num_facture . ' a été envoyé le ' .  $current_date->format('Y-m-d H:i:s') . ''
            )
        );*/




        // JM - Redirection vers l'url d'ou l'on est venu (reservation ou factures)
        return redirect()->to(session()->get('url_precedente'))
            ->with('success', 'La facture a bien été envoyée');
    }
    private function updateStatutInDatabase($id_facture, $num_facture)
    {
        DB::connection('mysql2')->update('
        UPDATE facture_statut_notification
        SET id_facture_statut = ?
        WHERE num_facture = ?', [$id_facture, $num_facture]);
    }

    // ------------------------------------ fin : create facture------------------------------------------------------------------------------------------------------------------------
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $factures)
    {
        $modelfacture = new Facture;
        $modelfacture->setConnection('mysql2');

        $num_fact = DB::connection('mysql2')->select('SELECT num_facture FROM factures');


        $url1 = (int) $factures;
        $url = $url1;

        foreach ($num_fact as $key => $value) {
            if ($url1 === $value->num_facture) {
                $url = $url1;
            }
        }


        $taille = DB::connection('mysql2')->select('SELECT * from paiement where num_facture=?', [$url]);
        $dbs = DB::connection('mysql2')->select('SELECT DISTINCT factures.num_facture, factures.nb_paiement,factures.prix_facture,factures.description_lib,contact.adresse,contact.ville,contact.code_postal,
        factures.id_stripe, factures.url_facture,contact.nom,contact.id_contact,contact.prenom,contact.email,contact.tel,facture_statut.statut_facture,p.id_paiment,p.libelle,p.prix,p.statut_paiement,p.date_echeance,factures.date_creation,p.id_stripe_paiement
            FROM factures JOIN contact JOIN facture_statut
            JOIN (
                    SELECT num_facture, MIN(id_paiment) AS id_paiment,id_contact,libelle,prix,statut_paiement,date_echeance,id_stripe_paiement
                    FROM paiement
                    GROUP BY num_facture
                ) AS p ON factures.num_facture = p.num_facture
            JOIN (
                SELECT num_facture, MAX(id_facture_statut) AS id_facture_statut
                FROM facture_statut_notification
                GROUP BY num_facture) AS fact_stat_notif ON factures.num_facture = fact_stat_notif.num_facture

            AND p.id_contact=contact.id_contact
            AND fact_stat_notif.id_facture_statut=facture_statut.id_facture_statut
            WHERE factures.num_facture=?', [$url]);
        $paiements = DB::connection('mysql2')->table('paiement')->where('num_facture', '=', $url)->get();

        $statut_facture = DB::connection('mysql2')->table('facture_statut_notification')
            ->join('facture_statut', 'facture_statut_notification.id_facture_statut', '=', 'facture_statut.id_facture_statut')
            ->where('facture_statut_notification.num_facture', $url)
            ->orderByDesc('facture_statut_notification.id_notification')
            ->first();

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

        $clients = DB::connection('mysql2')->select(
            'SELECT DISTINCT contact.id_contact,contact.nom,contact.prenom
        FROM contact JOIN factures JOIN paiement
        ON factures.num_facture = paiement.num_facture
        AND paiement.id_contact=contact.id_contact
        WHERE factures.num_facture=?',
            [$url]
        );


        $date_emission = DB::connection('mysql2')->table('facture_statut_notification')
            ->where('num_facture', '=', $url)
            ->where('id_facture_statut', '=', '3')
            ->first();
        if (!is_null($date_emission)) {
            $date_emission = $date_emission->date_statut;
        }
        // --------------------------
        $packs = DB::connection('mysql2')->table('factures')
            ->join('pack_experience', 'factures.num_facture', '=', 'pack_experience.num_facture')
            ->join('pack', 'pack_experience.id_pack', '=', 'pack.id_pack')
            ->join('liste_prix', 'liste_prix.id_pack', '=', 'pack.id_pack')
            ->join('experience', 'pack_experience.id_experience', '=', 'experience.id_experience')
            ->join('experience_statut_notification', 'pack_experience.id_experience', '=', 'experience_statut_notification.id_experience')
            ->join('experience_statut', 'experience_statut_notification.id_statut_experience', '=', 'experience_statut.id_statut_experience')
            ->where('factures.num_facture', '=', $url)
            ->groupBy('pack.id_pack')
            ->get();


        if ($packs->isEmpty()) {
            $packs = DB::connection('mysql2')->table('factures')
                ->join('pack_experience', 'factures.num_facture', '=', 'pack_experience.num_facture')
                ->join('pack', 'pack_experience.id_pack', '=', 'pack.id_pack')
                ->where('pack_experience.num_facture', '=', $url)
                ->groupBy('pack.id_pack')
                ->get();
        }
        $num_facture = $request->num_facture;

        $produits = DB::connection('mysql2')->table('factures')
            ->join('facture_produit_service', 'factures.num_facture', '=', 'facture_produit_service.num_facture')
            ->join('produits_services', 'facture_produit_service.id_produit', '=', 'produits_services.id_produit')
            ->where('factures.num_facture', '=', $url)
            ->groupBy('produits_services.id_produit')
            ->get();

        // --------------------------yasser------------------------------------------
        $event_fact = DB::connection('mysql2')->table('facture_statut_notification')
            ->join('facture_statut', 'facture_statut_notification.id_facture_statut', '=', 'facture_statut.id_facture_statut')
            ->where('facture_statut_notification.num_facture', $url)
            ->join('notification', 'facture_statut_notification.id_notification', '=', 'notification.id_notification')
            ->orderByDesc('facture_statut_notification.id_notification')
            ->get();

        $date_echeance = DB::connection('mysql2')->table('factures')
            ->join('paiement', 'factures.num_facture', '=', 'paiement.num_facture')
            ->where('paiement.statut_paiement', '=', 'Non payé')
            ->where('factures.num_facture', '=', $url)
            ->orderBy('paiement.id_paiment')
            ->first();

        if (!is_null($date_echeance)) {
            $date_echeance = $date_echeance->date_echeance;
        }

        $totalpayment = 0;
        $totalStripe = 0;

        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );


        foreach ($paiements as $paiement) {
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

        // dd($dbs[0]->prix_facture);

        if ($totalpayment == $totalStripe && $totalStripe == $dbs[0]->prix_facture) {
            return view('factures.show', compact('dbs', 'taille', 'num_facture', 'factures', 'statut_facture', 'experiences', 'paiements', 'clients', 'date_emission', 'packs', 'produits', 'event_fact', 'date_echeance'))
                ->with('success', "Les prix correspondent entre l'app et stripe");
        } else {
            return view('factures.show', compact('dbs', 'taille', 'num_facture', 'factures', 'statut_facture', 'experiences', 'paiements', 'clients', 'date_emission', 'packs', 'produits', 'event_fact', 'date_echeance'));
            // ->withErrors(['message' => "Les prix sont differents entre l'app et stripe"]);
        }
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

            return redirect('/factures');
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
        return redirect()->route('factures.index')
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
            return redirect()->route('factures.index')
                ->with('error', 'Erreur lors de la suppression de la facture');
        } else {


            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
            $current_date->setTimestamp($timestamp);
            $notif_text = ' Suppression de la ID ' . $facture . ' et de tous les entreés associé à cette facture dans plusieurs tables le ' .  $current_date->format('Y-m-d H:i:s') . '';

            $notification = DB::connection('mysql2')->table('notification')
                ->insert([
                    'contenu_notification' => $notif_text,
                    'date_notification' => $current_date->format('Y-m-d H:i:s'),
                    'type' => 'interaction'
                ]);

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

            return redirect()->route('factures.index')
                ->with('success', 'La facture a été supprimée avec succes');
        }
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

    public function valider(Request $request, $num_facture, $id_facture_statut)
    {
        if (($id_facture_statut == 2) || ($id_facture_statut == 1) || ($id_facture_statut == 11)) {
            $current_status = DB::connection('mysql2')->table('facture_statut')
                ->where('statut_facture', $id_facture_statut)
                ->first();

            if ($id_facture_statut == 11) {
                $timestamp = time();
                $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
                $current_date->setTimestamp($timestamp);
                $notif_text = ' La facture brouillon de ID ' . $num_facture . ' viens d\'être crée le ' .  $current_date->format('Y-m-d H:i:s') . '';

                DB::connection('mysql2')->table('factures')
                    ->where('num_facture', $num_facture)
                    ->update([
                        'date_creation' => $current_date->format('Y-m-d H:i:s'),
                        'date_update' => $current_date->format('Y-m-d H:i:s'),
                    ]);
            }

            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
            $current_date->setTimestamp($timestamp);
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

                $up = DB::connection('mysql2')->table('paiement')
                    ->where('id_paiment', $pay->id_paiment)
                    ->update([
                        'id_stripe_paiement' => $invoice['id'],
                        'date_update' => $current_date->format('Y-m-d H:i:s')
                    ]);

                $stripe->invoiceItems->create([
                    'customer' => $con->id_client_stripe,
                    'price' => $price['id'],
                    'invoice' => $invoice['id'],
                ]);
                $stripe->invoices->finalizeInvoice(
                    $invoice['id'],
                    []
                );
            }
            $this->updateStatutInDatabaseFacture(10, $num_facture);


            $url = getenv('DISCORD_WEBHOOK');
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
            /*
                $result = file_get_contents($url, false, $context);
                if ($result === false) {
                    // Gérer l'erreur de l'envoi du message
                } else {
                    // Message envoyé avec succès
                }
                */

            return redirect()->route('factures.index')
                ->with('success', 'La facture a bien ete validée');
        } else {
            return redirect()->route('factures.index')
                ->with('error', 'Erreur lors de la validation de la facture');
        }
    }

    public function envoyer(Request $request, $num_facture, $id_facture_statut)
    {
        if ((($id_facture_statut >= 3) && ($id_facture_statut <= 6)) || ($id_facture_statut == 10)) {
            $current_status = DB::connection('mysql2')->table('facture_statut')
                ->where('statut_facture', $id_facture_statut)
                ->first();

            $timestamp = time();
            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
            $current_date->setTimestamp($timestamp);
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


                $stripe = new \Stripe\StripeClient(
                    env('STRIPE_SECRET')
                );


                $stripe->invoices->sendInvoice(
                    $pay->id_stripe_paiement,
                    []
                );
                $url = getenv('DISCORD_WEBHOOK');
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


            return redirect()->route('factures.index')
                ->with('success', 'La facture a bien été envoyée');
        } else {
            return redirect()->route('factures.index')
                ->with('error', 'Erreur lors de l\'envoi de la facture');
        }
    }


    public function createInteraction(Request $request)
    {
        $request->validate([
            'id_exp' => 'nullable|exists:mysql2.experience,id_experience',
            'id_cnt' => 'required|exists:mysql2.contact,id_contact',
            'num_facture' => 'required|exists:mysql2.factures,num_facture',
            'type_int',
            'texte' => 'required'
        ]);

        $id_experience = $request->id_exp;
        $id_contact = $request->id_cnt;
        $num_facture = $request->num_facture;
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
            ->insert([
                'date_heure' => $current_date->format('Y-m-d H:i:s'),
                'texte' => $texte,
                'type_interaction' => $type_int,
                'id_contact' => $id_contact,
                'id_experience' => $id_experience
            ]);
        $this->updateStatutInDatabase(3, $num_facture);
        return redirect()->route('factures.show', ['facture' => $num_facture])
            ->with('success', 'Interaction créée avec succes');
    }

    public function createStorytelling(Request $request)
    {
        $request->validate([
            'id_exp' => 'required|exists:mysql2.experience,id_experience',
            'num_facture' => 'required|exists:mysql2.factures,num_facture',
            'desc_content',
            'desc_story' => 'required'
        ]);

        $id_experience = $request->id_exp;
        $num_facture = $request->num_facture;
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
            ->insert([
                'id_content_experience' => $content,
                'description' => $desc_story,
                'date_creation' => $current_date->format('Y-m-d H:i:s'),
                'date_update' => $current_date->format('Y-m-d H:i:s'),
            ]);


        return redirect()->route('factures.show', ['facture' => $num_facture])
            ->with('success', 'Storytelling créé avec succes');
    }

    // ---------------------- modif_client_dans_facture----------------------------
    /*******************************************Oumayma************************,*********************** */
    public function modif_client_dans_facture(Request $request)
    {
        $request->validate([
            'id_contacts' => 'required',
            'nom' => 'required|nullable',
            'prenom' => 'required|nullable',
            'email' => 'required|nullable',
            'tel' => 'nullable',
            'adresse' => 'nullable',
            'code_postal' => 'nullable',
            'ville' => 'nullable',
            'enteprise' => 'nullable',
            'type' => 'nullable',
        ]);

        $id_contacts = $request->id_contacts;
        $id_entreprise = $request->entreprise;

        // Mettre à jour la table "contact"
        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);

        DB::connection('mysql2')->table('contact')
            ->whereIn('id_contact', [$id_contacts])
            ->update([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'email' => $request->email,
                'tel' => $request->tel,
                'adresse' => $request->adresse,
                'code_postal' => $request->code_postal,
                'ville' => $request->ville,
                'date_update' => $current_date->format('Y-m-d H:i:s')
            ]);

        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );

        $con = DB::connection('mysql2')->table('contact')->where('id_contact', $id_contacts)->get()->first();

        if (isset($con->id_client_stripe)) {
            $client = $stripe->customers->update(
                $con->id_client_stripe,
                [
                    'address' => [
                        'line1' => $request->adresse,
                        'postal_code' => $request->code_postal,
                        'city' => $request->ville,
                    ],
                    'phone' => $request->tel,
                    'email' => $request->email,
                    'name' => $request->prenom . ' ' . $request->nom,
                ]
            );
        }

        if (is_null($id_entreprise)) {
            DB::connection('mysql2')->table('contact_entreprise')
                ->where('id_contact', '=', $id_contacts)
                ->delete();
            if (isset($con->id_client_stripe)) {
                $client = $stripe->customers->update(
                    $con->id_client_stripe,
                    [
                        'metadata' =>
                        [
                            'type' => null,
                            'id_organisation' => null
                        ]
                    ]
                );
            }
        } else {
            DB::connection('mysql2')->table('contact_entreprise')->updateOrInsert(
                ['id_contact' => $id_contacts],
                [
                    'type' => $request->type,
                    'id_organisation' => $id_entreprise,
                ]
            );

            if (isset($con->id_client_stripe)) {
                $client = $stripe->customers->update(
                    $con->id_client_stripe,
                    [
                        'metadata' =>
                        [
                            'type' => $request->type,
                            'id_organisation' => $id_entreprise
                        ]
                    ]
                );
            }
        }

        return response()->json("ok");
    }


    /*
    public function modif_client_dans_facture(Request $request){
        // dd("on arrive bien ");
        $request->validate([
            'id_contacts'=> 'required',
            'nom'=> 'required|nullable',
            'prenom'=> 'required|nullable',
            'email'=> 'required|nullable',
            'tel'=> 'nullable',
            'adresse'=> 'nullable',
            'code_postal' => 'nullable',
            'ville' => 'nullable',
            'enteprise' => 'required|nullable',
            'type' => 'nullable',
        ]);
        $id_contacts= $request->id_contacts;
        $id_entreprise = $request->enteprise;
        if($id_entreprise == 0 ){
            DB::connection('mysql2')->table('contact_entreprise')->where('id_contact', '=', $id_contacts)->delete();
        }
        // dd($request);

        $timestamp = time();
        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
        $current_date->setTimestamp($timestamp);

        // Mettre à jour la table "contact"
        DB::connection('mysql2')->table('contact')
        ->whereIn('id_contact', [$id_contacts])
        ->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'tel'=> $request->tel,
            'adresse'=> $request->adresse,
            'code_postal'=> $request->code_postal,
            'ville'=> $request->ville,
            'date_update' => $current_date->format('Y-m-d H:i:s')
        ]);



        DB::connection('mysql2')->table('contact_entreprise')->updateOrInsert(
            ['id_contact' => $id_contacts],
            [
                'type' => $request->type,
                'id_organisation' => $id_enteprise,
            ]
        );


        return response()->json("ok");
    }
*/
    public function deleteSelect(Request $request)
    {
        $ids = $request->input('factures');
        DB::connection('mysql2')->table('factures')->whereIn('num_facture', $ids)->delete();

        return redirect()->route('facture.index')->with('success', 'Selection supprimée avec succes');
    }

    private function updateStatutInDatabaseFacture($id_facture, $num_facture)
    {
        DB::connection('mysql2')->update('
        UPDATE facture_statut_notification
        SET id_facture_statut = ?
        WHERE num_facture = ?', [$id_facture, $num_facture]);
    }

    public function createFactureByCSV()
    {
        $csvFile = 'C:/Users/Harena/Documents/CSV/Liste.csv';
        $file = new SplFileObject($csvFile, 'r');
        $file->setFlags(SplFileObject::READ_CSV);

        $data = [];

        foreach ($file as $row) {
            // Utilisez la première ligne du fichier CSV comme clés
            if (empty($headers)) {
                $headers = $row;
                continue;
            }

            // Associez chaque valeur aux clés correspondantes
            $rowData = array_combine($headers, $row);

            // Ajoutez la ligne de données au tableau
            $data[] = $rowData;
        }

        foreach ($data as $line) {

            $pack = Pack::where('nom', $line['pack'])->first();

            if ($line['type_paiement'] == 'Gratuit') {
                $prix = 0;
            } else {
                $prix = $pack->prix + (intval($line['nb_participant']) - 1) * 40 + (intval($line['nb_titre']) - 1) * 85;
            }
            $contact = Contact::where('email', $line['email'])->first();
            if (!$contact) {
                if ($line['email'] == "") {
                    $email = null;
                } else {
                    $email = $line['email'];
                }
                $contact = Contact::create([
                    'nom' => $line['nom'],
                    'prenom' => $line['prenom'],
                    'email' => $line['email'],
                    'tel' => $line['tel'],
                    'adresse' => $line['adresse'],
                    'code_postal' => $line['code_postal'],
                    'ville' => $line['ville'],
                ]);
            }

            $facture = Facture::create([
                'description_lib' => '',
                'prix_facture' => $prix,
                'statut_facture' => 'Payé',
                'nb_paiement' => 1,
                'canal_reservation' => $line['type_paiement'],
                'date_creation' => $line['date_creation'],
            ]);

            $notification1 = Notification::create([
                'contenu_notification' => 'La facture a été payé',
                'date_notification' => $line['date_creation'],
                'type' => 'facture'
            ]);

            $facture_statut_notification = FactureStatutNotification::create([
                'id_notification' => $notification1->id_notification,
                'date_statut' => $line['date_publication'],
                'num_facture' => $facture->num_facture,
                'id_facture_statut' => 6
            ]);

            $paiement = Paiement::create([
                'libelle' => 'Paiement de ' . $line['nom'] . ' ' . $line['prenom'],
                'prix_paiement' => $prix,
                'statut_paiement' => 'Payé',
                'moyen_paiement' => $line['type_paiement'],
                'date_creation'    => $line['date_creation'],
                'canal_paiement' => $line['type_paiement'],
                'num_facture' => $facture->num_facture,
                'id_contact' => $contact->id_contact
            ]);

            $liste_prix = ListePrix::where('id_pack', $pack->id_pack)->orderByDesc('id_liste_prix')->first();

            $pack_experience = PackExperience::create([
                'nb_titres' => $line['nb_titre'],
                'nb_participants' => $line['nb_participant'],
                'id_pack' => $pack->id_pack,
                'num_facture' => $facture->num_facture,
                'id_liste_prix' => $liste_prix->id_liste_prix
            ]);
            $d = new DateTime($line['date_creation']);
            $d2 = $d->format('ymd');
            $num_exp = strtoupper($d2 . (Str::random(4)));
            $experience = Experience::create([
                'numero_experience' => $num_exp,
                'nom_experience' => 'Experience ' . $num_exp,
                'histoire_experience' => '',
                'date_reservation' => '',
                'heure_reservation' => '',
                'duree_reservation' => '',
                'date_creation' => $line['date_creation'],
                'date_update' => ''
            ]);

            $notification2 = Notification::create([
                'contenu_notification' => 'L\'experience a été publié',
                'date_notification' => $line['date_publication'],
                'type' => 'facture'
            ]);

            $experience_statut_notification = ExperienceStatutNotification::create([
                'id_notification' => $notification2->id_notification,
                'date_statut' => $line['date_publication'],
                'id_experience' => $experience->id_experience,
                'id_statut_experience' => 7
            ]);

            $pack_experience->id_experience = $experience->id_experience;
            $pack_experience->save();

            $contact_experience = ContactExperience::create([
                'id_experience' => $experience->id_experience,
                'id_contact' => $contact->id_contact,
                'profil' => 'Client-User',
                'description' => ''
            ]);
        }

        // Vous pouvez maintenant utiliser le tableau $data qui contient les données du fichier CSV
        // Par exemple, pour afficher les données :
        dd($data);
    }
}
