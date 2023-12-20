<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediasLalachante extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $table = 'medias_lalachante';
    protected $primaryKey = 'id_media';
    public $timesstamps=false;
}
