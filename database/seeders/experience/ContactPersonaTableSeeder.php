<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ContactPersonaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('contact_persona')->delete();
        
        \DB::table('contact_persona')->insert(array (
            0 => 
            array (
                'id_contact' => 305,
                'id_persona' => 1,
            ),
            1 => 
            array (
                'id_contact' => 305,
                'id_persona' => 2,
            ),
            2 => 
            array (
                'id_contact' => 307,
                'id_persona' => 3,
            ),
        ));
        
        
    }
}