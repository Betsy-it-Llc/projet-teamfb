<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AutrePrestationExperience
 * 
 * @property int $id_produit
 * @property int $id_pack_experience
 * @property int|null $id_liste_prix
 * @property int|null $id_historique_remise
 * 
 * @property ProduitsService $produits_service
 * @property PackExperience $pack_experience
 * @property ListePrix|null $liste_prix
 * @property HistoriqueRemise|null $historique_remise
 *
 * @package App\Models
 */
class AutrePrestationExperience extends Model
{
	protected $table = 'autre_prestation_experience';
	public $incrementing = false;
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'id_produit' => 'int',
		'id_pack_experience' => 'int',
		'id_liste_prix' => 'int',
		'id_historique_remise' => 'int'
	];

	protected $fillable = [
		'id_liste_prix',
		'id_historique_remise'
	];

	public function produits_service()
	{
		return $this->belongsTo(ProduitsService::class, 'id_produit');
	}

	public function pack_experience()
	{
		return $this->belongsTo(PackExperience::class, 'id_pack_experience');
	}

	public function liste_prix()
	{
		return $this->belongsTo(ListePrix::class, 'id_liste_prix');
	}

	public function historique_remise()
	{
		return $this->belongsTo(HistoriqueRemise::class, 'id_historique_remise');
	}
}
