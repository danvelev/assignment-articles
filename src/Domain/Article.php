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
    /**
     * @var Collection<Comment> $comments
     */
    private Collection $comments;


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

    /**
     * @return Collection<Comment>
     */
    public function comments(): Collection
    {
        return $this->comments;
    }

    public function publishedComments(): Collection
    {
        return $this->comments->filter(function (Comment $comment) {
            return $comment->isPublished();
        });
    }

    public function addComment(Comment $comment): void
    {
        $this->comments[] = $comment;
    }

}
