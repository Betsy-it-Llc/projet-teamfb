<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Storytelling
 * 
 * @property int $id_storytelling
 * @property int $id_content_experience
 * @property string|null $description
 * @property string|null $tags
 * @property Carbon|null $date_creation
 * @property Carbon|null $date_update
 * 
 * @property ContentsExperience $contents_experience
 * @property Collection|TagStorytelling[] $tag_storytellings
 *
 * @package App\Models
 */
class Storytelling extends Model
{
	protected $table = 'storytelling';
	protected $primaryKey = 'id_storytelling';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'id_content_experience' => 'int',
		'date_creation' => 'datetime',
		'date_update' => 'datetime'
	];

	protected $fillable = [
		'id_content_experience',
		'description',
		'tags',
		'date_creation',
		'date_update'
	];

	public function contents_experience()
	{
		return $this->belongsTo(ContentsExperience::class, 'id_content_experience');
	}

	public function tag_storytellings()
	{
		return $this->hasMany(TagStorytelling::class, 'id_storytelling');
	}
}
