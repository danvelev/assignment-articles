<?php

namespace Tests\Feature;

use Mockery;
use Tests\TestCase;

class CommentIntentionTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

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

        $response = $this->post('/api/comment/intended', [
            'user_id' => 1,
            'article_id' => 1
        ]);

        $response->assertStatus(200);
    }

    public function testCommentIntentionRequestWithNonExistingRecords()
    {
        $response = $this->post('/api/comment/intended', [
            'user_id' => 1,
            'article_id' => 2
        ]);

        $response->assertStatus(404);
    }

    public function testCommentIntentionRequestWithBadRequest()
    {
        $response = $this->post('/api/comment/intended', [
            'user_id' => 1
        ]);

        $response->assertStatus(400);
    }
}
