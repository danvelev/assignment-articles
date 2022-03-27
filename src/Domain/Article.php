<?php

declare(strict_types=1);

namespace Src\Domain;

use App\Models\User;
use DateTime;
use Illuminate\Support\Collection;
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
    ) { }

    public function id(): ArticleId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->title;
    }

    /**
     * @return Content
     */
    public function content(): Content
    {
        return $this->content;
    }

    /**
     * @return User
     */
    public function author(): User
    {
        return $this->author;
    }

    /**
     * @return DateTime
     */
    public function dateCreated(): DateTime
    {
        return $this->dateCreated;
    }

    /**
     * @return DateTime
     */
    public function datePublished(): DateTime
    {
        return $this->datePublished;
    }

}
