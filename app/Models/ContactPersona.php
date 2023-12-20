<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ContactPersona
 * 
 * @property int $id_contact
 * @property int $id_persona
 * 
 * @property Contact $contact
 * @property Persona $persona
 *
 * @package App\Models
 */
class ContactPersona extends Model
{
	protected $table = 'contact_persona';
	public $incrementing = false;
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'id_contact' => 'int',
		'id_persona' => 'int'
	];

	public function contact()
	{
		return $this->belongsTo(Contact::class, 'id_contact');
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class, 'id_persona');
	}
}
