<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FactureStatutTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::connection('mysql2')->table('facture_statut')->delete();
        
        \DB::connection('mysql2')->table('facture_statut')->insert(array (
            0 => 
            array (
                'id_facture_statut' => 1,
                'statut_facture' => 'Demande resa',
            ),
            1 => 
            array (
                'id_facture_statut' => 2,
                'statut_facture' => 'Créée',
            ),
            2 => 
            array (
                'id_facture_statut' => 3,
                'statut_facture' => 'Non payée',
            ),
            3 => 
            array (
                'id_facture_statut' => 4,
                'statut_facture' => 'En retard +15j',
            ),
            4 => 
            array (
                'id_facture_statut' => 5,
                'statut_facture' => 'Partiellement payé',
            ),
            5 => 
            array (
                'id_facture_statut' => 6,
                'statut_facture' => 'Payée',
            ),
            6 => 
            array (
                'id_facture_statut' => 7,
                'statut_facture' => 'Remboursé',
            ),
            7 => 
            array (
                'id_facture_statut' => 8,
                'statut_facture' => 'Avoir',
            ),
            8 => 
            array (
                'id_facture_statut' => 9,
                'statut_facture' => 'Annulée',
            ),
            9 => 
            array (
                'id_facture_statut' => 10,
                'statut_facture' => 'Validée',
            ),
            10 => 
            array (
                'id_facture_statut' => 11,
                'statut_facture' => 'Brouillon',
            ),
        ));
        
        
    }
}