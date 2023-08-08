<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Followers extends Component
{
    public $userId;
    protected $user;

    protected $listeners = ['toggleFollow' => 'getCountProperty'];

    public function getCountProperty()
    {
        $this->user = User::find($this->userId);
        return $this->user->followers()->wherePivot('confirmed' , true)->count();
    }


    public function render()
    {
        return view('livewire.followers');
    }
}