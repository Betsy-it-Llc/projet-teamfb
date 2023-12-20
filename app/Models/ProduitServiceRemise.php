<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProduitServiceRemise
 * 
 * @property int $id_remise
 * @property int $id_produit
 * @property float|null $taux
 * @property float|null $montant
 * @property int|null $id_historique_remise
 * 
 * @property Remise $remise
 * @property ProduitsService $produits_service
 * @property HistoriqueRemise|null $historique_remise
 *
 * @package App\Models
 */
class ProduitServiceRemise extends Model
{
	protected $table = 'produit_service_remise';
	public $incrementing = false;
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'id_remise' => 'int',
		'id_produit' => 'int',
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

	public function produits_service()
	{
		return $this->belongsTo(ProduitsService::class, 'id_produit');
	}

	public function historique_remise()
	{
		return $this->belongsTo(HistoriqueRemise::class, 'id_historique_remise');
	}
}
