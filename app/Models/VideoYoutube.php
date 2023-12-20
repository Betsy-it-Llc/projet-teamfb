<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VideoYoutube
 * 
 * @property int $id_video_youtube
 * @property string|null $titre
 * @property string|null $categorie
 * @property string|null $url_source
 * @property string|null $visibilite
 * @property string|null $description
 * @property string|null $playlist
 * @property string|null $tags
 * @property string|null $url_youtube
 * @property Carbon|null $date_enregistrement
 * @property Carbon|null $date_publication
 * @property Carbon|null $date_creation
 * @property Carbon|null $date_modification
 * @property int $id_content_experience
 * 
 * @property ContentsExperience $contents_experience
 *
 * @package App\Models
 */
class VideoYoutube extends Model
{
	protected $table = 'video_youtube';
	protected $primaryKey = 'id_video_youtube';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'date_enregistrement' => 'datetime',
		'date_publication' => 'datetime',
		'date_creation' => 'datetime',
		'date_modification' => 'datetime',
		'id_content_experience' => 'int'
	];

	protected $fillable = [
		'titre',
		'categorie',
		'url_source',
		'visibilite',
		'description',
		'playlist',
		'tags',
		'url_youtube',
		'date_enregistrement',
		'date_publication',
		'date_creation',
		'date_modification',
		'id_content_experience'
	];

	public function contents_experience()
	{
		return $this->belongsTo(ContentsExperience::class, 'id_content_experience');
	}
}
