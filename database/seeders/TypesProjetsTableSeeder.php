<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TypesProjetsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::connection('mysql2')->table('types_projets')->delete();
        
        \DB::connection('mysql2')->table('types_projets')->insert(array (
            0 => 
            array (
                'id' => 1,
                'valeur' => 'Expérimentateur',
            ),
            1 => 
            array (
                'id' => 2,
                'valeur' => 'Expérience',
            ),
            2 => 
            array (
                'id' => 3,
                'valeur' => 'Cagnotte',
            ),
            3 => 
            array (
                'id' => 4,
                'valeur' => 'Cause',
            ),
            4 => 
            array (
                'id' => 5,
                'valeur' => 'Organisation',
            ),
        ));
        
        
    }
}