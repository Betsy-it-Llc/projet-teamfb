<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FacturesRemise
 * 
 * @property int $num_facture
 * @property int $id_remise
 * @property float|null $taux
 * @property float|null $montant
 * 
 * @property Facture $facture
 * @property Remise $remise
 *
 * @package App\Models
 */
class FacturesRemise extends Model
{
	protected $table = 'factures_remise';
	public $incrementing = false;
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'num_facture' => 'int',
		'id_remise' => 'int',
		'taux' => 'float',
		'montant' => 'float'
	];

	protected $fillable = [
		'taux',
		'montant'
	];

	public function facture()
	{
		return $this->belongsTo(Facture::class, 'num_facture');
	}

	public function remise()
	{
		return $this->belongsTo(Remise::class, 'id_remise');
	}
}
