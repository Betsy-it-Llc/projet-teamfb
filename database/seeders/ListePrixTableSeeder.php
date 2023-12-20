<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ListePrixTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::connection('mysql2')->table('liste_prix')->delete();
        
        \DB::connection('mysql2')->table('liste_prix')->insert(array (
            0 => 
            array (
                'id_liste_prix' => 1,
                'prix' => '85.00',
                'statut' => 'Par defaut',
                'date_creation' => '2019-04-23 10:10:00',
                'id_pack' => 12,
                'id_produit' => NULL,
            ),
            1 => 
            array (
                'id_liste_prix' => 2,
                'prix' => '5.00',
                'statut' => 'Inactif',
                'date_creation' => '2020-05-08 00:00:00',
                'id_pack' => NULL,
                'id_produit' => 20,
            ),
            2 => 
            array (
                'id_liste_prix' => 3,
                'prix' => '5.00',
                'statut' => 'Inactif',
                'date_creation' => '2020-05-08 00:00:00',
                'id_pack' => NULL,
                'id_produit' => 21,
            ),
            3 => 
            array (
                'id_liste_prix' => 4,
                'prix' => '85.00',
                'statut' => 'Par defaut',
                'date_creation' => '2020-09-08 16:58:00',
                'id_pack' => 11,
                'id_produit' => NULL,
            ),
            4 => 
            array (
                'id_liste_prix' => 5,
                'prix' => '125.00',
                'statut' => 'Par defaut',
                'date_creation' => '2020-12-05 00:00:00',
                'id_pack' => 13,
                'id_produit' => NULL,
            ),
            5 => 
            array (
                'id_liste_prix' => 6,
                'prix' => '40.00',
                'statut' => 'Par defaut',
                'date_creation' => '2021-01-27 00:00:00',
                'id_pack' => NULL,
                'id_produit' => 14,
            ),
            6 => 
            array (
                'id_liste_prix' => 7,
                'prix' => '85.00',
                'statut' => 'Par defaut',
                'date_creation' => '2021-06-04 00:00:00',
                'id_pack' => 1,
                'id_produit' => NULL,
            ),
            7 => 
            array (
                'id_liste_prix' => 8,
                'prix' => '45.00',
                'statut' => 'Actif',
                'date_creation' => '2021-06-05 00:00:00',
                'id_pack' => NULL,
                'id_produit' => 5,
            ),
            8 => 
            array (
                'id_liste_prix' => 9,
                'prix' => '125.00',
                'statut' => 'Par defaut',
                'date_creation' => '2021-06-05 00:00:00',
                'id_pack' => 6,
                'id_produit' => NULL,
            ),
            9 => 
            array (
                'id_liste_prix' => 10,
                'prix' => '300.00',
                'statut' => 'Actif',
                'date_creation' => '2022-01-13 00:00:00',
                'id_pack' => NULL,
                'id_produit' => 13,
            ),
            10 => 
            array (
                'id_liste_prix' => 11,
                'prix' => '85.00',
                'statut' => 'Actif',
                'date_creation' => '2022-02-01 00:00:00',
                'id_pack' => NULL,
                'id_produit' => 12,
            ),
            11 => 
            array (
                'id_liste_prix' => 12,
                'prix' => '385.00',
                'statut' => 'Par defaut',
                'date_creation' => '2022-02-02 00:00:00',
                'id_pack' => 3,
                'id_produit' => NULL,
            ),
            12 => 
            array (
                'id_liste_prix' => 13,
                'prix' => '125.00',
                'statut' => 'Par defaut',
                'date_creation' => '2022-05-10 00:00:00',
                'id_pack' => 9,
                'id_produit' => NULL,
            ),
            13 => 
            array (
                'id_liste_prix' => 14,
                'prix' => '150.00',
                'statut' => 'Par defaut',
                'date_creation' => '2022-05-10 00:00:00',
                'id_pack' => 10,
                'id_produit' => NULL,
            ),
            14 => 
            array (
                'id_liste_prix' => 15,
                'prix' => '40.00',
                'statut' => 'Actif',
                'date_creation' => '2022-05-21 10:57:19',
                'id_pack' => NULL,
                'id_produit' => 6,
            ),
            15 => 
            array (
                'id_liste_prix' => 16,
                'prix' => '85.00',
                'statut' => 'Par defaut',
                'date_creation' => '2022-06-02 15:22:23',
                'id_pack' => NULL,
                'id_produit' => 4,
            ),
            16 => 
            array (
                'id_liste_prix' => 17,
                'prix' => '70.00',
                'statut' => 'Par defaut',
                'date_creation' => '2022-06-02 15:23:21',
                'id_pack' => NULL,
                'id_produit' => 1,
            ),
            17 => 
            array (
                'id_liste_prix' => 18,
                'prix' => '35.00',
                'statut' => 'Par defaut',
                'date_creation' => '2022-08-18 14:44:30',
                'id_pack' => NULL,
                'id_produit' => 2,
            ),
            18 => 
            array (
                'id_liste_prix' => 19,
                'prix' => '30.00',
                'statut' => 'Actif',
                'date_creation' => '2022-08-18 14:44:30',
                'id_pack' => NULL,
                'id_produit' => 11,
            ),
            19 => 
            array (
                'id_liste_prix' => 20,
                'prix' => '35.00',
                'statut' => 'Par defaut',
                'date_creation' => '2022-09-10 11:25:01',
                'id_pack' => NULL,
                'id_produit' => 10,
            ),
            20 => 
            array (
                'id_liste_prix' => 21,
                'prix' => '60.00',
                'statut' => 'Par defaut',
                'date_creation' => '2022-10-08 00:14:15',
                'id_pack' => 8,
                'id_produit' => NULL,
            ),
            21 => 
            array (
                'id_liste_prix' => 22,
                'prix' => '100.00',
                'statut' => 'Par defaut',
                'date_creation' => '2022-11-20 01:37:02',
                'id_pack' => 7,
                'id_produit' => NULL,
            ),
            22 => 
            array (
                'id_liste_prix' => 23,
                'prix' => '0.00',
                'statut' => 'Par defaut',
                'date_creation' => '2022-12-21 10:48:31',
                'id_pack' => NULL,
                'id_produit' => 3,
            ),
            23 => 
            array (
                'id_liste_prix' => 24,
                'prix' => '1.00',
                'statut' => 'Inactif',
                'date_creation' => '2022-12-26 18:35:00',
                'id_pack' => NULL,
                'id_produit' => 18,
            ),
            24 => 
            array (
                'id_liste_prix' => 25,
                'prix' => '35.00',
                'statut' => 'Actif',
                'date_creation' => '2023-03-21 19:39:11',
                'id_pack' => NULL,
                'id_produit' => 5,
            ),
            25 => 
            array (
                'id_liste_prix' => 26,
                'prix' => '125.00',
                'statut' => 'Par defaut',
                'date_creation' => '2023-04-17 11:38:52',
                'id_pack' => 2,
                'id_produit' => NULL,
            ),
            26 => 
            array (
                'id_liste_prix' => 27,
                'prix' => '85.00',
                'statut' => 'Par defaut',
                'date_creation' => '2023-05-05 20:35:07',
                'id_pack' => 4,
                'id_produit' => NULL,
            ),
            27 => 
            array (
                'id_liste_prix' => 28,
                'prix' => '385.00',
                'statut' => 'Par defaut',
                'date_creation' => '2023-05-05 20:53:55',
                'id_pack' => 5,
                'id_produit' => NULL,
            ),
            28 => 
            array (
                'id_liste_prix' => 29,
                'prix' => '35.00',
                'statut' => 'Par defaut',
                'date_creation' => '2023-05-05 21:01:14',
                'id_pack' => NULL,
                'id_produit' => 11,
            ),
            29 => 
            array (
                'id_liste_prix' => 30,
                'prix' => '40.00',
                'statut' => 'Par defaut',
                'date_creation' => '2023-05-12 21:49:44',
                'id_pack' => NULL,
                'id_produit' => 5,
            ),
            30 => 
            array (
                'id_liste_prix' => 31,
                'prix' => '60.00',
                'statut' => 'Inactif',
                'date_creation' => '2023-05-25 19:02:00',
                'id_pack' => NULL,
                'id_produit' => 19,
            ),
            31 => 
            array (
                'id_liste_prix' => 32,
                'prix' => '60.00',
                'statut' => 'Actif',
                'date_creation' => '2023-06-29 10:59:24',
                'id_pack' => NULL,
                'id_produit' => 16,
            ),
            32 => 
            array (
                'id_liste_prix' => 33,
                'prix' => '120.00',
                'statut' => 'Actif',
                'date_creation' => '2023-06-29 16:47:47',
                'id_pack' => NULL,
                'id_produit' => 17,
            ),
            33 => 
            array (
                'id_liste_prix' => 34,
                'prix' => '150.00',
                'statut' => 'Inactif',
                'date_creation' => '2020-05-08 00:00:00',
                'id_pack' => NULL,
                'id_produit' => 22,
            ),
            34 => 
            array (
                'id_liste_prix' => 35,
                'prix' => '200.00',
                'statut' => 'Inactif',
                'date_creation' => '2020-05-08 00:00:00',
                'id_pack' => NULL,
                'id_produit' => 23,
            ),
            35 => 
            array (
                'id_liste_prix' => 36,
                'prix' => '45.00',
                'statut' => 'Inactif',
                'date_creation' => '2020-05-08 00:00:00',
                'id_pack' => NULL,
                'id_produit' => 24,
            ),
            36 => 
            array (
                'id_liste_prix' => 37,
                'prix' => '30.00',
                'statut' => 'Actif',
                'date_creation' => '2022-08-18 14:44:30',
                'id_pack' => NULL,
                'id_produit' => 11,
            ),
            37 => 
            array (
                'id_liste_prix' => 38,
                'prix' => '75.00',
                'statut' => 'Inactif',
                'date_creation' => '2021-08-29 00:00:00',
                'id_pack' => NULL,
                'id_produit' => 25,
            ),
            38 => 
            array (
                'id_liste_prix' => 39,
                'prix' => '220.00',
                'statut' => 'Inactif',
                'date_creation' => '2020-07-21 00:00:00',
                'id_pack' => NULL,
                'id_produit' => 26,
            ),
            39 => 
            array (
                'id_liste_prix' => 40,
                'prix' => '45.00',
                'statut' => 'Inactif',
                'date_creation' => '2020-05-08 00:00:00',
                'id_pack' => NULL,
                'id_produit' => 27,
            ),
            40 => 
            array (
                'id_liste_prix' => 41,
                'prix' => '20.00',
                'statut' => 'Inactif',
                'date_creation' => '2020-05-08 00:00:00',
                'id_pack' => NULL,
                'id_produit' => 28,
            ),
            41 => 
            array (
                'id_liste_prix' => 42,
                'prix' => '6.00',
                'statut' => 'Inactif',
                'date_creation' => '2020-05-08 00:00:00',
                'id_pack' => NULL,
                'id_produit' => 29,
            ),
            42 => 
            array (
                'id_liste_prix' => 43,
                'prix' => '60.00',
                'statut' => 'Par defaut',
                'date_creation' => '2023-05-25 19:45:00',
                'id_pack' => NULL,
                'id_produit' => 30,
            ),
            43 => 
            array (
                'id_liste_prix' => 44,
                'prix' => '40.00',
                'statut' => 'Inactif',
                'date_creation' => '2022-01-29 00:00:00',
                'id_pack' => NULL,
                'id_produit' => 31,
            ),
            44 => 
            array (
                'id_liste_prix' => 45,
                'prix' => '85.00',
                'statut' => 'Inactif',
                'date_creation' => '2022-02-01 00:00:00',
                'id_pack' => NULL,
                'id_produit' => 32,
            ),
            45 => 
            array (
                'id_liste_prix' => 46,
                'prix' => '85.00',
                'statut' => 'Inactif',
                'date_creation' => '2022-02-01 00:00:00',
                'id_pack' => NULL,
                'id_produit' => 33,
            ),
            46 => 
            array (
                'id_liste_prix' => 47,
                'prix' => '415.00',
                'statut' => 'Inactif',
                'date_creation' => '2020-03-12 00:00:00',
                'id_pack' => 14,
                'id_produit' => NULL,
            ),
            47 => 
            array (
                'id_liste_prix' => 48,
                'prix' => '85.00',
                'statut' => 'Inactif',
                'date_creation' => '2020-05-08 00:00:00',
                'id_pack' => 6,
                'id_produit' => NULL,
            ),
            48 => 
            array (
                'id_liste_prix' => 49,
                'prix' => '100.00',
                'statut' => 'Par Défaut',
                'date_creation' => '2023-08-22 12:55:05',
                'id_pack' => 15,
                'id_produit' => NULL,
            ),
            49 => 
            array (
                'id_liste_prix' => 50,
                'prix' => '875.00',
                'statut' => 'Par Défaut',
                'date_creation' => '2023-08-24 17:46:19',
                'id_pack' => 16,
                'id_produit' => NULL,
            ),
            50 => 
            array (
                'id_liste_prix' => 51,
                'prix' => '625.00',
                'statut' => 'Par Défaut',
                'date_creation' => '2023-08-24 17:47:42',
                'id_pack' => 17,
                'id_produit' => NULL,
            ),
            51 => 
            array (
                'id_liste_prix' => 52,
                'prix' => '375.00',
                'statut' => 'Par Défaut',
                'date_creation' => '2023-08-24 17:48:41',
                'id_pack' => 18,
                'id_produit' => NULL,
            ),
            52 => 
            array (
                'id_liste_prix' => 53,
                'prix' => '40.00',
                'statut' => 'Par défaut',
                'date_creation' => '2021-06-05 00:00:00',
                'id_pack' => NULL,
                'id_produit' => 5,
            ),
            53 => 
            array (
                'id_liste_prix' => 54,
                'prix' => '35.00',
                'statut' => 'Par défaut',
                'date_creation' => '2022-05-21 10:54:19',
                'id_pack' => NULL,
                'id_produit' => 10,
            ),
            54 => 
            array (
                'id_liste_prix' => 55,
                'prix' => '35.00',
                'statut' => 'Par défaut',
                'date_creation' => '2022-05-21 10:59:19',
                'id_pack' => NULL,
                'id_produit' => 11,
            ),
        ));
        
        
    }
}