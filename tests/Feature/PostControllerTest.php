<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    /**
     * Test the Index Route of Post Controller.
     *
     * @return void
     */
    public function test_index_route()
    {
        $response = $this->get('/api/posts');

        $response->assertJson(
            fn (AssertableJson $json) =>
            $json->has(2)->first(
                function (AssertableJson $json) {
                    $json->hasAll(['id', 'title', 'tag_id', 'author_id']);
                    $json->missingAll(['content', 'created_at', 'updated_at']);
                }
            )
        );

        $response->assertStatus(200);
        $response->assertSuccessful();

        $response->assertJsonCount(2);
    }

    /**
     * Test the Show Route of Post Controller.
     *
     * @return void
     */
    public function test_show_route()
    {
        $response = $this->get('/api/posts/1');

        $response->assertJson(
            function (AssertableJson $json) {
                $json->hasAll(['content', 'title', 'tag_id', 'author_id', 'created_at', 'updated_at']);
                $json->missingAll(['id', 'password']);
            }
        );

        $response->assertStatus(200);
        $response->assertSuccessful();
        
        $response->assertJsonCount(6);
    }
    
    /**
     * Test the Show Route of Post Controller with Not Found Id.
     * 
     * @return void
     */
    public function test_show_route_not_found()
    {
        $response = $this->get('/api/posts/5');

        $response->assertExactJson(["Error" => "Post not found"]);

        $response->assertStatus(404);
        $response->assertNotFound();
    }
}
