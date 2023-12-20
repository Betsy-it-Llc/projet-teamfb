<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Paiement
 * 
 * @property int $id_paiment
 * @property string|null $libelle
 * @property float|null $prix
 * @property string|null $statut_paiement
 * @property string|null $moyen_paiement
 * @property Carbon|null $date_echeance
 * @property Carbon|null $date_creation
 * @property string|null $canal_paiement
 * @property Carbon|null $date_update
 * @property int $num_facture
 * @property int|null $id_contact
 * @property string|null $id_stripe_paiement
 * @property string|null $url_stripe_paiement
 * 
 * @property Facture $facture
 * @property Contact|null $contact
 * @property Collection|Transaction[] $transactions
 *
 * @package App\Models
 */
class Paiement extends Model
{
	protected $table = 'paiement';
	protected $primaryKey = 'id_paiment';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'prix' => 'float',
		'date_echeance' => 'datetime',
		'date_creation' => 'datetime',
		'date_update' => 'datetime',
		'num_facture' => 'int',
		'id_contact' => 'int'
	];

	protected $fillable = [
		'libelle',
		'prix',
		'statut_paiement',
		'moyen_paiement',
		'date_echeance',
		'date_creation',
		'canal_paiement',
		'date_update',
		'num_facture',
		'id_contact',
		'id_stripe_paiement',
		'url_stripe_paiement'
	];

	public function facture()
	{
		return $this->belongsTo(Facture::class, 'num_facture');
	}

	public function contact()
	{
		return $this->belongsTo(Contact::class, 'id_contact');
	}

	public function transactions()
	{
		return $this->hasMany(Transaction::class, 'id_paiment');
	}
}
