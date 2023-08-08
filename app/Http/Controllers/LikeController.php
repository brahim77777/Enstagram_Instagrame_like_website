<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like(Post $post){
        auth()->user()->likes()->attach($post);
        return back();

    }
}
