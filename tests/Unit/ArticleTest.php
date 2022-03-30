<?php

namespace Tests\Unit;

use PHPUnit\Framework\Assert;
use Src\Domain\Article;
use Src\Domain\User;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    public function testArticleMake(): void
    {
        $dateCreated = \DateTime::createFromFormat('Y-m-d H:i:s', '2022-01-01 00:00:00');

        $user = User::make(1, 'name', 'email@mail.com');
        $article = Article::make(
            articleId: 1,
            title: 'title',
            content: 'content',
            author: $user,
            dateCreated: $dateCreated ?: null
        );

        Assert::assertNotEmpty($article);
        Assert::assertEquals(1, $article->id()->value());
        Assert::assertEquals('content', $article->content()->value());
        Assert::assertEquals($dateCreated, $article->dateCreated());
    }

    public function testArticleMakeWithoutDate(): void
    {
        $user = User::make(1, 'name', 'email@mail.com');
        $article = Article::make(
            1,
            'title',
            'content',
            $user
        );

        Assert::assertNotEmpty($article);
        Assert::assertEquals(1, $article->id()->value());
        Assert::assertEquals('content', $article->content()->value());
        Assert::assertNotEmpty($article->dateCreated());
    }
}
