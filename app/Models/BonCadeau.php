<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BonCadeau
 * 
 * @property int $id_bonCadeau
 * @property string|null $nom_destinataire
 * @property string|null $titre
 * @property string|null $message
 * @property string|null $url
 * @property int $id_content_experience
 * 
 * @property ContentsExperience $contents_experience
 *
 * @package App\Models
 */
class BonCadeau extends Model
{
	protected $table = 'bon_cadeau';
	protected $primaryKey = 'id_bonCadeau';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'id_content_experience' => 'int'
	];

	protected $fillable = [
		'nom_destinataire',
		'titre',
		'message',
		'url',
		'id_content_experience',
		'drive_url'
	];

	public function contents_experience()
	{
		return $this->belongsTo(ContentsExperience::class, 'id_content_experience');
	}
}
