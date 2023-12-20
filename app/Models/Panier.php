<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Panier
 * 
 * @property int $id_panier
 * @property Carbon|null $date_creation
 * @property string|null $statut
 * @property int $num_facture
 * @property int|null $id_contact
 * 
 * @property Facture $facture
 * @property Contact|null $contact
 *
 * @package App\Models
 */
class Panier extends Model
{
	protected $table = 'paniers';
	protected $primaryKey = 'id_panier';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'date_creation' => 'datetime',
		'num_facture' => 'int',
		'id_contact' => 'int'
	];

	protected $fillable = [
		'date_creation',
		'statut',
		'num_facture',
		'id_contact'
	];

	public function facture()
	{
		return $this->belongsTo(Facture::class, 'num_facture');
	}

	public function contact()
	{
		return $this->belongsTo(Contact::class, 'id_contact');
	}
}
