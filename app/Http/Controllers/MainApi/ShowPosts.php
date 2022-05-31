<?php

namespace App\Http\Controllers\MainApi;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

trait ShowPosts
{
    protected function GetPosts(int $Id): array
    {
        $Query = $this->FindId($Id);

        $Posts = $Query->posts()->getResults();

        $HiddenValues = ['content', 'tag_id', 'author_id', 'created_at', 'updated_at'];

        $PostsArray = $Posts->makeHidden($HiddenValues)->toArray();

        return $PostsArray;
    }

    public function showPosts(Request $Request)
    {
        $this->ValidateId($Request);

        $Id = $Request->id;
        $ActionMethod = 'showPosts';
        $ControllerName = $this->GetControllerName();

        $Key = "$ControllerName.$ActionMethod.$Id";
        $Minutes = 5 * 60;

        $Result = Cache::remember($Key, $Minutes, fn () => $this->GetPosts($Id));

        return $Result;
    }
}
