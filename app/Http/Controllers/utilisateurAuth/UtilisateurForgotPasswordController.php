<?php

namespace App\Http\Controllers\utilisateurAuth;

use App\Http\Controllers\Controller;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Models\User;

class UtilisateurForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */
    
    use SendsPasswordResetEmails;

    public function forgotPass(){
        return view("utilisateurauth.passwords.email");
    }

    protected function sendResetLinkEmail(Request $request){
        $this->validateEmail($request);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return $this->sendResetLinkFailedResponse($request, 'email_not_found');
        }

        // Generate a token and save it to the password_resets table
        $token = $this->broker()->createToken($user);
        $user->notify(new ResetPasswordNotification($token));

        return redirect(route('utilisateur.showconfirm'), 303)->with('email',$request->email);
        // return back()->with('status', trans('passwords.sent'));
    }

}
