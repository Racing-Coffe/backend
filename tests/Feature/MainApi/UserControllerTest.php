<?php

namespace Tests\Feature\MainApi;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    /**
     * Test the Index Route of User Controller.
     *
     * @return void
     */
    public function test_index_route()
    {
        $response = $this->get('/api/users');

        $data = $response->json('data');
        $dataFirstItem = $response->json('data.0');

        $has = ['id', 'name', 'description', 'is_author'];
        $except = ['email', 'avatar', 'twitter', 'password', 'created_at', 'updated_at', 'email_verified_at'];

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
     * Test the Show Route of User Controller.
     *
     * @return void
     */
    public function test_show_route()
    {
        $response = $this->get('/api/users/1');

        $response->assertJson(
            function (AssertableJson $json) {
                $json->hasAll(['name', 'avatar', 'twitter', 'description', 'created_at', 'updated_at', 'is_author', 'email_verified_at']);
                $json->missingAll(['id', 'email', 'password']);
            }
        );

        $response->assertStatus(200);
        $response->assertSuccessful();

        $response->assertJsonCount(8);
    }

    /**
     * Test the Show Route of User Controller when User isn't Author.
     * 
     * @return void
     */
    public function test_show_route_user_not_author()
    {
        $response = $this->get('/api/users/3');

        $response->assertJson(
            function (AssertableJson $json) {
                $json->hasAll(['name', 'avatar', 'twitter', 'description', 'created_at', 'updated_at', 'is_author', 'email_verified_at']);
                $json->missingAll(['id', 'email', 'password']);
            }
        );

        $response->assertStatus(200);
        $response->assertSuccessful();

        $response->assertJsonCount(8);
    }

    /**
     * Test the ShowComments Route of User Controller.
     * 
     * @return void
     */
    public function test_show_comments_route()
    {
        $response = $this->get('/api/users/2/comments');

        $data = $response->json('data');
        $dataFirstItem = $response->json('data.0');

        $has = ['id', 'content', 'is_fixed', 'post_id', 'created_at', 'updated_at'];
        $except = ['user_id'];

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
     * Test the Show Route of User Controller with Not Found Id.
     * 
     * @return void
     */
    public function test_show_route_not_found()
    {
        $response = $this->get('/api/users/5');

        $response->assertExactJson(["Error" => "User not found"]);

        $response->assertStatus(404);
        $response->assertNotFound();
    }

    /**
     * Test the ShowPosts Route of User Controller.
     *
     * @return void
     */
    public function test_show_posts_route()
    {
        $response = $this->get('/api/users/1/posts');

        $response->assertJson(
            fn (AssertableJson $json) =>
            $json->has(1)->first(
                function (AssertableJson $json) {
                    $json->hasAll(['id', 'title']);
                    $json->missingAll(['content', 'tag_id', 'user_id', 'created_at', 'updated_at']);
                }
            )
        );

        $response->assertStatus(200);
        $response->assertSuccessful();

        $response->assertJsonCount(1);
    }

    /**
     * Test the ShowPosts Route of User Controller with Not Found Id.
     * 
     * @return void
     */
    public function test_show_posts_route_not_found()
    {
        $response = $this->get('/api/users/5/posts');

        $response->assertExactJson(["Error" => "User not found"]);

        $response->assertStatus(404);
        $response->assertNotFound();
    }

    /**
     * Test the ShowPosts Route of User Controller with Not Found Id.
     * 
     * @return void
     */
    public function test_show_posts_route_user_not_author()
    {
        $response = $this->get('/api/users/3/posts');

        $response->assertExactJson(["Error" => "User The Devick isn't an Author"]);

        $response->assertStatus(404);
        $response->assertNotFound();
    }
}
