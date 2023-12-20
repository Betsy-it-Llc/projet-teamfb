<?php   

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use \Stripe\Stripe;

class   BaseController extends Controller {
    public function getDescription() {
        set_time_limit(120); 
        Stripe::setApiKey(env('STRIPE_SECRET_LIVE'));
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_LIVE'));
        $contacts = DB::connection('mysql2')->table('contact')->get();
        foreach ($contacts as $contact) {
            if(isset($contact->id_client_stripe)) {
                $id_stripe_contact = $contact->id_client_stripe;
                $customer = $stripe->customers->retrieve($id_stripe_contact,[]);
                //update de contact

                DB::connection('mysql2')->table('contact')
                    ->where('id_contact', $contact->id_contact)
                    ->update(['description' => $customer->description]);

                    DB::connection('mysql2')->table('contact')
                    ->where('id_contact', $contact->id_contact)
                    ->update(['tel'=> $customer->phone]);

                    if(isset($customer->address)){
                        //dd($customer->address);
                        DB::connection('mysql2')->table('contact')
                        ->where('id_contact', $contact->id_contact)
                        ->update(['adresse'=> $customer->address->line1, 'code_postal'=> $customer->address->postal_code, 'ville'=> $customer->address->city]);
                    }

                // $factures = DB::connection('mysql2')
                //     ->select(
                //         'SELECT factures.* FROM paiement, factures WHERE id_contact ='.$contact->id_contact.' AND paiement.num_facture = factures.num_facture GROUP BY factures.num_facture'
                //     ); 

                // foreach ($factures as $facture) {
                //     // DB::connection('mysql2')->table('factures')
                //     //     ->where('num_facture', $facture->num_facture)
                //     //     ->update(['description_lib' => $customer->description]);
                //     $experiences = DB::connection('mysql2')
                //         ->select(
                //             'SELECT experience.* FROM experience, pack_experience WHERE pack_experience.num_facture = '. $facture->num_facture.' AND pack_experience.id_experience = experience.id_experience GROUP BY experience.id_experience'
                //         );
                //     foreach($experiences as $experience){
                //         DB::connection('mysql2')->table('experience')
                //             ->where('id_experience', $experience->id_experience)
                //             ->update(['histoire_experience' => $customer->description]);
                //     }
                // }





                // $factures = DB::connection('mysql2')
                //     ->table('paiement')
                //     ->where('id_contact', 122)
                //     ->get();
                // dd($paiements);
                // foreach ($paiements as $paiement) {
                //     if(isset($paiement->id_stripe_paiement)){
                //         $id_stripe_paiement = $paiement->id_stripe_paiement;
                //         if(Str::startsWith($id_stripe_paiement, 'in_')){
                //             $invoice = $stripe->invoices->retrieve($id_stripe_paiement,[]);
                //             if(isset($invoice->description)){
                //                 $description = $invoice->description;
                //             } else {
                //                 $description = $customer->description;
                //             }
                //             //dd($invoice,$description);
                //         } elseif (Str::startsWith($id_stripe_paiement, 'pi_')) {
                //             $pi = $stripe->paymentIntents->retrieve($id_stripe_paiement,[]);
                //             if(isset($pi->invoice)){
                //                 $invoice = $stripe->invoices->retrieve($pi->invoice,[]);
                //                 if(isset($invoice->description)){
                //                     $description = $invoice->description;
                //                 } else {
                //                     $description = $customer->description;
                //                 }
                //             } else {   
                //                 $description = $customer->description;
                //             }
                //             //dd($pi,$description);
                //         }
                //         //update factures

                //         if ($paiement)
                //     }
                    
                // }
            }
        }
    }
}