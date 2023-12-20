<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SuppTableTestTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('supp__table_test')->delete();
        
        \DB::table('supp__table_test')->insert(array (
            0 => 
            array (
                'idtable_test' => '• La Nuit à Toulouse :smiling_imp:',
            ),
        ));
        
        
    }
}