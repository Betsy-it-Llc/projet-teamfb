<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RemiseTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::connection('mysql2')->table('remise')->delete();
        
        \DB::connection('mysql2')->table('remise')->insert(array (
            0 => 
            array (
                'id_remise' => 1,
                'nom_remise' => 'test Code Promo remisse',
                'type_remise' => 'Test',
                'taux' => 6.0,
                'montant' => NULL,
                'date_debut' => '2023-08-17 00:00:00',
                'date_fin' => '2023-08-25 00:00:00',
                'description' => NULL,
                'statut' => 'inactif',
                'date_creation' => '2023-08-07 14:40:45',
                'date_update' => '2023-09-25 21:40:10',
                'id_stripe_remise' => 'IaHxjoXu',
                'url_stripe_remise' => 'https://dashboard.stripe.com/test/coupons/IaHxjoXu',
            ),
            1 => 
            array (
                'id_remise' => 2,
                'nom_remise' => 'REMISE100v2',
                'type_remise' => NULL,
                'taux' => 100.0,
                'montant' => NULL,
                'date_debut' => '2023-08-27 00:00:00',
                'date_fin' => '2023-09-10 00:00:00',
                'description' => NULL,
                'statut' => 'actif',
                'date_creation' => '2023-08-30 12:05:11',
                'date_update' => '2023-09-25 21:40:11',
                'id_stripe_remise' => 'Ut0tpU1E',
                'url_stripe_remise' => 'https://dashboard.stripe.com/test/coupons/Ut0tpU1E',
            ),
        ));
        
        
    }
}