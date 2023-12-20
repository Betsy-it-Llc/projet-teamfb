<?php

namespace App\Http\Controllers;

use App\Models\Compte;
use App\Models\Panier;
use App\Models\Cagnotte;
use App\Models\Transaction;
use App\Models\experienceApp\Pack;
use Illuminate\Support\Facades\DB;
use App\Models\experienceApp\Contact;
use App\Models\experienceApp\Facture;
use App\Models\FactureProduitService;
use App\Models\experienceApp\ListePrix;
use App\Models\experienceApp\PackExperience;
use App\Models\experienceApp\ProduitService;
use Illuminate\Http\Request;

class PanierController extends Controller
{
    public static function addPackToCart(Pack $item, Panier $cart, $nb_participants = 1, $nb_titres = 1)
    {
        $prix = ListePrix::where('id_pack', $item->id_pack)->orderBy('date_creation', 'desc')->first();
        $packExperience = PackExperience::create([
            'nb_participants' => $nb_participants,
            'nb_titres' => $nb_titres,
            'num_facture' => $cart->num_facture,
            'id_pack' => $item->id_pack,
            'id_liste_prix' => $prix->id_liste_prix
        ]);

        return $packExperience;
    }

    public static function addProduitToCart(ProduitService $item, Panier $cart, $quanity = 1)
    {
        $prix = ListePrix::where('id_produit', $item->id_produit)->orderBy('date_creation', 'desc')->first();
        $produitFacture = FactureProduitService::create([
            'id_produit' => $item->id_produit,
            'id_liste_prix' => $prix->id_liste_prix,
            'quantity' => $quanity,
            'num_facture' => $cart->num_facture
        ]);
        return $produitFacture;
    }

    public function supprimerProduitDuPanier($produitId, $numFactureId)
    {
        // Récupération du panier par numéro de facture
        $panier = DB::connection('mysql2')->table('paniers')
            ->where('num_facture', $numFactureId)
            ->first();

        if ($panier) {
            // Recherche du produit facturé
            $produitFacture = DB::connection('mysql2')->table('facture_produit_service')
                ->where('id_produit', $produitId)
                ->where('num_facture', $numFactureId)
                ->first();

            if ($produitFacture) {
                // Suppression du produit facturé
                DB::connection('mysql2')->table('facture_produit_service')
                    ->where('num_facture', $produitFacture->num_facture)
                    ->where('id_produit', $produitFacture->id_produit)
                    ->delete();

                return redirect()->route('utilisateur.panier', ['id_panier' => $panier->id_panier])->with('success', 'Le produit a été retiré du panier avec succès.');
            } else {
                return redirect()->route('utilisateur.panier', ['id_panier' => $panier->id_panier])->with('error', 'Le produit n\'a pas été trouvé dans le panier.');
            }
        } else {
            return redirect()->route('utilisateur.panier')->with('error', 'Le panier n\'a pas été trouvé pour cette facture.');
        }
    }



    public function supprimerPackDuPanier($packId, $numFactureId)
    {

        $panier = Panier::where('num_facture', $numFactureId)->first();
        if ($panier) {
            // Vous avez maintenant l'ID du panier
            $id_panier = $panier->id_panier;
            // Recherchez l'entrée correspondant au pack dans le panier
            $packExperience = PackExperience::where('id_pack', $packId)
                ->where('num_facture', $numFactureId)
                ->first();

            if ($packExperience) {
                // Si l'entrée existe, supprimez-la
                $packExperience->delete();

                return redirect()->route('utilisateur.panier', ['id_panier' => $id_panier])->with('success', 'Le pack a été retiré du panier avec succès.');
            } else {
                return redirect()->route('utilisateur.panier', ['id_panier' => $id_panier])->with('error', 'Le pack n\'a pas été trouvé dans le panier.');
            }
        } else {
            return redirect()->route('utilisateur.panier')->with('error', 'Le panier n\'a pas été trouvé pour cette facture.');
        }
    }

