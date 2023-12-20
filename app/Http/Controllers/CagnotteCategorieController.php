<?php

namespace App\Http\Controllers;

use App\Models\CagnotteCategorie;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CagnotteCategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Récupérez toutes les catégories avec leurs cagnottes associées
        $categories = Categorie::with('cagnottes')->get();

        // Calcul du nombre de contributeurs par catégorie
        $contributeursParCategorie = [];

        // Calcul du montant total par catégorie
        $montantTotalParCategorie = [];

        foreach ($categories as $categorie) {
            $totalContributeurs = 0;
            $montantTotal = 0;

            foreach ($categorie->cagnottes as $cagnotte) {
                $totalContributeurs += $cagnotte->contributions->count();
                $montantTotal += $cagnotte->montant_actuel;
            }

            $contributeursParCategorie[$categorie->id_categorie] = $totalContributeurs;
            $montantTotalParCategorie[$categorie->id_categorie] = $montantTotal;
        }

        // Passez les données à la vue pour les afficher
        return view('cagnottecategories.index', [
            'categories' => $categories,
            'contributeursParCategorie' => $contributeursParCategorie,
            'montantTotalParCategorie' => $montantTotalParCategorie,
        ]);
    }


    public function show($id_categorie)
    {
        // Récupérez la cagnotte spécifique en fonction de son ID avec la relation "contacts" et "contributions"
        $categorie = Categorie::with(['cagnottes'])->findOrFail($id_categorie);

        // Calcul du montant total à partir du modèle de catégorie
        $montantTotal = $categorie->calculerMontantTotal();

        // Calcul du nombre de cagnottes pour cette catégorie
        $nombreCagnottes = $categorie->cagnottes->count();

        // Créer un tableau pour stocker les contributions par contributeur
        $contributionsParContributeur = [];

        foreach ($categorie->cagnottes as $cagnotte) {
            foreach ($cagnotte->contributions as $contribution) {
                $idContributeur = $contribution->id_contact;

                // Vérifier si l'ID du contributeur existe déjà dans le tableau
                if (!isset($contributionsParContributeur[$idContributeur])) {
                    $contributionsParContributeur[$idContributeur] = [
                        'nom' => $contribution->contact->nom,
                        'prenom' => $contribution->contact->prenom,
                        'pseudo' => $contribution->contact->pseudo,
                        'total' => 0,
                        'nombre' => 0,
                    ];
                }

                // Ajouter le montant de la contribution au total du contributeur
                $contributionsParContributeur[$idContributeur]['total'] += $contribution->montant;
                // Incrémenter le nombre de contributions du contributeur
                $contributionsParContributeur[$idContributeur]['nombre']++;
            }
        }

        // Calcul du nombre total de contributeurs uniques
        $nombreContributeurs = 0;

        foreach ($categorie->cagnottes as $cagnotte) {
            $contributeursUniques = [];

            foreach ($cagnotte->contributions as $contribution) {
                if (!in_array($contribution->id_contact, $contributeursUniques)) {
                    $contributeursUniques[] = $contribution->id_contact;
                    $nombreContributeurs++;
                }
            }
        }

        // Passez les données à la vue pour les afficher
        return view('cagnottecategories.show', [
            'categorie' => $categorie,
            'montantTotal' => $montantTotal,
            'nombreCagnottes' => $nombreCagnottes,
            'contributionsParContributeur' => $contributionsParContributeur,
            'nombreContributeurs' => $nombreContributeurs,
        ]);
    }

    public function edit($id_categorie)
    {
        // Récupérez la catégorie à éditer
        $categorie = Categorie::findOrFail($id_categorie);

        // Affichez la vue d'édition avec les données de la catégorie
        return view('cagnottecategories.edit', ['categorie' => $categorie]);
    }

    public function update(Request $request, $id_categorie)
    {
        // Validez les données du formulaire (vous pouvez utiliser la validation Laravel ici)

        // Récupérez la catégorie à mettre à jour
        $categorie = Categorie::findOrFail($id_categorie);

        // Mettez à jour les attributs de la catégorie avec les nouvelles données
        $categorie->nom = $request->input('nom');
        $categorie->description = $request->input('description');
        $categorie->save();

        // Redirigez l'utilisateur vers la liste des catégories ou une autre page appropriée
        return redirect()->route('cagnottecategories.index')->with('success', 'La catégorie a été mise à jour avec succès.');
    }

    public function store(Request $request)
    {
        // Validez les données du formulaire
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            // Ajoutez ici les règles de validation pour d'autres champs du formulaire si nécessaire
        ]);

        // Créez une nouvelle catégorie en utilisant les données validées
        $categorie = new Categorie($validatedData);

        // Enregistrez la nouvelle catégorie dans la base de données
        $categorie->save();

        return redirect()->route('cagnottecategories.index',);
    }

    public function create()
    {
        return view('cagnottecategories.create');
    }


    public function destroy($id_categorie)
    {
        // Récupérez la catégorie à supprimer
        $categorie = Categorie::findOrFail($id_categorie);

        // Supprimez la catégorie
        $categorie->delete();

        // Redirigez l'utilisateur vers la liste des catégories ou une autre page appropriée
        return redirect()->route('cagnottecategories.index')->with('success', 'La catégorie a été supprimée avec succès.');
    }
}
