<?php

use Illuminate\Support\Facades\Route;
use App\Mail\newUserWelcom;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::post("follow/{user}",[App\Http\Controllers\FollowsController::class, "store"]
    /*function(){
        return "fuck";
    }*/
);
Route::post("/like/{post}",[App\Http\Controllers\PostsLikes::class,"like"]);
Route::post("/comment/{post}",[App\Http\Controllers\PostsController::class,"comment"]);
Route::get("/email",function(){
    return new newUserWelcom();
});
Route::get("/",[App\Http\Controllers\PostsController::class,"index"]);
Route::get("/p/create",[App\Http\Controllers\PostsController::class, "create"]);
Route::get("/mahmoud",[App\Http\Controllers\ProfilesController::class,"mahmoud"]);
Route::post("/p",[App\Http\Controllers\PostsController::class, "store"]);
Route::get("/p/{post}",[App\Http\Controllers\PostsController::class,"show"]);
Route::get('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'index'])->name('profile.show');
Route::patch('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'update'])->name('profile.update');
Route::get('/profile/{user}/edit', [App\Http\Controllers\ProfilesController::class, 'edit'])->name('profile.show');
