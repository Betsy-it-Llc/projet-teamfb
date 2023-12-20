<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProjetsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::connection('mysql2')->table('projets')->delete();
        
        \DB::connection('mysql2')->table('projets')->insert(array (
            0 => 
            array (
                'id_projet' => 1,
                'nom' => 'projet Eni',
                'description_courte' => NULL,
                'description_detaille' => NULL,
                'objectif_financier' => NULL,
                'info_contributeur' => 'info vers contributeur',
                'date_creation' => '2023-05-12 14:21:00',
                'date_fin' => NULL,
                'visibilite' => 'public',
                'id_type_projet' => 1,
                'id_statut_projet' => 1,
            ),
            1 => 
            array (
                'id_projet' => 2,
                'nom' => 'projet Eni Aimouski',
                'description_courte' => NULL,
                'description_detaille' => NULL,
                'objectif_financier' => NULL,
                'info_contributeur' => 'info vers contributeur',
                'date_creation' => '2023-05-12 14:21:00',
                'date_fin' => NULL,
                'visibilite' => 'public',
                'id_type_projet' => 1,
                'id_statut_projet' => 1,
            ),
            2 => 
            array (
                'id_projet' => 3,
                'nom' => 'Projet experience',
                'description_courte' => 'Projet experience Descritpion',
                'description_detaille' => 'Projet experience Descritpion Details',
                'objectif_financier' => 300.0,
                'info_contributeur' => NULL,
                'date_creation' => '2023-09-04 10:17:25',
                'date_fin' => NULL,
                'visibilite' => 'Public',
                'id_type_projet' => NULL,
                'id_statut_projet' => NULL,
            ),
            3 => 
            array (
                'id_projet' => 4,
                'nom' => 'Projet experience Ga',
                'description_courte' => NULL,
                'description_detaille' => 'Afin de vivre l\'experience LalaChante',
                'objectif_financier' => 385.0,
                'info_contributeur' => NULL,
                'date_creation' => '2023-10-02 17:51:11',
                'date_fin' => NULL,
                'visibilite' => 'Public',
                'id_type_projet' => 2,
                'id_statut_projet' => 2,
            ),
            4 => 
            array (
                'id_projet' => 5,
                'nom' => 'Projet equie foot',
                'description_courte' => NULL,
                'description_detaille' => 'Afin de financer les vacances de ntre equipe de foot',
                'objectif_financier' => NULL,
                'info_contributeur' => NULL,
                'date_creation' => '2023-10-02 18:07:45',
                'date_fin' => '2023-10-31 18:07:45',
                'visibilite' => 'Public',
                'id_type_projet' => 3,
                'id_statut_projet' => 2,
            ),
            5 => 
            array (
                'id_projet' => 6,
                'nom' => 'Projet soutint au resto du coeur',
                'description_courte' => 'Soutenez la cause des restos du coeur',
                'description_detaille' => 'Soutenez la cause des restos du coeur',
                'objectif_financier' => NULL,
                'info_contributeur' => 'Nous vous remercions',
                'date_creation' => '2023-10-01 18:20:27',
                'date_fin' => NULL,
                'visibilite' => 'Public',
                'id_type_projet' => 4,
                'id_statut_projet' => 2,
            ),
            6 => 
            array (
                'id_projet' => 7,
                'nom' => 'projet benevole Resto Coeur',
                'description_courte' => NULL,
                'description_detaille' => NULL,
                'objectif_financier' => NULL,
                'info_contributeur' => NULL,
                'date_creation' => '2023-10-02 18:27:10',
                'date_fin' => '2023-10-02 18:27:10',
                'visibilite' => 'Public',
                'id_type_projet' => 4,
                'id_statut_projet' => 2,
            ),
            7 => 
            array (
                'id_projet' => 8,
                'nom' => 'projet 10 experience au Resto du Coeur',
                'description_courte' => NULL,
                'description_detaille' => NULL,
                'objectif_financier' => NULL,
                'info_contributeur' => NULL,
                'date_creation' => '2023-10-02 18:27:10',
                'date_fin' => '2023-10-02 18:27:10',
                'visibilite' => 'Public',
                'id_type_projet' => 5,
                'id_statut_projet' => 2,
            ),
        ));
        
        
    }
}