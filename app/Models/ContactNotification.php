<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ContactNotification
 * 
 * @property int $id_notification
 * @property Carbon|null $date_creation
 * @property int $id_contact
 * 
 * @property Notification $notification
 * @property Contact $contact
 *
 * @package App\Models
 */
class ContactNotification extends Model
{
	protected $table = 'contact_notification';
	protected $primaryKey = 'id_notification';
	public $incrementing = false;
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'id_notification' => 'int',
		'date_creation' => 'datetime',
		'id_contact' => 'int'
	];

	protected $fillable = [
		'date_creation',
		'id_contact'
	];

	public function notification()
	{
		return $this->belongsTo(Notification::class, 'id_notification');
	}

	public function contact()
	{
		return $this->belongsTo(Contact::class, 'id_contact');
	}
}
