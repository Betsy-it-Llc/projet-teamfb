<?php

namespace App\Models\experienceApp;

use App\Models\Projets;
use App\Models\Cagnotte;
use App\Models\Commentaire;
use Spatie\MediaLibrary\HasMedia;
use App\Models\ContentsExperience;
use Kyslik\ColumnSortable\Sortable;
use App\Models\experienceApp\Contact;
use App\Models\FactureProduitService;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Models\experienceApp\ExperienceStatutNotification;

class Experience extends Model implements HasMedia
{
    use HasFactory;
    use Sortable;
    use InteractsWithMedia;

    protected $connection = 'mysql2';
    protected $primaryKey = 'id_experience';
    protected $table = 'experience';
    public $timestamps = false;
    protected $fillable = [
        'id_experience',
        'numero_experience',
        'nom_experience',
        'histoire_experience',
        'url_experience_folder',
        'date_reservation',
        'heure_reservation',
        'duree_reservation',
        'date_creation',
        'date_update',
        'visibility',
        'id_produit',
        'id_pack',
        'id_projet',
        'drive_url'
    ];
    public $sortable = [
        'id_experience',
        'numero_experience',
        'nom_experience',
        'histoire_experience',
        'url_experience_folder',
        'date_reservation',
        'heure_reservation',
        'duree_reservation',
        'date_creation',
        'date_update',
        'visibility',
        'id_produit',
        'id_pack',
        'id_projet',
        'drive_url'
    ];

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'id_experience');
    }

    public function projet()
    {
        return $this->belongsTo(Projets::class, 'id_projet', 'id_projet');
    }

    public function contacts()
    {
        return $this->belongsToMany(Contact::class, 'contact_experience', 'id_experience', 'id_contact');
    }

    public function factureProduitService()
    {
        return $this->hasMany(FactureProduitService::class, 'id_experience', 'id_experience');
    }

    public function cagnotte()
    {
        return $this->belongsTo(Cagnotte::class, 'id_projet', 'id_projet');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('soutenir_experience_avatar')
            ->width(110)
            ->height(110)
            ->sharpen(10);
    }

    public function contents_experiences()
    {
        return $this->hasMany(ContentsExperience::class, 'id_experience');
    }
}
