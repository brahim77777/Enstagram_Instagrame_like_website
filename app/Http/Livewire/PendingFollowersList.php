<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class PendingFollowersList extends ModalComponent
{
    public function getFollowersListProperty(){
        return auth()->user()->followers()->wherePivot('confirmed' , false)->get();
    }
    
    public function removeFollowRequest($userId){
        $follower = User::find($userId);
        $follower->unfollow(auth()->user());
        $this->emit('RequestExecuted');

    }

    public function acceptFollowRequest($userId){
        $follower = User::find($userId);
        $follower->following()->UpdateExistingPivot(auth()->id(),['confirmed'=>true]);
        $this->emit('RequestExecuted');
    }

    public function render()
    {
        return view('livewire.pending-followers-list');
    }
}
