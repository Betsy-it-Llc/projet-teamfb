<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CampagneSegmentTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('campagne_segment')->delete();
        
        \DB::table('campagne_segment')->insert(array (
            0 => 
            array (
                'id_segment' => 1,
                'id_campagne' => 16,
                'lien_legende_post_partage' => NULL,
                'legende_post_partage' => 'Voila c\'est bientôt la rentrée, j\'espère que vous avez bien profité de votre été',
            ),
            1 => 
            array (
                'id_segment' => 1,
                'id_campagne' => 18,
                'lien_legende_post_partage' => NULL,
                'legende_post_partage' => 'Petite envie de partager avec vous l\'expérience de Noémie qui nous offre une expérience unique qui me rappelle les nuits d\'été au bord de la mer',
            ),
            2 => 
            array (
                'id_segment' => 2,
                'id_campagne' => 16,
                'lien_legende_post_partage' => NULL,
                'legende_post_partage' => 'Petit post pour vous souhaiter une belle rentrée à tous ! ',
            ),
            3 => 
            array (
                'id_segment' => 2,
                'id_campagne' => 17,
                'lien_legende_post_partage' => NULL,
                'legende_post_partage' => 'Petit post pour vous souhaiter un joli mois de septembre et un chouette Dimanche',
            ),
            4 => 
            array (
                'id_segment' => 3,
                'id_campagne' => 16,
                'lien_legende_post_partage' => NULL,
                'legende_post_partage' => 'J\'espère que vous avez profité de votre été',
            ),
            5 => 
            array (
                'id_segment' => 3,
                'id_campagne' => 18,
                'lien_legende_post_partage' => NULL,
                'legende_post_partage' => 'Petite envie de partager avec vous l\'expérience de Noémie qui nous offre une expérience unique qui me rappelle les nuits d\'été au bord de la mer',
            ),
            6 => 
            array (
                'id_segment' => 4,
                'id_campagne' => 16,
                'lien_legende_post_partage' => NULL,
                'legende_post_partage' => 'Je vous souhaite à tous une belle reprise et une belle rentrée ',
            ),
            7 => 
            array (
                'id_segment' => 4,
                'id_campagne' => 18,
                'lien_legende_post_partage' => NULL,
                'legende_post_partage' => 'Petite envie de partager avec vous l\'expérience de Noémie qui nous offre une expérience unique qui me rappelle les nuits d\'été au bord de la mer',
            ),
            8 => 
            array (
                'id_segment' => 4,
                'id_campagne' => 21,
                'lien_legende_post_partage' => NULL,
                'legende_post_partage' => 'Avesta Llc - Aujourd’hui à 12:35',
            ),
            9 => 
            array (
                'id_segment' => 5,
                'id_campagne' => 16,
                'lien_legende_post_partage' => NULL,
                'legende_post_partage' => 'Petit post pour vous souhaiter une belle rentrée à tous ! ',
            ),
            10 => 
            array (
                'id_segment' => 5,
                'id_campagne' => 18,
                'lien_legende_post_partage' => NULL,
                'legende_post_partage' => 'Petite envie de partager avec vous l\'expérience de Noémie qui nous offre une expérience unique qui me rappelle les nuits d\'été au bord de la mer',
            ),
            11 => 
            array (
                'id_segment' => 9,
                'id_campagne' => 0,
                'lien_legende_post_partage' => NULL,
                'legende_post_partage' => 'test Publication dans les Groupes',
            ),
            12 => 
            array (
                'id_segment' => 10,
                'id_campagne' => 0,
                'lien_legende_post_partage' => NULL,
                'legende_post_partage' => '’espère que vous vous portez bien.',
            ),
        ));
        
    }
}