<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CodesPromoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::connection('mysql2')->table('codes_promo')->delete();
        
        \DB::connection('mysql2')->table('codes_promo')->insert(array (
            0 => 
            array (
                'id_code' => 5,
                'code' => 'AGAG',
                'nb_utilisation' => 10,
                'nb_code' => 0,
                'description' => NULL,
                'statut_code' => 'actif',
                'date_creation' => '2023-08-08 16:54:39',
                'date_update' => '2023-08-08 16:54:40',
                'id_remise' => 1,
                'id_stripe_code' => 'promo_1NcrIyJcMHqHTYoTjq5c3uEq',
                'url_stripe_code' => 'https://dashboard.stripe.com/test/promotion_codes/promo_1NcrIyJcMHqHTYoTjq5c3uEq',
            ),
            1 => 
            array (
                'id_code' => 9,
                'code' => '64',
                'nb_utilisation' => 1,
                'nb_code' => 0,
                'description' => NULL,
                'statut_code' => 'actif',
                'date_creation' => '2023-08-09 14:57:28',
                'date_update' => '2023-08-09 14:57:28',
                'id_remise' => 1,
                'id_stripe_code' => 'promo_1NdBx6JcMHqHTYoTED1niJe7',
                'url_stripe_code' => 'https://dashboard.stripe.com/test/promotion_codes/promo_1NdBx6JcMHqHTYoTED1niJe7',
            ),
            2 => 
            array (
                'id_code' => 10,
                'code' => '21313',
                'nb_utilisation' => 1,
                'nb_code' => 0,
                'description' => NULL,
                'statut_code' => 'actif',
                'date_creation' => '2023-08-11 10:06:59',
                'date_update' => '2023-08-11 10:06:59',
                'id_remise' => 1,
                'id_stripe_code' => 'promo_1NdqN5JcMHqHTYoTD75LMxf5',
                'url_stripe_code' => 'https://dashboard.stripe.com/test/promotion_codes/promo_1NdqN5JcMHqHTYoTD75LMxf5',
            ),
            3 => 
            array (
                'id_code' => 11,
                'code' => 'ehege',
                'nb_utilisation' => 1,
                'nb_code' => 0,
                'description' => NULL,
                'statut_code' => 'actif',
                'date_creation' => '2023-08-25 10:26:21',
                'date_update' => '2023-08-25 10:26:21',
                'id_remise' => 1,
                'id_stripe_code' => 'promo_1NivLVJcMHqHTYoTzB3yy8LG',
                'url_stripe_code' => 'https://dashboard.stripe.com/test/promotion_codes/promo_1NivLVJcMHqHTYoTzB3yy8LG',
            ),
            4 => 
            array (
                'id_code' => 12,
                'code' => 'FDGDKF',
                'nb_utilisation' => 12,
                'nb_code' => 0,
                'description' => NULL,
                'statut_code' => 'actif',
                'date_creation' => '2023-09-15 18:19:02',
                'date_update' => '2023-09-15 18:19:02',
                'id_remise' => 2,
                'id_stripe_code' => 'promo_1NqejTJcMHqHTYoT06O1Qc2s',
                'url_stripe_code' => 'https://dashboard.stripe.com/test/promotion_codes/promo_1NqejTJcMHqHTYoT06O1Qc2s',
            ),
            5 => 
            array (
                'id_code' => 13,
                'code' => 'AGAG',
                'nb_utilisation' => 2,
                'nb_code' => 0,
                'description' => NULL,
                'statut_code' => 'actif',
                'date_creation' => '2023-09-19 15:16:51',
                'date_update' => '2023-09-19 15:16:51',
                'id_remise' => 1,
                'id_stripe_code' => NULL,
                'url_stripe_code' => NULL,
            ),
            6 => 
            array (
                'id_code' => 14,
                'code' => 'AGAG',
                'nb_utilisation' => 2,
                'nb_code' => 0,
                'description' => NULL,
                'statut_code' => 'actif',
                'date_creation' => '2023-09-19 15:17:07',
                'date_update' => '2023-09-19 15:17:07',
                'id_remise' => 1,
                'id_stripe_code' => NULL,
                'url_stripe_code' => NULL,
            ),
            7 => 
            array (
                'id_code' => 15,
                'code' => 'bt',
                'nb_utilisation' => 2,
                'nb_code' => 0,
                'description' => NULL,
                'statut_code' => 'actif',
                'date_creation' => '2023-09-19 15:25:12',
                'date_update' => '2023-09-19 15:25:12',
                'id_remise' => 1,
                'id_stripe_code' => 'promo_1Ns3vQJcMHqHTYoTjdKYlvic',
                'url_stripe_code' => 'https://dashboard.stripe.com/test/promotion_codes/promo_1Ns3vQJcMHqHTYoTjdKYlvic',
            ),
            8 => 
            array (
                'id_code' => 16,
                'code' => '123',
                'nb_utilisation' => 12,
                'nb_code' => 0,
                'description' => NULL,
                'statut_code' => 'actif',
                'date_creation' => '2023-09-19 15:29:52',
                'date_update' => '2023-09-19 15:29:52',
                'id_remise' => 2,
                'id_stripe_code' => NULL,
                'url_stripe_code' => NULL,
            ),
        ));
        
        
    }
}