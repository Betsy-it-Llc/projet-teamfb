<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ContactExperience
 * 
 * @property int $id_experience
 * @property int $id_contact
 * @property string|null $profil
 * @property string|null $personna
 * @property string|null $description
 * 
 * @property Experience $experience
 * @property Contact $contact
 *
 * @package App\Models
 */
class ContactExperience extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
	protected $table = 'contact_experience';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_experience' => 'int',
		'id_contact' => 'int'
	];

	protected $fillable = [
		'id_experience',
		'id_contact',
		'profil',
		'personna',
		'description'
	];

	public function experience()
	{
		return $this->belongsTo(Experience::class, 'id_experience');
	}

	public function contact()
	{
		return $this->belongsTo(Contact::class, 'id_contact');
	}
}
