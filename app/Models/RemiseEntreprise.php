<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RemiseEntreprise
 * 
 * @property int $id_remise
 * @property int $id_organisation
 * 
 * @property Remise $remise
 * @property Organisation $organisation
 *
 * @package App\Models
 */
class RemiseEntreprise extends Model
{
	protected $table = 'remise_entreprise';
	public $incrementing = false;
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'id_remise' => 'int',
		'id_organisation' => 'int'
	];

	public function remise()
	{
		return $this->belongsTo(Remise::class, 'id_remise');
	}

	public function organisation()
	{
		return $this->belongsTo(Organisation::class, 'id_organisation');
	}
}
