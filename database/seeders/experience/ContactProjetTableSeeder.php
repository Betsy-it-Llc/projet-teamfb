<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ContactProjetTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('contact_projet')->delete();
        
        
        
    }
}