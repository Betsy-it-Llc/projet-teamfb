<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UtilisateurGroupeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('utilisateur_groupe')->delete();
        
        
        
    }
}