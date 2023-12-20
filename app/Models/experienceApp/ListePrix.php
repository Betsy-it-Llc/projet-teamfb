<?php

namespace App\Models\experienceApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListePrix extends Model
{
    //use HasFactory;
    protected $table = 'liste_prix';
	protected $primaryKey = 'id_liste_prix';
    protected $connection = 'mysql2';

    protected $fillable = [
        'prix',
        'statut',
        'date_creation',
        'id_pack',
        'id_produit'
	];
}
