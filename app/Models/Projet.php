<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Collection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Class Projet
 * 
 * @property int $id_projet
 * @property string|null $nom
 * @property string|null $description_courte
 * @property string|null $description_detaille
 * @property float|null $objectif_financier
 * @property string|null $info_contributeur
 * @property Carbon|null $date_creation
 * @property Carbon|null $date_fin
 * @property string|null $visibilite
 * @property int|null $id_type_projet
 * @property int|null $id_statut_projet
 * 
 * @property TypesProjet|null $types_projet
 * @property StatutsProjet|null $statuts_projet
 * @property Collection|Cagnotte[] $cagnottes
 * @property Collection|Contact[] $contacts
 * @property Collection|Experience[] $experiences
 * @property Collection|HistoriqueLiaison[] $historique_liaisons
 * @property Collection|Organisation[] $organisations
 *
 * @package App\Models
 */
class Projet extends Model implements HasMedia
{
	use InteractsWithMedia;
	protected $table = 'projets';
	protected $primaryKey = 'id_projet';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'objectif_financier' => 'float',
		'date_creation' => 'datetime',
		'date_fin' => 'datetime',
		'id_type_projet' => 'int',
		'id_statut_projet' => 'int'
	];

	protected $fillable = [
		'nom',
		'description_courte',
		'description_detaille',
		'objectif_financier',
		'info_contributeur',
		'date_creation',
		'date_fin',
		'visibilite',
		'id_type_projet',
		'id_statut_projet',
		'drive_url'
	];

	public function types_projet()
	{
		return $this->belongsTo(TypesProjet::class, 'id_type_projet');
	}

	public function statuts_projet()
	{
		return $this->belongsTo(StatutsProjet::class, 'id_statut_projet');
	}

	public function cagnottes()
	{
		return $this->hasMany(Cagnotte::class, 'id_projet');
	}

	public function contacts()
	{
		return $this->belongsToMany(Contact::class, 'contact_projets', 'id_projet', 'id_contact');
	}

	public function experiences()
	{
		return $this->hasMany(Experience::class, 'id_projet');
	}

	public function historique_liaisons()
	{
		return $this->hasMany(HistoriqueLiaison::class, 'id_projet_cible');
	}

	public function organisations()
	{
		return $this->belongsToMany(Organisation::class, 'organisation_projet', 'id_projet', 'id_organisation');
	}

	public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('miniature_projet')
            ->width(110)
            ->height(110)
            ->sharpen(10);
    }
}
