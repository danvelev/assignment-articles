<?php

declare(strict_types=1);

namespace Src\Domain;

use DateTime;
use Src\Domain\ValueObjects\ArticleId;
use Src\Domain\ValueObjects\Content;

class Article
{
    public function __construct(
        private ArticleId $id,
        private string $title,
        private Content $content,
        private User $author,
        private DateTime $dateCreated,
        private ?DateTime $datePublished
    ) {
    }

    public function id(): ArticleId
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function content(): Content
    {
        return $this->content;
    }

    public function author(): User
    {
        return $this->author;
    }

    public function dateCreated(): DateTime
    {
        return $this->dateCreated;
    }

    public function datePublished(): ?DateTime
    {
        return $this->datePublished;
    }

    public static function make(
        int $articleId,
        string $title,
        string $content,
        User $author,
        ?DateTime $dateCreated = null,
        ?DateTime $datePublished = null): self
    {
        return new self(
            new ArticleId($articleId),
            $title,
            new Content($content),
            $author,
            $dateCreated ?? now(),
            $datePublished
        );
    }
}
