<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FactureStatut
 * 
 * @property int $id_facture_statut
 * @property string|null $statut_facture
 * 
 * @property Collection|Notification[] $notifications
 *
 * @package App\Models
 */
class FactureStatut extends Model
{
	protected $table = 'facture_statut';
	protected $primaryKey = 'id_facture_statut';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $fillable = [
		'statut_facture'
	];

	public function notifications()
	{
		return $this->belongsToMany(Notification::class, 'facture_statut_notification', 'id_facture_statut', 'id_notification')
			->withPivot('date_statut', 'num_facture');
	}
}
