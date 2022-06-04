<?php

namespace Tests\Feature;

use App\Models\Tag;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class TagControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    /**
     * Test the Index Route of Tag Controller.
     *
     * @return void
     */
    public function test_index_route()
    {
        $response = $this->get('/api/tags');

        $response->assertJson(
            fn (AssertableJson $json) =>
            $json->has(2)->first(
                function (AssertableJson $json) {
                    $json->hasAll(['id', 'title']);
                    $json->missingAll(['description', 'created_at', 'updated_at']);
                }
            )
        );

        $response->assertStatus(200);
        $response->assertSuccessful();

        $response->assertJsonCount(2);
    }

    /**
     * Test the Show Route of Tag Controller.
     *
     * @return void
     */
    public function test_show_route()
    {
        $response = $this->get('/api/tags/1');

        $response->assertJson(
            function (AssertableJson $json) {
                $json->hasAll(['title', 'description', 'created_at', 'updated_at']);
                $json->missingAll(['id']);
            }
        );

        $response->assertStatus(200);
        $response->assertSuccessful();

        $response->assertJsonCount(4);
    }

    /**
     * Test the Show Route of Tag Controller with Not Found Id.
     * 
     * @return void
     */
    public function test_show_route_not_found()
    {
        $response = $this->get('/api/tags/5');

        $response->assertExactJson(["Error" => "Tag not found"]);

        $response->assertStatus(404);
        $response->assertNotFound();
    }

    /**
     * Test the ShowPosts Route of Tag Controller.
     *
     * @return void
     */
    public function test_show_posts_route()
    {
        $response = $this->get('/api/tags/1/posts');

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
     * Test the ShowPosts Route of Tag Controller with Not Found Id.
     * 
     * @return void
     */
    public function test_show_posts_route_not_found()
    {
        $response = $this->get('/api/tags/5/posts');

        $response->assertExactJson(["Error" => "Tag not found"]);

        $response->assertStatus(404);
        $response->assertNotFound();
    }
}
