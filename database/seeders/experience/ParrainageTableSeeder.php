<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ParrainageTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('parrainage')->delete();
        
        \DB::table('parrainage')->insert(array (
            0 => 
            array (
                'id_parrainage' => 1,
                'id_code' => 9,
                'statut_parrainage' => NULL,
            ),
        ));
        
        
    }
}