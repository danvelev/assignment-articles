<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Mockery\LegacyMockInterface;
use Mockery\MockInterface;
use Tests\TestCase;

class CommentIntentionTest extends TestCase
{
    use RefreshDatabase;

    private Collection|Model $user;
    private Collection|Model $article;
    private LegacyMockInterface|MockInterface $mock;

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

    public function testCommentIntentionRequestWithExistingRecords(): void
    {
        $this->mock->shouldReceive('save')->once();

        $response = $this->post(route('comment.intended', [
            'user_id' => $this->user->id,
            'article_id' => $this->article->id
        ]));

        $response->assertStatus(200);
    }

    public function testCommentIntentionRequestWithNonExistingRecords(): void
    {
        $nonExistingId = $this->article->id + 10;

        $response = $this->post(route('comment.intended', [
            'user_id' => $this->user->id,
            'article_id' => $nonExistingId
        ]));

        $response->assertStatus(404);
    }

    public function testCommentIntentionRequestWithInvalidPayload(): void
    {
        $response = $this->post('/api/comment/intended', [
            'user_id' => $this->user->id
        ]);

        $response->assertStatus(400);
    }
}
