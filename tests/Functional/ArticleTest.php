<?php

namespace Tests\Functional;

use App\Models\Article;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    const ARTICLE_JSON = [
        'title',
        'content',
        'author_id',
        'date_created'
    ];

    public function testJsonResponseGetArticleById(): void
    {
        $article = Article::factory()->create();

        $response = $this->getJson(route('get.article.by.id', $article->id));

        $response->assertJsonStructure(self::ARTICLE_JSON);
    }
}
