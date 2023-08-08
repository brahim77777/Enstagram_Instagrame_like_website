<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostList extends Component
{
    protected $listeners = ['toggleFollow' => 'getPostsProperty'];

    public function getPostsProperty()
    {
       $ids = auth()->user()->following()->wherePivot('confirmed', true)->get()->pluck('id');
       return Post::whereIn('user_id', $ids)->latest()->get();
    }

    public function render()
    {
        return view('livewire.post-list');
    }
}
