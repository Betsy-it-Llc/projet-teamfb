<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ContributionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::connection('mysql2')->table('contributions')->delete();
        
        \DB::connection('mysql2')->table('contributions')->insert(array (
            0 => 
            array (
                'id_contributions' => 1,
                'date_contribution' => '2023-06-10 10:24:00',
                'mode_paiement' => NULL,
                'statut' => 'payé',
                'montant' => 25.0,
                'frais' => NULL,
                'message' => 'message experience 1',
                'id_cagnotte' => 1,
                'id_contact' => 307,
            ),
            1 => 
            array (
                'id_contributions' => 2,
                'date_contribution' => '2023-10-01 10:27:36',
                'mode_paiement' => 'En ligne',
                'statut' => 'Accepté',
                'montant' => 125.0,
                'frais' => NULL,
                'message' => NULL,
                'id_cagnotte' => 3,
                'id_contact' => 307,
            ),
            2 => 
            array (
                'id_contributions' => 3,
                'date_contribution' => '2023-06-18 10:24:00',
                'mode_paiement' => NULL,
                'statut' => 'payé',
                'montant' => 30.0,
                'frais' => NULL,
                'message' => 'message contribution 2',
                'id_cagnotte' => 2,
                'id_contact' => 305,
            ),
        ));
        
        
    }
}