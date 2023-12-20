<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class InvitationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('invitations')->delete();
        
        
        
    }
}