    public function supprimerPanierComplet($numFacture)
    {

        // Supprimez d'abord les produits du panier depuis la table "facture_produit_service"
        DB::connection('mysql2')
            ->table('facture_produit_service')
            ->where('num_facture', $numFacture)
            ->delete();

        // Supprimez ensuite les packs du panier depuis la table "pack_experience"
        DB::connection('mysql2')
            ->table('pack_experience')
            ->where('num_facture', $numFacture)
            ->delete();

        // Supprimez le panier lui-même depuis la table "paniers"
        DB::connection('mysql2')
            ->table('paniers')
            ->where('num_facture', $numFacture)
            ->delete();

        // Supprimez la notification depuis la table "facture_statut_notification"
        DB::connection('mysql2')
            ->table('facture_statut_notification')
            ->where('num_facture', $numFacture)
            ->delete();

        // Supprimez le paiement depuis la table "paiement"
        DB::connection('mysql2')
            ->table('paiement')
            ->where('num_facture', $numFacture)
            ->delete();

        // Supprimez l'entrée correspondante dans la table "factures" si nécessaire
        DB::connection('mysql2')
            ->table('factures')
            ->where('num_facture', $numFacture)
            ->delete();

        // Redirigez l'utilisateur vers la page appropriée (par exemple, la liste des paniers)
        return redirect()->route('utilisateur.produitpack')->with('success', 'Le panier a été supprimé avec succès.');
    }

    public function modifierQuantitePersonnes($facture, $pack, Request $request)
    {
        $request->validate([
            'nb_participants' => 'required|integer',
        ]);

        $numFacture = $facture;
        $packId = $pack;
        $nbParticipants = $request->input('nb_participants');

        // Recherchez le pack dans le panier
        $packExperience = PackExperience::where('id_pack', $packId)
            ->where('num_facture', $numFacture)
            ->first();

        if ($packExperience) {
            // Si le pack existe, mettez à jour le nombre de participants
            $packExperience->nb_participants = $nbParticipants;
            $packExperience->save();

            // Recherchez l'ID du panier associé à ce pack
            $id_panier = Panier::where('num_facture', $numFacture)->value('id_panier');

            return redirect()->route('utilisateur.panier', ['id_panier' => $id_panier])->with('success', 'Le nombre de participants du pack a été modifié avec succès.');
        } else {
            return redirect()->route('utilisateur.panier')->with('error', 'Le pack n\'a pas été trouvé dans le panier.');
        }
    }



    public function modifierQuantiteTitres($facture, $pack, Request $request)
    {
        $request->validate([
            'nb_titres' => 'required|integer',
        ]);

        $numFacture = $facture;
        $packId = $pack;
        $nbTitres = $request->input('nb_titres');

        // Recherchez le pack dans le panier
        $packExperience = PackExperience::where('id_pack', $packId)
            ->where('num_facture', $numFacture)
            ->first();

        if ($packExperience) {
            // Si le pack existe, mettez à jour le nombre de titres
            $packExperience->nb_titres = $nbTitres;
            $packExperience->save();

            // Recherchez l'ID du panier associé à ce pack
            $id_panier = Panier::where('num_facture', $numFacture)->value('id_panier');

            return redirect()->route('utilisateur.panier', ['id_panier' => $id_panier])->with('success', 'Le nombre de titres du pack a été modifié avec succès.');
        } else {
            return redirect()->route('utilisateur.panier')->with('error', 'Le pack n\'a pas été trouvé dans le panier.');
        }
    }



    public function modifierQuantiteProduit($numFactureId, $produitId, Request $request)
    {
        // Récupération du panier par numéro de facture
        $panier = DB::connection('mysql2')->table('paniers')
            ->where('num_facture', $numFactureId)
            ->first();
        //dd($numFactureId);

        if ($panier) {
            // Recherche du produit facturé
            $produitFacture = DB::connection('mysql2')->table('facture_produit_service')
                ->where('id_produit', $produitId)
                ->where('num_facture', $numFactureId)
                ->first();

            if ($produitFacture) {
                // Mettez à jour la quantité du produit facturé
                DB::connection('mysql2')->table('facture_produit_service')
                    ->where('num_facture', $produitFacture->num_facture)
                    ->where('id_produit', $produitFacture->id_produit)
                    ->update(['quantity' => $request->input('quantity')]);

                return redirect()->route('utilisateur.panier', ['id_panier' => $panier->id_panier])->with('success', 'La quantité du produit a été modifiée avec succès.');
            } else {
                return redirect()->route('utilisateur.panier', ['id_panier' => $panier->id_panier])->with('error', 'Le produit n\'a pas été trouvé dans le panier.');
            }
        }
    }
}
