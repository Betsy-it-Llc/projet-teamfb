<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class JeuxConcour
 * 
 * @property int $id_jeux
 * @property string|null $nom_jeu
 * @property Carbon|null $date_début
 * @property Carbon|null $date_fin
 * @property int $id_remise
 * 
 * @property Remise $remise
 * @property Collection|ContactJeux[] $contact_jeuxes
 *
 * @package App\Models
 */
class JeuxConcour extends Model
{
	protected $table = 'jeux_concours';
	protected $primaryKey = 'id_jeux';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'date_début' => 'datetime',
		'date_fin' => 'datetime',
		'id_remise' => 'int'
	];

	protected $fillable = [
		'nom_jeu',
		'date_début',
		'date_fin',
		'id_remise'
	];

	public function remise()
	{
		return $this->belongsTo(Remise::class, 'id_remise');
	}

	public function contact_jeuxes()
	{
		return $this->hasMany(ContactJeux::class, 'id_jeux');
	}
}
