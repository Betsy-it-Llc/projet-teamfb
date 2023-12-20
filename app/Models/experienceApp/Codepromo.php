<?php

namespace App\Models\experienceApp;


use Spatie\MediaLibrary\HasMedia;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Codepromo extends Model implements HasMedia
{
    use HasFactory;
    use Sortable;
    use InteractsWithMedia;
    protected $connection = 'mysql2';
    protected $table = 'codes_promo';
    public $timestamps = false;
    protected $primaryKey = 'id_code';

    protected $fillable = [
        'id_remise','id_code','code','nb_utilisation','nb_code','description','statut_code','date_creation','date_update','id_stripe_code','url_stripe_code' 	
    ];
    public $sortable = [ 
        'id_remise','id_code','code','nb_utilisation','nb_code','description','statut_code','date_creation','date_update','id_stripe_code','url_stripe_code' ];
}
