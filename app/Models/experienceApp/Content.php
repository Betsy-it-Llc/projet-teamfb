<?php

namespace App\Models\experienceApp;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Content extends Model
{
    use HasFactory;
    use Sortable;

    protected $connection = 'mysql2';
    protected $table = 'contact';
    protected $table1 = 'contact_experience';
    protected $table2 = 'experience';
    protected $table3 = 'contents_experience';
    protected $fillable = [
        'id_experience',
        'nom',
        'prenom',
        'type',
        'description_',
        'id_content_experience',
        'url_experience_folder'
    ];
    public $sortable = ['id_experience',
    'nom',
    'prenom',
    'type',
    'description_',
    'id_content_experience',
    'url_experience_folder'];
}
