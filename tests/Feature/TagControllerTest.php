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
}