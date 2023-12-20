<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PackTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pack')->delete();
        
        \DB::table('pack')->insert(array (
            0 => 
            array (
                'id_pack' => 1,
                'nom' => 'Saphir',
                'prix' => 85.0,
                'abstract' => NULL,
                'description' => NULL,
                'stock' => NULL,
                'date_creation' => '2021-06-04 00:00:00',
                'date_update' => NULL,
                'statut' => 'actif',
                'id_stripe_pack' => 'prod_MzIwbdNqmgxMdI',
                'url_stripe_pack' => NULL,
            ),
            1 => 
            array (
                'id_pack' => 2,
                'nom' => 'Emeraude',
                'prix' => 125.0,
                'abstract' => NULL,
                'description' => NULL,
                'stock' => NULL,
                'date_creation' => '2023-04-17 11:38:52',
                'date_update' => NULL,
                'statut' => 'actif',
                'id_stripe_pack' => 'prod_MzIvw0LXvHvrRt',
                'url_stripe_pack' => NULL,
            ),
            2 => 
            array (
                'id_pack' => 3,
                'nom' => 'Diamant',
                'prix' => 385.0,
                'abstract' => NULL,
                'description' => NULL,
                'stock' => NULL,
                'date_creation' => '2022-02-02 00:00:00',
                'date_update' => NULL,
                'statut' => 'actif',
                'id_stripe_pack' => 'prod_MzIwhabK6VgGqI',
                'url_stripe_pack' => NULL,
            ),
            3 => 
            array (
                'id_pack' => 4,
                'nom' => 'Expérience EvjF Saphir',
                'prix' => 85.0,
                'abstract' => 'Expérience Saphir offre EvjF',
                'description' => 'Expérience Saphir offre EvjF',
                'stock' => NULL,
                'date_creation' => '2023-05-05 20:35:07',
                'date_update' => NULL,
                'statut' => 'actif',
                'id_stripe_pack' => NULL,
                'url_stripe_pack' => NULL,
            ),
            4 => 
            array (
                'id_pack' => 5,
                'nom' => 'Expérience EvjF Diamant',
                'prix' => 385.0,
                'abstract' => 'Expérience EvjF Diamant',
                'description' => 'Expérience EvjF Diamant',
                'stock' => NULL,
                'date_creation' => '2023-05-05 20:53:55',
                'date_update' => NULL,
                'statut' => 'actif',
                'id_stripe_pack' => NULL,
                'url_stripe_pack' => NULL,
            ),
            5 => 
            array (
                'id_pack' => 6,
                'nom' => 'Expérience EvjF Emeraude',
                'prix' => 125.0,
                'abstract' => 'Expérience EvjF Emeraude',
                'description' => 'Expérience EvjF Emeraude',
                'stock' => NULL,
                'date_creation' => '2021-06-05 00:00:00',
                'date_update' => NULL,
                'statut' => 'actif',
                'id_stripe_pack' => NULL,
                'url_stripe_pack' => NULL,
            ),
            6 => 
            array (
                'id_pack' => 7,
                'nom' => 'Eni Cool',
                'prix' => 100.0,
                'abstract' => NULL,
                'description' => NULL,
                'stock' => NULL,
                'date_creation' => '2022-11-20 01:37:02',
                'date_update' => NULL,
                'statut' => 'actif',
                'id_stripe_pack' => NULL,
                'url_stripe_pack' => NULL,
            ),
            7 => 
            array (
                'id_pack' => 8,
                'nom' => 'Eny & Leveneur',
                'prix' => 60.0,
                'abstract' => NULL,
                'description' => NULL,
                'stock' => NULL,
                'date_creation' => '2022-10-08 00:14:15',
                'date_update' => NULL,
                'statut' => 'actif',
                'id_stripe_pack' => NULL,
                'url_stripe_pack' => NULL,
            ),
            8 => 
            array (
                'id_pack' => 9,
            'nom' => 'Urban Experience 150€ ( Remise 25€)',
                'prix' => 125.0,
                'abstract' => NULL,
                'description' => NULL,
                'stock' => NULL,
                'date_creation' => '2022-05-10 00:00:00',
                'date_update' => NULL,
                'statut' => 'actif',
                'id_stripe_pack' => NULL,
                'url_stripe_pack' => NULL,
            ),
            9 => 
            array (
                'id_pack' => 10,
                'nom' => 'Urban Expérience',
                'prix' => 150.0,
                'abstract' => NULL,
                'description' => NULL,
                'stock' => NULL,
                'date_creation' => '2022-05-10 00:00:00',
                'date_update' => NULL,
                'statut' => 'actif',
                'id_stripe_pack' => NULL,
                'url_stripe_pack' => NULL,
            ),
            10 => 
            array (
                'id_pack' => 11,
                'nom' => 'Expérience LalaChante Emeraude',
                'prix' => 85.0,
                'abstract' => '',
                'description' => '',
                'stock' => NULL,
                'date_creation' => '2020-09-08 16:58:00',
                'date_update' => '0000-00-00 00:00:00',
                'statut' => 'archivé',
                'id_stripe_pack' => NULL,
                'url_stripe_pack' => NULL,
            ),
            11 => 
            array (
                'id_pack' => 12,
                'nom' => 'Pack Saphir',
                'prix' => 85.0,
                'abstract' => 'Lalachante Pack Saphir',
                'description' => '',
                'stock' => NULL,
                'date_creation' => '2019-04-23 10:10:00',
                'date_update' => '0000-00-00 00:00:00',
                'statut' => 'archivé',
                'id_stripe_pack' => NULL,
                'url_stripe_pack' => NULL,
            ),
            12 => 
            array (
                'id_pack' => 13,
                'nom' => 'Experience Emeraude 1 personne',
                'prix' => 125.0,
                'abstract' => '',
                'description' => '',
                'stock' => NULL,
                'date_creation' => '2020-12-05 00:00:00',
                'date_update' => '0000-00-00 00:00:00',
                'statut' => 'actif',
                'id_stripe_pack' => NULL,
                'url_stripe_pack' => NULL,
            ),
            13 => 
            array (
                'id_pack' => 14,
                'nom' => 'Arrangement, Coaching, Enregistrement mixage proje',
                'prix' => 415.0,
                'abstract' => 'Arrangement, Coaching, Enregistrement mixage projet "Je veux"',
                'description' => 'Arrangement, Coaching, Enregistrement mixage projet "Je veux"',
                'stock' => NULL,
                'date_creation' => '2020-03-12 00:00:00',
                'date_update' => '0000-00-00 00:00:00',
                'statut' => 'archivé',
                'id_stripe_pack' => NULL,
                'url_stripe_pack' => NULL,
            ),
            14 => 
            array (
                'id_pack' => 15,
                'nom' => 'Pack ete',
                'prix' => 100.0,
                'abstract' => 'Pack ete',
                'description' => 'Pack ete',
                'stock' => NULL,
                'date_creation' => '2023-08-22 12:55:05',
                'date_update' => '2023-08-22 12:55:06',
                'statut' => 'actif',
                'id_stripe_pack' => 'prod_OUryvuTHPgUR6G',
                'url_stripe_pack' => 'https://dashboard.stripe.com/test/products/prod_OUryvuTHPgUR6G',
            ),
            15 => 
            array (
                'id_pack' => 16,
                'nom' => 'Emeraude Edition 7',
                'prix' => 875.0,
                'abstract' => 'Emeraude Edition 7',
                'description' => 'Emeraude Edition 7',
                'stock' => NULL,
                'date_creation' => '2023-08-24 17:46:19',
                'date_update' => '2023-08-24 17:46:20',
                'statut' => 'actif',
                'id_stripe_pack' => 'prod_OVh8nmGSVJu7rq',
                'url_stripe_pack' => 'https://dashboard.stripe.com/test/products/prod_OVh8nmGSVJu7rq',
            ),
            16 => 
            array (
                'id_pack' => 17,
                'nom' => 'Emeraude Edtion 5',
                'prix' => 625.0,
                'abstract' => 'Emeraude Edition 5',
                'description' => 'Emeraude Edition 5',
                'stock' => NULL,
                'date_creation' => '2023-08-24 17:47:42',
                'date_update' => '2023-08-24 19:10:09',
                'statut' => 'actif',
                'id_stripe_pack' => 'prod_OVh9YCdKvPMApo',
                'url_stripe_pack' => 'https://dashboard.stripe.com/test/products/prod_OVh9YCdKvPMApo',
            ),
            17 => 
            array (
                'id_pack' => 18,
                'nom' => 'Emeraude Edition 3',
                'prix' => 375.0,
                'abstract' => 'Emeraude Edition 3',
                'description' => 'Emeraude Edition 3',
                'stock' => NULL,
                'date_creation' => '2023-08-24 17:48:41',
                'date_update' => '2023-08-24 17:48:41',
                'statut' => 'actif',
                'id_stripe_pack' => 'prod_OVhAmhvOevE8Ms',
                'url_stripe_pack' => 'https://dashboard.stripe.com/test/products/prod_OVhAmhvOevE8Ms',
            ),
        ));
        
        
    }
}