<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class InteractionTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('interaction')->delete();
        
        \DB::table('interaction')->insert(array (
            0 => 
            array (
                'id_interaction' => 2,
                'date_heure' => '2023-05-16 15:09:10',
                'texte' => 'sdfsdfs',
                'type_interaction' => 'sdf',
                'id_contact' => 140,
                'id_experience' => 82,
            ),
            1 => 
            array (
                'id_interaction' => 3,
                'date_heure' => '2023-05-16 15:09:13',
                'texte' => 'sdfsdfs',
                'type_interaction' => 'sdf',
                'id_contact' => 140,
                'id_experience' => 82,
            ),
            2 => 
            array (
                'id_interaction' => 4,
                'date_heure' => '2023-05-16 15:10:19',
                'texte' => 'test3test3test3test3test3test3test3test3test3',
                'type_interaction' => 'test3',
                'id_contact' => 140,
                'id_experience' => 82,
            ),
            3 => 
            array (
                'id_interaction' => 5,
                'date_heure' => '2023-05-16 23:22:17',
                'texte' => 'Pierre Ulysse est thérapeute Et Educateur  , et nous a trouver via Google  , il recherchais un studio   pour enregistrer des sosn',
                'type_interaction' => 'Pour les deux expérience',
                'id_contact' => 141,
                'id_experience' => 83,
            ),
            4 => 
            array (
                'id_interaction' => 6,
                'date_heure' => '2023-05-17 21:52:11',
                'texte' => 'test interration',
                'type_interaction' => 'Test Interaction',
                'id_contact' => 141,
                'id_experience' => NULL,
            ),
            5 => 
            array (
                'id_interaction' => 7,
                'date_heure' => '2023-05-17 22:05:25',
                'texte' => 'Il a été agressé au couteau quelque jours avant de venir au studio',
                'type_interaction' => 'Anecdote',
                'id_contact' => 141,
                'id_experience' => 83,
            ),
            6 => 
            array (
                'id_interaction' => 8,
                'date_heure' => '2023-05-21 13:57:35',
                'texte' => 'Goole    recherche studio depuis 2 ans il n\'avais pas enregistré ..
Profil Passion rap',
                'type_interaction' => 'Comment',
                'id_contact' => 141,
                'id_experience' => 85,
            ),
            7 => 
            array (
                'id_interaction' => 9,
                'date_heure' => '2023-05-22 21:08:28',
                'texte' => 'Ma Tel Pour prendre des Infos afin de réserver  
- Souhaite réserver une expérience pour sa maman qui prend des cours de chant
- Cadeau commun avec plusieurs personnes de la famille 
- L\'idée vient de son frère qui est musicien  .',
                'type_interaction' => 'Explication',
                'id_contact' => 142,
                'id_experience' => 87,
            ),
            8 => 
            array (
                'id_interaction' => 10,
                'date_heure' => '2023-05-22 21:15:41',
                'texte' => 'nous a donné beaucoup d\'info sur les problème du parcours de réservation  client  .. trop Email / Manque de clarté  / explication expérience Utilisateur',
                'type_interaction' => 'Echange',
                'id_contact' => 142,
                'id_experience' => 87,
            ),
            9 => 
            array (
                'id_interaction' => 11,
                'date_heure' => '2023-05-24 22:30:58',
                'texte' => 'travaille Chez Orange
Pot de départ 
Clip  
Viens avec 2 collègues pour faire une surprise
12 /6 16h 18h',
                'type_interaction' => 'pourquoi',
                'id_contact' => 143,
                'id_experience' => NULL,
            ),
            10 => 
            array (
                'id_interaction' => 12,
                'date_heure' => '2023-06-01 22:09:28',
                'texte' => 'Anais vernede est la soeur de victor Vernede 
- Victor est venu  au mois de décembre, et  son autre frère lui avait offert le bon cadeau 
- C\'est sa Maman Qui lui a Offert le bon cadeau  , mais cest-elle qui a directement réservé',
                'type_interaction' => 'Info',
                'id_contact' => 146,
                'id_experience' => 90,
            ),
            11 => 
            array (
                'id_interaction' => 13,
                'date_heure' => '2023-06-05 19:49:37',
                'texte' => 'Personne a Tel  pour EVG 6 Personnes( donc 5 filles.
A été recommandé par Coiffeuse  .. // Prise d\'information ,mais na pas retel',
                    'type_interaction' => 'Infomation',
                    'id_contact' => 144,
                    'id_experience' => NULL,
                ),
                12 => 
                array (
                    'id_interaction' => 14,
                    'date_heure' => '2023-06-05 21:05:28',
                    'texte' => 'test
teste
te
st',
                    'type_interaction' => 'teste intéraction',
                    'id_contact' => 144,
                    'id_experience' => NULL,
                ),
                13 => 
                array (
                    'id_interaction' => 18,
                    'date_heure' => '2023-06-09 14:20:00',
                    'texte' => 'Echange suite demande de réservation 
- Ai retel suite question sur nombre de chanson. 
- Ad\'abords Choisis 3 puis a trouvé cela trop chère   alors m\'a demandé de passer a 2 chansons lors de notre échange téléphonique.
- Ai eu un doutes pour l\'enregistrement  du non dans le formulaire s\'il devait mettre ses coordonnées ou celle de sa soeur  !',
                    'type_interaction' => 'USER EXPERIENCE',
                    'id_contact' => 148,
                    'id_experience' => NULL,
                ),
                14 => 
                array (
                    'id_interaction' => 19,
                    'date_heure' => '2023-07-26 19:16:46',
                    'texte' => 'A payer que 285 euro au lien de 325 du  / ok ai eu client / soit paye le jour du studio/renvoier un autre paiement
--------------
A régularisé !!',
                    'type_interaction' => NULL,
                    'id_contact' => 150,
                    'id_experience' => 94,
                ),
                15 => 
                array (
                    'id_interaction' => 20,
                    'date_heure' => '2023-06-21 12:14:09',
                    'texte' => 'Mme la montagne est une Anglaise mariée à un français. Elle a tel pour demander   info pour réserver pour son mari, car elle voulait venir vendredi, .? ..Finallement elle n\'a pas payer la réservation , probléme d\'incompréhension, je pense',
                    'type_interaction' => NULL,
                    'id_contact' => 151,
                    'id_experience' => NULL,
                ),
                16 => 
                array (
                    'id_interaction' => 22,
                    'date_heure' => '2023-06-21 12:34:40',
                    'texte' => 'Elle souhaite acheter un cadeau a son mari Yve - car il aime chanter , et ses amies lui on dit qu\'il etait doué ..',
                    'type_interaction' => NULL,
                    'id_contact' => 151,
                    'id_experience' => NULL,
                ),
                17 => 
                array (
                    'id_interaction' => 23,
                    'date_heure' => '2023-06-29 14:08:11',
                    'texte' => 'Sous titre pour accompagner la video Orange marion Azoulay',
                    'type_interaction' => 'Raison_Achat',
                    'id_contact' => 155,
                    'id_experience' => NULL,
                ),
                18 => 
                array (
                    'id_interaction' => 24,
                    'date_heure' => '2023-06-30 20:32:46',
                    'texte' => 'Ils ont trouvé expérience super . 
On fait que des bon retour',
                    'type_interaction' => 'Feedback',
                    'id_contact' => 143,
                    'id_experience' => 91,
                ),
                19 => 
                array (
                    'id_interaction' => 25,
                    'date_heure' => '2023-07-18 20:25:12',
                    'texte' => 'il manquait 2 personnes a payer, A Payé rapidement ma demander de lui faire parvenir, la version en Mp3',
                    'type_interaction' => 'Note',
                    'id_contact' => 108,
                    'id_experience' => NULL,
                ),
                20 => 
                array (
                    'id_interaction' => 27,
                    'date_heure' => '2023-08-11 14:38:48',
                    'texte' => 'djrjr',
                    'type_interaction' => NULL,
                    'id_contact' => 305,
                    'id_experience' => 322,
                ),
                21 => 
                array (
                    'id_interaction' => 28,
                    'date_heure' => '2023-08-11 14:40:42',
                    'texte' => 'jdj',
                    'type_interaction' => NULL,
                    'id_contact' => 305,
                    'id_experience' => 322,
                ),
                22 => 
                array (
                    'id_interaction' => 29,
                    'date_heure' => '2023-08-11 14:41:44',
                    'texte' => 'jjtbtbt',
                    'type_interaction' => NULL,
                    'id_contact' => 305,
                    'id_experience' => 322,
                ),
                23 => 
                array (
                    'id_interaction' => 30,
                    'date_heure' => '2023-08-14 14:31:18',
                    'texte' => 'ù$ù',
                    'type_interaction' => NULL,
                    'id_contact' => 305,
                    'id_experience' => 322,
                ),
                24 => 
                array (
                    'id_interaction' => 31,
                    'date_heure' => '2023-08-14 14:31:39',
                    'texte' => 'ijijijij',
                    'type_interaction' => NULL,
                    'id_contact' => 305,
                    'id_experience' => 322,
                ),
                25 => 
                array (
                    'id_interaction' => 32,
                    'date_heure' => '2023-08-14 14:32:00',
                    'texte' => 'ikjiojiojoijoijioj',
                    'type_interaction' => NULL,
                    'id_contact' => 305,
                    'id_experience' => 322,
                ),
                26 => 
                array (
                    'id_interaction' => 33,
                    'date_heure' => '2023-08-16 14:08:39',
                    'texte' => 'test',
                    'type_interaction' => NULL,
                    'id_contact' => 189,
                    'id_experience' => NULL,
                ),
            ));
        
        
    }
}