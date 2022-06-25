<?php

namespace App\Http\Controllers\MainApi;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\ResponseFactory;

class UserController extends MainApiController
{
    use ShowPosts;
    use ShowComments;

    protected function GetControllerName(): string
    {
        return 'users';
    }

    protected function HiddenValues(): object
    {
        return (object) [
            'index' => ['email', 'avatar', 'twitter', 'created_at', 'updated_at', 'email_verified_at'],
            'show' => ['id', 'email'],
        ];
    }

    protected function GetModel(): Model
    {
        return new User;
    }

    protected function HiddenValuesComments(): array
    {
        return ["user_id"];
    }

    protected function NotFoundText(): string
    {
        return 'User not found';
    }
}
