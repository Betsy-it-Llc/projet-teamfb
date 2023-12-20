<?php

namespace App\Livewire;

use Livewire\Component;

class Cagnotte extends Component
{   
    public $count = 0;
    public $contribution=0;
    public $contributeurs;
    public $cagnotte;
    public $objectifCagnotte;
    public $pourcentageAvancementCagnotte;
    public $contact;
    public $idExperience;

    public function addContribution(){
        $this->contribution= $this->contribution+$this->count;
    }
    public function typeAmount($value)
    {
        $this->count= $value;
        if($value=''){
            $value=0;
        }
        
    }
    public function increment()
    {
        $this->count+=5;
        
    }
 
    public function decrement()
    {
        $this->count-=5;
        if ($this->count<=0) {
            $this->count=0;
        }
    }

    public function setContact($contact){
        $this->contact =$contact;
    }

    public function setExperience($idExperience) {
        $this->idExperience = $idExperience;
    }

    public function render()
    {
        $idExperience = $this->idExperience;
        $contact = $this->contact;
        return view('livewire.cagnotte', compact('idExperience','contact'));
    }
}
