<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExperienceStatutNotification
 * 
 * @property int $id_notification
 * @property Carbon|null $date_statut
 * @property int $id_experience
 * @property int $id_statut_experience
 * 
 * @property Notification $notification
 * @property Experience $experience
 * @property ExperienceStatut $experience_statut
 *
 * @package App\Models
 */
class ExperienceStatutNotification extends Model
{
	protected $table = 'experience_statut_notification';
	protected $primaryKey = 'id_notification';
	public $incrementing = false;
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'id_notification' => 'int',
		'date_statut' => 'datetime',
		'id_experience' => 'int',
		'id_statut_experience' => 'int'
	];

	protected $fillable = [
		'date_statut',
		'id_experience',
		'id_statut_experience'
	];

	public function notification()
	{
		return $this->belongsTo(Notification::class, 'id_notification');
	}

	public function experience()
	{
		return $this->belongsTo(Experience::class, 'id_experience');
	}

	public function experience_statut()
	{
		return $this->belongsTo(ExperienceStatut::class, 'id_statut_experience');
	}
}
