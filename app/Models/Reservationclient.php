<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Reservationclient extends Model
{
    use HasFactory;
    use Sortable;
    protected $connection = 'mysql2';
    protected $table1 = 'contact';
    protected $table2 = 'experience';
    protected $table3 = 'factures';
    protected $table4 = 'produits_services';
    protected $table5 = 'paiement';
    protected $table6 = 'pack';
    protected $table7 = 'pack_experience';
    protected $table8 = 'experience_statut_notification';
    protected $table9 = 'experience_statut';
    protected $table10 = 'facture_statut_notification';
    protected $table11 = 'facture_statut';
    protected $table12 = 'bon_cadeau';


    protected $fillable = [
        'contact.id_contact',
        'contact.nom',
        'contact.prenom',
        'contact.tel',
        'contact.email',
        'contact.adresse',
        'contact.ville',
        'contact.code_postal',
        'pack_experience.nb_titre',
        'pack_experience.nb_participants',
        'experience_statut.statut_experience',
        'factures.num_facture',
        'factures.prix_facture',
        'facture_statut.statut_facture',
        'pack.id_pack',
        'bon_cadeau.id_bonCadeau',
        'paiement.id_paiment',
        
    ];
    public $sortable = [  'contact.id_contact',
    'contact.nom',
    'contact.prenom',
    'contact.tel',
    'contact.email',
    'contact.adresse',
    'contact.ville',
    'contact.code_postal',
    'pack_experience.nb_titre',
    'pack_experience.nb_participants',
    'experience_statut.statut_experience',
    'factures.num_facture',
    'factures.prix_facture',
    'facture_statut.statut_facture',
    'pack.id_pack',
    'bon_cadeau.id_bonCadeau',
    'paiement.id_paiment',];
}
