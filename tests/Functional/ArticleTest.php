<?php

namespace Tests\Functional;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    const ARTICLE_JSON = [
        'title',
        'content',
        'author_id',
        'dateCreated'
    ];

    public function testJsonResponseGetArticleById()
    {
        $response = $this->getJson('/api/article/1');

        $response->assertJsonStructure(self::ARTICLE_JSON);
    }
}
