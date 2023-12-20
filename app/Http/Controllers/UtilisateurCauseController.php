<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use App\Models\User;
use App\Models\Projet;
use App\Models\Cagnotte;
use Illuminate\Http\Request;
use App\Models\ContactEntreprise;
use App\Models\HistoriqueLiaison;
use App\Traits\SyncsWithUserModel;
use Spatie\Permission\Models\Role;
use App\Models\experienceApp\Contact;
use App\Models\Organisation;
use Illuminate\Support\Carbon;


class UtilisateurCauseController extends Controller
{

    use SyncsWithUserModel;
    private function getProjetAndCagnotte($id_projet)
    {
        // Récupérez le projet en fonction de l'ID
        $projet = Projet::findOrFail($id_projet);

        // Récupérez la cagnotte liée à ce projet
        $cagnottes = $projet->cagnottes;

        // Utilisez first() pour obtenir le premier élément de la collection
        $cagnotte = $cagnottes->first();

        return ['projet' => $projet, 'cagnotte' => $cagnotte];
    }

    private function getContactConnecte()
    {

        // Récupérez le contact associé à l'utilisateur
        $contact = Contact::where('email', auth()->user()->email)->get()->first();

        return $contact;
    }

    private function getProjetAndCagnotteForContactConnecte()
    {
        // Récupérez le contact connecté
        $contact = $this->getContactConnecte();

        // Récupérez tous les projets associés à ce contact via la table pivot contact_projets
        $projetsDuContact = $contact->projets;

        // Initialisez un tableau pour stocker les cagnottes
        $cagnottes = collect();

        // Parcourez tous les projets du contact
        foreach ($projetsDuContact as $projet) {
            $result=HistoriqueLiaison::where('id_projet_source', $projet->id_projet)->where('type', 'Transfert')->get();
            if($result->isEmpty()){
                $cagnottes = $cagnottes->merge($projet->cagnottes);
            };
            // Ajoutez les cagnottes du projet à la collection
        }

        return $cagnottes;
    }

    private function calculerNombreContributeursUniques($cagnottes)
    {
        // Initialisation d'un tableau pour stocker le nombre de contributeurs uniques par cagnotte
        $contributeursUniquesParCagnotte = [];

        foreach ($cagnottes as $cagnotte) {
            $contributeurs = $cagnotte->contributions->pluck('id_contact');
            $contributeursUniques = $contributeurs->unique()->count();

            // Stockez le nombre de contributeurs uniques dans le tableau avec l'ID de la cagnotte comme clé
            $contributeursUniquesParCagnotte[$cagnotte->id_cagnotte] = $contributeursUniques;
        }

        return $contributeursUniquesParCagnotte;
    }




    public function recapsoutenir($id_projet)
    {
        // Récupérez le projet et la cagnotte associée au projet
        ['projet' => $projet, 'cagnotte' => $cagnotte] = $this->getProjetAndCagnotte($id_projet);

        // Passez les données à la vue
        return view('utilisateurcontribution.soutenir.recapsoutien', compact('projet', 'cagnotte'));
    }

    public function choixsoutien($id_projet)
    {
        // Récupérez le projet et la cagnotte associée au projet
        ['projet' => $projet, 'cagnotte' => $cagnotte] = $this->getProjetAndCagnotte($id_projet);

        // Passez les données à la vue
        return view('utilisateurcontribution.soutenir.choixsoutien', compact('projet', 'cagnotte'));
    }

    public function liercagnotte($id_projet)
    {
        // Récupérez le projet et la cagnotte associée au projet
        ['projet' => $projet, 'cagnotte' => $cagnotte] = $this->getProjetAndCagnotte($id_projet);

        // Récupérez les projets et cagnottes associés au contact connecté
        $projetsCagnottesContact = $this->getProjetAndCagnotteForContactConnecte();

        // Utilisez votre nouvelle méthode pour calculer le nombre de contributeurs uniques pour chaque cagnotte
        $nombreContributeursUniques = $this->calculerNombreContributeursUniques($projetsCagnottesContact);

        // Passez les données à la vue
        return view('utilisateurcontribution.soutenir.causeliercagnotte', compact('projet', 'cagnotte', 'projetsCagnottesContact', 'nombreContributeursUniques'));
    }


