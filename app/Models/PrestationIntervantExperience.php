<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PrestationIntervantExperience
 * 
 * @property int $id_experience
 * @property int $id_prestation_intervenant
 * 
 * @property Experience $experience
 * @property PrestationIntervenant $prestation_intervenant
 *
 * @package App\Models
 */
class PrestationIntervantExperience extends Model
{
	protected $table = 'prestation_intervant_experience';
	public $incrementing = false;
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'id_experience' => 'int',
		'id_prestation_intervenant' => 'int'
	];

	public function experience()
	{
		return $this->belongsTo(Experience::class, 'id_experience');
	}

	public function prestation_intervenant()
	{
		return $this->belongsTo(PrestationIntervenant::class, 'id_prestation_intervenant');
	}
}
