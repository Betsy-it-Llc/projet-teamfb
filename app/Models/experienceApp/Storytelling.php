<?php

namespace App\Models\experienceApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Storytelling extends Model
{
    use HasFactory;
    use Sortable;

    protected $connection = 'mysql2';
    protected $table = 'storytelling';
    protected $table1 = 'contents_experience';
    protected $table2 = 'experience';
    
    protected $fillable = [
        'id_storytelling',
        'description',
        'tags',
        'id_experience',
        'nom_experience',
        'date_heure',
        
    ];
    public $sortable = [ 'id_storytelling',
    'description',
    'tags',
    'id_experience',
    'nom_experience',
    'date_heure',];
}
