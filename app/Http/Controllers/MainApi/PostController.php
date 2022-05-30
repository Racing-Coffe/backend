<?php

namespace App\Http\Controllers\MainApi;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;

class PostController extends MainApiController
{
    protected function GetControllerName(): string
    {
        return 'posts';
    }

    protected function HiddenValues(): object
    {
        return (object) [
            'index' => ['content', 'created_at', 'updated_at'],
            'show' => ['id'],
        ];
    }

    protected function GetModel(): Model
    {
        return new Post;
    }

    protected function NotFound()
    {
        return response(['Error' => 'Post not found'], 404);
    }

    protected function NotFoundText(): string
    {
        return 'Post not found';
    }
}
