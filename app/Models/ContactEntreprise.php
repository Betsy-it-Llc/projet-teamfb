<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ContactEntreprise
 * 
 * @property int $id_contact
 * @property string|null $type
 * @property int $id_organisation
 * 
 * @property Contact $contact
 * @property Organisation $organisation
 *
 * @package App\Models
 */
class ContactEntreprise extends Model
{
	protected $table = 'contact_entreprise';
	protected $primaryKey = 'id_contact';
	public $incrementing = false;
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'id_contact' => 'int',
		'id_organisation' => 'int'
	];

	protected $fillable = [
		'id_contact',
		'type',
		'id_organisation'
	];

	public function contact()
	{
		return $this->belongsTo(Contact::class, 'id_contact');
	}

	public function organisation()
	{
		return $this->belongsTo(Organisation::class, 'id_organisation');
	}
}
