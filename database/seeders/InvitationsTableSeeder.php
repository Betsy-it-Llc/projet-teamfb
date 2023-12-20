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
        

        \DB::connection('mysql2')->table('invitations')->delete();
        
        \DB::connection('mysql2')->table('invitations')->insert(array (
            0 => 
            array (
                'id_invitation' => 1,
                'email_invite' => 'email_invite@invite.fr',
                'date_invite' => '2023-10-01 10:58:07',
                'statut' => 'envoyé',
                'id_cagnotte' => 3,
            ),
            1 => 
            array (
                'id_invitation' => 2,
                'email_invite' => 'NULL',
                'date_invite' => '2023-06-09 10:24:00',
                'statut' => 'Accepté',
                'id_cagnotte' => 1,
            ),
        ));
        
        
    }
}