<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Transaction
 * 
 * @property int $id_transaction
 * @property float|null $montant
 * @property Carbon|null $date_transaction
 * @property string|null $type
 * @property string|null $description
 * @property int|null $id_cagnotte
 * @property int|null $id_paiment
 * @property int|null $id_avoir
 * @property int|null $id_compte_source
 * @property int|null $id_compte_destinataire
 * @property int $id_contact
 * @property int|null $id_commission
 * @property int|null $id_frais
 * 
 * @property Cagnotte|null $cagnotte
 * @property Paiement|null $paiement
 * @property Avoir|null $avoir
 * @property Compte|null $compte
 * @property Contact $contact
 * @property Commission|null $commission
 * @property Frai|null $frai
 *
 * @package App\Models
 */
class Transaction extends Model
{
	protected $connection = 'mysql2';
	protected $table = 'transactions';
	protected $primaryKey = 'id_transaction';
	public $timestamps = false;

	protected $casts = [
		'montant' => 'float',
		'date_transaction' => 'datetime',
		'id_cagnotte' => 'int',
		'id_paiment' => 'int',
		'id_avoir' => 'int',
		'id_compte_source' => 'int',
		'id_compte_destinataire' => 'int',
		'id_contact' => 'int',
		'id_commission' => 'int',
		'id_frais' => 'int'
	];

	protected $fillable = [
		'montant',
		'date_transaction',
		'type',
		'description',
		'id_cagnotte',
		'id_paiment',
		'id_avoir',
		'id_compte_source',
		'id_compte_destinataire',
		'id_contact',
		'id_commission',
		'id_frais'
	];

	public function cagnotte()
	{
		return $this->belongsTo(Cagnotte::class, 'id_cagnotte');
	}

	public function paiement()
	{
		return $this->belongsTo(Paiement::class, 'id_paiment');
	}

	public function avoir()
	{
		return $this->belongsTo(Avoir::class, 'id_avoir');
	}

	public function compte()
	{
		return $this->belongsTo(Compte::class, 'id_compte_destinataire');
	}

	public function contact()
	{
		return $this->belongsTo(Contact::class, 'id_contact');
	}

	public function commission()
	{
		return $this->belongsTo(Commission::class, 'id_commission');
	}

	public function frai()
	{
		return $this->belongsTo(Frai::class, 'id_frais');
	}
}
