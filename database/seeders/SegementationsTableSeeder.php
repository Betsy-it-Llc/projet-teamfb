<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SegementationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('segementations')->delete();
        
        \DB::table('segementations')->insert(array (
            0 => 
            array (
                'id_segmentation' => 1,
                'nom_segmentation' => 'segmentation initiale',
                'criteres' => 'criters',
                'description' => 'Liste de groupes S1, 2, 3, 4, 5 de base issu fichier Sheet',
                'nb_groupe' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id_segmentation' => 2,
                'nom_segmentation' => 'Promo',
                'criteres' => '',
                'description' => 'A-PROMO, B-MOYEN, C-SAFE',
                'nb_groupe' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id_segmentation' => 3,
                'nom_segmentation' => 'List group Brut ',
                'criteres' => 'sans ambassadeur, 
Non Filtré
',
                'description' => 'Tout les nouveau groupe entrés dans la bbd etpas encore selectionné pour Opé 
Sans Ambassadeurs',
                'nb_groupe' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id_segmentation' => 4,
                'nom_segmentation' => 'Groupe Prêt ',
                'criteres' => NULL,
                'description' => 'Group Prêt Pour premiére camapgne 
Ambassadeur Ok
Qualification Ok 
Info group OK 
',
                'nb_groupe' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id_segmentation' => 5,
                'nom_segmentation' => 'Achat_Vente',
                'criteres' => NULL,
                'description' => 'Tt les groupe au format Achat vente',
                'nb_groupe' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id_segmentation' => 6,
                'nom_segmentation' => 'Group_adhésion_Process',
                'criteres' => NULL,
                'description' => 'groupe dans le processus d\'adhésion ',
                'nb_groupe' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id_segmentation' => 7,
                'nom_segmentation' => 'Groupes indéfinis',
                'criteres' => NULL,
                'description' => 'groupe n\'est pas Achats/Ventes ou Classique',
                'nb_groupe' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id_segmentation' => 8,
                'nom_segmentation' => 'Présentation Laura',
                'criteres' => NULL,
                'description' => 'groupe à partager le post Bonjour Laura',
                'nb_groupe' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id_segmentation' => 9,
                'nom_segmentation' => 'PassCulture Occitanie',
                'criteres' => NULL,
                'description' => NULL,
                'nb_groupe' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id_segmentation' => 6673,
                'nom_segmentation' => 'Campagne Présentation  Amabassadeurs',
                'criteres' => '',
                'description' => 'Nouveau groupes dans lesquels personne n\'a encore posté ',
                'nb_groupe' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id_segmentation' => 6681,
                'nom_segmentation' => 'Segmentation test pour import list group',
                'criteres' => '',
                'description' => 'Segmentation test pour import list group',
                'nb_groupe' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id_segmentation' => 6682,
                'nom_segmentation' => 'Music',
                'criteres' => NULL,
                'description' => 'groupe hors région spécialisé Musique',
                'nb_groupe' => NULL,
                'created_at' => NULL,
                'updated_at' => '2022-09-09 23:36:31',
            ),
        ));
        
        
    }
}