<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Entreprise extends Model
{
    use HasFactory;
    use Sortable;
    protected $connection = 'mysql2';
    protected $table = 'organisation';
    protected $primaryKey = 'id_organisation';
    public $timestamps = false;
    protected $fillable = [
        'id_organisation',
        'tel',
        'nom',
        'email',
        'adresse',
        'code_postal',
        'ville',
        'num_cse',
        'description',
        'nb_salarie',
        'date_creation',
        'date_update'
    ];	 

    public $sortable = [    
    'id_organisation',
    'tel',
    'nom',
    'email',
    'adresse',
    'code_postal',
    'ville',
    'num_cse',
    'description',
    'nb_salarie',
    'date_creation',
    'date_update'
    ];
}
