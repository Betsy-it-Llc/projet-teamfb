<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PersonaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::connection('mysql2')->table('persona')->delete();
        
        \DB::connection('mysql2')->table('persona')->insert(array (
            0 => 
            array (
                'id_persona' => 1,
                'tag' => 'har',
                'avatar' => NULL,
                'description_generale' => NULL,
                'age' => NULL,
                'genre' => NULL,
                'niveau_education' => NULL,
                'situation_familiale' => NULL,
                'profession' => NULL,
                'geographie' => NULL,
                'revenu' => NULL,
                'objectifs_principaux' => NULL,
                'defis' => NULL,
                'methode_achat' => NULL,
                'facteurs_decision' => NULL,
                'frequence_achat' => NULL,
                'media_prefere' => NULL,
                'centres_interet' => NULL,
                'marques_produits_preferes' => NULL,
                'citations_fictives' => NULL,
                'objections_potentielles' => NULL,
                'solution_proposee' => NULL,
                'motivations_achat' => NULL,
                'canal_acquisition' => NULL,
            ),
            1 => 
            array (
                'id_persona' => 2,
                'tag' => 'k,ss',
                'avatar' => NULL,
                'description_generale' => NULL,
                'age' => NULL,
                'genre' => NULL,
                'niveau_education' => NULL,
                'situation_familiale' => NULL,
                'profession' => NULL,
                'geographie' => NULL,
                'revenu' => NULL,
                'objectifs_principaux' => NULL,
                'defis' => NULL,
                'methode_achat' => NULL,
                'facteurs_decision' => NULL,
                'frequence_achat' => NULL,
                'media_prefere' => NULL,
                'centres_interet' => NULL,
                'marques_produits_preferes' => NULL,
                'citations_fictives' => NULL,
                'objections_potentielles' => NULL,
                'solution_proposee' => NULL,
                'motivations_achat' => NULL,
                'canal_acquisition' => NULL,
            ),
            2 => 
            array (
                'id_persona' => 3,
                'tag' => 'tag',
                'avatar' => NULL,
                'description_generale' => NULL,
                'age' => NULL,
                'genre' => NULL,
                'niveau_education' => NULL,
                'situation_familiale' => NULL,
                'profession' => NULL,
                'geographie' => NULL,
                'revenu' => NULL,
                'objectifs_principaux' => NULL,
                'defis' => NULL,
                'methode_achat' => NULL,
                'facteurs_decision' => NULL,
                'frequence_achat' => NULL,
                'media_prefere' => NULL,
                'centres_interet' => NULL,
                'marques_produits_preferes' => NULL,
                'citations_fictives' => NULL,
                'objections_potentielles' => NULL,
                'solution_proposee' => NULL,
                'motivations_achat' => NULL,
                'canal_acquisition' => NULL,
            ),
        ));
        
        
    }
}