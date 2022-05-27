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

Route::get('authors', [AuthorController::class, 'index']);
Route::get('authors/{id}', [AuthorController::class, 'show']);
Route::get('authors/{id}/posts', [AuthorController::class, 'showPosts']);

Route::get('tags', [TagController::class, 'index']);
Route::get('tags/{id}', [TagController::class, 'show']);
Route::get('tags/{id}/posts', [TagController::class, 'showPosts']);