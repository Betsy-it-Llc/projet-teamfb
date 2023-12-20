<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Livrable
 * 
 * @property int $id_livrable_
 * @property string|null $nom
 * @property string|null $type
 * @property Carbon|null $date_envoie
 * @property string|null $url
 * @property Carbon|null $date_creation
 * @property Carbon|null $date_update
 * @property int $id_content_experience
 * 
 * @property ContentsExperience $contents_experience
 *
 * @package App\Models
 */
class Livrable extends Model
{
	protected $table = 'livrables';
	protected $primaryKey = 'id_livrable_';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'date_envoie' => 'datetime',
		'date_creation' => 'datetime',
		'date_update' => 'datetime',
		'id_content_experience' => 'int'
	];

	protected $fillable = [
		'nom',
		'type',
		'date_envoie',
		'url',
		'date_creation',
		'date_update',
		'id_content_experience'
	];

	public function contents_experience()
	{
		return $this->belongsTo(ContentsExperience::class, 'id_content_experience');
	}
}
