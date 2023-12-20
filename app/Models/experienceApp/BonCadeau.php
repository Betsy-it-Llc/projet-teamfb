<?php

namespace App\Models\experienceApp;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\InteractsWithMedia;


class BonCadeau extends Model implements HasMedia
{
    use HasFactory;
    use Sortable;
    use InteractsWithMedia;

    protected $connection = 'mysql2';
    protected $table = 'bon_cadeau';
    public $timestamps = false ;
    protected $primaryKey = 'id_bonCadeau';

    protected $fillable = [
        'id_bonCadeau',
        'nom_destinataire',
        'titre',
        'message',
        'url',
        'id_content_experience'
    ];

    protected $sortable = [
        'id_bonCadeau',
        'nom_destinataire',
        'titre',
        'message',
        'url',
        'id_content_experience'
    ];
}
