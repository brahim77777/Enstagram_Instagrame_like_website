<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Like extends Component
{
    public $liked;
    public $post;
    public function mount(){
        $this->liked = $this->post->likes()->wherePivot('user_id' , auth()->id())->count() ? true : false;
    }

    public function like(){
        auth()->user()->likes()->toggle($this->post);
        $this->liked = !$this->liked;
    }
    public function render()
    {
        return view('livewire.like');
    }
}
