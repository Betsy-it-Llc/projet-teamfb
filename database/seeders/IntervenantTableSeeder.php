<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class IntervenantTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::connection('mysql2')->table('intervenant')->delete();
        
        \DB::connection('mysql2')->table('intervenant')->insert(array (
            0 => 
            array (
                'id_intervenant_' => 2,
                'ville_intervention' => NULL,
                'role_' => 'Ingé Studio',
                'description' => 'Flo 1G Nekopolise !! Attenteion fiche test contact non valide',
                'date_creation' => NULL,
                'date_update' => NULL,
                'id_contact' => 147,
            ),
            1 => 
            array (
                'id_intervenant_' => 3,
                'ville_intervention' => NULL,
                'role_' => NULL,
                'description' => NULL,
                'date_creation' => '2023-09-07 22:26:04',
                'date_update' => '2023-09-07 22:26:04',
                'id_contact' => 105,
            ),
        ));
        
        
    }
}