<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class JeuxConcoursTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('jeux_concours')->delete();
        
        
        
    }
}