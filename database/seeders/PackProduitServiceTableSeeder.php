<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PackProduitServiceTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::connection('mysql2')->table('pack_produit_service')->delete();
        
        
        
    }
}