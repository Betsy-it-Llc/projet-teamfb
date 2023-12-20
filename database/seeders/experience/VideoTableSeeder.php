<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VideoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('video')->delete();
        
        \DB::table('video')->insert(array (
            0 => 
            array (
                'id_video' => 1,
                'description' => NULL,
                'url' => 'https://drive.google.com/file/d/19i1Nd1WhX7EtA00ay4E67ctB4V-B1MlS/preview',
                'id_content_experience' => 20,
            ),
        ));
        
        
    }
}