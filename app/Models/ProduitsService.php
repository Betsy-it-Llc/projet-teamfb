<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProduitsService
 * 
 * @property int $id_produit
 * @property string|null $abstract
 * @property string|null $description
 * @property string|null $categorie
 * @property Carbon|null $date_creation
 * @property Carbon|null $date_update
 * @property string|null $statut
 * @property string|null $nom_produit
 * @property string|null $prix
 * @property int|null $stock
 * @property string|null $id_stripe_produit
 * @property string|null $url_stripe_produit
 * 
 * @property Collection|AutrePrestationExperience[] $autre_prestation_experiences
 * @property Collection|Experience[] $experiences
 * @property Collection|FactureProduitService[] $facture_produit_services
 * @property Collection|ListePrix[] $liste_prixes
 * @property Collection|PackProduitService[] $pack_produit_services
 * @property Collection|ProduitServiceRemise[] $produit_service_remises
 *
 * @package App\Models
 */
class ProduitsService extends Model
{
	protected $table = 'produits_services';
	protected $primaryKey = 'id_produit';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'date_creation' => 'datetime',
		'date_update' => 'datetime',
		'stock' => 'int'
	];

	protected $fillable = [
		'abstract',
		'description',
		'categorie',
		'date_creation',
		'date_update',
		'statut',
		'nom_produit',
		'prix',
		'stock',
		'id_stripe_produit',
		'url_stripe_produit',
		'drive_url'
	];

	public function autre_prestation_experiences()
	{
		return $this->hasMany(AutrePrestationExperience::class, 'id_produit');
	}

	public function experiences()
	{
		return $this->hasMany(Experience::class, 'id_produit');
	}

	public function facture_produit_services()
	{
		return $this->hasMany(FactureProduitService::class, 'id_produit');
	}

	public function liste_prixes()
	{
		return $this->hasMany(ListePrix::class, 'id_produit');
	}

	public function pack_produit_services()
	{
		return $this->hasMany(PackProduitService::class, 'id_produit');
	}

	public function produit_service_remises()
	{
		return $this->hasMany(ProduitServiceRemise::class, 'id_produit');
	}
}
