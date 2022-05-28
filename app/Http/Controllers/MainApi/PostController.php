<?php

namespace App\Http\Controllers\MainApi;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\MainController;

class PostController extends MainController
{
    public function index(Request $Request)
    {
        $HiddenValues = ['content', 'created_at', 'updated_at'];

        $Posts = Post::all()->makeHidden($HiddenValues);

        $PostsArray = $Posts->toArray();

        return $PostsArray;
    }

    public function show(Request $Request)
    {
        if (!$this->ValidateId($Request)) return $this->NotFound();

        $Post = Post::find($Request->id);

        if (!$Post) return $this->NotFound();

        $HiddenValues = ['id'];

        $PostArray = $Post->makeHidden($HiddenValues)->toArray();

        return $PostArray;
    }

    protected function NotFound()
    {
        return response(['Error' => 'Post not found'], 404);
    }
}