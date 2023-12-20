<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Frai
 * 
 * @property int $id_frais
 * @property float|null $montant
 * @property Carbon|null $date_creation
 * @property string|null $description
 * @property string|null $type
 * @property float|null $valeur
 * 
 * @property Collection|Transaction[] $transactions
 *
 * @package App\Models
 */
class Frai extends Model
{
	protected $table = 'frais';
	protected $primaryKey = 'id_frais';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'montant' => 'float',
		'date_creation' => 'datetime',
		'valeur' => 'float'
	];

	protected $fillable = [
		'montant',
		'date_creation',
		'description',
		'type',
		'valeur'
	];

	public function transactions()
	{
		return $this->hasMany(Transaction::class, 'id_frais');
	}
}
