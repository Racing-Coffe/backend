<?php

namespace App\Http\Controllers\AuthApi;

use App\Http\Controllers\MainController;
use Illuminate\Database\Eloquent\Model;
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

    public function destroy()
    {
        return "destroy";
    }

    public function update()
    {
        return "update";
    }

    public function setAuthor()
    {
        return "setAuthor";
    }

    public function store()
    {
        return "store";
    }

    public function login()
    {
        return "login";
    }
}
