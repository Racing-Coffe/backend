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
            $json->has(3)->first(
                function (AssertableJson $json) {
                    $json->hasAll(['id', 'title', 'tag_id', 'author_id']);
                    $json->missingAll(['content', 'created_at', 'updated_at']);
                }
            )
        );

        $response->assertStatus(200);
        $response->assertSuccessful();

        $response->assertJsonCount(3);
    }
}
