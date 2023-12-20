<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InteractionTag
 * 
 * @property int $id_interaction
 * @property int $id_tag_interaction
 * 
 * @property Interaction $interaction
 * @property TagInteraction $tag_interaction
 *
 * @package App\Models
 */
class InteractionTag extends Model
{
	protected $table = 'interaction_tag';
	public $incrementing = false;
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'id_interaction' => 'int',
		'id_tag_interaction' => 'int'
	];

	public function interaction()
	{
		return $this->belongsTo(Interaction::class, 'id_interaction');
	}

	public function tag_interaction()
	{
		return $this->belongsTo(TagInteraction::class, 'id_tag_interaction');
	}
}
