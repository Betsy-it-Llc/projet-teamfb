<?php

namespace App\Models\experienceApp;

use Spatie\MediaLibrary\HasMedia;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pack extends Model implements HasMedia
{
    use HasFactory;
    use Sortable;
    use InteractsWithMedia;

    protected $connection = 'mysql2';
    protected $table = 'pack';
    protected $primaryKey = 'id_pack';
    public $timestamps=false;

    protected $fillable=
    [
        'id_pack',
        'nom',
        'prix',
        'abstract',
        'description',
        'date_creation',
        'date_update',
        'statut',
        'id_stripe_pack',
        'url_stripe_pack'
    ];

    protected $sortable=
    [
        'id_pack',
        'nom',
        'prix',
        'abstract',
        'description',
        'date_creation',
        'date_update',
        'statut',
        'id_stripe_pack',
        'url_stripe_pack'
    ];
}
