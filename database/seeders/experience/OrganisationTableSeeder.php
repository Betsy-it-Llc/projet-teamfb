<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrganisationTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('organisation')->delete();
        
        \DB::table('organisation')->insert(array (
            0 => 
            array (
                'id_organisation' => 1,
                'nom' => 'Orange test',
                'tel' => '0600000000',
                'email' => 'orangetest@testorage.Fr',
                'adresse' => NULL,
                'code_postal' => NULL,
                'ville' => NULL,
                'nb_salarie' => NULL,
                'num_cse' => '0000000000',
                'description' => 'test remplissage automatique',
                'date_creation' => '2023-09-15 18:40:41',
                'date_update' => NULL,
            ),
        ));
        
        
    }
}