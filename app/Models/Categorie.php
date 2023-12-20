<?php

namespace App\Models;

use App\Models\Cagnotte;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// Modèle Categorie
class Categorie extends Model
{

    use HasFactory;
    use Sortable;

    protected $connection = 'mysql2';
    protected $table = 'categories';
    protected $primaryKey = 'id_categorie';
    protected $fillable = ['nom', 'description'];
    public $timestamps = false;

    public function cagnottes()
    {
        return $this->hasMany(Cagnotte::class, 'id_categorie', 'id_categorie');
    }

    public function calculerMontantTotal()
    {
        return $this->cagnottes->sum('montant_actuel');
    }
}
