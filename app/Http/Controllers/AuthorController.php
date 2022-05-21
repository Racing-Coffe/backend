<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(Request $Request)
    {
        $HiddenValues = ['email', 'avatar', 'twitter', 'created_at', 'updated_at'];

        $Authors = Author::all()->makeHidden($HiddenValues);

        $AuthorsArray = $Authors->toArray();

        return $AuthorsArray;
    }

    public function show(Request $Request)
    {
        $HiddenValues = ['id', 'email'];

        $Author = Author::find($Request->id)->makeHidden($HiddenValues);

        $AuthorArray = $Author->toArray();

        return $AuthorArray;
    }

    public function showPosts(Request $Request)
    {
        $HiddenValues = ['content', 'category_id', 'author_id', 'created_at', 'updated_at'];

        $Posts = Author::find($Request->id)
            ->posts()
            ->getResults()
            ->makeHidden($HiddenValues);

        $PostsArray = $Posts->toArray();

        return $PostsArray;
    }
}
