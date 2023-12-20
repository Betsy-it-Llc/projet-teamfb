<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class HistoriquesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('historiques')->delete();
        
        
        
    }
}