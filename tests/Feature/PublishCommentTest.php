<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Mockery;
use Src\Application\Commands\CommentPublishedCommand;
use Tests\TestCase;

class PublishCommentTest extends TestCase
{
    use RefreshDatabase;

    private Collection|Model $user;

    private Collection|Model $article;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->article = Article::factory()->create();
    }

    public function tearDown(): void
    {
        parent::tearDown();

        Mockery::close();
    }

    public function testPublishCommentRequestWithExistingRecords(): void
    {
        Bus::fake();

        $response = $this->post(route('comment.publish', [
            'user_id' => $this->user->id,
            'article_id' => $this->article->id,
            'message' => 'Random test text',
        ]));

        Bus::assertDispatched(CommentPublishedCommand::class);

        $response->assertStatus(201);
    }

    public function testPublishCommentRequestWithNonExistingRecords(): void
    {
        Bus::fake();

        $response = $this->post(route('comment.publish', [
            'user_id' => $this->user->id,
            'article_id' => $this->article->id + 10,
            'message' => 'Random test text',
        ]));

        Bus::assertNotDispatched(CommentPublishedCommand::class);

        $response->assertStatus(404);
    }

    public function testPublishCommentRequestWithInvalidPayload(): void
    {
        $response = $this->post(route('comment.publish', [
            'user_id' => $this->user->id,
            'article_id' => $this->article->id,
        ]));

        $response->assertStatus(400);
    }
}
