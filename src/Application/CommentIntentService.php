<?php

namespace Src\Application;

use Src\Application\Repositories\CommentIntentionRepository;
use Src\Domain\Article;
use Src\Domain\CommentIntention;
use Src\Domain\User;

class CommentIntentService
{
    public function __construct(
        private CommentIntentionRepository $commentIntentionRepository
    ) {
    }

    public function saveCommentIntent(User $visitor, Article $article): void
    {
        $commentIntention = CommentIntention::make($visitor, $article);

        $this->commentIntentionRepository->save($commentIntention);
    }
}
