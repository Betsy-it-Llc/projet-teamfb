<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 11,
                'name' => 'la',
                'email' => 'la@llc.fr',
                'email_verified_at' => NULL,
                'role' => 'Dev',
                'password' => 'sidosi',
                'remember_token' => NULL,
                'created_at' => '2022-04-29 05:34:54',
                'updated_at' => '2022-06-20 07:40:24',
            ),
            1 => 
            array (
                'id' => 17,
                'name' => 'aa',
                'email' => 'aa@llc.fr',
                'email_verified_at' => NULL,
                'role' => 'Dev',
                'password' => '$2y$10$cFjHPuoEbGMsg6Redze9euS1XdN7C7TCLHDHoBPsW6nuYhL1BeXYW',
                'remember_token' => NULL,
                'created_at' => '2022-04-29 05:41:55',
                'updated_at' => '2022-06-01 14:15:34',
            ),
            2 => 
            array (
                'id' => 31,
                'name' => 'Team',
                'email' => 'aa@llc.fr',
                'email_verified_at' => NULL,
                'role' => NULL,
                'password' => '$2y$10$QpuETMe4mAZBKR.RhWZYHOgygzG8c7MwbRPosYODHJer0bdh/KMp6',
                'remember_token' => NULL,
                'created_at' => '2022-09-24 18:48:59',
                'updated_at' => '2022-09-24 18:48:59',
            ),
            3 => 
            array (
                'id' => 32,
                'name' => 'Harena',
                'email' => 'harenait.lalachante@gmail.com',
                'email_verified_at' => NULL,
                'role' => NULL,
                'password' => '$2y$10$UO.DdbnSBb7NM3AYjWfONeyg68LzAg/EuO4C32hHfZfRzv.3cLZt2',
                'remember_token' => NULL,
                'created_at' => '2023-01-27 21:21:41',
                'updated_at' => '2023-01-27 21:21:41',
            ),
            4 => 
            array (
                'id' => 34,
                'name' => 'Mohammed Pm',
                'email' => 'mohammedpm.lalachante@gmail.com',
                'email_verified_at' => NULL,
                'role' => NULL,
                'password' => '$2y$10$xBAhVO78jHzlcPhTZ1SPFeBmINZucBRrEUXv.QFMNzz/d0mcnP9o2',
                'remember_token' => NULL,
                'created_at' => '2023-02-27 12:21:16',
                'updated_at' => '2023-02-27 12:21:16',
            ),
            5 => 
            array (
                'id' => 35,
                'name' => 'Zakariait Llc',
                'email' => 'zakariait.lalachante@gmail.com',
                'email_verified_at' => NULL,
                'role' => NULL,
                'password' => '$2y$10$Wgudwod/mBmAMrKeJMWsEOZOK7xxrXU30nqkE4fIsdMJ0B1I4VPjy',
                'remember_token' => NULL,
                'created_at' => '2023-03-03 16:25:41',
                'updated_at' => '2023-03-03 16:25:41',
            ),
            6 => 
            array (
                'id' => 36,
                'name' => 'dev',
                'email' => 'dev@test.fr',
                'email_verified_at' => NULL,
                'role' => NULL,
                'password' => '$2y$10$8ut4lsgWiVywPSh6bvC9s.TGqUnTeuo0/YjJKkGkgBOCYtB6ecyTe',
                'remember_token' => NULL,
                'created_at' => '2023-03-17 16:21:45',
                'updated_at' => '2023-03-20 10:22:33',
            ),
            7 => 
            array (
                'id' => 38,
                'name' => 'Ronny',
                'email' => 'ronnyit.lalachante@gmail.com',
                'email_verified_at' => NULL,
                'role' => NULL,
                'password' => '$2y$10$eRsZEAGprRK/cNEwrrS05O1CQEhAElNsJ2vffHQ5XxN2X1gmzs/ey',
                'remember_token' => NULL,
                'created_at' => '2023-05-19 17:37:08',
                'updated_at' => '2023-05-22 08:44:57',
            ),
            8 => 
            array (
                'id' => 39,
                'name' => 'Daniel LalaChante',
                'email' => 'danielit.lalachante@gmail.com',
                'email_verified_at' => NULL,
                'role' => NULL,
                'password' => '$2y$10$BUYvnFL0DRpUIchetr2jkeFbxJ2kCayOlyl1vMFxYocMwyJlZyFcS',
                'remember_token' => NULL,
                'created_at' => '2023-07-10 16:40:54',
                'updated_at' => '2023-07-10 16:40:54',
            ),
            9 => 
            array (
                'id' => 42,
                'name' => 'Aina LalaChante',
                'email' => 'eliasyit.lalachante@gmail.com',
                'email_verified_at' => NULL,
                'role' => NULL,
                'password' => '$2y$10$O.9n1Im3qvL3tF/wfVHu3Oz.KASz0/BhtRvyFOTstVOm6BsbTGIXG',
                'remember_token' => NULL,
                'created_at' => '2023-08-28 20:09:33',
                'updated_at' => '2023-08-28 20:09:33',
            ),
        ));
        
        
    }
}