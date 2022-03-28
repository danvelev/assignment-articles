<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->article = Article::factory()->create();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetRequestWithExistingArticle()
    {
        $response = $this->get(route('get.article.by.id', $this->article->id));

        $response->assertStatus(200);
    }

    public function testGetRequestWithNonExistingArticle()
    {
        $response = $this->get(route('get.article.by.id',0));

        $response->assertStatus(404);
    }
}
