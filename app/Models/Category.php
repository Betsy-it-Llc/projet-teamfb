<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * 
 * @property int $id_categorie
 * @property string|null $nom
 * @property string|null $description
 * 
 * @property Collection|Cagnotte[] $cagnottes
 *
 * @package App\Models
 */
class Category extends Model
{
	protected $table = 'categories';
	protected $primaryKey = 'id_categorie';
	public $timestamps = false;
	public $connection = 'mysql2';

	protected $fillable = [
		'nom',
		'description'
	];

	public function cagnottes()
	{
		return $this->hasMany(Cagnotte::class, 'id_categorie');
	}
}
