<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UtilisateurContribution extends Model implements HasMedia
{
    use HasFactory;
    use Sortable;
    use InteractsWithMedia;
    protected $connection = 'mysql2';
    protected $table = '';
    protected $table1 = '';

    protected $fillable = [];
    public $sortable = [];
}
