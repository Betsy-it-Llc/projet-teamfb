<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VideoYoutubeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('video_youtube')->delete();
        
        \DB::table('video_youtube')->insert(array (
            0 => 
            array (
                'id_video_youtube' => 1,
                'titre' => 'Laurie & Pierrick -Place des Grands Homme - l\' Expérience LalaChante',
                'categorie' => NULL,
                'url_source' => 'https://drive.google.com/file/d/19i1Nd1WhX7EtA00ay4E67ctB4V-B1MlS/preview',
                'visibilite' => NULL,
                'description' => 'Laurie réécrit les paroles de Place des Grands Hommes une chanson surprise pour un événement qui compte et qui doit rassembler la Famille ?les amis,.
Pierrick son frère l\'accompagne au piano, quelques séances de coaching avec voix avec l\'équipe de LalaChante . Une aventure incroyable. 

Bravo Laurie & Pierrick, la famille et les amies vont être touchés de découvrir ce cadeau que vous leur avez fait... 

C\'\'est pour aider à réaliser des histoires comme cela que LalaChante.
Merci à tous les deux. ??

L\'expérience  LalaChante 
L\'Expérience studio professionnel dédiée au grand public. http://www.lalachante.fr',
                'playlist' => NULL,
                'tags' => NULL,
                'url_youtube' => 'https://www.youtube.com/watch?v=scuTqOuZJ9U',
                'date_enregistrement' => NULL,
                'date_publication' => '2023-06-05 10:10:45',
                'date_creation' => '2023-06-05 10:10:45',
                'date_modification' => '2023-06-05 10:10:45',
                'id_content_experience' => 20,
            ),
            1 => 
            array (
                'id_video_youtube' => 2,
                'titre' => 'ENI iV - MARMAILL KROUTÉ / INACHEVÉ - LalaChante Urban Expérience',
                'categorie' => 'Music',
                'url_source' => NULL,
                'visibilite' => 'Public',
            'description' => 'ENI (versus iV) Marmaill Krouté, construit son chemin avec des pierres taillées sur la route !
Venom Veille - Aimeouski

Urban Expérience LalaChante 
L\'Expérience studio professionnel destinée au grand public. 
http://www.lalachante.fr',
                'playlist' => NULL,
                'tags' => NULL,
                'url_youtube' => 'https://www.youtube.com/watch?v=8G_ufNTmyaU',
                'date_enregistrement' => '2023-02-06 15:00:00',
                'date_publication' => '2023-02-19 15:00:00',
                'date_creation' => '2023-02-19 15:00:00',
                'date_modification' => '2023-02-19 15:00:00',
                'id_content_experience' => 22,
            ),
            2 => 
            array (
                'id_video_youtube' => 3,
                'titre' => 'Titouane - Je veux',
                'categorie' => 'Shorts',
                'url_source' => NULL,
                'visibilite' => 'Public',
                'description' => 'Titouane - Je veux',
                'playlist' => NULL,
                'tags' => NULL,
                'url_youtube' => 'https://www.youtube.com/shorts/THyIPvd7pWI',
                'date_enregistrement' => '2023-02-07 15:00:00',
                'date_publication' => '2023-02-19 15:00:01',
                'date_creation' => '2023-02-19 15:00:01',
                'date_modification' => '2023-02-19 15:00:00',
                'id_content_experience' => 24,
            ),
            3 => 
            array (
                'id_video_youtube' => 4,
                'titre' => 'Thomas - Break my heart again',
                'categorie' => 'Shorts',
                'url_source' => NULL,
                'visibilite' => 'Public',
                'description' => 'Thomas - Break my heart again',
                'playlist' => NULL,
                'tags' => NULL,
                'url_youtube' => 'https://www.youtube.com/shorts/1NyZvT9JZro',
                'date_enregistrement' => '2023-02-08 15:00:00',
                'date_publication' => '2023-02-19 15:00:02',
                'date_creation' => '2023-02-19 15:00:02',
                'date_modification' => '2023-02-19 15:00:00',
                'id_content_experience' => 25,
            ),
            4 => 
            array (
                'id_video_youtube' => 5,
                'titre' => 'ENI iii - AIMEOUSKI / INACHEVÉ - LalaChante Urban Expérience',
                'categorie' => 'Music',
                'url_source' => NULL,
                'visibilite' => 'Public',
            'description' => 'ENI revient inspiré, avec un style bien a lui (versus iii) - Aimeouski

Urban Expérience LalaChante 
L\'Expérience studio professionnel destinée au grand public. http://www.lalachante.fr',
                'playlist' => NULL,
                'tags' => NULL,
                'url_youtube' => 'ENI iii - AIMEOUSKI / INACHEVÉ - LalaChante Urban ',
                'date_enregistrement' => '2023-02-06 15:00:00',
                'date_publication' => '2023-02-20 15:00:02',
                'date_creation' => '2023-02-20 15:00:02',
                'date_modification' => '2023-02-20 15:00:00',
                'id_content_experience' => 26,
            ),
            5 => 
            array (
                'id_video_youtube' => 6,
                'titre' => 'Titouane - Je veux',
                'categorie' => 'Shorts',
                'url_source' => NULL,
                'visibilite' => 'Public',
                'description' => 'Titouane - Je veux',
                'playlist' => NULL,
                'tags' => NULL,
                'url_youtube' => 'https://www.youtube.com/shorts/THyIPvd7pWI',
                'date_enregistrement' => '2023-02-07 15:00:00',
                'date_publication' => '2023-02-21 15:00:02',
                'date_creation' => '2023-02-21 15:00:02',
                'date_modification' => '2023-02-21 15:00:00',
                'id_content_experience' => 28,
            ),
            6 => 
            array (
                'id_video_youtube' => 7,
                'titre' => 'Thomas - Break my heart again',
                'categorie' => 'Shorts',
                'url_source' => NULL,
                'visibilite' => 'Public',
                'description' => 'Thomas - Break my heart again',
                'playlist' => NULL,
                'tags' => NULL,
                'url_youtube' => 'https://www.youtube.com/shorts/1NyZvT9JZro',
                'date_enregistrement' => '2023-02-08 15:00:00',
                'date_publication' => '2023-02-22 15:00:02',
                'date_creation' => '2023-02-22 15:00:02',
                'date_modification' => '2023-02-22 15:00:00',
                'id_content_experience' => 29,
            ),
        ));
        
        
    }
}