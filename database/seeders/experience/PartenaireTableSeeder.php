<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PartenaireTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('partenaire')->delete();
        
        \DB::table('partenaire')->insert(array (
            0 => 
            array (
                'id_partenaire' => 1,
                'fonction' => NULL,
                'type' => 'ceo',
                'description' => NULL,
                'date_creation' => '2023-08-28 22:38:57',
                'date_update' => '2023-08-30',
                'id_contact' => 55,
            ),
            1 => 
            array (
                'id_partenaire' => 2,
                'fonction' => NULL,
                'type' => NULL,
                'description' => NULL,
                'date_creation' => '2023-09-07 22:25:40',
                'date_update' => '2023-09-07',
                'id_contact' => 78,
            ),
        ));
        
        
    }
}