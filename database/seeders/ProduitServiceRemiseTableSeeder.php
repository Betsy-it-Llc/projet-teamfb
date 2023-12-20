<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProduitServiceRemiseTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::connection('mysql2')->table('produit_service_remise')->delete();
        
        \DB::connection('mysql2')->table('produit_service_remise')->insert(array (
            0 => 
            array (
                'id_remise' => 1,
                'id_produit' => 1,
                'taux' => NULL,
                'montant' => NULL,
                'id_historique_remise' => 2,
            ),
        ));
        
        
    }
}