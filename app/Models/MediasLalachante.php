<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MediasLalachante
 * 
 * @property int $id_media
 * @property string|null $type
 * @property string|null $description
 * @property string|null $url
 * @property Carbon|null $date_creation
 * @property Carbon|null $date_update
 * @property int $id_content_experience
 * 
 * @property ContentsExperience $contents_experience
 *
 * @package App\Models
 */
class MediasLalachante extends Model
{
	protected $table = 'medias_lalachante';
	protected $primaryKey = 'id_media';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'date_creation' => 'datetime',
		'date_update' => 'datetime',
		'id_content_experience' => 'int'
	];

	protected $fillable = [
		'type',
		'description',
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
