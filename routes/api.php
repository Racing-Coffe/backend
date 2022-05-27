<?php

use App\Http\Controllers\TagController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\PostController;
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

Route::get('tags', [TagController::class, 'index']);
Route::get('tags/{id}', [TagController::class, 'show']);
Route::get('tags/{id}/posts', [TagController::class, 'showPosts']);