<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupecampagne extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_campagne';
    protected $table = 'groupecampagnes';
    protected $fillable = [
        'id_campagne','nom', 'score','date_debut','date_fin','contexte','contenu_post_mere', 'objectifs', 'recommandation',
        'bilan','date_programmation','nb_likes','nb_comments', 'nb_shares', 'portee','id_segmentation',
    ];
}
