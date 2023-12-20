<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Retrait
 * 
 * @property int $id_retrait
 * @property float|null $montant
 * @property Carbon|null $date_demande
 * @property string|null $statut
 * @property int $id_cagnotte
 * 
 * @property Cagnotte $cagnotte
 *
 * @package App\Models
 */
class Retrait extends Model
{
	protected $table = 'retraits';
	protected $primaryKey = 'id_retrait';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'montant' => 'float',
		'date_demande' => 'datetime',
		'id_cagnotte' => 'int'
	];

	protected $fillable = [
		'montant',
		'date_demande',
		'statut',
		'id_cagnotte'
	];

	public function cagnotte()
	{
		return $this->belongsTo(Cagnotte::class, 'id_cagnotte');
	}
}
