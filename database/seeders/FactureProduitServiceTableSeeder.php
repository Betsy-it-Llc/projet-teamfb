<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FactureProduitServiceTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::connection('mysql2')->table('facture_produit_service')->delete();
        
        \DB::connection('mysql2')->table('facture_produit_service')->insert(array (
            0 => 
            array (
                'num_facture' => 87,
                'id_produit' => 3,
                'id_liste_prix' => 23,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => 75,
            ),
            1 => 
            array (
                'num_facture' => 96,
                'id_produit' => 3,
                'id_liste_prix' => 23,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => NULL,
            ),
            2 => 
            array (
                'num_facture' => 97,
                'id_produit' => 3,
                'id_liste_prix' => 23,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => NULL,
            ),
            3 => 
            array (
                'num_facture' => 138,
                'id_produit' => 3,
                'id_liste_prix' => 23,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => NULL,
            ),
            4 => 
            array (
                'num_facture' => 142,
                'id_produit' => 3,
                'id_liste_prix' => 23,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => NULL,
            ),
            5 => 
            array (
                'num_facture' => 146,
                'id_produit' => 3,
                'id_liste_prix' => 23,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => NULL,
            ),
            6 => 
            array (
                'num_facture' => 149,
                'id_produit' => 3,
                'id_liste_prix' => 23,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => NULL,
            ),
            7 => 
            array (
                'num_facture' => 153,
                'id_produit' => 17,
                'id_liste_prix' => 33,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => 91,
            ),
            8 => 
            array (
                'num_facture' => 154,
                'id_produit' => 3,
                'id_liste_prix' => 23,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => NULL,
            ),
            9 => 
            array (
                'num_facture' => 200,
                'id_produit' => 21,
                'id_liste_prix' => 3,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => NULL,
            ),
            10 => 
            array (
                'num_facture' => 201,
                'id_produit' => 20,
                'id_liste_prix' => 2,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => NULL,
            ),
            11 => 
            array (
                'num_facture' => 204,
                'id_produit' => 22,
                'id_liste_prix' => 34,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => 202,
            ),
            12 => 
            array (
                'num_facture' => 208,
                'id_produit' => 24,
                'id_liste_prix' => 36,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => 206,
            ),
            13 => 
            array (
                'num_facture' => 210,
                'id_produit' => 27,
                'id_liste_prix' => 40,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => 208,
            ),
            14 => 
            array (
                'num_facture' => 210,
                'id_produit' => 28,
                'id_liste_prix' => 41,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => 208,
            ),
            15 => 
            array (
                'num_facture' => 210,
                'id_produit' => 29,
                'id_liste_prix' => 42,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => 208,
            ),
            16 => 
            array (
                'num_facture' => 212,
                'id_produit' => 13,
                'id_liste_prix' => 10,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => 210,
            ),
            17 => 
            array (
                'num_facture' => 215,
                'id_produit' => 3,
                'id_liste_prix' => 23,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => 213,
            ),
            18 => 
            array (
                'num_facture' => 217,
                'id_produit' => 24,
                'id_liste_prix' => 36,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => 215,
            ),
            19 => 
            array (
                'num_facture' => 218,
                'id_produit' => 3,
                'id_liste_prix' => 23,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => 216,
            ),
            20 => 
            array (
                'num_facture' => 220,
                'id_produit' => 3,
                'id_liste_prix' => 23,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => 218,
            ),
            21 => 
            array (
                'num_facture' => 222,
                'id_produit' => 26,
                'id_liste_prix' => 39,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => 220,
            ),
            22 => 
            array (
                'num_facture' => 223,
                'id_produit' => 3,
                'id_liste_prix' => 23,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => 221,
            ),
            23 => 
            array (
                'num_facture' => 224,
                'id_produit' => 24,
                'id_liste_prix' => 36,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => 222,
            ),
            24 => 
            array (
                'num_facture' => 225,
                'id_produit' => 3,
                'id_liste_prix' => 23,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => 223,
            ),
            25 => 
            array (
                'num_facture' => 226,
                'id_produit' => 3,
                'id_liste_prix' => 23,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => 224,
            ),
            26 => 
            array (
                'num_facture' => 227,
                'id_produit' => 3,
                'id_liste_prix' => 23,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => 225,
            ),
            27 => 
            array (
                'num_facture' => 262,
                'id_produit' => 3,
                'id_liste_prix' => 23,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => 261,
            ),
            28 => 
            array (
                'num_facture' => 262,
                'id_produit' => 25,
                'id_liste_prix' => 38,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => 261,
            ),
            29 => 
            array (
                'num_facture' => 272,
                'id_produit' => 13,
                'id_liste_prix' => 10,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => 271,
            ),
            30 => 
            array (
                'num_facture' => 275,
                'id_produit' => 31,
                'id_liste_prix' => 44,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => 274,
            ),
            31 => 
            array (
                'num_facture' => 276,
                'id_produit' => 32,
                'id_liste_prix' => 45,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => NULL,
            ),
            32 => 
            array (
                'num_facture' => 276,
                'id_produit' => 33,
                'id_liste_prix' => 46,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => NULL,
            ),
            33 => 
            array (
                'num_facture' => 282,
                'id_produit' => 5,
                'id_liste_prix' => 25,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => NULL,
            ),
            34 => 
            array (
                'num_facture' => 285,
                'id_produit' => 5,
                'id_liste_prix' => 25,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => NULL,
            ),
            35 => 
            array (
                'num_facture' => 289,
                'id_produit' => 6,
                'id_liste_prix' => 15,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => 285,
            ),
            36 => 
            array (
                'num_facture' => 294,
                'id_produit' => 1,
                'id_liste_prix' => 17,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => 290,
            ),
            37 => 
            array (
                'num_facture' => 298,
                'id_produit' => 11,
                'id_liste_prix' => 37,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => 294,
            ),
            38 => 
            array (
                'num_facture' => 310,
                'id_produit' => 3,
                'id_liste_prix' => 23,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => 306,
            ),
            39 => 
            array (
                'num_facture' => 320,
                'id_produit' => 18,
                'id_liste_prix' => 24,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => NULL,
            ),
            40 => 
            array (
                'num_facture' => 338,
                'id_produit' => 30,
                'id_liste_prix' => 43,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => NULL,
            ),
            41 => 
            array (
                'num_facture' => 351,
                'id_produit' => 14,
                'id_liste_prix' => 6,
                'id_historique_remise' => NULL,
                'quantity' => 3,
                'id_experience' => NULL,
            ),
            42 => 
            array (
                'num_facture' => 352,
                'id_produit' => 5,
                'id_liste_prix' => 30,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => NULL,
            ),
            43 => 
            array (
                'num_facture' => 352,
                'id_produit' => 10,
                'id_liste_prix' => 20,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => NULL,
            ),
            44 => 
            array (
                'num_facture' => 364,
                'id_produit' => 3,
                'id_liste_prix' => 23,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => NULL,
            ),
            45 => 
            array (
                'num_facture' => 369,
                'id_produit' => 3,
                'id_liste_prix' => 23,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => NULL,
            ),
            46 => 
            array (
                'num_facture' => 370,
                'id_produit' => 3,
                'id_liste_prix' => 23,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => NULL,
            ),
            47 => 
            array (
                'num_facture' => 371,
                'id_produit' => 3,
                'id_liste_prix' => 23,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => NULL,
            ),
            48 => 
            array (
                'num_facture' => 373,
                'id_produit' => 3,
                'id_liste_prix' => 23,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => NULL,
            ),
            49 => 
            array (
                'num_facture' => 375,
                'id_produit' => 3,
                'id_liste_prix' => 23,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => NULL,
            ),
            50 => 
            array (
                'num_facture' => 376,
                'id_produit' => 3,
                'id_liste_prix' => 23,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => NULL,
            ),
            51 => 
            array (
                'num_facture' => 378,
                'id_produit' => 3,
                'id_liste_prix' => 23,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => NULL,
            ),
            52 => 
            array (
                'num_facture' => 381,
                'id_produit' => 3,
                'id_liste_prix' => 23,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => NULL,
            ),
            53 => 
            array (
                'num_facture' => 382,
                'id_produit' => 3,
                'id_liste_prix' => 23,
                'id_historique_remise' => NULL,
                'quantity' => 1,
                'id_experience' => NULL,
            ),
        ));
        
        
    }
}