    public function recapliercagnotte($id_projet, $id_cagnotte)
    {
        // Récupérez le projet et la cagnotte associée au projet
        ['projet' => $projet, 'cagnotte' => $cagnotte] = $this->getProjetAndCagnotte($id_projet);

        // Récupérez la cagnotte transférée
        $cagnotteTransferee = Cagnotte::with('contributions')->find($id_cagnotte);
        // Calculez le montant total des contributions

        // Récupérez l'historique de liaison
        $historiquesLiaison = HistoriqueLiaison::where('id_projet_cible', $projet->id_projet)
            ->where('id_projet_source',  $cagnotteTransferee->id_projet)
            ->orderByDesc('created_date')
            ->get();

        // Initialisez une variable pour la date de début
        $formattedDateStart = null;

        // Initialisez un tableau pour stocker les dates de fin
        $formattedDatesEnd = null;

        // Formattez les dates pour la vue
        // Parcourez la collection d'historiques de liaison
        foreach ($historiquesLiaison as $historiqueLiaison) {
            if ($historiqueLiaison->type == 'Liaison') {
                // Si c'est une liaison, mettez à jour la date de début
                $formattedDateStart = Carbon::parse($historiqueLiaison->date_program)->format('d-m-Y');
            } elseif ($historiqueLiaison->type == 'Déliaison') {
                // Si c'est une déliaison, ajoutez la date de fin au tableau
                $formattedDatesEnd = Carbon::parse($historiqueLiaison->date_program)->format('d-m-Y');
            }
        }

        return view('utilisateurcontribution.soutenir.recapcauseliercagnotte', [
            'projet' => $projet,
            'cagnotte' => $cagnotte,
            'cagnotteTransferee' => $cagnotteTransferee,
            'formattedDateStart' => $formattedDateStart,
            'formattedDatesEnd' => $formattedDatesEnd,
        ]);
    }



    public function tranfertcagnotte($id_projet)
    {
        // Récupérez le projet et la cagnotte associée au projet
        ['projet' => $projet, 'cagnotte' => $cagnotte] = $this->getProjetAndCagnotte($id_projet);


        // Récupérez les projets et cagnottes associés au contact connecté
        $projetsCagnottesContact = $this->getProjetAndCagnotteForContactConnecte();

        // Utilisez votre nouvelle méthode pour calculer le nombre de contributeurs uniques pour chaque cagnotte
        $nombreContributeursUniques = $this->calculerNombreContributeursUniques($projetsCagnottesContact);

        // Passez les données à la vue
        return view('utilisateurcontribution.soutenir.causetranfertcagnotte', compact('projet', 'cagnotte', 'projetsCagnottesContact', 'nombreContributeursUniques'));
    }

    public function recaptranfertcagnotte($id_projet, $id_cagnotte)
    {
        // Récupérez le projet et la cagnotte associée au projet
        ['projet' => $projet, 'cagnotte' => $cagnotte] = $this->getProjetAndCagnotte($id_projet);

        // Récupérez la cagnotte transférée
        $cagnotteTransferee = Cagnotte::with('contributions')->find($id_cagnotte);

        // Calculez le montant total des contributions
        $montantTotalContributions = $cagnotteTransferee->contributions->sum('montant');

        // Passez les données à la vue
        return view('utilisateurcontribution.soutenir.recapcausetranfertcagnotte', compact('projet', 'cagnotte', 'cagnotteTransferee', 'montantTotalContributions'));
    }



    public function doncagnotte($id_projet)
    {
        // Récupérez le projet et la cagnotte associée au projet
        ['projet' => $projet, 'cagnotte' => $cagnotte] = $this->getProjetAndCagnotte($id_projet);


        // Récupérez les projets et cagnottes associés au contact connecté
        $projetsCagnottesContact = $this->getProjetAndCagnotteForContactConnecte();

        // Utilisez votre nouvelle méthode pour calculer le nombre de contributeurs uniques pour chaque cagnotte
        $nombreContributeursUniques = $this->calculerNombreContributeursUniques($projetsCagnottesContact);

        // Passez les données à la vue
        return view('utilisateurcontribution.soutenir.causedoncagnotte', compact('projet', 'cagnotte', 'projetsCagnottesContact', 'nombreContributeursUniques'));
    }


    public function recapdoncagnotte($id_projet, $id_cagnotte)
    {
        // Récupérez le projet et la cagnotte associée au projet
        ['projet' => $projet, 'cagnotte' => $cagnotte] = $this->getProjetAndCagnotte($id_projet);


        // Récupérez la cagnotte transférée
        $cagnotteTransferee = Cagnotte::with('contributions')->find($id_cagnotte);

        // Calculez le montant total des contributions
        $montantTotalContributions = $cagnotteTransferee->contributions->sum('montant');

        // Passez les données à la vue
        return view('utilisateurcontribution.soutenir.recapcausedoncagnotte', compact('projet', 'cagnotte', 'cagnotteTransferee', 'montantTotalContributions'));
    }



