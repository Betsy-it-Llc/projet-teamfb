<?php

namespace App\Models;

use App\Models\Projets;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypesProjets extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'types_projets';


    public function projets()
    {
        return $this->hasMany(Projets::class, 'id_type_projet');
    }
}
