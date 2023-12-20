<?php

namespace App\Http\Controllers\utilisateurAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UtilisateurShowConfirmController extends Controller
{
    public function showconfirmation(){

        return view('utilisateurauth.passwords.showconfirm');
    }
}