    public function linkUserToCause(int|Contact $contact, int|Organisation $cause)
    {
        if (is_int($contact)) {
            $contact = Contact::find($contact);
        }
        if (is_int($cause)) {
            $cause = Organisation::find($cause);
        }
        $contact_entreprise = ContactEntreprise::find($contact->id_contact);
        if (!$contact_entreprise) {
            $contact_entreprise = ContactEntreprise::create([
                'id_contact' => $contact->id_contact,
                'type' => 'Contact Cause',
                'id_organisation' => $cause->id_organisation
            ]);
        }
        $contact_entreprise->type = 'Contact Cause';

        //Assigner le role qui permet de cntroler une cause dans l'app
        $user = User::find($contact->email);
        $user->assignRole('Contact Cause');
    }

    public function linkNewUserToCause(Request $request)
    {
        //dd($request);
        $idOrganisation = $request->input('id_organisation');
        $request->validate([
            'last_name' => 'required',
            'first_name' => 'required',
            'email' => ['required', 'email', 'unique:users'],
            'id_organisation' => 'required'
        ], [
            'last_name.required' => 'Le champ nom est requis.',
            'first_name.required' => 'Le champ prénom est requis.',
            'email.required' => 'Le champ email est requis.',
            'email.email' => 'L\'adresse email n\'est pas valide.',
            'email.unique' => 'Cet email est déjà utilisé.',
        ]);

        $user = User::find($request->email);
        if (!$user) {
            $pass = UtilisateurRegisterController::generateStrongPassword();
            $userData = [
                'name' => request('first_name') . ' ' . request('last_name'),
                'password' => $pass,
                'email' => request('email')
            ];
            $user = $this->syncWithUser($userData);
            UtilisateurRegisterController::sendPassword($pass, $user);
        }

        $contact = Contact::where('email', request('email'))->first();
        if (!$contact) {
            $contact = Contact::create([
                'nom' => request('last_name'),
                'prenom' => request('first_name'),
                'email' => request('email')
            ]);
        }

        $user = $this->syncWithUser($userData);
        $user->assignRole('Cause');


        $contact_entreprise = ContactEntreprise::where('id_contact', $contact->id_contact)->first();
        if (!$contact_entreprise) {
            $contact_entreprise = ContactEntreprise::create([
                'id_contact' => $contact->id_contact,
                'type' => 'Contact Cause',
                'id_organisation' =>  $idOrganisation
            ]);
        } else {
            $contact_entreprise->type = 'Contact Cause';
            $contact_entreprise->save;
        }
        $user->sendEmailVerificationNotification();

        return $user;
    }


    public function userCreateCause(Request $request)
    {
        $request->validate([
            'nom_cause' => 'required',
            'tel' => ['required', 'regex:/^[0-9+\(\)#\.\s\-]+$/'],
            'email' => 'required|email',
            'adresse' => 'required',
            'code_postal' => 'required|regex:/^[0-9]{5}$/',
            'ville' => 'required',
            'description' => 'required',
            'id_contact' => 'required',
        ], [
            'nom_cause.required' => 'Le nom de la cause est requis.',
            'tel.required' => 'Le numéro de téléphone est requis.',
            'tel.regex' => 'Le numéro de téléphone n\'est pas au format valide.',
            'email.required' => 'L\'adresse e-mail est requise.',
            'email.email' => 'L\'adresse e-mail n\'est pas valide.',
            'adresse.required' => 'L\'adresse est requise.',
            'code_postal.required' => 'Le code postal est requis.',
            'code_postal.regex' => 'Le code postal doit contenir exactement 5 chiffres.',
            'ville.required' => 'La ville est requise.',
            'description.required' => 'La description est requise.'
        ]);
        $current_date = (new DateTime('now', new DateTimeZone('Europe/Paris')))->format('Y-m-d H:i:s');
        $cause = Organisation::create([
            'nom' => request('nom_cause'),
            'tel' => request('tel'),
            'email' => request('email'),
            'adresse' => request('adresse'),
            'code_postal' => request('code_postal'),
            'ville' => request('ville'),
            'description' => request('code'),
            'is_membre_cagnotte' => true,
            'date_creation' => $current_date,
            'date_update' => $current_date,
        ]);
        $contact_entreprise = ContactEntreprise::find(request('id_contact'));
        if (!$contact_entreprise) {
            $contact_entreprise = ContactEntreprise::create([
                'id_contact' => request('id_contact'),
                'type' => 'Contact Cause',
                'id_organisation' => $cause->id_organisation
            ]);
        } else {
            $contact_entreprise->type = 'Contact Cause';
            $contact_entreprise->save;
        }

        $projet_cause = Projet::create([
            'nom' => 'Projet ' . request('nom_cause'),
            'date_creation' => $current_date,
            'visibilite' => 'publique',
            'id_type_projet' => 4,
            'id_statut_projet' => 2,
        ]);
    }

