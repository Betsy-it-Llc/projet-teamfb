<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PrestationIntervantExperienceTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::connection('mysql2')->table('prestation_intervant_experience')->delete();
        
        
        
    }
}