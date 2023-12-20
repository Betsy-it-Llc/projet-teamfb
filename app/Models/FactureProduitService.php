<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FactureProduitService
 * 
 * @property int $num_facture
 * @property int $id_produit
 * @property int $id_liste_prix
 * @property int|null $id_historique_remise
 * @property float|null $prix_personnalise
 * @property int|null $quantity
 * @property int|null $id_experience
 * 
 * @property Facture $facture
 * @property ProduitsService $produits_service
 * @property Experience|null $experience
 * @property ListePrix $liste_prix
 * @property HistoriqueRemise|null $historique_remise
 *
 * @package App\Models
 */
class FactureProduitService extends Model
{
	protected $table = 'facture_produit_service';
	public $incrementing = false;
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'num_facture' => 'int',
		'id_produit' => 'int',
		'id_liste_prix' => 'int',
		'id_historique_remise' => 'int',
		'prix_personnalise' => 'float',
		'quantity' => 'int',
		'id_experience' => 'int'
	];

	protected $fillable = [
		'id_produit',
		'id_liste_prix',
		'id_historique_remise',
		'prix_personnalise',
		'quantity',
		'id_experience',
		'num_facture'
	];

	public function facture()
	{
		return $this->belongsTo(Facture::class, 'num_facture');
	}

	public function produits_service()
	{
		return $this->belongsTo(ProduitsService::class, 'id_produit');
	}

	public function experience()
	{
		return $this->belongsTo(Experience::class, 'id_experience');
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
