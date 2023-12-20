<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RemiseEntrepriseTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('remise_entreprise')->delete();
        
        \DB::table('remise_entreprise')->insert(array (
            0 => 
            array (
                'id_remise' => 1,
                'id_organisation' => 1,
            ),
            1 => 
            array (
                'id_remise' => 2,
                'id_organisation' => 1,
            ),
        ));
        
        
    }
}