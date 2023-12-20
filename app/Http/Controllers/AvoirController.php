<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Avoir;
use App\Models\Compte;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AvoirController extends Controller
{
    public function createAvoir($paiement, $date_expiration=null) {
        $current_date = date("Y-m-d H:i:s");
        $avoir = Avoir::create([
            'montant'=>$paiement->prix,
            'date_creation'=>$current_date,
            'date_expiration'=>$date_expiration,
            'statut'=>'Valide'
        ]);

        $compte = Compte::where('id_contact','=',$paiement->id_contact)->where('type','=','Avoir');
        $compte->increment('solde',$paiement->prix);
    
        $transaction = Transaction::create([
            'montant'=>$paiement->prix,
            'date_transaction'=>$current_date,
            'type'=>'avoir',
            'id_paiement'=>$paiement->id_paiment,
            'id_avoir'=>$avoir->id_avoir,
            'id_compte_destinataire'=>$compte->id_compte,
            'id_contact'=>$paiement->id_contact
        ]);
    }
}
