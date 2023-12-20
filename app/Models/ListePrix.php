<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ListePrix
 * 
 * @property int $id_liste_prix
 * @property float|null $prix
 * @property string|null $statut
 * @property Carbon|null $date_creation
 * @property int|null $id_pack
 * @property int|null $id_produit
 * 
 * @property Pack|null $pack
 * @property ProduitsService|null $produits_service
 * @property Collection|AutrePrestationExperience[] $autre_prestation_experiences
 * @property Collection|FactureProduitService[] $facture_produit_services
 * @property Collection|PackExperience[] $pack_experiences
 *
 * @package App\Models
 */
class ListePrix extends Model
{
	protected $connection = 'mysql2';
	protected $table = 'liste_prix';
	protected $primaryKey = 'id_liste_prix';
	public $timestamps = false;

	protected $casts = [
		'prix' => 'float',
		'date_creation' => 'datetime',
		'id_pack' => 'int',
		'id_produit' => 'int'
	];

	protected $fillable = [
		'prix',
		'statut',
		'date_creation',
		'id_pack',
		'id_produit'
	];

	public function pack()
	{
		return $this->belongsTo(Pack::class, 'id_pack');
	}

	public function produits_service()
	{
		return $this->belongsTo(ProduitsService::class, 'id_produit');
	}

	public function autre_prestation_experiences()
	{
		return $this->hasMany(AutrePrestationExperience::class, 'id_liste_prix');
	}

	public function facture_produit_services()
	{
		return $this->hasMany(FactureProduitService::class, 'id_liste_prix');
	}

	public function pack_experiences()
	{
		return $this->hasMany(PackExperience::class, 'id_liste_prix');
	}
}
