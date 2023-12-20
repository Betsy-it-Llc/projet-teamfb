<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Models\experienceApp\Experience;
use App\Models\experienceApp\ExperienceStatut;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kyslik\ColumnSortable\Sortable;
use App\Models\Projets;
use App\Models\Cagnotte;
use App\Models\Categorie;
use App\Models\Commentaire;
use App\Models\TypesProjets;
use App\Models\StatutsProjets;
use App\Models\ContactExperience;
use App\Models\experienceApp\Contact;
use App\Models\FactureProduitService;

/**
 * Class Contribution
 * 
 * @property int $id_contributions
 * @property Carbon|null $date_contribution
 * @property string|null $mode_paiement
 * @property string|null $statut
 * @property float|null $montant
 * @property string|null $frais
 * @property string|null $message
 * @property bool|null $is_anonymous
 * @property int $id_cagnotte
 * @property int $id_contact
 * 
 * @property Cagnotte $cagnotte
 * @property Contact $contact
 *
 * @package App\Models
 */
class Contribution extends Model
{
    use HasFactory;
    use Sortable;

    protected $connection = 'mysql2';
    protected $table = 'contributions';
    protected $primaryKey = 'id_contributions';
    public $timestamps = false;

    protected $casts = [
        'date_contribution' => 'datetime',
        'montant' => 'float',
        'is_anonymous' => 'bool',
        'is_hidden_price' => 'bool',
        'id_cagnotte' => 'int',
        'id_contact' => 'int'
    ];

    protected $fillable = [
        'date_contribution',
        'mode_paiement',
        'statut',
        'montant',
        'frais',
        'message',
        'is_anonymous',
        'is_hidden_price',
        'id_cagnotte',
        'id_contact'
    ];

    public $sortable = [
        'date_contribution',
        'mode_paiement',
        'statut',
        'montant',
        'frais',
        'message',
        'is_anonymous',
        'is_hidden_price',
        'id_cagnotte',
        'id_contact'
    ];

    public function cagnotte()
    {
        return $this->belongsTo(Cagnotte::class, 'id_cagnotte');
    }


    protected $dates = [
        'date_contribution',
    ];

    public function getDateContributionFormatted()
    {
        // Vérifiez si la date est définie
        if ($this->date_contribution) {
            $date = Carbon::createFromFormat('Y-m-d H:i:s', $this->date_contribution);
            return $date->format('d/m/Y');
        }
    }

    public function getDateContributionPlusRecenteAttribute()
    {
        $date = $this->where('id_contact', $this->id_contact)
            ->orderBy('date_contribution', 'desc')
            ->value('date_contribution');

        // Formatez la date sans l'heure
        return Carbon::parse($date)->format('d/m/Y');
    }

    public function getHeureContributionFormattedAttribute()
    {
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['date_contribution']);
        return $date->format('H:i:s');
    }

    protected $orderBy = [
        'date_contribution' => 'desc', // Tri par défaut
    ];

    public function facturePourExperience($id_experience)
    {
        return FactureProduitService::where('id_experience', $id_experience)->first();
    }

    public function projet()
    {
        return $this->cagnotte->belongsTo(Projets::class, 'id_projet');
    }

    public function typeProjet()
    {
        return $this->projet->belongsTo(TypesProjets::class, 'id_type_projet');
    }

    public function statutProjet()
    {
        return $this->projet->belongsTo(StatutsProjets::class, 'id_statut_projet');
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class, 'id_contact', 'id_contact');
    }

    public function experience()
    {
        return $this->belongsTo(Experience::class, 'id_experience', 'id_experience');
    }

    public function nomExperience()
    {
        $firstExperience = $this->cagnotte->projet->experiences->first();

        return $firstExperience
            ? $firstExperience->nom_experience
            : 'Aucune expérience disponible';
    }

    public function idExperience()
    {
        $firstExperience = $this->cagnotte->projet->experiences->first();

        return $firstExperience
            ? $firstExperience->id_experience
            : null; // Ou une valeur par défaut appropriée
    }

    public function numExperience()
    {
        $firstExperience = $this->cagnotte->projet->experiences->first();

        return $firstExperience
            ? $firstExperience->numero_experience
            : null; // Ou une valeur par défaut appropriée
    }
    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'id_categorie');
    }

    public function getNomCategorieAttribute()
    {
        // Si vous avez une méthode "categorie" définie, vous pouvez accéder au nom de la catégorie ainsi
        return $this->categorie ? $this->categorie->nom : null;
    }

    // Dans le modèle Contribution
    public function contributions()
    {
        return $this->hasMany(Contribution::class, 'id_contact', 'id_contact');
    }

    // Contribution.php

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'id_contact', 'id_contact');
    }
}
