<?php

namespace App\Models\experienceApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Interaction extends Model
{
    use HasFactory;
    use Sortable;

    protected $connection = 'mysql2';
    protected $table = 'interaction';
    public $timestamps = false;
    protected $primaryKey = 'id_interaction';
    
    protected $fillable = [
        'id_interaction',
        'date_heure',
        'texte',
        'type_interaction',
        'id_contact',
        'id_experience'
    ];
    public $sortable = [  
    'id_interaction',
    'date_heure',
    'texte',
    'type_interaction',
    'id_contact',
    'id_experience'];
}
