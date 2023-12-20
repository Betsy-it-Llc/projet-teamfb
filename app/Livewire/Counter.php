<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Counter tutorial sample')]
class Counter extends Component
{

    public $count = 1;
 

    public function mount()
    {
    }

    public function increment()
    {
        $this->count++;
    }
 
    public function decrement()
    {
        $this->count--;
    }
 
    public function render()
    {
        return view('livewire.counter')->extends('layouts.appwithtailwind');
    }
}
