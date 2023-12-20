<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PacksRemise
 * 
 * @property int $id_remise
 * @property int $id_pack
 * @property float|null $taux
 * @property float|null $montant
 * @property int|null $id_historique_remise
 * 
 * @property Remise $remise
 * @property Pack $pack
 * @property HistoriqueRemise|null $historique_remise
 *
 * @package App\Models
 */
class PacksRemise extends Model
{
	protected $table = 'packs_remise';
	public $incrementing = false;
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'id_remise' => 'int',
		'id_pack' => 'int',
		'taux' => 'float',
		'montant' => 'float',
		'id_historique_remise' => 'int'
	];

	protected $fillable = [
		'taux',
		'montant',
		'id_historique_remise'
	];

	public function remise()
	{
		return $this->belongsTo(Remise::class, 'id_remise');
	}

	public function pack()
	{
		return $this->belongsTo(Pack::class, 'id_pack');
	}

	public function historique_remise()
	{
		return $this->belongsTo(HistoriqueRemise::class, 'id_historique_remise');
	}
}
