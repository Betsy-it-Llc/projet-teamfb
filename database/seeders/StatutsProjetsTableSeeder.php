<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StatutsProjetsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::connection('mysql2')->table('statuts_projets')->delete();
        
        \DB::connection('mysql2')->table('statuts_projets')->insert(array (
            0 => 
            array (
                'id' => 1,
                'valeur' => 'créé',
            ),
            1 => 
            array (
                'id' => 2,
                'valeur' => 'en cours',
            ),
            2 => 
            array (
                'id' => 3,
                'valeur' => 'terminé',
            ),
        ));
        
        
    }
}