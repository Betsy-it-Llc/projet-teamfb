<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Son
 * 
 * @property int $id_son
 * @property string|null $description
 * @property string|null $url
 * @property int $id_content_experience
 * 
 * @property ContentsExperience $contents_experience
 *
 * @package App\Models
 */
class Son extends Model
{
	protected $table = 'son';
	protected $primaryKey = 'id_son';
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
