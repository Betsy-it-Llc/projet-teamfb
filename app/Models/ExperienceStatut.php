<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExperienceStatut
 * 
 * @property int $id_statut_experience
 * @property string|null $statut_experience
 * 
 * @property Collection|Notification[] $notifications
 *
 * @package App\Models
 */
class ExperienceStatut extends Model
{
	protected $table = 'experience_statut';
	protected $primaryKey = 'id_statut_experience';
	public $timestamps = false;

	protected $fillable = [
		'statut_experience'
	];

	public function notifications()
	{
		return $this->belongsToMany(Notification::class, 'experience_statut_notification', 'id_statut_experience', 'id_notification')
					->withPivot('date_statut', 'id_experience');
	}
}
