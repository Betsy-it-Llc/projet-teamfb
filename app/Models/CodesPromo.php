<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CodesPromo
 * 
 * @property int $id_code
 * @property string|null $code
 * @property int|null $nb_utilisation
 * @property int $nb_code
 * @property string|null $description
 * @property string $statut_code
 * @property Carbon|null $date_creation
 * @property Carbon|null $date_update
 * @property int $id_remise
 * @property string|null $id_stripe_code
 * @property string|null $url_stripe_code
 * 
 * @property Remise $remise
 * @property Collection|ContactCodePromo[] $contact_code_promos
 * @property Parrainage $parrainage
 *
 * @package App\Models
 */
class CodesPromo extends Model
{
	protected $table = 'codes_promo';
	protected $primaryKey = 'id_code';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'nb_utilisation' => 'int',
		'nb_code' => 'int',
		'date_creation' => 'datetime',
		'date_update' => 'datetime',
		'id_remise' => 'int'
	];

	protected $fillable = [
		'code',
		'nb_utilisation',
		'nb_code',
		'description',
		'statut_code',
		'date_creation',
		'date_update',
		'id_remise',
		'id_stripe_code',
		'url_stripe_code',
		'drive_url'
	];

	public function remise()
	{
		return $this->belongsTo(Remise::class, 'id_remise');
	}

	public function contact_code_promos()
	{
		return $this->hasMany(ContactCodePromo::class, 'id_code');
	}

	public function parrainage()
	{
		return $this->hasOne(Parrainage::class, 'id_code');
	}
}
