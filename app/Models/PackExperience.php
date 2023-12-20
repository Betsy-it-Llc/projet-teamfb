<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PackExperience
 * 
 * @property int $id_pack_experience
 * @property int|null $nb_titres
 * @property int|null $nb_participants
 * @property int $id_pack
 * @property int $num_facture
 * @property int|null $id_experience
 * @property int $id_liste_prix
 * @property int|null $id_historique_remise
 * 
 * @property Pack $pack
 * @property Facture $facture
 * @property Experience|null $experience
 * @property ListePrix $liste_prix
 * @property HistoriqueRemise|null $historique_remise
 * @property Collection|AutrePrestationExperience[] $autre_prestation_experiences
 *
 * @package App\Models
 */
class PackExperience extends Model
{
	protected $table = 'pack_experience';
	protected $primaryKey = 'id_pack_experience';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $casts = [
		'nb_titres' => 'int',
		'nb_participants' => 'int',
		'id_pack' => 'int',
		'num_facture' => 'int',
		'id_experience' => 'int',
		'id_liste_prix' => 'int',
		'id_historique_remise' => 'int'
	];

	protected $fillable = [
		'nb_titres',
		'nb_participants',
		'id_pack',
		'num_facture',
		'id_experience',
		'id_liste_prix',
		'id_historique_remise'
	];

	public function pack()
	{
		return $this->belongsTo(Pack::class, 'id_pack');
	}

	public function facture()
	{
		return $this->belongsTo(Facture::class, 'num_facture');
	}

	public function experience()
	{
		return $this->belongsTo(Experience::class, 'id_experience');
	}

	public function liste_prix()
	{
		return $this->belongsTo(ListePrix::class, 'id_liste_prix');
	}

	public function historique_remise()
	{
		return $this->belongsTo(HistoriqueRemise::class, 'id_historique_remise');
	}

	public function autre_prestation_experiences()
	{
		return $this->hasMany(AutrePrestationExperience::class, 'id_pack_experience');
	}

	public function experienceStatutNotification()
	{
		return $this->hasMany(ExperienceStatutNotification::class, 'id_experience');
	}
}
