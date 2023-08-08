<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PendingFollowersCount extends Component
{
    protected $listeners = ['RequestExecuted' => 'getCountProperty'];
    public function getCountProperty(){
        return auth()->user()->followers()->wherePivot('confirmed' , false)->count();
    }

    public function render()
    {
        return view('livewire.pending-followers-count');
    }
}
