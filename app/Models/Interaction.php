<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Interaction
 * 
 * @property int $id_interaction
 * @property Carbon|null $date_heure
 * @property string|null $texte
 * @property string|null $type_interaction
 * @property int|null $id_contact
 * @property int|null $id_experience
 * 
 * @property Contact|null $contact
 * @property Experience|null $experience
 * @property Collection|InteractionTag[] $interaction_tags
 *
 * @package App\Models
 */
class Interaction extends Model
{
	protected $table = 'interaction';
	protected $primaryKey = 'id_interaction';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'date_heure' => 'datetime',
		'id_contact' => 'int',
		'id_experience' => 'int'
	];

	protected $fillable = [
		'date_heure',
		'texte',
		'type_interaction',
		'id_contact',
		'id_experience'
	];

	public function contact()
	{
		return $this->belongsTo(Contact::class, 'id_contact');
	}

	public function experience()
	{
		return $this->belongsTo(Experience::class, 'id_experience');
	}

	public function interaction_tags()
	{
		return $this->hasMany(InteractionTag::class, 'id_interaction');
	}
}
