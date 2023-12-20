<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\MailSendPassword;
use App\Models\Compte;
use App\Models\experienceApp\Contact;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Traits\SyncsWithUserModel;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Mail;
use Spatie\Permission\Models\Role;

class UtilisateurRegisterController extends Controller
{

    use SyncsWithUserModel;
    protected function register()
    {
        return view('utilisateurauth.register');
    }

    public function store(Request $request){
        $request->validate([
            'last_name' => 'required',
            'first_name' => 'required',
            'email' => ['required','email','unique:users'],
            'password' => [
                'required','string',
                'min:8', // Au moins 8 caractères
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).*$/', // Au moins une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial
            ],
            'password_confirmation' => 'required|same:password'
        ],[
            'last_name.required' => 'Le champ nom est requis.',
            'first_name.required' => 'Le champ prénom est requis.',
            'email.required' => 'Le champ email est requis.',
            'email.email' => 'L\'adresse email n\'est pas valide.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'password.required' => 'Le champ mot de passe est requis.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères',
            'password.regex' => 'Le mot de passe doit contenir au moins une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial.',
            'password_confirmation.required' => 'Le champ de confirmation du mot de passe est requis.',
            'password_confirmation.same' => 'Le champ de confirmation du mot de passe doit correspondre au mot de passe.'
        ]);

        $contact= Contact::where('email','=', request('email'))->get()->first();
        if(!$contact){
            $contact = Contact::create([
                'nom'=>request('last_name'),
                'prenom'=>request('first_name'),
                'email'=>request('email'),
            ]);
        }
        
        // $compte = Compte::where('id_contact','=', $contact->id_contact)
        // ->where('type','=','Llc')
        // ->get()->first();

        // if(!$compte){
        //     $compte = Compte::create([
        //         'solde'=>0,
        //         'type'=>'Llc',
        //         'id_contact'
        //     ]);
        // }

        $userData = [
            'name'=>request('first_name').' '.request('last_name'),
            'password'=>request('password'),
            'email'=>request('email')
        ];

        $role=Role::where('name','Expérimentateur')->first();

        $user = $this->syncWithUser($userData);
        $user->syncRoles($role);
        
        $user->sendEmailVerificationNotification();

        return redirect(route('temporaire').'?idContact='.$contact->id_contact)
                    ->with('success','Inscription effectué avec succès');
        // return redirect()->route('utilisateur.connection')
        //             ->with('success','Inscription effectué avec succès');
        
    }

    public static function generateStrongPassword() {
        $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lowercase = 'abcdefghijklmnopqrstuvwxyz';
        $numbers = '0123456789';
        $specialChars = '!@#$%^&*()-_+=[]{}|;:,.<>?';
    
        $requiredLength = 8;
        $password = '';
    
       // Au moins une majuscule, une minuscule, un chiffre et un caractère spécial
        $password .= $uppercase[random_int(0, strlen($uppercase) - 1)];
        $password .= $lowercase[random_int(0, strlen($lowercase) - 1)];
        $password .= $numbers[random_int(0, strlen($numbers) - 1)];
        $password .= $specialChars[random_int(0, strlen($specialChars) - 1)];

        $remainingLength = $requiredLength - 4;

        $pool = $uppercase . $lowercase . $numbers . $specialChars;

        for ($i = 0; $i < $remainingLength; $i++) {
            $password .= $pool[random_int(0, strlen($pool) - 1)];
        }

        // Mélanger les caractères du mot de passe pour plus de sécurité
        $password = str_shuffle($password);
    
        return $password;
    }

    public static function sendPassword(string $password, Contact|User $contact) {
        $email = new MailSendPassword($password, $contact->email);
        Mail::to($contact->email)
            ->send($email);
    }
}
