<?php

namespace App\Http\Controllers\MainApi;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\ResponseFactory;

class TagController extends MainApiController
{
    use ShowPosts;

    protected function GetControllerName(): string
    {
        return 'tags';
    }

    protected function HiddenValues(): object
    {
        return (object) [
            'index' => ['description', 'created_at', 'updated_at'],
            'show' => ['id'],
        ];
    }

    protected function GetModel(): Model
    {
        return new Tag;
    }

    protected function NotFoundText(): string
    {
        return 'Tag not found';
    }
}
