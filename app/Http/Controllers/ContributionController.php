<?php

namespace App\Http\Controllers;

use App\Models\Contribution;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ContributionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Récupérez les données à partir du modèle Contribution avec les relations
        $contributions = Contribution::with('cagnotte.experience.projet', 'contact')
            ->orderBy('date_contribution', 'desc');

        // Utilisez la fonction de recherche pour appliquer les conditions
        $contributions = $this->search($request);

        // Obtenez le total des données
        $totalContributions = $contributions->count();

        // Passez les données à la vue pour les afficher
        return view('contributions.index', [
            'contributions' => $contributions,
            'totalContributions' => $totalContributions,
        ]);
    }


    public function show($id_contribution)
    {
        // Récupérez la contribution spécifique en fonction de son ID
        $contribution = Contribution::with('cagnotte.projet.experiences', 'contact', 'cagnotte.projet.types_Projet')
            ->findOrFail($id_contribution);


        // Assurez-vous que la relation cagnotte existe et n'est pas nulle
        if ($contribution->cagnotte) {
            // Accédez au projet associé à la cagnotte
            $projet = $contribution->cagnotte->projet;

            // Assurez-vous que le projet existe et n'est pas nul
            if ($projet) {
                // Accédez aux expériences associées au projet
                $experiences = $projet->experiences;

                // Vous pouvez boucler à travers les expériences ici si nécessaire
                // Par exemple, pour obtenir le premier id_experience, vous pouvez utiliser :
                $id_experience = $experiences->first()->id_experience;

                // Récupérez la facture associée à cet id_experience
                $facture = $contribution->facturePourExperience($id_experience);

                if ($facture) {
                    // Accédez aux données de la facture
                    $num_facture = $facture->num_facture;
                } else {
                    // Gérez le cas où il n'y a pas de facture associée
                    $num_facture = null;
                }
            } else {
                // Gérez le cas où il n'y a pas de projet associé à la cagnotte
                $num_facture = null;
            }
        } else {
            // Gérez le cas où il n'y a pas de cagnotte associée à la contribution
            $num_facture = null;
        }

        // Passez les données à la vue pour les afficher
        return view('contributions.show', [
            'contribution' => $contribution,
            'num_facture' => $num_facture,
        ]);
    }

    public function search(Request $request)
    {
        // Récupérez les valeurs de recherche depuis la requête
        $multisearchprenom = $request->get('multisearchprenom');
        $multisearchnom = $request->get('multisearchnom');
        $multisearchexperience = $request->get('multisearchexperience');
        $multisearchdate = $request->get('multisearchdate');

        // Créez une instance de Contribution avec les relations
        $contributions = Contribution::with('cagnotte.experience.projet', 'contact')
            ->orderBy('date_contribution', 'desc');

        // Appliquez les conditions de recherche si elles sont définies
        // ...

        // Effectuez la recherche et récupérez les résultats
        $contributions = $contributions->get();

        return $contributions;
    }


    public function edit()
    {
        return view('contributions.edit');
    }

    public function store()
    {
        return view('contributions.store');
    }

    public function update()
    {
        return view('contributions.update');
    }

    public function destroy()
    {
        return view('contributions.destroy');
    }
}
