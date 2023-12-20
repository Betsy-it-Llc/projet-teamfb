<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Dev',
                'guard_name' => 'web',
                'created_at' => '2023-03-17 16:17:00',
                'updated_at' => '2023-03-17 16:17:00',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Admin',
                'guard_name' => 'web',
                'created_at' => '2023-03-17 16:17:00',
                'updated_at' => '2023-03-17 16:17:00',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Social Média',
                'guard_name' => 'web',
                'created_at' => '2023-03-17 16:56:10',
                'updated_at' => '2023-03-17 16:56:10',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Manteere',
                'guard_name' => 'web',
                'created_at' => '2023-03-21 16:02:54',
                'updated_at' => '2023-05-30 08:26:18',
            ),
        ));
        
        
    }
}