<?php

namespace App\Http\Controllers;

use App\Models\Cagnotte;

use App\Models\Historique;
use App\Models\HistoriqueLiaison;
use App\Models\Projet;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CagnotteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Récupérez les données à partir du modèle Cagnotte avec la relation contacts
        $cagnottes = Cagnotte::with('contacts')->get();

        // Obtenez le nombre total de cagnottes
        $totalCagnottes = $cagnottes->count();

        // Passez les données à la vue pour les afficher
        return view('cagnottes.index', [
            'cagnottes' => $cagnottes,
            'totalCagnottes' => $totalCagnottes,
        ]);
    }

    public function show($id_cagnotte)
    {
        // Récupérez la cagnotte spécifique en fonction de son ID avec la relation "contacts" et "contributions"
        $cagnotte = Cagnotte::with(['contacts', 'contributions'])->findOrFail($id_cagnotte);

        // Accédez au contact lié à la cagnotte
        $contactDeLaCagnotte = $cagnotte->contacts->first(); // Si une cagnotte a un seul contactphp

        // Passez les données à la vue pour les afficher
        return view('cagnottes.show', [
            'cagnotte' => $cagnotte,
            'contactDeLaCagnotte' => $contactDeLaCagnotte,
        ]);
    }

    public function edit()
    {
        return view('cagnottes.edit');
    }

    public function store()
    {
        return view('cagnottes.store');
    }

    public function update()
    {
        return view('cagnottes.update');
    }

    public function destroy()
    {
        return view('cagnottes.destroy');
    }

    public function linkMyCagnotte(Request $request)
    {
        $cagnotteId = $request->input('selected_cagnotte');
        $projetCauseId = $request->input('projet_cause');

        $cagnotte = Cagnotte::find($cagnotteId);
        $projetCause = Projet::find($projetCauseId);
        $projetCagnotte = $cagnotte->projet;

        // Récupérez la valeur de start_date et end_date à partir de la requête
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Déterminez la date_program en fonction de start_date
        if ($startDate) {
            $dateTimeStart = new DateTime($startDate, new DateTimeZone('Europe/Paris'));
            $formattedDateStart = $dateTimeStart->format('Y-m-d H:i:s');
            $etatActuelStart = ($dateTimeStart->format('Y-m-d') === now()->format('Y-m-d')) ? true : false;
        } else {
            // Utilisez la date et l'heure actuelles si start_date n'est pas renseigné
            $formattedDateStart = now()->format('Y-m-d H:i:s');
            $etatActuelStart = true; // État actuel à true puisque c'est la date actuelle
        }

        // Créez une entrée avec date_program
        HistoriqueLiaison::create([
            'type' => 'Liaison',
            'created_date' => now(),
            'date_program' => $formattedDateStart,
            'etat_actuel' => $etatActuelStart,
            'id_projet_cible' => $projetCause->id_projet,
            'id_projet_source' => $projetCagnotte->id_projet
        ]);

        // Créez une entrée pour la date de fin si elle est renseignée
        if ($endDate) {
            $dateTimeEnd = new DateTime($endDate, new DateTimeZone('Europe/Paris'));
            $formattedDateEnd = $dateTimeEnd->format('Y-m-d H:i:s');
            $etatActuelEnd = false;

            HistoriqueLiaison::create([
                'type' => 'Déliaison',
                'created_date' => now(),
                'date_program' => $formattedDateEnd,
                'etat_actuel' => $etatActuelEnd,
                'id_projet_cible' => $projetCause->id_projet,
                'id_projet_source' => $projetCagnotte->id_projet
            ]);
        }

        $historiqueCagnotte = Historique::create([
            'action' => "Cagnotte lié vers " . $projetCause->nom,
            'id_cagnotte' => $cagnotte->id_cagnotte
        ]);

        return redirect()->route('utilisateur.recapliercagnotte', [
            'id_projet' => $projetCause->id_projet,
            'id_cagnotte' => $cagnotte->id_cagnotte
        ]);
    }



    public function unlinkMyCagnotte(int|Cagnotte $cagnotte, int|Projet $projet_cause)
    {
        if (is_int($cagnotte)) {
            $cagnotte = Cagnotte::find($cagnotte);
        }
        if (is_int($projet_cause)) {
            $projet_cause = Projet::find($projet_cause);
        }
        $projet_cagnotte = $cagnotte->projet;
        $current_date = (new DateTime('now', new DateTimeZone('Europe/Paris')))->format('Y-m-d H:i:s');
        $liaison_projet = HistoriqueLiaison::create([
            'type' => 'Déliaison',
            'created_date' => $current_date,
            'etat_actuel' => false,
            'id_projet_cible' => $projet_cause->id_projet,
            'id_projet_source' => $projet_cagnotte->id_projet
        ]);
        $historique_cagnotte = Historique::create([
            'action' => "Cagnotte delié de " . $projet_cause->nom,
            'date_creation' => $current_date,
            'id_cagnotte' => $cagnotte->id_cagnotte
        ]);
        return ([$liaison_projet, $historique_cagnotte]);
    }

    public function transferMyCagnotte(Request $request)
    {
        $cagnotteId = $request->input('selected_cagnotte');
        $projetCauseId = $request->input('projet_cause');

        $cagnotte = Cagnotte::find($cagnotteId);
        $projetCause = Projet::find($projetCauseId);

        $projet_cagnotte = $cagnotte->projet;
        $current_date = (new DateTime('now', new DateTimeZone('Europe/Paris')))->format('Y-m-d H:i:s');
        $liaison_projet = HistoriqueLiaison::create([
            'type' => 'Transfert',
            'created_date' => $current_date,
            'etat_actuel' => true,
            'id_projet_cible' => $projetCause->id_projet,
            'id_projet_source' => $projet_cagnotte->id_projet
        ]);
        $historique_cagnotte = Historique::create([
            'action' => "Cagnotte tranferé vers " . $projetCause->nom,
            'date_creation' => $current_date,
            'id_cagnotte' => $cagnotte->id_cagnotte
        ]);
        return redirect()->route('utilisateur.recaptransfertcagnotte', [
            'id_projet' => $projetCause->id_projet,
            'id_cagnotte' => $cagnotte->id_cagnotte
        ]);
    }

    public function donateByCagnotte(Request $request)
    {

        $cagnotteId = $request->input('selected_cagnotte');
        $projetCauseId = $request->input('projet_cause');
        $montant = $request->input('montant');

        $cagnotte = Cagnotte::find($cagnotteId);
        $projetCause = Projet::find($projetCauseId);

        $current_date = (new DateTime('now', new DateTimeZone('Europe/Paris')))->format('Y-m-d H:i:s');
        $cagnotte_cause = $projetCause->cagnottes[0];
        // dd($cagnotte_cause);
        $cagnotte->decrement('montant_actuel', $montant);
        $cagnotte_cause->increment('montant_actuel', $montant);
        $historique_cagnotte = Historique::create([
            'action' => "Un don de " . $montant . "€ a été effectué vers la cagnotte " . $cagnotte_cause->titre,
            'date_creation' => $current_date,
            'id_cagnotte' => $cagnotte->id_cagnotte
        ]);
        $historique_cagnotte_cause = Historique::create([
            'action' => "Un don de " . $montant . "€ a été reçu depuis la cagnotte " . $cagnotte->titre,
            'date_creation' => $current_date,
            'id_cagnotte' => $cagnotte_cause->id_cagnotte
        ]);
        return redirect()->route('utilisateur.recapdoncagnotte', [
            'id_projet' => $projetCause->id_projet,
            'id_cagnotte' => $cagnotte->id_cagnotte
        ]);
    }
}
