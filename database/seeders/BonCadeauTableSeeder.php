<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BonCadeauTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::connection('mysql2')->table('bon_cadeau')->delete();
        
        
        
    }
}