<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ContentsExperienceTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::connection('mysql2')->table('contents_experience')->delete();
        
        \DB::connection('mysql2')->table('contents_experience')->insert(array (
            0 => 
            array (
                'id_content_experience' => 1,
                'date_heure' => '2023-05-16 23:09:58',
                'date_update' => NULL,
                'description_' => 'Jour du studio',
                'type' => 'storytelling',
                'id_experience' => 83,
            ),
            1 => 
            array (
                'id_content_experience' => 3,
                'date_heure' => '2023-05-17 22:02:06',
                'date_update' => NULL,
                'description_' => NULL,
                'type' => 'storytelling',
                'id_experience' => 83,
            ),
            2 => 
            array (
                'id_content_experience' => 4,
                'date_heure' => '2023-06-01 22:30:03',
                'date_update' => NULL,
                'description_' => NULL,
                'type' => 'storytelling',
                'id_experience' => 90,
            ),
            3 => 
            array (
                'id_content_experience' => 5,
                'date_heure' => '2023-06-05 12:54:51',
                'date_update' => NULL,
                'description_' => NULL,
                'type' => 'storytelling',
                'id_experience' => 92,
            ),
            4 => 
            array (
                'id_content_experience' => 6,
                'date_heure' => '2023-06-06 15:17:29',
                'date_update' => NULL,
                'description_' => 'Pour Expérienc e',
                'type' => 'storytelling',
                'id_experience' => 90,
            ),
            5 => 
            array (
                'id_content_experience' => 7,
                'date_heure' => '2023-06-06 15:21:55',
                'date_update' => NULL,
                'description_' => 'Story histoire',
                'type' => 'storytelling',
                'id_experience' => 90,
            ),
            6 => 
            array (
                'id_content_experience' => 9,
                'date_heure' => '2023-06-09 23:03:50',
                'date_update' => NULL,
                'description_' => 'Pourquoi ?',
                'type' => 'storytelling',
                'id_experience' => 93,
            ),
            7 => 
            array (
                'id_content_experience' => 10,
                'date_heure' => '2023-06-30 20:35:10',
                'date_update' => '2023-06-30 20:35:10',
                'description_' => NULL,
                'type' => 'storytelling',
                'id_experience' => 91,
            ),
            8 => 
            array (
                'id_content_experience' => 11,
                'date_heure' => '2023-07-22 18:17:07',
                'date_update' => '2023-07-22 18:17:07',
                'description_' => 'Dossier photo - test',
                'type' => 'storytelling',
                'id_experience' => 309,
            ),
            9 => 
            array (
                'id_content_experience' => 12,
                'date_heure' => '2023-07-25 22:37:05',
                'date_update' => '2023-07-25 22:37:05',
                'description_' => NULL,
                'type' => 'storytelling',
                'id_experience' => 203,
            ),
            10 => 
            array (
                'id_content_experience' => 13,
                'date_heure' => '2023-07-25 22:43:17',
                'date_update' => '2023-07-25 22:43:17',
                'description_' => NULL,
                'type' => 'storytelling',
                'id_experience' => 203,
            ),
            11 => 
            array (
                'id_content_experience' => 14,
                'date_heure' => '2023-07-25 22:45:25',
                'date_update' => '2023-07-25 22:45:25',
                'description_' => 'Je serais la',
                'type' => 'storytelling',
                'id_experience' => 203,
            ),
            12 => 
            array (
                'id_content_experience' => 15,
                'date_heure' => '2023-07-25 22:58:03',
                'date_update' => '2023-07-25 22:58:03',
                'description_' => NULL,
                'type' => 'storytelling',
                'id_experience' => 296,
            ),
            13 => 
            array (
                'id_content_experience' => 16,
                'date_heure' => '2023-07-25 23:02:38',
                'date_update' => '2023-07-25 23:02:38',
                'description_' => NULL,
                'type' => 'storytelling',
                'id_experience' => 296,
            ),
            14 => 
            array (
                'id_content_experience' => 17,
                'date_heure' => '2023-07-25 23:07:43',
                'date_update' => '2023-07-25 23:07:43',
                'description_' => 'YouTube Expérience Llc - Love on the Top',
                'type' => 'storytelling',
                'id_experience' => 296,
            ),
            15 => 
            array (
                'id_content_experience' => 18,
                'date_heure' => '2023-07-27 21:52:48',
                'date_update' => '2023-07-27 21:52:48',
                'description_' => 'Sekkai',
                'type' => 'storytelling',
                'id_experience' => 323,
            ),
            16 => 
            array (
                'id_content_experience' => 20,
                'date_heure' => '2023-08-11 14:42:17',
                'date_update' => '2023-08-11 14:42:17',
                'description_' => NULL,
                'type' => 'storytelling',
                'id_experience' => 322,
            ),
            17 => 
            array (
                'id_content_experience' => 21,
                'date_heure' => '2023-08-14 14:32:38',
                'date_update' => '2023-08-14 14:32:38',
                'description_' => NULL,
                'type' => 'storytelling',
                'id_experience' => 322,
            ),
            18 => 
            array (
                'id_content_experience' => 22,
                'date_heure' => '2023-05-12 14:21:00',
                'date_update' => '2023-05-12 14:21:00',
                'description_' => NULL,
                'type' => 'Vidéo-clip-Experience',
                'id_experience' => 79,
            ),
            19 => 
            array (
                'id_content_experience' => 23,
                'date_heure' => '2023-05-12 14:21:00',
                'date_update' => '2023-05-12 14:21:00',
                'description_' => NULL,
                'type' => 'Pochette-Experience',
                'id_experience' => 79,
            ),
            20 => 
            array (
                'id_content_experience' => 24,
                'date_heure' => '2023-05-13 14:21:00',
                'date_update' => '2023-05-13 14:21:00',
                'description_' => NULL,
                'type' => 'Teaser Expérience',
                'id_experience' => 79,
            ),
            21 => 
            array (
                'id_content_experience' => 25,
                'date_heure' => '2023-05-14 14:21:00',
                'date_update' => '2023-05-14 14:21:00',
                'description_' => NULL,
                'type' => 'Teaser Expérience',
                'id_experience' => 79,
            ),
            22 => 
            array (
                'id_content_experience' => 26,
                'date_heure' => '2023-05-15 14:21:00',
                'date_update' => '2023-05-15 14:21:00',
                'description_' => NULL,
                'type' => 'Vidéo-clip-Experience',
                'id_experience' => 92,
            ),
            23 => 
            array (
                'id_content_experience' => 27,
                'date_heure' => '2023-05-16 14:21:00',
                'date_update' => '2023-05-16 14:21:00',
                'description_' => NULL,
                'type' => 'Pochette-Experience',
                'id_experience' => 92,
            ),
            24 => 
            array (
                'id_content_experience' => 28,
                'date_heure' => '2023-05-17 14:21:00',
                'date_update' => '2023-05-17 14:21:00',
                'description_' => NULL,
                'type' => 'Teaser Expérience',
                'id_experience' => 92,
            ),
            25 => 
            array (
                'id_content_experience' => 29,
                'date_heure' => '2023-05-18 14:21:00',
                'date_update' => '2023-05-18 14:21:00',
                'description_' => NULL,
                'type' => 'Teaser Expérience',
                'id_experience' => 92,
            ),
        ));
        
        
    }
}