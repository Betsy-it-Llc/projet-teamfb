<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RechercheCampagneTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('recherche_campagne')->delete();
        
        \DB::table('recherche_campagne')->insert(array (
            0 => 
            array (
                'id_recherche_campagne' => 1,
                'id_campagne' => 18,
                'statut_recherche' => 'terminé',
                'date_recherche' => '2021-10-17 11:35:59',
            ),
            1 => 
            array (
                'id_recherche_campagne' => 2,
                'id_campagne' => 20,
                'statut_recherche' => 'terminé',
                'date_recherche' => '2021-10-17 09:01:07',
            ),
            2 => 
            array (
                'id_recherche_campagne' => 3,
                'id_campagne' => 20,
                'statut_recherche' => 'terminé',
                'date_recherche' => '2021-10-17 09:14:05',
            ),
            3 => 
            array (
                'id_recherche_campagne' => 4,
                'id_campagne' => 18,
                'statut_recherche' => 'terminé',
                'date_recherche' => '2021-10-23 20:32:07',
            ),
            4 => 
            array (
                'id_recherche_campagne' => 5,
                'id_campagne' => 18,
                'statut_recherche' => 'terminé',
                'date_recherche' => '2021-10-23 20:33:47',
            ),
            5 => 
            array (
                'id_recherche_campagne' => 6,
                'id_campagne' => 18,
                'statut_recherche' => 'terminé',
                'date_recherche' => '2021-10-23 20:41:00',
            ),
        ));
        
        
    }
}