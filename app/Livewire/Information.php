<?php

namespace App\Livewire;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\experienceApp\Experience;


class Information extends Controller
{
    public function information($idExperience, $montant)
    {
        $experience = Experience::find($idExperience);
        $contact = null;


        return view('livewire.information', compact('idExperience', 'montant', 'experience', 'contact'));
    }
}
