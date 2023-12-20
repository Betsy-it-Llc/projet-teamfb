<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Email
 * 
 * @property int $id_cause
 * @property string|null $expediteur
 * @property string|null $destinataire
 * @property string|null $sujet
 * @property string|null $corps
 * @property Carbon|null $date_envoi
 * @property string|null $cc
 * @property string|null $bcc
 * @property string|null $pieces_jointes
 * @property string|null $lu
 * @property int|null $id_cause_1
 * @property int $id_contact
 * 
 * @property Email|null $email
 * @property Contact $contact
 * @property Collection|Email[] $emails
 *
 * @package App\Models
 */
class Email extends Model
{
	protected $table = 'email';
	protected $primaryKey = 'id_cause';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'date_envoi' => 'datetime',
		'id_cause_1' => 'int',
		'id_contact' => 'int'
	];

	protected $fillable = [
		'expediteur',
		'destinataire',
		'sujet',
		'corps',
		'date_envoi',
		'cc',
		'bcc',
		'pieces_jointes',
		'lu',
		'id_cause_1',
		'id_contact'
	];

	public function email()
	{
		return $this->belongsTo(Email::class, 'id_cause_1');
	}

	public function contact()
	{
		return $this->belongsTo(Contact::class, 'id_contact');
	}

	public function emails()
	{
		return $this->hasMany(Email::class, 'id_cause_1');
	}
}
