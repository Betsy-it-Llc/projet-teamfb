<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PrestationIntervenant
 * 
 * @property int $id_prestation_intervenant
 * @property string|null $type_service
 * @property string|null $description
 * @property float|null $cout
 * @property string|null $unite
 * @property Carbon|null $date_creation
 * @property Carbon|null $date_update
 * @property int $id_intervenant_
 * 
 * @property Intervenant $intervenant
 * @property Collection|PrestationIntervantExperience[] $prestation_intervant_experiences
 *
 * @package App\Models
 */
class PrestationIntervenant extends Model
{
	protected $table = 'prestation_intervenant';
	protected $primaryKey = 'id_prestation_intervenant';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'cout' => 'float',
		'date_creation' => 'datetime',
		'date_update' => 'datetime',
		'id_intervenant_' => 'int'
	];

	protected $fillable = [
		'type_service',
		'description',
		'cout',
		'unite',
		'date_creation',
		'date_update',
		'id_intervenant_'
	];

	public function intervenant()
	{
		return $this->belongsTo(Intervenant::class, 'id_intervenant_');
	}

	public function prestation_intervant_experiences()
	{
		return $this->hasMany(PrestationIntervantExperience::class, 'id_prestation_intervenant');
	}
}
