<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Commentaire;



class CagnotteCommentaire extends Component
{   
    public $commentaires;
    public $idExperience;
    
    public function render()
    {   
        // trouver les commentaires de l'expérience
        $this->commentaires=Commentaire::join('contact', 'commentaires.id_contact', '=', 'contact.id_contact')
        ->where('id_experience',$this->idExperience)->get();
    
        //dd($this->commentaires);
        return view('livewire.cagnotte-commentaire');
    }
}
