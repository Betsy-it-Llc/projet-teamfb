<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TagStory
 * 
 * @property int $id_tag_story
 * @property string|null $tag
 * 
 * @property Collection|TagStorytelling[] $tag_storytellings
 *
 * @package App\Models
 */
class TagStory extends Model
{
	protected $table = 'tag_story';
	protected $primaryKey = 'id_tag_story';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $fillable = [
		'tag'
	];

	public function tag_storytellings()
	{
		return $this->hasMany(TagStorytelling::class, 'id_tag_story');
	}
}
