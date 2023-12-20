<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdministrationTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('administration')->delete();
        
        
        
    }
}