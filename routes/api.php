<?php

use App\Http\Controllers\MainApi\TagController;
use App\Http\Controllers\MainApi\AuthorController;
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

Route::controller(AuthorController::class)->group(function () {
    Route::get('authors', 'index')->name('author.index');
    Route::get('authors/{id}', 'show')->name('author.show');
    Route::get('authors/{id}/posts', 'showPosts')->name('author.showPosts');
});


Route::controller(TagController::class)->group(function () {
    Route::get('tags', 'index')->name('tag.index');
    Route::get('tags/{id}', 'show')->name('tag.show');
    Route::get('tags/{id}/posts', 'showPosts')->name('tag.showPosts');
});
