<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class FollowButton extends Component
{
    public $status;
    public $userId;
    public $classes;
    public function mount(){
        $this->status = auth()->user()->follow_state($this->userId); 

   }

   public function Follow(){
        $otherUser = User::find($this->userId);
        User::find(auth()->id())->follow($otherUser);
        $this->status = (user::find(auth()->id())->follow_state($this->userId));
        $this->emit('toggleFollow');

    }
    public function Unfollow(){
        $otherUser = User::find($this->userId);
        User::find(auth()->id())->unfollow($otherUser);
        $this->status = (user::find(auth()->id())->follow_state($this->userId));
        $this->emit('toggleFollow');


    }
    public function render()
    {
        return view('livewire.follow-button');
    }
}
