<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class FollowersModal extends ModalComponent
{
    public $userId;
    protected $user;

    public function getFollowersListProperty(){
        $this->user =  User::find($this->userId);
        return $this->user->followers()->wherePivot('confirmed' , true)->get();
        
    }
    public function removeFollower($userId){
        $follower =User::find($userId);
        $this->user = User::find($this->userId);
        $follower->unfollow($this->user);
        $this->emit('unfollowUser');
        
    } 
    public function render()
    {
        return view('livewire.followers-modal');
    }
}
