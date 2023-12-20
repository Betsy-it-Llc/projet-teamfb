<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Experience
 * 
 * @property int $id_experience
 * @property string $numero_experience
 * @property string|null $nom_experience
 * @property string|null $histoire_experience
 * @property string|null $url_experience_folder
 * @property Carbon|null $date_reservation
 * @property Carbon|null $heure_reservation
 * @property Carbon|null $duree_reservation
 * @property Carbon|null $date_creation
 * @property Carbon|null $date_update
 * @property int|null $id_produit
 * @property int|null $id_pack
 * @property int|null $id_projet
 * 
 * @property ProduitsService|null $produits_service
 * @property Pack|null $pack
 * @property Projet|null $projet
 * @property Collection|Commentaire[] $commentaires
 * @property Collection|Contact[] $contacts
 * @property Collection|ContentsExperience[] $contents_experiences
 * @property Collection|Evenement[] $evenements
 * @property Collection|Notification[] $notifications
 * @property Collection|FactureProduitService[] $facture_produit_services
 * @property Collection|Interaction[] $interactions
 * @property Collection|Pack[] $packs
 * @property Collection|PrestationIntervantExperience[] $prestation_intervant_experiences
 *
 * @package App\Models
 */
class Experience extends Model
{
	protected $table = 'experience';
	protected $primaryKey = 'id_experience';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'date_reservation' => 'datetime',
		'heure_reservation' => 'datetime',
		'duree_reservation' => 'datetime',
		'date_creation' => 'datetime',
		'date_update' => 'datetime',
		'id_produit' => 'int',
		'id_pack' => 'int',
		'id_projet' => 'int'
	];

	protected $fillable = [
		'numero_experience',
		'nom_experience',
		'histoire_experience',
		'url_experience_folder',
		'date_reservation',
		'heure_reservation',
		'duree_reservation',
		'date_creation',
		'date_update',
		'id_produit',
		'id_pack',
		'id_projet',
		'drive_url'
	];

	public function produits_service()
	{
		return $this->belongsTo(ProduitsService::class, 'id_produit');
	}

	public function pack()
	{
		return $this->belongsTo(Pack::class, 'id_pack');
	}

	public function projet()
	{
		return $this->belongsTo(Projet::class, 'id_projet');
	}

	public function commentaires()
	{
		return $this->hasMany(Commentaire::class, 'id_experience');
	}

	public function contacts()
	{
		return $this->belongsToMany(Contact::class, 'contact_experience', 'id_experience', 'id_contact')
					->withPivot('profil', 'personna', 'description');
	}

	public function contents_experiences()
	{
		return $this->hasMany(ContentsExperience::class, 'id_experience');
	}

	public function evenements()
	{
		return $this->hasMany(Evenement::class, 'id_experience');
	}

	public function notifications()
	{
		return $this->belongsToMany(Notification::class, 'experience_statut_notification', 'id_experience', 'id_notification')
					->withPivot('date_statut', 'id_statut_experience');
	}

	public function facture_produit_services()
	{
		return $this->hasMany(FactureProduitService::class, 'id_experience');
	}

	public function interactions()
	{
		return $this->hasMany(Interaction::class, 'id_experience');
	}

	public function packs()
	{
		return $this->belongsToMany(Pack::class, 'pack_experience', 'id_experience', 'id_pack')
					->withPivot('id_pack_experience', 'nb_titres', 'nb_participants', 'num_facture', 'id_liste_prix', 'id_historique_remise');
	}

	public function prestation_intervant_experiences()
	{
		return $this->hasMany(PrestationIntervantExperience::class, 'id_experience');
	}
}
