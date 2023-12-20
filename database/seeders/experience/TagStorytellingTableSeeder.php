<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TagStorytellingTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tag_storytelling')->delete();
        
        \DB::table('tag_storytelling')->insert(array (
            0 => 
            array (
                'id_storytelling' => 11,
                'id_tag_story' => 1,
            ),
            1 => 
            array (
                'id_storytelling' => 13,
                'id_tag_story' => 1,
            ),
            2 => 
            array (
                'id_storytelling' => 17,
                'id_tag_story' => 2,
            ),
        ));
        
        
    }
}