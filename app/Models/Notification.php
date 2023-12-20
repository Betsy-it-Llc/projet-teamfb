<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Notification
 * 
 * @property int $id_notification
 * @property string|null $contenu_notification
 * @property Carbon|null $date_notification
 * @property string|null $type
 * 
 * @property Collection|Contact[] $contacts
 * @property Collection|Experience[] $experiences
 * @property Collection|ExperienceStatut[] $experience_statuts
 * @property Collection|Facture[] $factures
 * @property Collection|FactureStatut[] $facture_statuts
 *
 * @package App\Models
 */
class Notification extends Model
{
	protected $table = 'notification';
	protected $primaryKey = 'id_notification';
	protected $connection = 'mysql2';
	public $timestamps = false;

	protected $casts = [
		'date_notification' => 'datetime'
	];

	protected $fillable = [
		'contenu_notification',
		'date_notification',
		'type'
	];

	public function contacts()
	{
		return $this->belongsToMany(Contact::class, 'contact_notification', 'id_notification', 'id_contact')
					->withPivot('date_creation');
	}

	public function experiences()
	{
		return $this->belongsToMany(Experience::class, 'experience_statut_notification', 'id_notification', 'id_experience')
					->withPivot('date_statut', 'id_statut_experience');
	}

	public function experience_statuts()
	{
		return $this->belongsToMany(ExperienceStatut::class, 'experience_statut_notification', 'id_notification', 'id_statut_experience')
					->withPivot('date_statut', 'id_experience');
	}

	public function factures()
	{
		return $this->belongsToMany(Facture::class, 'facture_statut_notification', 'id_notification', 'num_facture')
					->withPivot('date_statut', 'id_facture_statut');
	}

	public function facture_statuts()
	{
		return $this->belongsToMany(FactureStatut::class, 'facture_statut_notification', 'id_notification', 'id_facture_statut')
					->withPivot('date_statut', 'num_facture');
	}
}
