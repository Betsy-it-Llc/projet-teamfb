<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ContactCodePromo
 * 
 * @property int $id_code
 * @property int $id_contact
 * 
 * @property CodesPromo $codes_promo
 * @property Contact $contact
 *
 * @package App\Models
 */
class ContactCodePromo extends Model
{
	protected $table = 'contact_code_promo';
	public $incrementing = false;
	public $timestamps = false;
	
	public $connection = 'mysql2';

	protected $casts = [
		'id_code' => 'int',
		'id_contact' => 'int'
	];

	public function codes_promo()
	{
		return $this->belongsTo(CodesPromo::class, 'id_code');
	}

	public function contact()
	{
		return $this->belongsTo(Contact::class, 'id_contact');
	}
}
