<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Models\Projets;
use App\Models\experienceApp\Contact;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ContactProjet
 * 
 * @property int $id_contact
 * @property int $id_projet
 * 
 * @property Contact $contact
 * @property Projet $projet
 *
 * @package App\Models
 */
class ContactProjet extends Model
{
    protected $connection = 'mysql2';
	protected $table = 'contact_projets';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_contact' => 'int',
		'id_projet' => 'int'
	];

	public function contact()
	{
		return $this->belongsTo(Contact::class, 'id_contact');
	}

	public function projet()
	{
		return $this->belongsTo(Projet::class, 'id_projet');
	}
}
