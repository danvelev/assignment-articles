<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    private Collection|Model $article;

    public function setUp(): void
    {
        parent::setUp();

        $this->article = Article::factory()->create();
    }

    public function testGetRequestWithExistingArticle(): void
    {
        $response = $this->get(route('get.article.by.id', $this->article->id));

        $response->assertStatus(200);
    }

    public function testGetRequestWithNonExistingArticle(): void
    {
        $response = $this->get(route('get.article.by.id', 0));

        $response->assertStatus(404);
    }
}
