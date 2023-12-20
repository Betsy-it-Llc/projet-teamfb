<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SegementsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('segements')->delete();
        
        \DB::table('segements')->insert(array (
            0 => 
            array (
                'id_segment' => 1,
                'nom_segment' => 'Groupe Ville 1',
                'theme' => 'theme1',
                'type' => 'type1',
                'caracteristique' => 'caracteristiqu1',
                'description' => 'Groupe Ville, Réactifs',
                'nom_segmentation' => 'segmentation initiale',
                'nb_groupe' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id_segment' => 2,
                'nom_segment' => 'Groupe Photo et montagne 2',
                'theme' => 'theme2',
                'type' => 'type2',
                'caracteristique' => 'caracteristiqu2',
                'description' => 'Post uniquement visuel, nature/ montagne',
                'nom_segmentation' => 'segmentation initiale',
                'nb_groupe' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id_segment' => 3,
                'nom_segment' => 'Thématique Toulouse 3',
                'theme' => 'theme3',
                'type' => 'type3',
                'caracteristique' => 'caracteristique3',
                'description' => 'Groupe thématique à Toulouse',
                'nom_segmentation' => 'segmentation initiale',
                'nb_groupe' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id_segment' => 4,
                'nom_segment' => 'Thématique Larges 4',
                'theme' => 'theme4',
                'type' => 'type4',
                'caracteristique' => 'caracteristique4',
                'description' => 'Groupe thématique larges sans facteur géographique ',
                'nom_segmentation' => 'segmentation initiale',
                'nb_groupe' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id_segment' => 5,
                'nom_segment' => 'Autres 5',
                'theme' => 'theme5',
                'type' => 'type5',
                'caracteristique' => 'caracteristique5',
                'description' => 'Autre, groupes variés/ troc-ventes...',
                'nom_segmentation' => 'segmentation initiale',
                'nb_groupe' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id_segment' => 6,
                'nom_segment' => 'A-Promo Possible',
                'theme' => NULL,
                'type' => NULL,
                'caracteristique' => NULL,
                'description' => NULL,
                'nom_segmentation' => 'Promo',
                'nb_groupe' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id_segment' => 7,
                'nom_segment' => 'B- Promo possible si événement',
                'theme' => NULL,
                'type' => NULL,
                'caracteristique' => NULL,
                'description' => NULL,
                'nom_segmentation' => 'Promo',
                'nb_groupe' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id_segment' => 8,
                'nom_segment' => 'C- Promo Safe',
                'theme' => NULL,
                'type' => NULL,
                'caracteristique' => NULL,
                'description' => NULL,
                'nom_segmentation' => 'Promo',
                'nb_groupe' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id_segment' => 9,
                'nom_segment' => 'Entraide/ Ventes',
                'theme' => '',
                'type' => '',
                'caracteristique' => '',
                'description' => 'Groupes troc/ ventes/ dons + entraide/ ville',
                'nom_segmentation' => 'Groupes indéfinis',
                'nb_groupe' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id_segment' => 10,
                'nom_segment' => 'Groupes Avesta',
                'theme' => '',
                'type' => '',
                'caracteristique' => '',
            'description' => 'Groupes issu de l\'import (ajout/ adhésion manuelle Avesta)',
                'nom_segmentation' => 'Présentation Laura',
                'nb_groupe' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id_segment' => 12,
            'nom_segment' => '2. Prescripteurs (les proches, parents)',
                'theme' => NULL,
                'type' => NULL,
                'caracteristique' => NULL,
                'description' => NULL,
                'nom_segmentation' => 'PassCulture Occitanie',
                'nb_groupe' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id_segment' => 13,
            'nom_segment' => 'Organismes (assos, sociaux, structures ) CHLOÉ',
                'theme' => '',
                'type' => '',
                'caracteristique' => '',
                'description' => 'Groupe d\'association sportives etc pour segment PassCulture ',
                'nom_segmentation' => 'PassCulture Occitanie',
                'nb_groupe' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id_segment' => 6668,
                'nom_segment' => 'Présentation Laura',
                'theme' => 'Campagne présentation Nouveau groupe',
                'type' => 'type1',
                'caracteristique' => 'Nouveau groupe',
                'description' => '1er post de tous les nouveau groupe associé  a laura',
                'nom_segmentation' => 'Campagne Présentation  Amabassadeurs',
                'nb_groupe' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id_segment' => 6669,
                'nom_segment' => 'Présentation Chloé',
                'theme' => 'Campagne présentation Nouveau groupe',
                'type' => 'type1',
                'caracteristique' => '',
                'description' => 'Premier post dans les groupes associé a Chloé',
                'nom_segmentation' => 'Campagne Présentation  Amabassadeurs',
                'nb_groupe' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id_segment' => 6670,
                'nom_segment' => 'Test Pour Import Liste groupe dans campagne',
                'theme' => '',
                'type' => 'type2',
                'caracteristique' => 'Test POur Import Lioste groupe dans campagne',
                'description' => 'Test POur Import Lioste groupe dans campagne',
                'nom_segmentation' => 'Segmentation test pour import list group',
                'nb_groupe' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id_segment' => 6671,
                'nom_segment' => 'test nouveau',
                'theme' => 'test nouveau',
                'type' => 'type1',
                'caracteristique' => 'test nouveau',
                'description' => 'test nouveau',
                'nom_segmentation' => 'Segmentation test pour import list group',
                'nb_groupe' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id_segment' => 6672,
                'nom_segment' => 'liste du jours 2022',
                'theme' => '',
                'type' => 'type1',
                'caracteristique' => '',
                'description' => 'test avec reda',
                'nom_segmentation' => 'segmentation initiale',
                'nb_groupe' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id_segment' => 6673,
                'nom_segment' => 'reda test 2 liste',
                'theme' => '',
                'type' => '',
                'caracteristique' => '',
                'description' => '',
                'nom_segmentation' => 'segmentation initiale',
                'nb_groupe' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id_segment' => 6678,
                'nom_segment' => 'farah-djazia',
                'theme' => 'Choisir un thème',
                'type' => 'Choisir un type',
                'caracteristique' => NULL,
                'description' => NULL,
                'nom_segmentation' => 'Promo',
                'nb_groupe' => NULL,
                'created_at' => '2022-09-05 14:40:56',
                'updated_at' => '2022-09-05 14:40:56',
            ),
        ));
        
        
    }
}