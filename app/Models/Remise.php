<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Remise
 * 
 * @property int $id_remise
 * @property string|null $nom_remise
 * @property string|null $type_remise
 * @property float|null $taux
 * @property float|null $montant
 * @property Carbon|null $date_debut
 * @property Carbon|null $date_fin
 * @property string|null $description
 * @property string $statut
 * @property Carbon|null $date_creation
 * @property Carbon|null $date_update
 * @property string|null $id_stripe_remise
 * @property string|null $url_stripe_remise
 * 
 * @property Collection|CodesPromo[] $codes_promos
 * @property Collection|Facture[] $factures
 * @property Collection|HistoriqueRemise[] $historique_remises
 * @property Collection|JeuxConcour[] $jeux_concours
 * @property Collection|Pack[] $packs
 * @property Collection|ProduitServiceRemise[] $produit_service_remises
 * @property Collection|RemiseEntreprise[] $remise_entreprises
 *
 * @package App\Models
 */
class Remise extends Model
{
	protected $table = 'remise';
	protected $primaryKey = 'id_remise';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'taux' => 'float',
		'montant' => 'float',
		'date_debut' => 'datetime',
		'date_fin' => 'datetime',
		'date_creation' => 'datetime',
		'date_update' => 'datetime'
	];

	protected $fillable = [
		'nom_remise',
		'type_remise',
		'taux',
		'montant',
		'date_debut',
		'date_fin',
		'description',
		'statut',
		'date_creation',
		'date_update',
		'id_stripe_remise',
		'url_stripe_remise',
		'drive_url'
	];

	public function codes_promos()
	{
		return $this->hasMany(CodesPromo::class, 'id_remise');
	}

	public function factures()
	{
		return $this->belongsToMany(Facture::class, 'factures_remise', 'id_remise', 'num_facture')
					->withPivot('taux', 'montant');
	}

	public function historique_remises()
	{
		return $this->hasMany(HistoriqueRemise::class, 'id_remise');
	}

	public function jeux_concours()
	{
		return $this->hasMany(JeuxConcour::class, 'id_remise');
	}

	public function packs()
	{
		return $this->belongsToMany(Pack::class, 'packs_remise', 'id_remise', 'id_pack')
					->withPivot('taux', 'montant', 'id_historique_remise');
	}

	public function produit_service_remises()
	{
		return $this->hasMany(ProduitServiceRemise::class, 'id_remise');
	}

	public function remise_entreprises()
	{
		return $this->hasMany(RemiseEntreprise::class, 'id_remise');
	}
}
