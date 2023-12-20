<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Invitation
 * 
 * @property int $id_invitation
 * @property string|null $email_invite
 * @property Carbon|null $date_invite
 * @property string|null $statut
 * @property int $id_cagnotte
 * 
 * @property Cagnotte $cagnotte
 *
 * @package App\Models
 */
class Invitation extends Model
{
	protected $table = 'invitations';
	protected $primaryKey = 'id_invitation';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'date_invite' => 'datetime',
		'id_cagnotte' => 'int'
	];

	protected $fillable = [
		'email_invite',
		'date_invite',
		'statut',
		'id_cagnotte'
	];

	public function cagnotte()
	{
		return $this->belongsTo(Cagnotte::class, 'id_cagnotte');
	}
}
