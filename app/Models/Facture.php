<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Facture
 *
 * @property int $num_facture
 * @property string|null $description_lib
 * @property float|null $prix_facture
 * @property string|null $statut_facture
 * @property string|null $id_stripe
 * @property string|null $url_facture
 * @property string|null $url_stripe
 * @property int|null $nb_paiement
 * @property string|null $canal_reservation
 * @property Carbon|null $date_creation
 * @property Carbon|null $date_update
 * @property int|null $id_historique_remise
 *
 * @property HistoriqueRemise|null $historique_remise
 * @property Collection|FactureProduitService[] $facture_produit_services
 * @property Collection|Notification[] $notifications
 * @property Collection|Remise[] $remises
 * @property Collection|PackExperience[] $pack_experiences
 * @property Collection|Paiement[] $paiements
 * @property Panier $panier
 *
 * @package App\Models
 */
class Facture extends Model
{
	protected $table = 'factures';
	protected $primaryKey = 'num_facture';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'prix_facture' => 'float',
		'nb_paiement' => 'int',
		'date_creation' => 'datetime',
		'date_update' => 'datetime',
		'id_historique_remise' => 'int'
	];

	protected $fillable = [
		'description_lib',
		'prix_facture',
		'statut_facture',
		'id_stripe',
		'url_facture',
		'url_stripe',
		'nb_paiement',
		'canal_reservation',
		'date_creation',
		'date_update',
		'id_historique_remise',
		'drive_url'
	];

	public function historique_remise()
	{
		return $this->belongsTo(HistoriqueRemise::class, 'id_historique_remise');
	}

	public function facture_produit_services()
	{
		return $this->hasMany(FactureProduitService::class, 'num_facture');
	}

	public function notifications()
	{
		return $this->belongsToMany(Notification::class, 'facture_statut_notification', 'num_facture', 'id_notification')
			->withPivot('date_statut', 'id_facture_statut');
	}

	public function remises()
	{
		return $this->belongsToMany(Remise::class, 'factures_remise', 'num_facture', 'id_remise')
			->withPivot('taux', 'montant');
	}

	public function pack_experiences()
	{
		return $this->hasMany(PackExperience::class, 'num_facture');
	}

	public function paiements()
	{
		return $this->hasMany(Paiement::class, 'num_facture');
	}

	public function panier()
	{
		return $this->hasOne(Panier::class, 'num_facture');
	}

	// Modèle Facture
	public function contact()
	{
		return $this->hasOneThrough(
			Contact::class,
			Paiement::class,
			'num_facture', // Clé étrangère de Facture dans la table Paiement
			'id_contact',  // Clé étrangère de Contact dans la table Paiement
			'num_facture', // Clé primaire de Facture dans la table Facture
			'id_contact'   // Clé primaire de Contact dans la table Paiement
		);
	}
}
