<?php

namespace App\Livewire;

use Livewire\Component;

class Card extends Component
{
    public $var1;
    public $var2;
    public $var3;
    public $var4;
    public function render()
    {
        return view('livewire.card');
    }
}
