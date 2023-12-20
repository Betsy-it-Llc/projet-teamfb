<?php

namespace App\Models\experienceApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Notification extends Model
{
    use HasFactory;
    use Sortable;
    protected $connection = 'mysql3';
    protected $table = 'notification';
    public $timestamps = false;
    protected $fillable = [
        'id_notification',
        'date',
        'heure',
        'automation',
        'statut',
        'message',
        'url_workflow',
           
    ];
    public $sortable = [ 'id_notification', 'date','heure','automation','statut', 'message', 'url_workflow'];
}
