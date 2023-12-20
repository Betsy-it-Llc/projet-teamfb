<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Lecturize\Addresses\Traits\HasContacts;
use Lecturize\Addresses\Traits\HasAddresses;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Utilisateur extends Model
{
    use HasFactory;
    use Sortable;
    use HasAddresses;
    use HasContacts;
    
    protected $primaryKey = 'id_utilisateur';
    protected $table = 'utilisateur';
    protected $fillable = [
        'id_utilisateur',
        'Nom',
        'prenom',
        'genre',
        'url_utilisateur',
        'profil',
        'updated_at',
        'created_at'
    ];

    public $sortable = [ 'Nom', 'prenom','genre','id_utilisateur','url_utilisateur','profil'];

}
