<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ReleveCampagneTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('releve_campagne')->delete();
        
        \DB::table('releve_campagne')->insert(array (
            0 => 
            array (
                'id_releve_campagne' => 1,
                'id_campagne' => 15,
                'statut_releve' => 'terminé',
                'date_releve' => '2021-08-12 16:08:00',
            ),
            1 => 
            array (
                'id_releve_campagne' => 2,
                'id_campagne' => 16,
                'statut_releve' => 'terminé',
                'date_releve' => '2021-09-03 19:07:34',
            ),
            2 => 
            array (
                'id_releve_campagne' => 3,
                'id_campagne' => 16,
                'statut_releve' => 'terminé',
                'date_releve' => '2021-09-05 20:06:06',
            ),
            3 => 
            array (
                'id_releve_campagne' => 4,
                'id_campagne' => 16,
                'statut_releve' => 'terminé',
                'date_releve' => '2021-09-10 12:33:30',
            ),
            4 => 
            array (
                'id_releve_campagne' => 5,
                'id_campagne' => 0,
                'statut_releve' => 'terminé',
                'date_releve' => '2021-09-10 12:39:03',
            ),
            5 => 
            array (
                'id_releve_campagne' => 6,
                'id_campagne' => 18,
                'statut_releve' => 'terminé',
                'date_releve' => '2021-09-14 09:09:44',
            ),
            6 => 
            array (
                'id_releve_campagne' => 7,
                'id_campagne' => 18,
                'statut_releve' => 'terminé',
                'date_releve' => '2021-09-14 15:00:15',
            ),
            7 => 
            array (
                'id_releve_campagne' => 8,
                'id_campagne' => 17,
                'statut_releve' => 'terminé',
                'date_releve' => '2021-09-14 15:39:10',
            ),
            8 => 
            array (
                'id_releve_campagne' => 9,
                'id_campagne' => 1,
                'statut_releve' => 'terminé',
                'date_releve' => '2021-09-14 17:47:23',
            ),
            9 => 
            array (
                'id_releve_campagne' => 10,
                'id_campagne' => 1,
                'statut_releve' => 'terminé',
                'date_releve' => '2021-09-14 18:53:19',
            ),
            10 => 
            array (
                'id_releve_campagne' => 11,
                'id_campagne' => 19,
                'statut_releve' => 'terminé',
                'date_releve' => '2021-10-05 17:16:11',
            ),
            11 => 
            array (
                'id_releve_campagne' => 12,
                'id_campagne' => 15,
                'statut_releve' => 'non terminé',
                'date_releve' => NULL,
            ),
            12 => 
            array (
                'id_releve_campagne' => 13,
                'id_campagne' => 19,
                'statut_releve' => 'terminé',
                'date_releve' => '2021-10-07 11:58:06',
            ),
            13 => 
            array (
                'id_releve_campagne' => 14,
                'id_campagne' => 19,
                'statut_releve' => 'terminé',
                'date_releve' => '2021-10-07 12:02:27',
            ),
            14 => 
            array (
                'id_releve_campagne' => 15,
                'id_campagne' => 14,
                'statut_releve' => 'terminé',
                'date_releve' => '2021-10-07 12:09:27',
            ),
            15 => 
            array (
                'id_releve_campagne' => 16,
                'id_campagne' => 4,
                'statut_releve' => 'terminé',
                'date_releve' => '2021-10-07 12:20:08',
            ),
            16 => 
            array (
                'id_releve_campagne' => 17,
                'id_campagne' => 18,
                'statut_releve' => 'terminé',
                'date_releve' => '2021-10-07 17:31:02',
            ),
            17 => 
            array (
                'id_releve_campagne' => 18,
                'id_campagne' => 17,
                'statut_releve' => 'terminé',
                'date_releve' => '2021-10-07 17:44:10',
            ),
            18 => 
            array (
                'id_releve_campagne' => 19,
                'id_campagne' => 4,
                'statut_releve' => 'terminé',
                'date_releve' => '2021-10-07 17:46:50',
            ),
            19 => 
            array (
                'id_releve_campagne' => 20,
                'id_campagne' => 20,
                'statut_releve' => 'terminé',
                'date_releve' => '2021-10-11 14:52:05',
            ),
            20 => 
            array (
                'id_releve_campagne' => 21,
                'id_campagne' => 18,
                'statut_releve' => 'terminé',
                'date_releve' => '2021-10-17 14:42:12',
            ),
            21 => 
            array (
                'id_releve_campagne' => 22,
                'id_campagne' => 82,
                'statut_releve' => 'non terminé',
                'date_releve' => NULL,
            ),
            22 => 
            array (
                'id_releve_campagne' => 23,
                'id_campagne' => 80,
                'statut_releve' => 'non terminé',
                'date_releve' => NULL,
            ),
            23 => 
            array (
                'id_releve_campagne' => 24,
                'id_campagne' => 21,
                'statut_releve' => 'non terminé',
                'date_releve' => NULL,
            ),
            24 => 
            array (
                'id_releve_campagne' => 25,
                'id_campagne' => 22,
                'statut_releve' => 'non terminé',
                'date_releve' => NULL,
            ),
            25 => 
            array (
                'id_releve_campagne' => 26,
                'id_campagne' => 71,
                'statut_releve' => 'non terminé',
                'date_releve' => NULL,
            ),
            26 => 
            array (
                'id_releve_campagne' => 27,
                'id_campagne' => 26,
                'statut_releve' => 'non terminé',
                'date_releve' => NULL,
            ),
            27 => 
            array (
                'id_releve_campagne' => 28,
                'id_campagne' => 13,
                'statut_releve' => 'non terminé',
                'date_releve' => NULL,
            ),
            28 => 
            array (
                'id_releve_campagne' => 29,
                'id_campagne' => 58,
                'statut_releve' => 'non terminé',
                'date_releve' => NULL,
            ),
            29 => 
            array (
                'id_releve_campagne' => 30,
                'id_campagne' => 61,
                'statut_releve' => 'non terminé',
                'date_releve' => NULL,
            ),
            30 => 
            array (
                'id_releve_campagne' => 31,
                'id_campagne' => 2,
                'statut_releve' => 'non terminé',
                'date_releve' => NULL,
            ),
        ));
        
        
    }
}