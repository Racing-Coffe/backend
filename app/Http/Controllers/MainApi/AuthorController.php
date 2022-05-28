<?php

namespace App\Http\Controllers\MainApi;

use App\Models\Author;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AuthorController extends MainApiController
{
    use ShowPosts;

    protected function HiddenValues(): object
    {
        return (object) [
            'index' => ['email', 'avatar', 'twitter', 'created_at', 'updated_at'],
            'show' => ['id', 'email'],
        ];
    }

    protected function GetModel(): Model
    {
        return new Author;
    }

    protected function NotFound()
    {
        return response(['Error' => 'Author not found'], 404);
    }
}
