<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Experimentateur extends Model
{
    use HasFactory;
    use Sortable;
    protected $connection = 'mysql2';
    protected $table = 'contact';
    protected $table1 = 'contact_experience';
    protected $table2 = 'experience';
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
        'id_parrainage',
        'id_experience',
        'numero_experience',
        'personna',
       
    ];
    public $sortable = [  'id_contact',
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
    'id_parrainage',
    'id_experience',
        'numero_experience',
        'personna',];
}
