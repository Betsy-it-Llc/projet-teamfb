<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TagInteraction
 * 
 * @property int $id_tag_interaction
 * @property string|null $tag
 * 
 * @property Collection|InteractionTag[] $interaction_tags
 *
 * @package App\Models
 */
class TagInteraction extends Model
{
	protected $table = 'tag_interaction';
	protected $primaryKey = 'id_tag_interaction';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $fillable = [
		'tag'
	];

	public function interaction_tags()
	{
		return $this->hasMany(InteractionTag::class, 'id_tag_interaction');
	}
}
