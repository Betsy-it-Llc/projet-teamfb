<?php

/**
 * Created by Reliese Model.
 */

namespace App\experienceApp\Models;

use App\Models\experienceApp\Contact;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Persona
 * 
 * @property int $id_persona
 * @property string|null $tag
 * @property string|null $avatar
 * @property string|null $description_generale
 * @property int|null $age
 * @property string|null $genre
 * @property string|null $niveau_education
 * @property string|null $situation_familiale
 * @property string|null $profession
 * @property string|null $geographie
 * @property float|null $revenu
 * @property string|null $objectifs_principaux
 * @property string|null $defis
 * @property string|null $methode_achat
 * @property string|null $facteurs_decision
 * @property string|null $frequence_achat
 * @property string|null $media_prefere
 * @property string|null $centres_interet
 * @property string|null $marques_produits_preferes
 * @property string|null $citations_fictives
 * @property string|null $objections_potentielles
 * @property string|null $solution_proposée
 * @property string|null $motivations_achat
 * @property string|null $canal_acquisition
 * 
 * @property Collection|Contact[] $contacts
 *
 * @package App\Models\
 */
class Persona extends Model
{
	protected $table = 'persona';
	protected $primaryKey = 'id_persona';
	public $timestamps = false;

	protected $casts = [
		'age' => 'int',
		'revenu' => 'float'
	];

	protected $fillable = [
		'tag',
		'avatar',
		'description_generale',
		'age',
		'genre',
		'niveau_education',
		'situation_familiale',
		'profession',
		'geographie',
		'revenu',
		'objectifs_principaux',
		'defis',
		'methode_achat',
		'facteurs_decision',
		'frequence_achat',
		'media_prefere',
		'centres_interet',
		'marques_produits_preferes',
		'citations_fictives',
		'objections_potentielles',
		'solution_proposee',
		'motivations_achat',
		'canal_acquisition'
	];

	public function contacts()
	{
		return $this->belongsToMany(Contact::class, 'contact_persona', 'id_persona', 'id_contact');
	}
}
