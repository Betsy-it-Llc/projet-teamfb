<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrganisationCagnotte
 * 
 * @property int $id_organisation
 * @property int $id_cagnotte
 * 
 * @property Organisation $organisation
 * @property Cagnotte $cagnotte
 *
 * @package App\Models
 */
class OrganisationCagnotte extends Model
{
	protected $table = 'organisation_cagnotte';
	public $incrementing = false;
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'id_organisation' => 'int',
		'id_cagnotte' => 'int'
	];

	public function organisation()
	{
		return $this->belongsTo(Organisation::class, 'id_organisation');
	}

	public function cagnotte()
	{
		return $this->belongsTo(Cagnotte::class, 'id_cagnotte');
	}
}
