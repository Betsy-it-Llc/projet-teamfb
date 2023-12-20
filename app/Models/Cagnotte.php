<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use App\Models\experienceApp\Experience;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Class Cagnotte
 * 
 * @property int $id_cagnotte
 * @property string|null $titre
 * @property int|null $montant_actuel
 * @property int|null $id_categorie
 * @property int $id_projet
 * @property int|null $id_statut_cagnotte
 * 
 * @property Category|null $category
 * @property Projet $projet
 * @property StatutsCagnotte|null $statuts_cagnotte
 * @property Collection|Contribution[] $contributions
 * @property Collection|Historique[] $historiques
 * @property Collection|Invitation[] $invitations
 * @property Collection|Organisation[] $organisations
 * @property Collection|Retrait[] $retraits
 * @property Collection|Transaction[] $transactions
 *
 * @package App\Models
 */
class Cagnotte extends Model implements HasMedia
{
	use HasFactory;
	use InteractsWithMedia;
	protected $connection = 'mysql2';
	protected $table = 'cagnottes';
	protected $primaryKey = 'id_cagnotte';
	public $timestamps = false;

	protected $casts = [
		'montant_actuel' => 'int',
		'id_categorie' => 'int',
		'id_projet' => 'int',
		'id_statut_cagnotte' => 'int'
	];

	protected $fillable = [
		'titre',
		'montant_actuel',
		'id_categorie',
		'id_projet',
		'id_statut_cagnotte',
		'drive_url'
	];

	public function category()
	{
		return $this->belongsTo(Category::class, 'id_categorie');
	}

	public function projet()
	{
		return $this->belongsTo(Projet::class, 'id_projet');
	}

	public function statuts_cagnotte()
	{
		return $this->belongsTo(StatutsCagnotte::class, 'id_statut_cagnotte');
	}

	public function contributions()
	{
		return $this->hasMany(Contribution::class, 'id_cagnotte');
	}

	public function historiques()
	{
		return $this->hasMany(Historique::class, 'id_cagnotte');
	}

	public function invitations()
	{
		return $this->hasMany(Invitation::class, 'id_cagnotte');
	}

	public function organisations()
	{
		return $this->belongsToMany(Organisation::class, 'organisation_cagnotte', 'id_cagnotte', 'id_organisation');
	}

	public function retraits()
	{
		return $this->hasMany(Retrait::class, 'id_cagnotte');
	}

	public function transactions()
	{
		return $this->hasMany(Transaction::class, 'id_cagnotte');
	}

















	public function experience()
	{
		return $this->belongsTo(Experience::class, 'id_projet', 'id_projet'); // Utilisez 'id_projet' pour la relation avec Experience
	}

	public function projets()
	{
		return $this->belongsTo(Projets::class, 'id_projet', 'id_projet'); // Spécifiez 'id_projet' comme clé primaire
	}

	public function categorie()
	{
		return $this->belongsTo(Categorie::class, 'id_categorie');
	}

	public function contacts()
	{
		return $this->belongsToMany(Contact::class, 'contact_projets', 'id_projet', 'id_contact');
	}


	public function getDateContributionFormatted()
	{
		// Vérifiez si la date est définie
		if ($this->date_contribution) {
			$date = Carbon::createFromFormat('Y-m-d H:i:s', $this->date_contribution);
			return $date->format('d/m/Y');
		}
	}

	public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('miniature_cagnotte')
            ->width(110)
            ->height(110)
            ->sharpen(10);
    }
}
