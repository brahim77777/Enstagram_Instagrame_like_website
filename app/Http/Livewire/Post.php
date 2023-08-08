<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Post extends Component
{
    protected $listeners = ['refresh' => '$refresh'];
    public $post;
    public function render()
    {
        return view('livewire.post');
    }
}