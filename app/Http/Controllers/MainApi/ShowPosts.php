<?php

namespace App\Http\Controllers\MainApi;

use Illuminate\Http\Request;

trait ShowPosts
{
    public function showPosts(Request $Request)
    {
        if (!$this->ValidateId($Request)) return $this->NotFound();
        if (!$this->FindId($Request->id)) return $this->NotFound();

        $Posts = $this
            ->FindId($Request->id)
            ->posts()
            ->getResults();

        $HiddenValues = ['content', 'tag_id', 'author_id', 'created_at', 'updated_at'];

        $PostsArray = $Posts->makeHidden($HiddenValues)->toArray();

        return $PostsArray;
    }
}
