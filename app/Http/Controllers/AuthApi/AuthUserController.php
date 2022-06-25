<?php

namespace App\Http\Controllers\AuthApi;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\MainController;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

    public function store(StoreUserRequest $Request)
    {
        $UserInfo = $Request->only([
            "name",
            "email",
            "password",
            "avatar",
            "twitter",
            "description"
        ]);

        $UserInfo['password'] = Hash::make($UserInfo['password']);

        $User = User::create($UserInfo);

        $AccessToken = $User->createToken('access_token', ['posts:comment'])->plainTextToken;

        $Response = [
            "data" => $User,
            "access_token" => $AccessToken
        ];

        return response()->json($Response, 201);
    }

    public function login()
    {
        return "login";
    }
}
