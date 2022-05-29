<?php

namespace App\Http\Controllers\MainApi;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

trait ShowPosts
{
    protected function GetPosts($Id)
    {
        if (!$this->FindId($Id)) return $this->NotFound();

        $Posts = $this
            ->FindId($Id)
            ->posts()
            ->getResults();

        $HiddenValues = ['content', 'tag_id', 'author_id', 'created_at', 'updated_at'];

        $PostsArray = $Posts->makeHidden($HiddenValues)->toArray();

        return $PostsArray;
    }

    public function showPosts(Request $Request)
    {
        if (!$this->ValidateId($Request)) return $this->NotFound();

        $Id = $Request->id;
        $ActionMethod = 'showPosts';
        $ControllerName = $this->GetControllerName();

        $Key = "$ControllerName.$ActionMethod.$Id";
        $Minutes = 5 * 60;

        $Result = Cache::remember($Key, $Minutes, fn () => $this->GetPosts($Id));

        return $Result;
    }
}
