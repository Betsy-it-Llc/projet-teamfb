<?php

namespace App\Models\experienceApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $connection = 'mysql2';
}
