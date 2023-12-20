<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Utilisateur extends Model
{
    use HasFactory;
    use Sortable;

    protected $primaryKey = 'id_utilisateur';
    protected $table = 'utilisateurs';
    protected $fillable = [
        'id_utilisateur',
        'nom',
        'prenom',
        'genre',
        'url_utilisateur'   
    ];

    public $sortable = [ 'nom', 'prenom','genre','id-utilisateur','updated_at','created_at'];

}
