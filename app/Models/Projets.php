<?php

namespace App\Models;

use App\Models\Cagnotte;
use App\Models\TypesProjets;
use App\Models\StatutsProjets;
use Spatie\MediaLibrary\HasMedia;
use App\Models\experienceApp\Contact;
use Illuminate\Database\Eloquent\Model;
use App\Models\experienceApp\Experience;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Projets extends Model implements HasMedia
{

    use InteractsWithMedia;

    protected $connection = 'mysql2';
    protected $table = 'projets';
    protected $primaryKey = 'id_projet';
    public $timestamps = false;


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
        'id_type_projet',
        'visibilite',
        'id_statut_projet',
    ];

    public function typeProjet()
    {
        return $this->belongsTo(TypesProjets::class, 'id_type_projet', 'id');
    }

    public function statutProjet()
    {
        return $this->belongsTo(StatutsProjets::class, 'id_statut_projet', 'id_statut_projet');
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class, 'id_projet', 'id_projet');
    }

    public function experience()
    {
        return $this->hasOne(Experience::class, 'id_projet', 'id_projet');
    }

    public function contacts()
    {
        return $this->belongsToMany(Contact::class, 'contact_projets', 'id_projet', 'id_contact');
    }

    public function cagnottes()
    {
        return $this->hasMany(Cagnotte::class, 'id_projet');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('miniature_projet')
            ->width(110)
            ->height(110)
            ->sharpen(10);
    }
}
