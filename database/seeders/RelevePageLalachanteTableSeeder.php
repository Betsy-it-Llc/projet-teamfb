<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RelevePageLalachanteTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('releve_page_lalachante')->delete();
        
        \DB::table('releve_page_lalachante')->insert(array (
            0 => 
            array (
                'id_releve' => 2,
                'nb_abonnes' => 606,
                'nb_likes' => 510,
                'nb_vues' => 0,
                'date_releve' => '2021-07-10 10:47:35',
                'id_campagne' => NULL,
            ),
            1 => 
            array (
                'id_releve' => 3,
                'nb_abonnes' => 607,
                'nb_likes' => 511,
                'nb_vues' => 0,
                'date_releve' => '2021-07-28 19:01:59',
                'id_campagne' => NULL,
            ),
            2 => 
            array (
                'id_releve' => 4,
                'nb_abonnes' => 607,
                'nb_likes' => 511,
                'nb_vues' => 0,
                'date_releve' => '2021-07-28 19:03:41',
                'id_campagne' => NULL,
            ),
            3 => 
            array (
                'id_releve' => 5,
                'nb_abonnes' => 609,
                'nb_likes' => 512,
                'nb_vues' => 0,
                'date_releve' => '2021-08-04 17:14:42',
                'id_campagne' => NULL,
            ),
            4 => 
            array (
                'id_releve' => 6,
                'nb_abonnes' => 610,
                'nb_likes' => 513,
                'nb_vues' => 0,
                'date_releve' => '2021-08-06 16:40:07',
                'id_campagne' => NULL,
            ),
            5 => 
            array (
                'id_releve' => 7,
                'nb_abonnes' => 619,
                'nb_likes' => 522,
                'nb_vues' => 0,
                'date_releve' => '2021-08-09 09:41:51',
                'id_campagne' => 15,
            ),
            6 => 
            array (
                'id_releve' => 8,
                'nb_abonnes' => 618,
                'nb_likes' => 521,
                'nb_vues' => 0,
                'date_releve' => '2021-08-31 11:16:19',
                'id_campagne' => 16,
            ),
            7 => 
            array (
                'id_releve' => 9,
                'nb_abonnes' => 618,
                'nb_likes' => 521,
                'nb_vues' => 0,
                'date_releve' => '2021-08-31 11:19:47',
                'id_campagne' => 16,
            ),
            8 => 
            array (
                'id_releve' => 10,
                'nb_abonnes' => 618,
                'nb_likes' => 521,
                'nb_vues' => 0,
                'date_releve' => '2021-08-31 15:05:38',
                'id_campagne' => 16,
            ),
            9 => 
            array (
                'id_releve' => 11,
                'nb_abonnes' => 622,
                'nb_likes' => 525,
                'nb_vues' => 0,
                'date_releve' => '2021-09-05 10:24:15',
                'id_campagne' => 16,
            ),
            10 => 
            array (
                'id_releve' => 12,
                'nb_abonnes' => 622,
                'nb_likes' => 525,
                'nb_vues' => 0,
                'date_releve' => '2021-09-05 10:27:00',
                'id_campagne' => 16,
            ),
            11 => 
            array (
                'id_releve' => 13,
                'nb_abonnes' => 623,
                'nb_likes' => 526,
                'nb_vues' => 0,
                'date_releve' => '2021-09-06 17:06:06',
                'id_campagne' => 16,
            ),
            12 => 
            array (
                'id_releve' => 14,
                'nb_abonnes' => 626,
                'nb_likes' => 529,
                'nb_vues' => 0,
                'date_releve' => '2021-09-08 16:35:06',
                'id_campagne' => 0,
            ),
            13 => 
            array (
                'id_releve' => 15,
                'nb_abonnes' => 626,
                'nb_likes' => 529,
                'nb_vues' => 0,
                'date_releve' => '2021-09-08 17:05:57',
                'id_campagne' => 0,
            ),
            14 => 
            array (
                'id_releve' => 16,
                'nb_abonnes' => 635,
                'nb_likes' => 533,
                'nb_vues' => 0,
                'date_releve' => '2021-09-10 15:30:19',
                'id_campagne' => 16,
            ),
            15 => 
            array (
                'id_releve' => 17,
                'nb_abonnes' => 635,
                'nb_likes' => 533,
                'nb_vues' => 0,
                'date_releve' => '2021-09-10 15:32:00',
                'id_campagne' => 17,
            ),
            16 => 
            array (
                'id_releve' => 18,
                'nb_abonnes' => 643,
                'nb_likes' => 538,
                'nb_vues' => 0,
                'date_releve' => '2021-09-17 16:43:11',
                'id_campagne' => 19,
            ),
            17 => 
            array (
                'id_releve' => 19,
                'nb_abonnes' => 648,
                'nb_likes' => 540,
                'nb_vues' => 0,
                'date_releve' => '2021-10-07 12:28:47',
                'id_campagne' => 19,
            ),
            18 => 
            array (
                'id_releve' => 20,
                'nb_abonnes' => 670,
                'nb_likes' => 561,
                'nb_vues' => 0,
                'date_releve' => '2021-10-11 14:34:14',
                'id_campagne' => 20,
            ),
        ));
        
        
    }
}