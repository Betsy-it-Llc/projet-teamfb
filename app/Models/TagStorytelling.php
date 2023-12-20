<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TagStorytelling
 * 
 * @property int $id_storytelling
 * @property int $id_tag_story
 * 
 * @property Storytelling $storytelling
 * @property TagStory $tag_story
 *
 * @package App\Models
 */
class TagStorytelling extends Model
{
	protected $table = 'tag_storytelling';
	public $incrementing = false;
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'id_storytelling' => 'int',
		'id_tag_story' => 'int'
	];

	public function storytelling()
	{
		return $this->belongsTo(Storytelling::class, 'id_storytelling');
	}

	public function tag_story()
	{
		return $this->belongsTo(TagStory::class, 'id_tag_story');
	}
}
