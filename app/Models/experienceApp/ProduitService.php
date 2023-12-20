<?php

namespace App\Models\experienceApp;

use Spatie\MediaLibrary\HasMedia;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProduitService extends Model implements HasMedia
{
    use HasFactory;
    use Sortable;
    use InteractsWithMedia;
    protected $connection = 'mysql2';
    protected $primaryKey = 'id_produit';
    protected $table = 'produits_services';
    public $timestamps = false;
    protected $fillable = [
        'id_produit',
        'nom_produit',
        'prix',
        'abstract',
        'categorie',
        'description',
        'date_creation',
        'date_update',
        'statut',
        'id_stripe_produit',
        'url_stripe_produit'
    ];
    public $sortable = [ 'id_produit', 'nom_produit', 'prix', 'abstract', 'categorie', 'description', 'date_creation', 'date_update', 'statut', 'id_stripe_produit','url_stripe_produit'];
}
