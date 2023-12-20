<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Parrainage
 * 
 * @property int $id_parrainage
 * @property int $id_code
 * @property string|null $statut_parrainage
 * 
 * @property CodesPromo $codes_promo
 * @property Contact $contact
 *
 * @package App\Models
 */
class Parrainage extends Model
{
	protected $table = 'parrainage';
	protected $primaryKey = 'id_parrainage';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'id_code' => 'int'
	];

	protected $fillable = [
		'id_code',
		'statut_parrainage'
	];

	public function codes_promo()
	{
		return $this->belongsTo(CodesPromo::class, 'id_code');
	}

	public function contact()
	{
		return $this->hasOne(Contact::class, 'id_parrainage');
	}
}
