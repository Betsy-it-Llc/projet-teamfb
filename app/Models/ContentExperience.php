<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\experienceApp\Storytelling;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContentExperience extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table="contents_experience";

    public function storytelling()
    {
        return $this->belongsTo(Storytelling::class,'id_storytelling');
    }
}
