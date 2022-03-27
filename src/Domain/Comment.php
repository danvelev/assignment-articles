<?php

declare(strict_types=1);

namespace Src\Domain;

use Src\Domain\ValueObjects\CommentId;

class Comment
{
    const STATE_DRAFT = 'draft';
    const STATE_PUBLISH = 'publish';

    public function __construct(
        private CommentId $id,
        private string $message,
        private User $visitor,
        private Article $article,
        private string $state
    ) { }

    /**
     * @return CommentId
     */
    public function id(): CommentId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return $this->message;
    }

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
     * @return string
     */
    public function state(): string
    {
        return $this->state;
    }

    public function isPublished(): bool
    {
        return $this->state === self::STATE_PUBLISH;
    }

    public function publish(): void
    {
        $this->state = self::STATE_PUBLISH;
    }

    public static function make(CommentId $id, string $message, User $visitor, Article $article): Comment
    {
        return new Comment($id, $message, $visitor, $article, self::STATE_DRAFT);
    }



}
