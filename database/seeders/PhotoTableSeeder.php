<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PhotoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::connection('mysql2')->table('photo')->delete();
        
        
        
    }
}