<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Contact
 * 
 * @property int $id_contact
 * @property string|null $tel
 * @property string|null $nom
 * @property string|null $prenom
 * @property string|null $pseudo
 * @property string|null $email
 * @property string|null $adresse
 * @property string|null $code_postal
 * @property string|null $ville
 * @property Carbon|null $date_naissance
 * @property string|null $nationalite
 * @property string|null $pays_residence
 * @property string|null $url_contact_folder
 * @property string|null $id_client_stripe
 * @property string|null $url_client_stripe
 * @property string|null $description
 * @property bool|null $notification_contribution_enabled
 * @property bool|null $notification_contributed_enabled
 * @property Carbon|null $date_creation
 * @property Carbon|null $date_update
 * @property int|null $id_parrainage
 * 
 * @property Parrainage|null $parrainage
 * @property Collection|Avoir[] $avoirs
 * @property Collection|Commentaire[] $commentaires
 * @property Collection|Compte[] $comptes
 * @property Collection|ContactCodePromo[] $contact_code_promos
 * @property ContactEntreprise $contact_entreprise
 * @property Collection|Experience[] $experiences
 * @property Collection|ContactJeux[] $contact_jeuxes
 * @property Collection|Notification[] $notifications
 * @property Collection|Persona[] $personas
 * @property Collection|Projet[] $projets
 * @property Collection|Contribution[] $contributions
 * @property Collection|Email[] $emails
 * @property Collection|Interaction[] $interactions
 * @property Intervenant $intervenant
 * @property Collection|Paiement[] $paiements
 * @property Collection|Panier[] $paniers
 * @property Partenaire $partenaire
 * @property Collection|Transaction[] $transactions
 *
 * @package App\Models
 */
class Contact extends Model
{
	protected $table = 'contact';
	protected $primaryKey = 'id_contact';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'date_naissance' => 'datetime',
		'notification_contribution_enabled' => 'bool',
		'notification_contributed_enabled' => 'bool',
		'date_creation' => 'datetime',
		'date_update' => 'datetime',
		'id_parrainage' => 'int'
	];

	protected $fillable = [
		'tel',
		'nom',
		'prenom',
		'pseudo',
		'email',
		'adresse',
		'code_postal',
		'ville',
		'date_naissance',
		'nationalite',
		'pays_residence',
		'url_contact_folder',
		'id_client_stripe',
		'url_client_stripe',
		'description',
		'notification_contribution_enabled',
		'notification_contributed_enabled',
		'date_creation',
		'date_update',
		'id_parrainage',
		'drive_url'
	];

	public function parrainage()
	{
		return $this->belongsTo(Parrainage::class, 'id_parrainage');
	}

	public function avoirs()
	{
		return $this->hasMany(Avoir::class, 'id_contact');
	}

	public function commentaires()
	{
		return $this->hasMany(Commentaire::class, 'id_contact');
	}

	public function comptes()
	{
		return $this->belongsToMany(Compte::class, 'contact_compte', 'id_contact', 'id_compte');
	}

	public function contact_code_promos()
	{
		return $this->hasMany(ContactCodePromo::class, 'id_contact');
	}

	public function contact_entreprise()
	{
		return $this->hasOne(ContactEntreprise::class, 'id_contact');
	}

	public function experiences()
	{
		return $this->belongsToMany(Experience::class, 'contact_experience', 'id_contact', 'id_experience')
					->withPivot('profil', 'personna', 'description');
	}

	public function contact_jeuxes()
	{
		return $this->hasMany(ContactJeux::class, 'id_contact');
	}

	public function notifications()
	{
		return $this->belongsToMany(Notification::class, 'contact_notification', 'id_contact', 'id_notification')
					->withPivot('date_creation');
	}

	public function personas()
	{
		return $this->belongsToMany(Persona::class, 'contact_persona', 'id_contact', 'id_persona');
	}

	public function projets()
	{
		return $this->belongsToMany(Projet::class, 'contact_projets', 'id_contact', 'id_projet');
	}

	public function contributions()
	{
		return $this->hasMany(Contribution::class, 'id_contact');
	}

	public function emails()
	{
		return $this->hasMany(Email::class, 'id_contact');
	}

	public function interactions()
	{
		return $this->hasMany(Interaction::class, 'id_contact');
	}

	public function intervenant()
	{
		return $this->hasOne(Intervenant::class, 'id_contact');
	}

	public function paiements()
	{
		return $this->hasMany(Paiement::class, 'id_contact');
	}

	public function paniers()
	{
		return $this->hasMany(Panier::class, 'id_contact');
	}

	public function partenaire()
	{
		return $this->hasOne(Partenaire::class, 'id_contact');
	}

	public function transactions()
	{
		return $this->hasMany(Transaction::class, 'id_contact');
	}
}
