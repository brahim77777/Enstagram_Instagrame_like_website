<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $posts= Post::paginate(10);
        $ids = auth()->user()->following()->wherePivot('confirmed'  , true)->get()->pluck('id');
        $posts= Post::whereIn('user_id' , $ids)->latest()->get();
        $suggested_users = User::suggested_users();
        return view('posts.index' ,compact(['posts' , 'suggested_users']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'image' => ['required' , 'mimes:jpeg,jpg,gif,png'],
            'description' => ['required' , 'max:512'],
        ]);
        $data['image'] = $data['image']->store('posts' , 'public');
        $data['slug'] = Str::random(10);
        auth()->user()->posts()->create($data);


        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
        return view('posts.show' , compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update' , $post);
        return view('posts.edit' , compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    
    public function update(Request $request, Post $post)
    {
        //
        $this->authorize('update' , $post);

        $data = $request->validate([
            'image' => 'nullable|mimes:png,jpeg,gif,jpg',
            'description' =>'required|max:512',
        ]);
        if($request->has('image') ){
            Storage::disk('public')->delete($post->image);
            $data['image'] = $request['image']->store('posts' ,'public');
        }
        $post->update($data);
        return redirect('/p/'.$post->slug);
        
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
        $this->authorize('delete' , $post);

        Storage::disk('public')->delete($post->image);
        $post->delete();
        return redirect(route('dashboard'));
    }
    public function explore(){
        $posts= Post::whereRelation('owner'  ,'private_account' , '=','0')->whereNot('user_id' , auth()->id())->simplePaginate(9);
        return view('posts.explore' , compact('posts'));
    }
}
