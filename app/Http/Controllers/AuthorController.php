<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends MainController
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
        if (!$this->ValidateId($Request)) return $this->NotFound();

        $Author = Author::find($Request->id);

        if (!$Author) return $this->NotFound();

        $HiddenValues = ['id', 'email'];

        $AuthorArray = $Author->makeHidden($HiddenValues)->toArray();

        return $AuthorArray;
    }

    public function showPosts(Request $Request)
    {
        $HiddenValues = ['content', 'category_id', 'author_id', 'created_at', 'updated_at'];

        $Author = Author::find($Request->id);

        if (!$Author) return response(['Error' => 'Author not found'], 404);

        $Posts = $Author->posts()->getResults();

        $PostsArray = $Posts->makeHidden($HiddenValues)->toArray();

        return $PostsArray;
    }

    protected function NotFound()
    {
        return response(['Error' => 'Author not found'], 404);
    }
}
