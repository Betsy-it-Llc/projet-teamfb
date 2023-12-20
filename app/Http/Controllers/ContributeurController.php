<?php

namespace App\Http\Controllers;



use App\Models\Contribution;
use App\Models\experienceApp\ExperienceStatut;
use Illuminate\Http\Request;

class ContributeurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Récupérez les contributeurs avec les informations nécessaires
        $contributeurs = Contribution::with('cagnotte.experience.projet', 'contact')
            ->orderBy('date_contribution', 'desc')
            ->groupBy('id_contact')
            ->selectRaw('id_contact, COUNT(DISTINCT cagnottes.id_projet) as total_projets, SUM(montant) as total_montant')
            ->join('cagnottes', 'contributions.id_cagnotte', '=', 'cagnottes.id_cagnotte')
            ->get();
        // Obtenez le nombre total de contributeurs
        $totalContributeurs = $contributeurs->count();

        // Passez les données à la vue pour les afficher
        return view('contributeurs.index', [
            'contributeurs' => $contributeurs,
            'totalContributeurs' => $totalContributeurs,
        ]);
    }


    protected function search($query, Request $request)
    {
        // Récupérez les valeurs de recherche depuis la requête
        $multisearchprenom = $request->get('multisearchprenom');
        $multisearchnom = $request->get('multisearchnom');
        $multisearchdate = $request->get('multisearchdate');
        $minProjetCount = $request->get('min_projet_count'); // Ajoutez cette ligne

        // Appliquez les conditions de recherche si elles sont définies
        if ($multisearchprenom) {
            $query->whereHas('contact', function ($subquery) use ($multisearchprenom) {
                $subquery->where('prenom', 'LIKE', '%' . $multisearchprenom . '%');
            });
        }

        if ($multisearchnom) {
            $query->whereHas('contact', function ($subquery) use ($multisearchnom) {
                $subquery->where('nom', 'LIKE', '%' . $multisearchnom . '%');
            });
        }

        if ($multisearchdate) {
            $query->where('date_contribution', 'LIKE', '%' . $multisearchdate . '%');
        }

        // Appliquez la condition de recherche pour le nombre minimum de projets
        if ($minProjetCount) {
            $query->whereHas('contact', function ($subquery) use ($minProjetCount) {
                $subquery->has('projets', '>=', $minProjetCount);
            });
        }

        // Retournez la requête modifiée
        return $query;
    }


    public function show($id_contact)
    {
        // Récupérez le contributeur spécifique en fonction de son ID de contact avec les informations de la relation
        $contributeur = Contribution::with('cagnotte.experience.projet', 'contact', 'contributions', 'commentaires')
            ->where('id_contact', $id_contact)
            ->first();



        // Vérifiez si le contributeur a été trouvé
        if ($contributeur) {
            // Obtenez le montant total des contributions de ce contributeur à partir de la relation
            $totalMontant = $contributeur->contributions->sum('montant');

            // Obtenez les commentaires de ce contributeur
            $commentaires = $contributeur->commentaires;

            // Passez les données à la vue pour les afficher
            return view('contributeurs.show', [
                'contributeur' => $contributeur,
                'totalMontant' => $totalMontant,
                'commentaires' => $commentaires,
            ]);
        } else {
            // Gérez le cas où le contributeur n'a pas été trouvé
            // Par exemple, redirigez vers une page d'erreur
            return redirect()->route('page_erreur');
        }
    }


    public function edit()
    {
        return view('contributeurs.edit');
    }

    public function store()
    {
        return view('contributeurs.store');
    }

    public function update()
    {
        return view('contributeurs.update');
    }

    public function destroy()
    {
        return view('contributeurs.destroy');
    }
}
