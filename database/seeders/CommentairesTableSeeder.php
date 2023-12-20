<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CommentairesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::connection('mysql2')->table('commentaires')->delete();
        
        \DB::connection('mysql2')->table('commentaires')->insert(array (
            0 => 
            array (
                'id_commentaire' => 1,
                'texte' => 'Texte du commentaire',
                'date_creation' => '2023-10-02 10:44:21',
                'likes' => 2,
                'dislikes' => 0,
                'statut' => 'approuvé',
                'id_commentaire_1' => NULL,
                'id_experience' => 322,
                'id_contact' => 304,
            ),
            1 => 
            array (
                'id_commentaire' => 2,
                'texte' => 'commentaire experience ENI',
                'date_creation' => '2023-06-10 10:24:00',
                'likes' => 3,
                'dislikes' => 0,
                'statut' => '',
                'id_commentaire_1' => NULL,
                'id_experience' => 79,
                'id_contact' => 139,
            ),
            2 => 
            array (
                'id_commentaire' => 3,
                'texte' => 'reponse commentaire',
                'date_creation' => '2023-06-10 10:30:00',
                'likes' => 3,
                'dislikes' => 0,
                'statut' => '',
                'id_commentaire_1' => 2,
                'id_experience' => 79,
                'id_contact' => 139,
            ),
            3 => 
            array (
                'id_commentaire' => 4,
                'texte' => 'commentaire experience ENI AIMEOUSKI',
                'date_creation' => '2023-06-15 10:30:00',
                'likes' => 10,
                'dislikes' => 0,
                'statut' => '',
                'id_commentaire_1' => NULL,
                'id_experience' => 92,
                'id_contact' => 307,
            ),
        ));
        
        
    }
}