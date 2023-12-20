<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StatutsCagnotte
 * 
 * @property int $id
 * @property string|null $valeur
 * 
 * @property Collection|Cagnotte[] $cagnottes
 *
 * @package App\Models
 */
class StatutsCagnotte extends Model
{
	protected $table = 'statuts_cagnottes';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $fillable = [
		'valeur'
	];

	public function cagnottes()
	{
		return $this->hasMany(Cagnotte::class, 'id_statut_cagnotte');
	}
}
