<?php

namespace App\Models\experienceApp;

use App\Models\Avoir;
use App\Models\Compte;
use App\Models\Projets;
use App\Models\Cagnotte;
use App\Models\Transaction;
use App\Models\ContactEntreprise;
use Spatie\MediaLibrary\HasMedia;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use App\Models\experienceApp\Experience;
use Illuminate\Notifications\Notifiable;
use Lecturize\Addresses\Traits\HasContacts;
use Spatie\MediaLibrary\InteractsWithMedia;

use Lecturize\Addresses\Traits\HasAddresses;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class Contact extends Model implements HasMedia
{
    use HasFactory;
    use Sortable;
    use HasAddresses;
    use HasContacts;
    use InteractsWithMedia;
    use Notifiable;
    protected $connection = 'mysql2';
    public $timestamps = false;
    protected $table = 'contact';
    protected $primarykey = 'id_contact';
    protected $fillable = [
        'id_contact',
        'tel',
        'nom',
        'prenom',
        'email',
        'adresse',
        'code_postal',
        'ville',
        'url_contact_folder',
        'id_client_stripe',
        'url_client_stripe',
        'description',
        'date_creation',
        'date_update',
        'id_parrainage',
        'nationalite',
        'pays_residence',
        'date_naissance',
        'pseudo',
        'notification_contribution_enbled',
        'notification_contributed_enbled'
    ];
    public $sortable = ['id_contact', 'tel', 'nom', 'prenom', 'email', 'adresse', 'code_postal', 'ville', 'url_contact_folder', 'id_client_stripe', 'url_client_stripe', 'description', 'date_creation', 'date_update', 'id_parrainage'];

    protected $primaryKey = 'id_contact';

    public function experiences()
    {
        return $this->belongsToMany(Experience::class, 'contact_experience', 'id_contact', 'id_experience');
    }

    public function projets()
    {
        return $this->belongsToMany(Projets::class, 'contact_projets', 'id_contact', 'id_projet');
    }

    public function comptes()
    {
        return $this->belongsToMany(Compte::class, 'contact_compte', 'id_contact', 'id_compte');
    }

    public function avoirs()
    {
        return $this->hasMany(Avoir::class, 'id_contact'); // Assurez-vous que la clé étrangère est correctement définie
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'id_contact', 'id_contact');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('photo_menu')
            ->width(110)
            ->height(110)
            ->sharpen(10);
        $this->addMediaConversion('photo_barre_menu')
            ->width(50)
            ->height(50)
            ->sharpen(10);
    }

    public function contact_entreprises()
    {
        return $this->hasOne(ContactEntreprise::class, 'id_contact');
    }
}
