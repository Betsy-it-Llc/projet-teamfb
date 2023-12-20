<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class HistoriquesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::connection('mysql2')->table('historiques')->delete();
        
        \DB::connection('mysql2')->table('historiques')->insert(array (
            0 => 
            array (
                'id_historique' => 1,
                'action' => 'contribution de 25€',
                'date_creation' => '2023-06-10 10:24:00',
                'id_cagnotte' => 1,
            ),
            1 => 
            array (
                'id_historique' => 2,
                'action' => 'contribution de 30€',
                'date_creation' => '2023-06-18 10:24:00',
                'id_cagnotte' => 2,
            ),
            2 => 
            array (
                'id_historique' => 3,
                'action' => 'Cagnotte a augmenté de valeur',
                'date_creation' => '2023-10-01 10:59:16',
                'id_cagnotte' => 3,
            ),
        ));
        
        
    }
}