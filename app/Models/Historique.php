<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Historique
 * 
 * @property int $id_historique
 * @property string|null $action
 * @property Carbon|null $date_creation
 * @property int $id_cagnotte
 * 
 * @property Cagnotte $cagnotte
 *
 * @package App\Models
 */
class Historique extends Model
{
	protected $table = 'historiques';
	protected $primaryKey = 'id_historique';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'date_creation' => 'datetime',
		'id_cagnotte' => 'int'
	];

	protected $fillable = [
		'action',
		'date_creation',
		'id_cagnotte'
	];

	public function cagnotte()
	{
		return $this->belongsTo(Cagnotte::class, 'id_cagnotte');
	}
}
