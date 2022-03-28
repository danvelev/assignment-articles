<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class CommentIntentionTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->article = Article::factory()->create();

        $this->mock = Mockery::mock('overload:EloquentCommentIntentionRepository');
    }

    public function tearDown(): void
    {
        parent::tearDown();

        Mockery::close();
    }

    public function testCommentIntentionRequestWithExistingRecords()
    {
        $this->mock->shouldReceive('save')->once();

        $response = $this->post(route('comment.intended', [
            'user_id' => $this->user->id,
            'article_id' => $this->article->id
        ]));

        $response->assertStatus(200);
    }

    public function testCommentIntentionRequestWithNonExistingRecords()
    {
        $nonExistingId = $this->article->id + 10;

        $response = $this->post(route('comment.intended', [
            'user_id' => $this->user->id,
            'article_id' => $nonExistingId
        ]));

        $response->assertStatus(404);
    }

    public function testCommentIntentionRequestWithBadRequest()
    {
        $response = $this->post('/api/comment/intended', [
            'user_id' => $this->user->id
        ]);

        $response->assertStatus(400);
    }
}
