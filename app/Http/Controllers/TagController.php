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
        if (!$this->ValidateId($Request)) return $this->NotFound();

        $Tag = Tag::find($Request->id);

        if (!$Tag) return $this->NotFound();

        $HiddenValues = ['id'];

        $TagArray = $Tag->makeHidden($HiddenValues)->toArray();

        return $TagArray;
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
