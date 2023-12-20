<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Evenement
 * 
 * @property int $id_evenement
 * @property string|null $type_evenement
 * @property Carbon|null $date_evenement
 * @property int $id_experience
 * 
 * @property Experience $experience
 *
 * @package App\Models
 */
class Evenement extends Model
{
	protected $table = 'evenement';
	protected $primaryKey = 'id_evenement';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'date_evenement' => 'datetime',
		'id_experience' => 'int'
	];

	protected $fillable = [
		'type_evenement',
		'date_evenement',
		'id_experience'
	];

	public function experience()
	{
		return $this->belongsTo(Experience::class, 'id_experience');
	}
}
