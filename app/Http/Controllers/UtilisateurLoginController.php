<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\experienceApp\Contact;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UtilisateurLoginController extends Controller
{

    use AuthenticatesUsers;


    protected $redirectTo = '/home';


    public function index()
    {
        return view('utilisateurauth.login');
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $contact = Contact::where('email', $input['email'])->first();
        // dd($contact);

        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
            return redirect(route('accueil'));
            //return redirect()->route('utilisateur.contribution.suivipaiement',['idContact'=>139,'idCagnotte'=>1])->with('success', 'Vous êtes connecté(e)');
        } else {
            return redirect()->route('utilisateur.connection')
                ->with('error', 'Adresse email ou mot de passe erroné');
        }
    }

    protected function findOrCreateUser($user)
    {
        // Vérifiez si l'utilisateur existe déjà dans votre base de données par email
        $authUser = User::where('email', $user->email)->first();
        $contact = Contact::where('email', $user->email)->first();
        if(!$contact){
            $contact = Contact::create([
                'nom' => $user->name,
                'email' => $user->email,
            ]);
        }
        if(!$authUser){
            $user =  User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => bcrypt(Str::random(16)), // Générez un mot de passe aléatoire
                // Ajoutez d'autres champs si nécessaire
            ]);

            $role=Role::where('name','Expérimentateur')->first();
            $user->syncRoles($role);
            
            $user->sendEmailVerificationNotification();
            return $user;
        }

        return $authUser;
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        // Vérifiez si l'utilisateur existe déjà dans votre base de données
        // Si non, créez un nouvel utilisateur

        $authUser = $this->findOrCreateUser($user);

        Auth::login($authUser, true);

        return redirect('/accueil');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect(route('utilisateur.connection'));
    }

    public function registertypechoice(Request $request)
    {


        return view('utilisateurauth.registertypechoice');
    }
}
