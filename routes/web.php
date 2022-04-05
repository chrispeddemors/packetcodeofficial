<?php

use App\Mail\NewUserWelcomeMail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/email', function() {return new NewUserWelcomeMail();});

Route::post('/follow/{user}', [App\Http\Controllers\FollowsController::class, 'store']);

//* '/' is the "homepage"
Route::get('/', [App\Http\Controllers\PostsController::class, 'index']);


Route::get('/p/create', [App\Http\Controllers\PostsController::class, 'show'])->name('posts.create');
Route::post('/p', [App\Http\Controllers\PostsController::class, 'store'])->name('posts.store');
Route::get('/p/create', [App\Http\Controllers\PostsController::class, 'create'])->name('posts.create');
Route::get('/p/{post}', [App\Http\Controllers\PostsController::class, 'show'])->name('posts.show');

Route::get('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'index'])->name('profile.show');
Route::get('/profile/{user}/edit', [App\Http\Controllers\ProfilesController::class, 'edit'])->name('profile.edit');
Route::patch('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'update'])->name('profile.update');



// Route::get('/profiel/{user}', [App\Http\Controllers\ProfielController::class, 'index'])->name('profiel.show');
