<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends MainController
{
    public function index(Request $Request)
    {
        $HiddenValues = ['description', 'created_at', 'updated_at'];

        $Tags = Tag::all()->makeHidden($HiddenValues);

        $TagsArray = $Tags->toArray();

        return $TagsArray;
    }

    public function show(Request $Request)
    {
        return "show";
    }

    public function showPosts(Request $Request)
    {
        return "show Posts";
    }

    protected function NotFound()
    {
        return response(['Error' => 'Tag not found'], 404);
    }
}
