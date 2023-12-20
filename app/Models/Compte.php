<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Compte
 * 
 * @property int $id_compte
 * @property float|null $solde
 * @property string|null $type
 * @property int|null $id_contact
 * 
 * @property Contact|null $contact
 * @property Collection|Contact[] $contacts
 * @property Collection|Transaction[] $transactions
 *
 * @package App\Models
 */
class Compte extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
	protected $table = 'comptes';
	protected $primaryKey = 'id_compte';
	public $timestamps = false;


	protected $casts = [
		'solde' => 'float',
		'id_contact' => 'int'
	];

	protected $fillable = [
		'solde',
		'type',
		'id_contact'
	];

	public function contact()
	{
		return $this->belongsTo(Contact::class, 'id_contact');
	}

	public function contacts()
	{
		return $this->belongsToMany(Contact::class, 'contact_compte', 'id_compte', 'id_contact');
	}

	public function transactions()
	{
		return $this->hasMany(Transaction::class, 'id_compte_destinataire');
	}
}
