<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class AuthUserControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    /**
     * Test Store an Full User
     */
    public function test_store_route_full_user()
    {
        $User = [
            "name" => "Example User",
            "email" => "example@user.com",
            "password" => "abcdef",
            "avatar" => "user.jpg",
            "twitter" => "@Twitter",
            "description" => "Um usuário usado para Testes"
        ];

        $Request = $this->post(route('auth.user.store'), $User);

        $Request->assertCreated();
        $Request->assertSuccessful();
        $Request->assertValid();

        $Request->assertJsonStructure([
            "access_token",
            "data" => [
                "name",
                "email",
                "avatar",
                "twitter",
                "description",
                "updated_at",
                "created_at",
                "id"
            ],
        ]);

        $UserData = [
            "name" => $User["name"],
            "email" => $User["email"]
        ];

        $this->assertDatabaseHas('users', $UserData);
    }

    /**
     * Test Store an Simple User
     */
    public function test_store_route_simple_user()
    {
        $User = [
            "name" => "Example User",
            "email" => "example@user.com",
            "password" => "abcdef",
        ];

        $Request = $this->post(route('auth.user.store'), $User);

        $Request->assertCreated();
        $Request->assertSuccessful();
        $Request->assertValid();

        $Request->assertJsonStructure([
            "access_token",
            "data" => [
                "name",
                "email",
                "updated_at",
                "created_at",
                "id"
            ],
        ]);

        $UserData = [
            "name" => $User["name"],
            "email" => $User["email"]
        ];

        $this->assertDatabaseHas('users', $UserData);
    }

    /**
     * Test Store Route is Hashing Password
     */
    public function test_store_route_is_hashing()
    {
        $User = [
            "name" => "Example User",
            "email" => "example@user.com",
            "password" => "abcdef",
        ];

        $this->post(route('auth.user.store'), $User);

        $UserModel = User::find(1);

        $this->assertNotEquals($User["password"], $UserModel->password);
    }
}
