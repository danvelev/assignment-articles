<?php

namespace Src\Infrastructure\Repositories;

use App\Models\CommentIntention as EloquentCommentIntentionModel;
use Src\Application\Repositories\CommentIntentionRepository;
use Src\Domain\CommentIntention;

class EloquentCommentIntentionRepository implements CommentIntentionRepository
{
    public function save(CommentIntention $commentIntention): void
    {
        $dbModel = new EloquentCommentIntentionModel([
            'article_id' => $commentIntention->article()->id()->value(),
            'user_id' => $commentIntention->visitor()->id()->value(),
        ]);

        $dbModel->save();
    }
}
