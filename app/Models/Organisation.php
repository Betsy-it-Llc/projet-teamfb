<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Organisation
 * 
 * @property int $id_organisation
 * @property string|null $nom
 * @property string|null $tel
 * @property string|null $email
 * @property string|null $adresse
 * @property string|null $code_postal
 * @property string|null $ville
 * @property int|null $nb_salarie
 * @property string|null $num_cse
 * @property string|null $description
 * @property Carbon|null $date_creation
 * @property Carbon|null $date_update
 * 
 * @property Collection|ContactEntreprise[] $contact_entreprises
 * @property Collection|Cagnotte[] $cagnottes
 * @property Collection|Projet[] $projets
 * @property Collection|RemiseEntreprise[] $remise_entreprises
 *
 * @package App\Models
 */
class Organisation extends Model
{
	protected $table = 'organisation';
	protected $primaryKey = 'id_organisation';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'nb_salarie' => 'int',
		'date_creation' => 'datetime',
		'date_update' => 'datetime'
	];

	protected $fillable = [
		'nom',
		'tel',
		'email',
		'adresse',
		'code_postal',
		'ville',
		'nb_salarie',
		'num_cse',
		'description',
		'date_creation',
		'date_update',
		'drive_url'
	];

	public function contact_entreprises()
	{
		return $this->hasMany(ContactEntreprise::class, 'id_organisation');
	}

	public function cagnottes()
	{
		return $this->belongsToMany(Cagnotte::class, 'organisation_cagnotte', 'id_organisation', 'id_cagnotte');
	}

	public function projets()
	{
		return $this->belongsToMany(Projet::class, 'organisation_projet', 'id_organisation', 'id_projet');
	}

	public function remise_entreprises()
	{
		return $this->hasMany(RemiseEntreprise::class, 'id_organisation');
	}
}
