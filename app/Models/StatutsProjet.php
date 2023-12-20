<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StatutsProjet
 * 
 * @property int $id
 * @property string|null $valeur
 * 
 * @property Collection|Projet[] $projets
 *
 * @package App\Models
 */
class StatutsProjet extends Model
{
	protected $table = 'statuts_projets';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $fillable = [
		'valeur'
	];

	public function projets()
	{
		return $this->hasMany(Projet::class, 'id_statut_projet');
	}
}
