<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;
    use Sortable;

    
    protected $connection = 'mysql2';
    protected $primaryKey = 'id_contact';
    protected $table = 'contact';

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
        'id_parrainage'
       
    ];
    public $sortable = [   'id_contact','tel','nom','prenom','email','adresse','code_postal','ville', 'url_contact_folder', 'id_client_stripe', 'url_client_stripe','description', 'id_parrainage'];
}
