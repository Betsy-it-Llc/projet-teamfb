<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FactureStatutNotification
 * 
 * @property int $id_notification
 * @property Carbon|null $date_statut
 * @property int $num_facture
 * @property int $id_facture_statut
 * 
 * @property Notification $notification
 * @property Facture $facture
 * @property FactureStatut $facture_statut
 *
 * @package App\Models
 */
class FactureStatutNotification extends Model
{
	protected $table = 'facture_statut_notification';
	protected $primaryKey = 'id_notification';
	protected $connection = 'mysql2';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_notification' => 'int',
		'date_statut' => 'datetime',
		'num_facture' => 'int',
		'id_facture_statut' => 'int'
	];

	protected $fillable = [
		'id_notification',
		'date_statut',
		'num_facture',
		'id_facture_statut'
	];

	public function notification()
	{
		return $this->belongsTo(Notification::class, 'id_notification');
	}

	public function facture()
	{
		return $this->belongsTo(Facture::class, 'num_facture');
	}

	public function facture_statut()
	{
		return $this->belongsTo(FactureStatut::class, 'id_facture_statut');
	}
}
