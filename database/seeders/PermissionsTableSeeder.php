<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'access Activité',
                'guard_name' => 'web',
                'created_at' => '2023-03-17 16:17:08',
                'updated_at' => '2023-03-17 16:17:08',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'access Analyse et stratégie',
                'guard_name' => 'web',
                'created_at' => '2023-03-17 16:17:08',
                'updated_at' => '2023-03-17 16:17:08',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'access Administration',
                'guard_name' => 'web',
                'created_at' => '2023-03-17 16:17:08',
                'updated_at' => '2023-03-17 16:17:08',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'access Infrastructure',
                'guard_name' => 'web',
                'created_at' => '2023-03-17 16:17:08',
                'updated_at' => '2023-03-17 16:17:08',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Espace perm',
                'guard_name' => 'web',
                'created_at' => '2023-03-21 16:03:32',
                'updated_at' => '2023-03-21 16:03:32',
            ),
        ));
        
        
    }
}