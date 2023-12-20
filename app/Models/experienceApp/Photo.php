<?php

namespace App\Models\experienceApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $table = 'photo';
    protected $primarykey = 'id_photo';
}
