<?php

namespace Src\Application;

use Src\Application\Repositories\CommentRepository;
use Src\Domain\Article;
use Src\Domain\Comment;
use Src\Domain\User;

class PublishCommentService
{
    public function __construct(
        private CommentRepository $commentRepository
    )
    { }

    public function publishComment(Article $article, User $visitor, string $message): int
    {
        $comment = Comment::make(0, $message, $visitor, $article);

        return $this->commentRepository->save($comment);
    }
}
