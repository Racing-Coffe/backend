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

    protected array $SimpleUserCredentials = [
        "name" => "Example User",
        "email" => "example@user.com",
        "password" => "abcdef",
    ];

    protected array $SimpleUser = [
        "name" => "Example User",
        "email" => "example@user.com",
    ];

    protected function CreateUser(): array
    {
        $User = $this->SimpleUserCredentials;

        $Request = $this->post(route('auth.user.store'), $User);

        return $Request->json();
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

    /**
     * Test Login Route
     */
    public function test_login_route()
    {
        $User = [
            "email" => "racingcoffe@gmail.com",
            "password" => "Secret",
        ];

        $Request = $this->post(route('auth.user.login'), $User);

        $Request->assertOk();
        $Request->assertSuccessful();

        $Request->assertJsonStructure(["access_token"]);
    }

    /**
     * Test Login Route Wrong Password
     */
    public function test_login_route_wrong_password()
    {
        $User = [
            "email" => "racingcoffe@gmail.com",
            "password" => "123456",
        ];

        $Request = $this->post(route('auth.user.login'), $User);

        $Request->assertUnauthorized();
        $Request->assertExactJson(["Error" => "Unauthorized"]);
    }

    /**
     * Test Login Route Wrong Email
     */
    public function test_login_route_wrong_eamil()
    {
        $User = [
            "email" => "dont@exist.com",
            "password" => "Secret",
        ];

        $Request = $this->post(route('auth.user.login'), $User);

        $Request->assertUnauthorized();
        $Request->assertExactJson(["Error" => "Unauthorized"]);
    }

    /**
     * Test Destroy Route
     */
    public function test_destroy_route()
    {
        //Arrange 
        $Token = $this->CreateUser()["access_token"];

        $Credentials = $this->SimpleUserCredentials;

        $Headers = [
            "Accept" => "application/json",
            "Authorization" => "Bearer $Token"
        ];

        //Act
        $Request = $this->delete(route('auth.user.destroy'), $Credentials, $Headers);

        //Assert
        $Request->assertExactJson(["Success" => "User Destroyed"]);
        $Request->assertSuccessful();
        $Request->assertOk();

        $this->assertDatabaseMissing('users', $this->SimpleUser);
    }
}
