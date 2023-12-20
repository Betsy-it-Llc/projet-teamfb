<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ExperienceStatutTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('experience_statut')->delete();
        
        \DB::table('experience_statut')->insert(array (
            0 => 
            array (
                'id_statut_experience' => 1,
                'statut_experience' => 'Payé',
            ),
            1 => 
            array (
                'id_statut_experience' => 2,
                'statut_experience' => 'Enregistré',
            ),
            2 => 
            array (
                'id_statut_experience' => 3,
                'statut_experience' => 'Speech',
            ),
            3 => 
            array (
                'id_statut_experience' => 4,
                'statut_experience' => 'Pré experience',
            ),
            4 => 
            array (
                'id_statut_experience' => 5,
                'statut_experience' => 'Record date',
            ),
            5 => 
            array (
                'id_statut_experience' => 6,
                'statut_experience' => 'Livraison',
            ),
            6 => 
            array (
                'id_statut_experience' => 7,
                'statut_experience' => 'Succes',
            ),
        ));
        
        
    }
}