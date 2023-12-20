<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ContactProjetsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::connection('mysql2')->table('contact_projets')->delete();
        
        \DB::connection('mysql2')->table('contact_projets')->insert(array (
            0 => 
            array (
                'id_contact' => 139,
                'id_projet' => 1,
            ),
            1 => 
            array (
                'id_contact' => 139,
                'id_projet' => 2,
            ),
            2 => 
            array (
                'id_contact' => 200,
                'id_projet' => 5,
            ),
            3 => 
            array (
                'id_contact' => 295,
                'id_projet' => 5,
            ),
            4 => 
            array (
                'id_contact' => 305,
                'id_projet' => 3,
            ),
            5 => 
            array (
                'id_contact' => 308,
                'id_projet' => 4,
            ),
            6 => 
            array (
                'id_contact' => 309,
                'id_projet' => 6,
            ),
            7 => 
            array (
                'id_contact' => 309,
                'id_projet' => 7,
            ),
        ));
        
        
    }
}