<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MediaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('media')->delete();
        
        \DB::table('media')->insert(array (
            0 => 
            array (
                'id_media' => 1,
                'type' => NULL,
                'description' => 'Dossier photo - test',
                'url' => 'lalachante.Fr',
                'date_creation' => '2023-07-22 18:17:07',
                'date_update' => '2023-07-22 18:17:07',
                'id_content_experience' => 11,
            ),
            1 => 
            array (
                'id_media' => 2,
                'type' => NULL,
                'description' => 'Je serais la',
                'url' => 'https://www.youtube.com/watch?v=O_Z9YEusuP0',
                'date_creation' => '2023-07-25 22:45:25',
                'date_update' => '2023-07-25 22:45:25',
                'id_content_experience' => 14,
            ),
            2 => 
            array (
                'id_media' => 3,
                'type' => NULL,
                'description' => 'YouTube Expérience Llc - Love on the Top',
                'url' => 'https://youtu.be/9AF04HDvMgk',
                'date_creation' => '2023-07-25 23:07:43',
                'date_update' => '2023-07-25 23:07:43',
                'id_content_experience' => 17,
            ),
        ));
        
        
    }
}