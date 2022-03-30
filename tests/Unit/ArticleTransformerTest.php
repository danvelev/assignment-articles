<?php

namespace Tests\Unit;

use PHPUnit\Framework\Assert;
use Src\Domain\Article;
use Src\Domain\User;
use Src\Domain\ValueObjects\ArticleId;
use Src\Domain\ValueObjects\Content;
use Src\Domain\ValueObjects\UserId;
use Src\Presentation\Transformers\ArticleTransformer;
use Tests\TestCase;

class ArticleTransformerTest extends TestCase
{
    public function testArticleTransform(): void
    {
        $user = new User(new UserId(1), 'name', 'random@email.com');
        $article = new Article(new ArticleId(1), 'long text', new Content('long content'), $user, now(), now());

        $response = ArticleTransformer::transform($article);

        Assert::assertNotEmpty($response);
        Assert::assertEquals(1, $response['id']);
        Assert::assertEquals('long text', $response['title']);
        Assert::assertEquals('long content', $response['content']);
        Assert::assertTrue($this->isValidDateFormat('Y-m-d H:i:s', $response['date_created']));
    }

    public function isValidDateFormat(string $format, string $date): bool
    {
        $dateTime = \DateTime::createFromFormat($format, $date);
        if (! $dateTime) {
            return false;
        }

        return $dateTime->format($format) === $date;
    }
}
