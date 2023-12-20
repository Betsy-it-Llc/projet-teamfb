<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StatutsCagnottesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::connection('mysql2')->table('statuts_cagnottes')->delete();
        
        \DB::connection('mysql2')->table('statuts_cagnottes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'valeur' => 'ouvert',
            ),
            1 => 
            array (
                'id' => 2,
                'valeur' => 'fermé',
            ),
            2 => 
            array (
                'id' => 3,
                'valeur' => 'ouvert',
            ),
            3 => 
            array (
                'id' => 4,
                'valeur' => 'fermé',
            ),
        ));
        
        
    }
}