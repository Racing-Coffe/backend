<?php

namespace App\Http\Controllers\MainApi;

use App\Http\Controllers\MainController;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\User;

class AuthUserController extends MainController
{
    protected function GetControllerName(): string
    {
        return "AuthUserController";
    }

    protected function GetModel(): Model
    {
        return new User;
    }

    protected function NotFoundText(): string
    {
        return "User not found";
    }
}
