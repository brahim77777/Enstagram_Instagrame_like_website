<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //
    public function index(User $user) {
        return view('users.profile' , compact('user'));
    }
    public function edit(User $user){
        $this->authorize('update' , $user);
        return view('users.edit' , compact('user'));
    }
    public function update(UpdateUserProfileRequest $request, User $user){
        $this->authorize('update' , $user);

        $data = $request->safe()->collect();
        if($data['password'] == '')
            unset($data['password']);
        else
            $data['password'] = Hash::make($data['password']);

        if($data->has('image')){
            Storage::disk('public')->delete($user->image); 
            $data['image'] =  $data['image']->store('users' , 'public');
        }
        $data['private_account'] = $request->has('private_account');

        $user->update($data->toArray());
        return redirect(route('user_profile' , $user->username ))->with('Success' , __('Your profile has been updated' , [],$data['lang'] ));

    }
}
