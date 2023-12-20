<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HistoriqueLiaison
 * 
 * @property int $id
 * @property string|null $type
 * @property Carbon|null $created_date
 * @property bool|null $etat_actuel
 * @property int $id_projet_source
 * @property int $id_projet_cible
 * 
 * @property Projet $projet
 *
 * @package App\Models
 */
class HistoriqueLiaison extends Model
{
	protected $table = 'historique_liaisons';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'created_date' => 'datetime',
		'date_program' => 'datetime',
		'etat_actuel' => 'bool',
		'id_projet_source' => 'int',
		'id_projet_cible' => 'int'
	];

	protected $fillable = [
		'type',
		'created_date',
		'date_program',
		'etat_actuel',
		'id_projet_source',
		'id_projet_cible'
	];

	public function projet()
	{
		return $this->belongsTo(Projet::class, 'id_projet_cible');
	}
}
