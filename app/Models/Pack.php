<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pack
 * 
 * @property int $id_pack
 * @property string|null $nom
 * @property float|null $prix
 * @property string|null $abstract
 * @property string|null $description
 * @property int|null $stock
 * @property Carbon|null $date_creation
 * @property Carbon|null $date_update
 * @property string|null $statut
 * @property string|null $id_stripe_pack
 * @property string|null $url_stripe_pack
 * 
 * @property Collection|Experience[] $experiences
 * @property Collection|ListePrix[] $liste_prixes
 * @property Collection|PackProduitService[] $pack_produit_services
 * @property Collection|Remise[] $remises
 *
 * @package App\Models
 */
class Pack extends Model
{
	protected $table = 'pack';
	protected $primaryKey = 'id_pack';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'prix' => 'float',
		'stock' => 'int',
		'date_creation' => 'datetime',
		'date_update' => 'datetime'
	];

	protected $fillable = [
		'nom',
		'prix',
		'abstract',
		'description',
		'stock',
		'date_creation',
		'date_update',
		'statut',
		'id_stripe_pack',
		'url_stripe_pack',
		'drive_url'
	];

	public function experiences()
	{
		return $this->belongsToMany(Experience::class, 'pack_experience', 'id_pack', 'id_experience')
					->withPivot('id_pack_experience', 'nb_titres', 'nb_participants', 'num_facture', 'id_liste_prix', 'id_historique_remise');
	}

	public function liste_prixes()
	{
		return $this->hasMany(ListePrix::class, 'id_pack');
	}

	public function pack_produit_services()
	{
		return $this->hasMany(PackProduitService::class, 'id_pack');
	}

	public function remises()
	{
		return $this->belongsToMany(Remise::class, 'packs_remise', 'id_pack', 'id_remise')
					->withPivot('taux', 'montant', 'id_historique_remise');
	}
}
