<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ContactJeux
 * 
 * @property int $id_contact
 * @property int $id_jeux
 * 
 * @property Contact $contact
 * @property JeuxConcour $jeux_concour
 *
 * @package App\Models
 */
class ContactJeux extends Model
{
	protected $table = 'contact_jeux';
	public $incrementing = false;
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'id_contact' => 'int',
		'id_jeux' => 'int'
	];

	public function contact()
	{
		return $this->belongsTo(Contact::class, 'id_contact');
	}

	public function jeux_concour()
	{
		return $this->belongsTo(JeuxConcour::class, 'id_jeux');
	}
}
