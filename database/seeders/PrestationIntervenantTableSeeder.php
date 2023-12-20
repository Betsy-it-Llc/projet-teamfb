<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PrestationIntervenantTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::connection('mysql2')->table('prestation_intervenant')->delete();
        
        
        
    }
}