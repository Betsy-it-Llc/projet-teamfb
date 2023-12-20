<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TagInteractionTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tag_interaction')->delete();
        
        \DB::table('tag_interaction')->insert(array (
            0 => 
            array (
                'id_tag_interaction' => 1,
                'tag' => 'Attention',
            ),
            1 => 
            array (
                'id_tag_interaction' => 2,
                'tag' => 'Info Contact',
            ),
        ));
        
        
    }
}