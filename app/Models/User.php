<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'bio',
        'username',
        'image',
        'email',
        'password',
        'private_account',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public static function  suggested_users(){
        return User::where('id' , '<>' , auth()->id())->get()->shuffle()->take(5);
    }

    public function likes(){
        return $this->belongsToMany(Post::class, 'likes');
    }
    public function following(){
        return $this->belongsToMany(User::class , 'follows'  , 'user_id' , 'following_user_id')->withPivot('confirmed')->withTimestamps();
    }
    public function followers(){
        return $this->belongsToMany(User::class , 'follows'  , 'following_user_id', 'user_id' )->withPivot('confirmed')->withTimestamps();
    }
    public function is_following(User $user)
    {
        return $this->following()->where('following_user_id', $user->id)->where('confirmed', true)->exists();
    }
    public function follow_state($user_id)
    {   
        $user = User::find(auth()->id());
        $otherUser = User::find($user_id);

        if($user->following()->wherePivot('confirmed' , true )->get()->contains($otherUser)){
            return 'unfollow';
        }
        if($user->following()->wherePivot('confirmed' , false )->get()->contains($otherUser)){
           return 'pending';
        }
        return 'follow';

        
    }
    public function is_follower($user_id){
        $user = User::find(auth()->id());
        $otherUser = User::find($user_id);
        if($user->followers()->wherePivot('confirmed', true)->get()->contains($otherUser)) {
            return 'follower';
        }
    }

    public function follow(User $user){
        
        $this->following()->attach($user , ['confirmed'=> !$user->private_account]);

    }
    public function unfollow(User $user){
        $this->following()->detach($user);
    }






}
