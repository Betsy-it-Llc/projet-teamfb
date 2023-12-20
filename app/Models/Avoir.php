<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Avoir
 * 
 * @property int $id_avoir
 * @property float|null $montant
 * @property Carbon|null $date_creation
 * @property Carbon|null $date_expiration
 * @property string|null $statut
 * @property int $id_contact
 * 
 * @property Contact $contact
 * @property Collection|Transaction[] $transactions
 *
 * @package App\Models
 */
class Avoir extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
	protected $table = 'avoirs';
	protected $primaryKey = 'id_avoir';
	public $timestamps = false;

	protected $casts = [
		'montant' => 'float',
		'date_creation' => 'datetime',
		'date_expiration' => 'datetime',
		'id_contact' => 'int'
	];

	protected $fillable = [
		'montant',
		'date_creation',
		'date_expiration',
		'statut',
		'id_contact'
	];

	public function contact()
	{
		return $this->belongsTo(Contact::class, 'id_contact');
	}

	public function transactions()
	{
		return $this->hasMany(Transaction::class, 'id_avoir');
	}
}
