<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AutrePrestationExperienceTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('autre_prestation_experience')->delete();

        \DB::table('autre_prestation_experience')->insert(array(
            0 =>
            array(
                'id_produit' => 2,
                'id_pack_experience' => 231,
                'id_liste_prix' => 18,
                'id_historique_remise' => NULL,
            ),
            1 =>
            array(
                'id_produit' => 3,
                'id_pack_experience' => 2,
                'id_liste_prix' => 23,
                'id_historique_remise' => NULL,
            ),
            2 =>
            array(
                'id_produit' => 3,
                'id_pack_experience' => 3,
                'id_liste_prix' => 23,
                'id_historique_remise' => NULL,
            ),
            3 =>
            array(
                'id_produit' => 3,
                'id_pack_experience' => 4,
                'id_liste_prix' => 23,
                'id_historique_remise' => NULL,
            ),
            4 =>
            array(
                'id_produit' => 3,
                'id_pack_experience' => 29,
                'id_liste_prix' => 23,
                'id_historique_remise' => NULL,
            ),
        ));
    }
}