    public function inscription()
    {

        return view("utilisateurcontribution.soutenir.causeinscription");
    }

    public function confirmation()
    {
        return view("utilisateurcontribution.soutenir.causeconfirmation");
    }

    public function store(Request $request)
    {

        $validator = $request->validate([
            'last_name' => 'required',
            'first_name' => 'required',
            'nom_organisme' => 'required',
            'email' => ['required', 'email', 'unique:users'],
            'telephone' => ['required', 'numeric', 'digits:10'],
            'date_naissance' => ['required', 'date', 'before_or_equal:' . now()->subYears(18)->format('Y/m/d')],
            'cgu' => 'required|accepted',
            'password' => [
                'required', 'string',
                'min:8', // Au moins 8 caractères
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).*$/', // Au moins une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial
            ],
            'password_confirmation' => 'required|same:password',
            'role' => 'required|in:Expérimentateur,Cause', // Validation du rôle avec les valeurs autorisées], [
        ], [
            'last_name.required' => 'Le champ nom est requis.',
            'first_name.required' => 'Le champ prénom est requis.',
            'nom_organisme.required' => 'Le champ nom organisme est requis.',
            'email.required' => 'Le champ email est requis.',
            'email.email' => 'L\'adresse email n\'est pas valide.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'telephone.required' => 'Le numéro de téléphone est requis',
            'telephone.digits' => 'Le numéro de téléphone doit avoir exactement 10 chiffres.',
            'date_naissance.required' => 'La date de naissance est requise',
            'date_naissance.required' => 'La date de naissance est requise',
            'date_naissance.before_or_equal' => 'La personne doit avoir au moins 18 ans.',
            'telephone.numeric' => 'Le numéro de téléphone doit être composé de chiffres.',
            'cgu.required' => 'Vous devez accepter les CGU de LalaChante',
            'password.required' => 'Le champ mot de passe est requis.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères',
            'password.regex' => 'Le mot de passe doit contenir au moins une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial.',
            'password_confirmation.required' => 'Le champ de confirmation du mot de passe est requis.',
            'password_confirmation.same' => 'Le champ de confirmation du mot de passe doit correspondre au mot de passe.',
            'role.required' => 'Le champ rôle est requis.',
            'role.in' => 'Le rôle sélectionné n\'est pas valide.',
        ]);

        if ($validator) {

            $contact = Contact::where('email', '=', request('email'))->get()->first();
            if (!$contact) {
                $contact = Contact::create([
                    'nom' => request('last_name'),
                    'prenom' => request('first_name'),
                    'email' => request('email'),
                    'date_naissance' => request('date_naissance'),
                    'tel' => request('telephone'),
                ]);
            }
            $userData = [
                'name' => request('first_name') . ' ' . request('last_name'),
                'password' => request('password'),
                'email' => request('email'),
                'date_naissance' => request('date_naissance'),
                'tel' => request('telephone'),
                'date_creation' => now(),
            ];

            $contactId = $contact->id_contact;

            // créer une organisation
            $organisation = Organisation::create([
                'nom' => request('nom_organisme'),
                'tel' => request('telephone'),
                'email' => request('email'),
                'date_creation' => now(),
            ]);

            $organisationId = $organisation->id_organisation;

            // créer projet 
            $projet = Projet::create([
                'nom' => 'projet-' . request('nom_organisme'),
                'id_type_projet' => '4',
                'visibilite' => 'public',
                'date_creation' => now(),
                'id_statut_projet' => '1',
            ]);

            $projetId = $projet->id_projet;

            // créer cagnotte
            $cagnotte = Cagnotte::create([
                'titre' => 'cagnotte-' . request('nom_organisme'),
                'id_categorie' => '4',
                'id_projet' => $projetId,
                'id_statut_cagnotte' => '1',
            ]);
            // créer contact entreprise
            $contact_entreprise = ContactEntreprise::create([
                'id_contact' => $contactId,
                'type' => 'Responsable Cause',
                'id_organisation' => $organisationId,
            ]);

            $role_selected = request('role');

            $role = Role::where('name', $role_selected)->first();

            $user = $this->syncWithUser($userData);
            $user->syncRoles($role);
            $user->sendEmailVerificationNotification();

            return redirect(route('utilisateur.causeconfirmation'))
                ->with('success', 'Inscription effectué avec succès');
        } else {

            return redirect()->back()
                ->withErrors($validator)->withInput();
        }
    }
}
