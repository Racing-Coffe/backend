<?php

namespace Tests\Feature;

use App\Models\Author;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class AuthorControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    /**
     * Test the Index Route of Author Controller.
     *
     * @return void
     */
    public function test_index_route()
    {
        $response = $this->get('/api/authors');

        $response->assertJson(
            fn (AssertableJson $json) =>
            $json->has(3)->first(
                function (AssertableJson $json) {
                    $json->hasAll(['id', 'name', 'description',]);
                    $json->missingAll(['email', 'avatar', 'twitter', 'password', 'created_at', 'updated_at']);
                }
            )
        );

        $response->assertStatus(200);
        $response->assertSuccessful();

        $response->assertJsonCount(3);
    }

    /**
     * Test the Show Route of Author Controller.
     *
     * @return void
     */
    public function test_show_route()
    {
        $response = $this->get('/api/authors/1');

        $response->assertJson(
            function (AssertableJson $json) {
                $json->hasAll(['name', 'avatar', 'twitter', 'description', 'created_at', 'updated_at']);
                $json->missingAll(['id', 'email', 'password']);
            }
        );

        $response->assertStatus(200);
        $response->assertSuccessful();

        $response->assertJsonCount(6);
    }
}
