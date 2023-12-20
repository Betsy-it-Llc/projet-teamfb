<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;


use App\Models\Compte;
use Kyslik\ColumnSortable\Sortable;
use App\Models\experienceApp\Contact;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class ContactCompte
 * 
 * @property int $id_contact
 * @property int $id_compte
 * 
 * @property Contact $contact
 * @property Compte $compte
 *
 * @package App\Models
 */
class ContactCompte extends Model
{
    protected $connection = 'mysql2';
	protected $table = 'contact_compte';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_contact' => 'int',
		'id_compte' => 'int'
	];

	public function contact()
	{
		return $this->belongsTo(Contact::class, 'id_contact');
	}

	public function compte()
	{
		return $this->belongsTo(Compte::class, 'id_compte');
	}
}
