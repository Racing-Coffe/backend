<?php

use App\Http\Controllers\MainApi\TagController;
use App\Http\Controllers\MainApi\UserController;
use App\Http\Controllers\MainApi\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(PostController::class)->group(function () {
    Route::get('posts', 'index')->name('post.index');
    Route::get('posts/{id}', 'show')->name('post.show');
});


Route::controller(UserController::class)->group(function () {
    Route::get('users', 'index')->name('user.index');
    Route::get('users/{id}', 'show')->name('user.show');
    Route::get('users/{id}/posts', 'showPosts')->name('user.showPosts');
});


Route::controller(TagController::class)->group(function () {
    Route::get('tags', 'index')->name('tag.index');
    Route::get('tags/{id}', 'show')->name('tag.show');
    Route::get('tags/{id}/posts', 'showPosts')->name('tag.showPosts');
});
