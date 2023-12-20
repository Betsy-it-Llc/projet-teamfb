<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class FormulaireWebhook extends Model
{
    use HasFactory;
    use Sortable;
    protected $connection = 'mysql2';
    protected $table1 = 'contact';
    protected $table2 = 'contact_experience';
    protected $table3 = 'experience';
    protected $table4 = 'contact_facture';
    protected $table5 = 'factures';
    protected $table6 = 'facture_produit_service';
    protected $table7 = 'pack_experience';
    protected $table8 = 'autre_prestation_experience';
    protected $fillable = [
        'contact.id_contact',
        'contact.tel',
        'contact.nom',
        'contact.prenom',
        'contact.email',
        'contact.adresse',
        'contact.code_postale',
        'contact.ville',
        'contact.url_contact_folder',
        'contact.url_contact_folder',	
        'contact.id_client_stripe',
        'contact.url_client_stripe',
        'contact.description',
        'contact.id_parrainage',

        'conact_experience.id_experience',
        'conact_experience.id_contact',
        'conact_experience.profil',
        'conact_experience.persona',
        'conact_experience.description',

        'experience.Textes complets',
        'experience.id_experience',
        'experience.numero_experience',
        'experience.nom_experience',
        'experience.histoire_experience', 
        'experience.url_experience_folder', 	
        'experience.id_produit',
        'experience.id_pack',

        'contact_facture.num_facture',
        'contact_facture.id_contact',

	    'factures.num_facture',
        'factures.description_lib',
        'factures.prix_facture',
        'factures.statut_facture',
        'factures.id_stripe',
        'factures.url_facture',
        'factures.url_stripe',
        'factures.nb_paiement',

	    'facture_produit_service.num_facture',
        'facture_produit_service.id_produit',
        'facture_produit_service.quantity',

        'pack_experience.id_pack_experience',
        'pack_experience.nb_titres',
        'pack_experience.nb_participants',
        'pack_experience.id_pack',
        'pack_experience.num_facture',

	    'autre_prestation_experience.id_produit',
        'autre_prestation_experience.id_pack_experience',

    ];
    public $sortable = [
        'contact.id_contact',
        'contact.tel',
        'contact.nom',
        'contact.prenom',
        'contact.email',
        'contact.adresse',
        'contact.code_postale',
        'contact.ville',
        'contact.url_contact_folder',
        'contact.url_contact_folder',	
        'contact.id_client_stripe',
        'contact.url_client_stripe',
        'contact.description',
        'contact.id_parrainage',

        'conact_experience.id_experience',
        'conact_experience.id_contact',
        'conact_experience.profil',
        'conact_experience.persona',
        'conact_experience.description',

        'experience.Textes complets',
        'experience.id_experience',
        'experience.numero_experience',
        'experience.nom_experience',
        'experience.histoire_experience', 
        'experience.url_experience_folder', 	
        'experience.id_produit',
        'experience.id_pack',

        'contact_facture.num_facture',
        'contact_facture.id_contact',

	    'factures.num_facture',
        'factures.description_lib',
        'factures.prix_facture',
        'factures.statut_facture',
        'factures.id_stripe',
        'factures.url_facture',
        'factures.url_stripe',
        'factures.nb_paiement',

	    'facture_produit_service.num_facture',
        'facture_produit_service.id_produit',
        'facture_produit_service.quantity',

        'pack_experience.id_pack_experience',
        'pack_experience.nb_titres',
        'pack_experience.nb_participants',
        'pack_experience.id_pack',
        'pack_experience.num_facture',

	    'autre_prestation_experience.id_produit',
        'autre_prestation_experience.id_pack_experience',
    ];
}