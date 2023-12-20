<?php

namespace App\Models\experienceApp;

use App\Models\experienceApp\Pack;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PackExperience extends Model
{
    use HasFactory;

    protected $table = 'pack_experience';
    protected $primaryKey = 'id_pack_experience';
    protected $connection = 'mysql2';
    public $timestamps = false;
    protected $fillable = [
        'nb_titres',
        'nb_participants',
        'id_pack',
        'num_facture',
        'id_experience',
        'id_liste_prix',
        'id_historique_remise'
    ];

    public function pack()
    {
        return $this->belongsTo(Pack::class, 'id_pack');
    }
}
