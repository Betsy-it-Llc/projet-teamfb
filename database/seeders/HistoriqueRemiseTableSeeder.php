<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class HistoriqueRemiseTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::connection('mysql2')->table('historique_remise')->delete();
        
        \DB::connection('mysql2')->table('historique_remise')->insert(array (
            0 => 
            array (
                'id_historique_remise' => 1,
                'date_creation' => '2023-08-07 14:40:45',
                'montant' => NULL,
                'taux' => '6.00',
                'id_remise' => 1,
            ),
            1 => 
            array (
                'id_historique_remise' => 2,
                'date_creation' => '2023-08-07 14:41:37',
                'montant' => NULL,
                'taux' => '10.00',
                'id_remise' => 1,
            ),
            2 => 
            array (
                'id_historique_remise' => 3,
                'date_creation' => '2023-08-30 12:05:11',
                'montant' => NULL,
                'taux' => '100.00',
                'id_remise' => 2,
            ),
            3 => 
            array (
                'id_historique_remise' => 4,
                'date_creation' => '2023-09-07 22:15:26',
                'montant' => NULL,
                'taux' => '100.00',
                'id_remise' => 2,
            ),
            4 => 
            array (
                'id_historique_remise' => 5,
                'date_creation' => '2023-08-07 14:40:45',
                'montant' => NULL,
                'taux' => '6.00',
                'id_remise' => 1,
            ),
            5 => 
            array (
                'id_historique_remise' => 6,
                'date_creation' => '2023-08-30 12:05:11',
                'montant' => NULL,
                'taux' => '100.00',
                'id_remise' => 2,
            ),
            6 => 
            array (
                'id_historique_remise' => 7,
                'date_creation' => '2023-08-07 14:40:45',
                'montant' => NULL,
                'taux' => '6.00',
                'id_remise' => 1,
            ),
            7 => 
            array (
                'id_historique_remise' => 8,
                'date_creation' => '2023-08-30 12:05:11',
                'montant' => NULL,
                'taux' => '100.00',
                'id_remise' => 2,
            ),
            8 => 
            array (
                'id_historique_remise' => 9,
                'date_creation' => '2023-08-07 14:40:45',
                'montant' => NULL,
                'taux' => '6.00',
                'id_remise' => 1,
            ),
            9 => 
            array (
                'id_historique_remise' => 10,
                'date_creation' => '2023-08-30 12:05:11',
                'montant' => NULL,
                'taux' => '100.00',
                'id_remise' => 2,
            ),
        ));
        
        
    }
}