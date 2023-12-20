<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Models\experienceApp\Experience;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Commentaire
 * 
 * @property int $id_commentaire
 * @property string|null $texte
 * @property Carbon|null $date_creation
 * @property int|null $likes
 * @property int|null $dislikes
 * @property string|null $statut
 * @property int|null $id_commentaire_1
 * @property int $id_experience
 * @property int $id_contact
 * 
 * @property Commentaire|null $commentaire
 * @property Experience $experience
 * @property Contact $contact
 * @property Collection|Commentaire[] $commentaires
 *
 * @package App\Models
 */
class Commentaire extends Model
{
    use HasFactory,InteractsWithMedia;

    protected $connection = 'mysql2';
	protected $table = 'commentaires';
	protected $primaryKey = 'id_commentaire';
	public $timestamps = false;

	protected $casts = [
		'date_creation' => 'datetime',
		'likes' => 'int',
		'dislikes' => 'int',
		'id_commentaire_1' => 'int',
		'id_experience' => 'int',
		'id_contact' => 'int'
	];

	protected $fillable = [
		'texte',
		'date_creation',
		'likes',
		'dislikes',
		'statut',
		'id_commentaire_1',
		'id_experience',
		'id_contact'
	];

	public function commentaire()
	{
		return $this->belongsTo(Commentaire::class, 'id_commentaire_1');
	}

	public function experience()
	{
		return $this->belongsTo(Experience::class, 'id_experience');
	}

	public function contact()
	{
		return $this->belongsTo(Contact::class, 'id_contact');
	}

	public function commentaires()
	{
		return $this->hasMany(Commentaire::class, 'id_commentaire_1');
	}
}
