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

        $data = $response->json('data');
        $dataFirstItem = $response->json('data.0');

        $has = ['id', 'title', 'tag_id', 'user_id'];
        $except = ['content', 'created_at', 'updated_at'];

        foreach ($has as $item) {
            $this->assertArrayHasKey($item, $dataFirstItem);
        }

        foreach ($except as $item) {
            $this->assertArrayNotHasKey($item, $dataFirstItem);
        }

        $this->assertCount(3, $data);

        $response->assertStatus(200);
        $response->assertSuccessful();
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
                $json->hasAll(['content', 'title', 'tag_id', 'user_id', 'created_at', 'updated_at']);
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

    /**
     * Test the ShowComments Route of Post Controller.
     * 
     * @return void
     */
    public function test_show_comments_route()
    {
        $response = $this->get('/api/posts/1/comments');

        $data = $response->json('data');
        $dataFirstItem = $response->json('data.0');

        $has = ['id', 'content', 'is_fixed', 'user_id', 'created_at', 'updated_at'];
        $except = ['post_id'];

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
}
