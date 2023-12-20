<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ContactEntrepriseTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('contact_entreprise')->delete();
        
        \DB::table('contact_entreprise')->insert(array (
            0 => 
            array (
                'id_contact' => 156,
                'type' => NULL,
                'id_organisation' => 1,
            ),
        ));
        
        
    }
}