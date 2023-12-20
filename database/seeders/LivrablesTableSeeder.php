<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LivrablesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::connection('mysql2')->table('livrables')->delete();
        
        \DB::connection('mysql2')->table('livrables')->insert(array (
            0 => 
            array (
                'id_livrable_' => 1,
                'nom' => 'Pochette-Experience-230515IMQB Exp  Eni Cool 1p',
                'type' => 'pochette',
                'date_envoie' => '2023-02-19 00:00:00',
                'url' => 'https://drive.google.com/file/d/1FXdBG6LIwIFpoawGzJJs9PYDPog9BF2m/preview',
                'date_creation' => '2023-02-19 00:00:00',
                'date_update' => '2023-02-19 00:00:00',
                'id_content_experience' => 23,
            ),
            1 => 
            array (
                'id_livrable_' => 2,
                'nom' => 'Pochette-Experience-230515IMQB Exp  Eni Cool 1p',
                'type' => 'pochette',
                'date_envoie' => '2023-02-19 00:00:00',
                'url' => 'pochette eni aimeouski.png',
                'date_creation' => '2023-02-19 00:00:00',
                'date_update' => '2023-02-19 00:00:00',
                'id_content_experience' => 27,
            ),
        ));
        
        
    }
}