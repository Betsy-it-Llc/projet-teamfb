<?php

namespace App\Models\experienceApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class ContactCodePromo extends Model
{
    use HasFactory;
    use Sortable;
    protected $connection = 'mysql2';
    protected $table = 'contact_code_promo';
    public $timestamps = false;

    protected $fillable = [
        'id_contact',
        'id_code'
    ];
    protected $sortable = [
        'id_contact',
        'id_code'
    ];
}
