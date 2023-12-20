<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class InteractionTagTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::connection('mysql2')->table('interaction_tag')->delete();
        
        \DB::connection('mysql2')->table('interaction_tag')->insert(array (
            0 => 
            array (
                'id_interaction' => 19,
                'id_tag_interaction' => 1,
            ),
            1 => 
            array (
                'id_interaction' => 20,
                'id_tag_interaction' => 2,
            ),
        ));
        
        
    }
}