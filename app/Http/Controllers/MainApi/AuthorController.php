<?php

namespace App\Http\Controllers\MainApi;

use App\Models\Author;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AuthorController extends MainApiController
{
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
