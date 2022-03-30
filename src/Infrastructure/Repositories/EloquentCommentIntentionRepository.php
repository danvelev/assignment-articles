<?php

namespace Src\Infrastructure\Repositories;

use App\Models\CommentIntention as EloquentCommentIntentionModel;
use Src\Application\Repositories\CommentIntentionRepository;
use Src\Domain\CommentIntention;

class EloquentCommentIntentionRepository implements CommentIntentionRepository
{
    public function __construct(
        private EloquentCommentIntentionModel $eloquentCommentIntentionModel
    ) { }

    public function save(CommentIntention $commentIntention): void
    {
        $dbModel = new $this->eloquentCommentIntentionModel([
            'article_id' => $commentIntention->article()->id()->value(),
            'user_id' => $commentIntention->visitor()->id()->value(),
        ]);

        $dbModel->save();
    }

    public function deleteAllWith(int $visitorId, int $articleId): void
    {
        $this->eloquentCommentIntentionModel::query()
            ->where('article_id', '=', $articleId)
            ->where('user_id', '=', $visitorId)
            ->delete();
    }
}
