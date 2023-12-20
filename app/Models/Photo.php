<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Photo
 * 
 * @property int $id_photo
 * @property string|null $description
 * @property string|null $url
 * @property int $id_content_experience
 * 
 * @property ContentsExperience $contents_experience
 *
 * @package App\Models
 */
class Photo extends Model
{
	protected $table = 'photo';
	protected $primaryKey = 'id_photo';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'id_content_experience' => 'int'
	];

	protected $fillable = [
		'description',
		'url',
		'id_content_experience'
	];

	public function contents_experience()
	{
		return $this->belongsTo(ContentsExperience::class, 'id_content_experience');
	}
}
