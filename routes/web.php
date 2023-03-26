<?php

use App\Mail\NewUserWelcomeMail;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/email', function(){
    return new NewUserWelcomeMail();
});

// index() will show all posts from Post.resource
Route::get('/', [App\Http\Controllers\PostsController::class,'index']);

Route::post('/follow/{user}', [App\Http\Controllers\FollowsController::class,'store']);


// hit this URL will run create() from Controller, return a post.create view //this must precede /p/{post} route
Route::get('/p/create', [App\Http\Controllers\PostsController::class,'create']);

//hit store.action to store the created post into database
Route::post('/p', [App\Http\Controllers\PostsController::class,'store']);

// hit /p/{an id} will run show(an id ) in the controller
Route::get('/p/{post}', [App\Http\Controllers\PostsController::class,'show']);

// {user} is the parameter passed to index()
// hit '/profile/{user}' route will run index({user}) in ProfilesController class, //route name = profile.show
Route::get('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'index'])->name('profile.show'); //

//step1 : edit profile on a edit.view
Route::get('/profile/{user}/edit', [App\Http\Controllers\ProfilesController::class, 'edit'])->name('profile.edit');
//step2 : patch $data (from user input) to Profile.table
Route::patch('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'update'])->name('profile.patch');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


