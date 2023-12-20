<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ContentsExperience
 * 
 * @property int $id_content_experience
 * @property Carbon|null $date_heure
 * @property Carbon|null $date_update
 * @property string|null $description_
 * @property string|null $type
 * @property int $id_experience
 * 
 * @property Experience $experience
 * @property BonCadeau $bon_cadeau
 * @property Livrable $livrable
 * @property MediasLalachante $medias_lalachante
 * @property Photo $photo
 * @property Son $son
 * @property Storytelling $storytelling
 * @property Video $video
 * @property VideoYoutube $video_youtube
 *
 * @package App\Models
 */
class ContentsExperience extends Model
{
	protected $table = 'contents_experience';
	protected $primaryKey = 'id_content_experience';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'date_heure' => 'datetime',
		'date_update' => 'datetime',
		'id_experience' => 'int'
	];

	protected $fillable = [
		'date_heure',
		'date_update',
		'description_',
		'type',
		'id_experience'
	];

	public function experience()
	{
		return $this->belongsTo(Experience::class, 'id_experience');
	}

	public function bon_cadeau()
	{
		return $this->hasOne(BonCadeau::class, 'id_content_experience');
	}

	public function livrable()
	{
		return $this->hasOne(Livrable::class, 'id_content_experience');
	}

	public function medias_lalachante()
	{
		return $this->hasOne(MediasLalachante::class, 'id_content_experience');
	}

	public function photo()
	{
		return $this->hasOne(Photo::class, 'id_content_experience');
	}

	public function son()
	{
		return $this->hasOne(Son::class, 'id_content_experience');
	}

	public function storytelling()
	{
		return $this->hasOne(Storytelling::class, 'id_content_experience');
	}

	public function video()
	{
		return $this->hasOne(Video::class, 'id_content_experience');
	}

	public function video_youtube()
	{
		return $this->hasOne(VideoYoutube::class, 'id_content_experience');
	}
}
