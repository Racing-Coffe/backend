<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
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
        $HiddenValues = ['id'];

        $Post = Post::find($Request->id);

        if(!$Post) return response(['Error' => 'Post not found'], 404);

        $PostArray = $Post->makeHidden($HiddenValues)->toArray();

        return $PostArray;
    }
}
