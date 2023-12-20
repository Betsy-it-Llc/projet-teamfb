<?php

namespace App\Models\experienceApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperienceStatut extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $table = 'experience_statut';
    protected $primaryKey = 'id_statut_experience';
}
