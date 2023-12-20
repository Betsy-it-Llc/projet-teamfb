<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrganisationCagnotteTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::connection('mysql2')->table('organisation_cagnotte')->delete();
        
        
        
    }
}