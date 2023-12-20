<?php

namespace App\Models\experienceApp;

use Spatie\MediaLibrary\HasMedia;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Remise extends Model implements HasMedia
{
    use HasFactory;
    use Sortable;
    use InteractsWithMedia;
    protected $connection = 'mysql2';
    protected $table = 'remise';
    public $timestamps=false;
    protected $primaryKey='id_remise';
    protected $fillable = [
        'id_remise','nom_remise','type_remise','taux','montant','date_debut','date_fin','statut','date_creation','date_update'
       
    ];
    public $sortable = [ 'id_remise','nom_remise','type_remise','taux','montant','date_debut','date_fin','statut','date_creation','date_update'];
}
