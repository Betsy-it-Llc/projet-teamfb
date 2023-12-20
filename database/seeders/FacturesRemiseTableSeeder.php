<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FacturesRemiseTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::connection('mysql2')->table('factures_remise')->delete();
        
        \DB::connection('mysql2')->table('factures_remise')->insert(array (
            0 => 
            array (
                'num_facture' => 362,
                'id_remise' => 1,
                'taux' => NULL,
                'montant' => NULL,
            ),
            1 => 
            array (
                'num_facture' => 392,
                'id_remise' => 2,
                'taux' => NULL,
                'montant' => NULL,
            ),
            2 => 
            array (
                'num_facture' => 393,
                'id_remise' => 2,
                'taux' => NULL,
                'montant' => NULL,
            ),
            3 => 
            array (
                'num_facture' => 394,
                'id_remise' => 2,
                'taux' => NULL,
                'montant' => NULL,
            ),
            4 => 
            array (
                'num_facture' => 395,
                'id_remise' => 2,
                'taux' => NULL,
                'montant' => NULL,
            ),
            5 => 
            array (
                'num_facture' => 396,
                'id_remise' => 2,
                'taux' => NULL,
                'montant' => NULL,
            ),
        ));
        
        
    }
}