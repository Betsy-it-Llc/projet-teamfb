<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HistoriqueRemise
 * 
 * @property int $id_historique_remise
 * @property Carbon|null $date_creation
 * @property float|null $montant
 * @property float|null $taux
 * @property int|null $id_remise
 * 
 * @property Remise|null $remise
 * @property Collection|AutrePrestationExperience[] $autre_prestation_experiences
 * @property Collection|FactureProduitService[] $facture_produit_services
 * @property Collection|Facture[] $factures
 * @property Collection|PackExperience[] $pack_experiences
 * @property Collection|PacksRemise[] $packs_remises
 * @property Collection|ProduitServiceRemise[] $produit_service_remises
 *
 * @package App\Models
 */
class HistoriqueRemise extends Model
{
	protected $table = 'historique_remise';
	protected $primaryKey = 'id_historique_remise';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'date_creation' => 'datetime',
		'montant' => 'float',
		'taux' => 'float',
		'id_remise' => 'int'
	];

	protected $fillable = [
		'date_creation',
		'montant',
		'taux',
		'id_remise'
	];

	public function remise()
	{
		return $this->belongsTo(Remise::class, 'id_remise');
	}

	public function autre_prestation_experiences()
	{
		return $this->hasMany(AutrePrestationExperience::class, 'id_historique_remise');
	}

	public function facture_produit_services()
	{
		return $this->hasMany(FactureProduitService::class, 'id_historique_remise');
	}

	public function factures()
	{
		return $this->hasMany(Facture::class, 'id_historique_remise');
	}

	public function pack_experiences()
	{
		return $this->hasMany(PackExperience::class, 'id_historique_remise');
	}

	public function packs_remises()
	{
		return $this->hasMany(PacksRemise::class, 'id_historique_remise');
	}

	public function produit_service_remises()
	{
		return $this->hasMany(ProduitServiceRemise::class, 'id_historique_remise');
	}
}
