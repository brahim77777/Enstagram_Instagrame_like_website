<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CommentForm extends Component
{
    public $body;
    public $post;
    public function store(){
        $this->post->comments()->create(['body'=>$this->body , 'project_id'=> $this->post->id , 'user_id' => auth()->id()]);
        $this->emitTo('comments', 'update');
        $this->body="";
    }
    public function render()
    {
        return view('livewire.comment-form');
    }
}
