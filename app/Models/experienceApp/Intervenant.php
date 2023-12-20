<?php

namespace App\Models\experienceApp;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Lecturize\Addresses\Traits\HasContacts;
use Lecturize\Addresses\Traits\HasAddresses;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Intervenant extends Model
{
    use HasFactory;
    use Sortable;
    use HasAddresses;
    use HasContacts;
    protected $connection = 'mysql2';
    protected $table = 'contact';
    protected $table1 = 'intervenant';
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
        'id_intervenant_',
        'ville_intervention',
        'role_',
       
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
    'id_intervenant_',
        'ville_intervention',
        'role_',];
}
