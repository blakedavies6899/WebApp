<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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
Route::view('home', 'home')->middleware('auth'); 
Route::get ('posts',[PostController::class, 'index'])->middleware('auth');
Route::get ('createPosts',[PostController::class, 'viewCreate'])->middleware('auth');
Route::post ('createPosts',[PostController::class, 'createPosts'])->name('postCreate');

Route::post ('/update', [PostController::class, 'updatePost'])->name('UpdatePost')->middleware('auth');;
Route::get ('update/{id}', [PostController::class, 'update'])->name('postUpdate')->middleware('auth');

Route::get('post/{id}',[PostController::class, 'show'])->name('postDetails');
Route::get('delete/{id}',[PostController::class, 'deletePost'])->name('postDelete');

Route::post('save-comment',[PostController::class,'save_comment']);
Route::put('editComment',[PostController::class,'edit_comment']);