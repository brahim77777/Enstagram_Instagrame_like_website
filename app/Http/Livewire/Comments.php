<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Comments extends Component
{
    public $post;
    protected $listeners = ['update'=> '$refresh']; 
    public function render()
    {
        return view('livewire.comments');
    }
}
