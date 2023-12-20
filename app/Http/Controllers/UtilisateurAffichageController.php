<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;


class UtilisateurAffichageController extends Controller
{
    public function experience()
    {
        return view('utilisateurcontribution.affichage.experience');
    }

    public function projet()
    {
        return view('utilisateurcontribution.affichage.projet');
    }

    public function cause()
    {
        return view('utilisateurcontribution.affichage.cause');
    }

    public function cagnotte()
    {
        return view('utilisateurcontribution.affichage.cagnotte');
    }

    public function experimentateur()
    {
        return view('utilisateurcontribution.affichage.experimentateur');
    }
}
