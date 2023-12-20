<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EvenementTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('evenement')->delete();
        
        \DB::table('evenement')->insert(array (
            0 => 
            array (
                'id_evenement' => 1,
                'type_evenement' => 'Prise de contact',
                'date_evenement' => '2023-05-16 00:00:00',
                'id_experience' => 85,
            ),
            1 => 
            array (
                'id_evenement' => 2,
                'type_evenement' => 'Speetch experience',
                'date_evenement' => '2023-05-16 00:00:00',
                'id_experience' => 85,
            ),
            2 => 
            array (
                'id_evenement' => 3,
                'type_evenement' => 'Reservation date',
                'date_evenement' => '2023-05-16 00:00:00',
                'id_experience' => 85,
            ),
            3 => 
            array (
                'id_evenement' => 4,
                'type_evenement' => 'Record date',
                'date_evenement' => '2023-05-16 00:00:00',
                'id_experience' => 85,
            ),
            4 => 
            array (
                'id_evenement' => 5,
                'type_evenement' => 'Livraison chanson Experience',
                'date_evenement' => '2023-05-31 00:00:00',
                'id_experience' => 85,
            ),
            5 => 
            array (
                'id_evenement' => 6,
                'type_evenement' => 'Prise de contact',
                'date_evenement' => '2023-06-03 00:00:00',
                'id_experience' => 92,
            ),
            6 => 
            array (
                'id_evenement' => 7,
                'type_evenement' => 'Record date',
                'date_evenement' => '2023-06-03 00:00:00',
                'id_experience' => 92,
            ),
            7 => 
            array (
                'id_evenement' => 8,
                'type_evenement' => 'Livraison chanson Experience',
                'date_evenement' => '2023-06-18 00:00:00',
                'id_experience' => 92,
            ),
            8 => 
            array (
                'id_evenement' => 9,
                'type_evenement' => 'Période studio experience',
                'date_evenement' => '2023-06-03 00:00:00',
                'id_experience' => 92,
            ),
            9 => 
            array (
                'id_evenement' => 10,
                'type_evenement' => 'Record date',
                'date_evenement' => '2023-06-26 00:00:00',
                'id_experience' => 90,
            ),
            10 => 
            array (
                'id_evenement' => 11,
                'type_evenement' => 'Livraison chanson Experience',
                'date_evenement' => '2023-07-11 00:00:00',
                'id_experience' => 90,
            ),
            11 => 
            array (
                'id_evenement' => 12,
                'type_evenement' => 'Prise de contact',
                'date_evenement' => '2023-05-30 00:00:00',
                'id_experience' => 90,
            ),
            12 => 
            array (
                'id_evenement' => 13,
                'type_evenement' => 'Speetch experience',
                'date_evenement' => '2023-06-06 00:00:00',
                'id_experience' => 90,
            ),
            13 => 
            array (
                'id_evenement' => 14,
                'type_evenement' => 'Prise de contact',
                'date_evenement' => '2023-05-12 00:00:00',
                'id_experience' => 91,
            ),
            14 => 
            array (
                'id_evenement' => 15,
                'type_evenement' => 'Speetch experience',
                'date_evenement' => '2023-06-02 00:00:00',
                'id_experience' => 91,
            ),
            15 => 
            array (
                'id_evenement' => 16,
            'type_evenement' => ' Interaction (pré experience)',
                'date_evenement' => '2023-06-03 00:00:00',
                'id_experience' => 91,
            ),
            16 => 
            array (
                'id_evenement' => 17,
            'type_evenement' => ' Interaction (pré experience)',
                'date_evenement' => '2023-07-04 00:00:00',
                'id_experience' => 91,
            ),
            17 => 
            array (
                'id_evenement' => 18,
                'type_evenement' => 'Reservation date',
                'date_evenement' => '2023-06-12 00:00:00',
                'id_experience' => 91,
            ),
            18 => 
            array (
                'id_evenement' => 19,
                'type_evenement' => 'Record date',
                'date_evenement' => '2023-06-12 00:00:00',
                'id_experience' => 91,
            ),
            19 => 
            array (
                'id_evenement' => 20,
                'type_evenement' => 'Livraison chanson Experience',
                'date_evenement' => '2023-06-27 00:00:00',
                'id_experience' => 91,
            ),
            20 => 
            array (
                'id_evenement' => 21,
                'type_evenement' => 'Sucess post Experience',
                'date_evenement' => '2023-06-28 00:00:00',
                'id_experience' => 91,
            ),
            21 => 
            array (
                'id_evenement' => 22,
                'type_evenement' => 'Record date',
                'date_evenement' => '2023-07-22 00:00:00',
                'id_experience' => 309,
            ),
            22 => 
            array (
                'id_evenement' => 23,
                'type_evenement' => 'Livraison chanson Experience',
                'date_evenement' => '2023-08-06 00:00:00',
                'id_experience' => 309,
            ),
            23 => 
            array (
                'id_evenement' => 24,
                'type_evenement' => 'Record date',
                'date_evenement' => '2023-07-25 00:00:00',
                'id_experience' => 203,
            ),
            24 => 
            array (
                'id_evenement' => 25,
                'type_evenement' => 'Livraison chanson Experience',
                'date_evenement' => '2023-08-09 00:00:00',
                'id_experience' => 203,
            ),
            25 => 
            array (
                'id_evenement' => 26,
                'type_evenement' => 'Livraison chanson Experience',
                'date_evenement' => '2023-07-23 00:00:00',
                'id_experience' => 296,
            ),
            26 => 
            array (
                'id_evenement' => 27,
                'type_evenement' => 'Record date',
                'date_evenement' => '2023-07-04 00:00:00',
                'id_experience' => 296,
            ),
            27 => 
            array (
                'id_evenement' => 28,
                'type_evenement' => 'Prise de contact',
                'date_evenement' => '2023-09-20 00:00:00',
                'id_experience' => 403,
            ),
            28 => 
            array (
                'id_evenement' => 29,
                'type_evenement' => '',
                'date_evenement' => '2023-09-21 00:00:00',
                'id_experience' => 407,
            ),
            29 => 
            array (
                'id_evenement' => 30,
                'type_evenement' => 'Speetch experience',
                'date_evenement' => '2023-09-20 00:00:00',
                'id_experience' => 407,
            ),
            30 => 
            array (
                'id_evenement' => 31,
                'type_evenement' => 'Reservation date',
                'date_evenement' => '2023-09-21 00:00:00',
                'id_experience' => 405,
            ),
            31 => 
            array (
                'id_evenement' => 32,
                'type_evenement' => 'Prise de contact',
                'date_evenement' => '2023-09-20 00:00:00',
                'id_experience' => 405,
            ),
        ));
        
        
    }
}