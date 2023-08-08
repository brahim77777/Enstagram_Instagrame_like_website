<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
require __DIR__.'/auth.php';
Route::get('/lang-en' , function(){
    session()->put('lang' , 'en');  
    return redirect()->back();

});
Route::get('lang-ar' , function(){
    session()->put('lang' , 'ar');
    return redirect()->back();
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $posts = Post::where('user_id' , '=' , auth()->user()->id)->get();
    return view('dashboard' , compact('posts'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['lang', 'auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('explore' , [PostController::class , 'explore'])->name('explore')->middleware(['lang', 'auth']);
Route::get('/{user:username}' , [UserController::class  , 'index'])->name('user_profile');
Route::get('/{user:username}/edit' , [UserController::class , 'edit'])->name('user_edit')->middleware(['lang', 'auth']);
Route::match(['put', 'patch'],'/{user:username}',[UserController::class, 'update'])->name('update_profile')->middleware(['lang', 'auth']);


Route::controller(PostController::class)->middleware(['lang', 'auth'])->group(function(){
    Route::get('/' , 'index')->name('home_page');  
    Route::get('/p/create' ,  'create')->name('create_post');
    Route::get('/p/{post:slug}/edit' ,  'edit')->name('edit_post');
    Route::get('/p/{post:slug}',  'show')->name('show_post');
    Route::match(['put', 'patch'], '/p/{post:slug}/update','update')->name('update_post');
    Route::post('/p/create' ,  'store')->name('store_post');
    Route::delete('/p/{post:slug}' ,  'destroy')->name('delete_post');
});


Route::get('/p/{post:slug}/like' , [LikeController::class , 'like'])->middleware(['lang', 'auth'])->name('like');




Route::post('/p/{post:slug}/comment' , [CommentController::class , 'store'])->name('store_comment')->middleware(['lang', 'auth']);



