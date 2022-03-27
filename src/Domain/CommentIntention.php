<?php

declare(strict_types=1);

namespace Src\Domain;

use DateTime;

class CommentIntention
{
    private const TYPE = 'comment';

    public function __construct(
        private User $visitor,
        private Article $article,
        private DateTime $dateCreated,
    ) { }

    /**
     * @return User
     */
    public function visitor(): User
    {
        return $this->visitor;
    }

    /**
     * @return Article
     */
    public function article(): Article
    {
        return $this->article;
    }

    /**
     * @return DateTime
     */
    public function dateCreated(): DateTime
    {
        return $this->dateCreated;
    }

    public static function make(User $visitor, Article $article): self
    {
        return new CommentIntention($visitor, $article, now());
    }
}
