<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Intervenant
 * 
 * @property int $id_intervenant_
 * @property string|null $ville_intervention
 * @property string|null $role_
 * @property string|null $description
 * @property Carbon|null $date_creation
 * @property Carbon|null $date_update
 * @property int $id_contact
 * 
 * @property Contact $contact
 * @property Collection|PrestationIntervenant[] $prestation_intervenants
 *
 * @package App\Models
 */
class Intervenant extends Model
{
	protected $table = 'intervenant';
	protected $primaryKey = 'id_intervenant_';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'date_creation' => 'datetime',
		'date_update' => 'datetime',
		'id_contact' => 'int'
	];

	protected $fillable = [
		'ville_intervention',
		'role_',
		'description',
		'date_creation',
		'date_update',
		'id_contact',
		'drive_url'
	];

	public function contact()
	{
		return $this->belongsTo(Contact::class, 'id_contact');
	}

	public function prestation_intervenants()
	{
		return $this->hasMany(PrestationIntervenant::class, 'id_intervenant_');
	}
}
