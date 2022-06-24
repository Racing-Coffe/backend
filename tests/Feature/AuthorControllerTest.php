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

        $data = $response->json('data');
        $dataFirstItem = $response->json('data.0');

        $has = ['id', 'name', 'description'];
        $except = ['email', 'avatar', 'twitter', 'password', 'created_at', 'updated_at'];

        foreach ($has as $item) {
            $this->assertArrayHasKey($item, $dataFirstItem);
        }
        
        foreach ($except as $item) {
            $this->assertArrayNotHasKey($item, $dataFirstItem);
        }

        $this->assertCount(2, $data);

        $response->assertStatus(200);
        $response->assertSuccessful();
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

    /**
     * Test the Show Route of Author Controller with Not Found Id.
     * 
     * @return void
     */
    public function test_show_route_not_found()
    {
        $response = $this->get('/api/authors/5');

        $response->assertExactJson(["Error" => "Author not found"]);

        $response->assertStatus(404);
        $response->assertNotFound();
    }

    /**
     * Test the ShowPosts Route of Author Controller.
     *
     * @return void
     */
    public function test_show_posts_route()
    {
        $response = $this->get('/api/authors/1/posts');

        $response->assertJson(
            fn (AssertableJson $json) =>
            $json->has(1)->first(
                function (AssertableJson $json) {
                    $json->hasAll(['id', 'title']);
                    $json->missingAll(['content', 'tag_id', 'author_id', 'created_at', 'updated_at']);
                }
            )
        );

        $response->assertStatus(200);
        $response->assertSuccessful();

        $response->assertJsonCount(1);
    }

    /**
     * Test the ShowPosts Route of Author Controller with Not Found Id.
     * 
     * @return void
     */
    public function test_show_posts_route_not_found()
    {
        $response = $this->get('/api/authors/5/posts');

        $response->assertExactJson(["Error" => "Author not found"]);

        $response->assertStatus(404);
        $response->assertNotFound();
    }
}
