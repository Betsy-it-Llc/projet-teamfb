<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ContactCagnotteTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::connection('mysql2')->table('contact_cagnotte')->delete();
        
        
        
    }
}