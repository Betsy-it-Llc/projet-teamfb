<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PacksRemiseTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('packs_remise')->delete();
        
        
        
    }
}