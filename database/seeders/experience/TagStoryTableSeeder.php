<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TagStoryTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tag_story')->delete();
        
        \DB::table('tag_story')->insert(array (
            0 => 
            array (
                'id_tag_story' => 1,
                'tag' => 'story telling',
            ),
            1 => 
            array (
                'id_tag_story' => 2,
                'tag' => 'htt',
            ),
            2 => 
            array (
                'id_tag_story' => 3,
                'tag' => 'Pourquoi ?',
            ),
        ));
        
        
    }
}