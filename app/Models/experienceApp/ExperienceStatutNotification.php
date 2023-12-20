<?php

namespace App\Models\experienceApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ExperienceStatutNotification extends Model
{
    public $timestamps = false;
    protected $connection = 'mysql2';
    protected $table = 'experience_statut_notification';
    protected $primaryKey = 'id_notification';
    protected $fillable = [
        'id_notification',
        'date_statut',
        'id_experience',
        'id_statut_experience'
    ];
}
