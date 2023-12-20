<?php

namespace App\Models\experienceApp;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Facture extends Model
{
    use HasFactory;
    use Sortable;
    protected $connection = 'mysql2';

    protected $table = 'factures';
    public $timestamps = false;
    protected $primaryKey = 'num_facture';
    protected $fillable = [
        'num_facture',
        'description_lib',
        'prix_facture',
        'statut_facture',
        'id_stripe',
        'url_facture',
        'url_stripe',
        'nb_paiement',
        'canal_reservation',
        'date_creation',
        'date_update',
        'id_historique_remise'
    ];


    protected $sortable = [
        'num_facture',
        'description_lib',
        'prix_facture',
        'statut_facture',
        'id_stripe',
        'url_facture',
        'url_stripe',
        'nb_paiement',
        'canal_reservation',
        'date_creation',
        'date_update',
        'id_historique_remise'
    ];
}
