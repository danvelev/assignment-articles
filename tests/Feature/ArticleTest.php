<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    // TODO: Add seeders
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetRequestWithExistingArticle()
    {
        $response = $this->get('/api/article/1');

        $response->assertStatus(200);
    }

    public function testGetRequestWithNonExistingArticle()
    {
        $response = $this->get('/api/article/0');

        $response->assertStatus(404);
    }
}
