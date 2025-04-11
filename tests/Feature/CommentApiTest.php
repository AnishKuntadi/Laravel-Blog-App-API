<?php

namespace Tests\Feature;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    //Test that an authenticated user can add a comment to a post.
    public function test_user_can_add_comment()
    {
        // Create a new user and new post using factory
        $user = User::factory()->create();
        $post = Post::factory()->create();

         // Simulate acting as the created user and send a POST request to add a comment
        $response = $this->actingAs($user, 'api')->postJson('/api/comments', [
            'post_id' => $post->id,
            'content' => 'This is a comment'
        ]);

        // response status is 201 (Created)
        $response->assertStatus(201)
                ->assertJsonStructure(['id', 'user_id', 'post_id', 'content']);
    }

}
