<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Partenaire
 * 
 * @property int $id_partenaire
 * @property string|null $fonction
 * @property string|null $type
 * @property string|null $description
 * @property Carbon|null $date_creation
 * @property Carbon|null $date_update
 * @property int $id_contact
 * 
 * @property Contact $contact
 *
 * @package App\Models
 */
class Partenaire extends Model
{
	protected $table = 'partenaire';
	protected $primaryKey = 'id_partenaire';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'date_creation' => 'datetime',
		'date_update' => 'datetime',
		'id_contact' => 'int'
	];

	protected $fillable = [
		'fonction',
		'type',
		'description',
		'date_creation',
		'date_update',
		'id_contact'
	];

	public function contact()
	{
		return $this->belongsTo(Contact::class, 'id_contact');
	}
}
