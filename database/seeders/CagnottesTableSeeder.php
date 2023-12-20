<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CagnottesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::connection('mysql2')->table('cagnottes')->delete();
        
        \DB::connection('mysql2')->table('cagnottes')->insert(array (
            0 => 
            array (
                'id_cagnotte' => 1,
                'titre' => 'titre cagnotte eni 230515IMQB',
                'montant_actuel' => 25,
                'id_categorie' => 1,
                'id_projet' => 1,
                'id_statut_cagnotte' => 1,
            ),
            1 => 
            array (
                'id_cagnotte' => 2,
                'titre' => 'titre cagnotte eni 23064UPHE',
                'montant_actuel' => 30,
                'id_categorie' => 1,
                'id_projet' => 2,
                'id_statut_cagnotte' => 1,
            ),
            2 => 
            array (
                'id_cagnotte' => 3,
                'titre' => 'Laurie & Pierrick -Place des Grands Homme',
                'montant_actuel' => 125,
                'id_categorie' => 1,
                'id_projet' => 3,
                'id_statut_cagnotte' => NULL,
            ),
            3 => 
            array (
                'id_cagnotte' => 4,
                'titre' => 'cagnotte Ga',
                'montant_actuel' => 0,
                'id_categorie' => 1,
                'id_projet' => 4,
                'id_statut_cagnotte' => 1,
            ),
            4 => 
            array (
                'id_cagnotte' => 5,
                'titre' => 'cagnotte equipte foot',
                'montant_actuel' => 0,
                'id_categorie' => 5,
                'id_projet' => 5,
                'id_statut_cagnotte' => 1,
            ),
        ));
        
        
    }
}