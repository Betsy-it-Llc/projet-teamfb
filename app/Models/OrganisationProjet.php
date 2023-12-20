<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrganisationProjet
 * 
 * @property int $id_organisation
 * @property int $id_projet
 * 
 * @property Organisation $organisation
 * @property Projet $projet
 *
 * @package App\Models
 */
class OrganisationProjet extends Model
{
	protected $table = 'organisation_projet';
	public $incrementing = false;
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'id_organisation' => 'int',
		'id_projet' => 'int'
	];

	public function organisation()
	{
		return $this->belongsTo(Organisation::class, 'id_organisation');
	}

	public function projet()
	{
		return $this->belongsTo(Projet::class, 'id_projet');
	}
}
