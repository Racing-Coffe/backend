<?php

namespace App\Http\Controllers\AuthApi;

use App\Models\User;
use App\Http\Controllers\MainController;
use App\Http\Requests\DestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

    /**
     * @param DestroyUserRequest $Request
     * @param Authenticatable|User $User 
     */
    public function destroy(DestroyUserRequest $Request, Authenticatable $User)
    {
        $UserInfo = $Request->only([
            "name",
            "email",
            "password"
        ]);

        $UserCorrect =
            $User->name === $UserInfo["name"] &&
            $User->email === $UserInfo["email"] &&
            Hash::check($UserInfo["password"], $User->password);

        if ($UserCorrect === false) {
            return response()->json(["Error" => "Unauthorized"], 401);
        }

        $UserDeleted = $User->delete();

        if($UserDeleted === false) {
            return response()->json(["Error" => "Server Error"], 500);
        }

        return response()->json(["Success" => "User Destroyed"], 200);
    }

    public function update()
    {
        return "update";
    }

    public function setAuthor()
    {
        return "setAuthor";
    }

    /**
     * @param StoreUserRequest $Request
     */
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

    /**
     * @param Request $Request
     */
    public function login(Request $Request)
    {
        $Credentials = $Request->only([
            "email",
            "password"
        ]);

        if (Auth::attempt($Credentials) === false) {
            return response(["Error" => "Unauthorized"], 401);
        }

        $User = User::where('email', $Credentials["email"])->first();

        $User->tokens()->delete();
        $AccessToken = $User->createToken('access_token', ['posts:comment'])->plainTextToken;

        return response()->json(["access_token" => $AccessToken]);
    }
}
