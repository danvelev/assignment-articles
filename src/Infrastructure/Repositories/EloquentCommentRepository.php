<?php

namespace Src\Infrastructure\Repositories;

use App\Models\Comment as EloquentCommentModel;
use Src\Application\Exceptions\CommentPublicationException;
use Src\Application\Repositories\CommentRepository;
use Src\Domain\Comment;

class EloquentCommentRepository implements CommentRepository
{
    public function __construct(
        private EloquentCommentModel $eloquentCommentModel
    ) { }

    /**
     * @throws CommentPublicationException
     */
    public function save(Comment $comment): int
    {
        $dbModel = new EloquentCommentModel([
            'message' => $comment->message(),
            'article_id' => $comment->article()->id()->value(),
            'user_id' => $comment->visitor()->id()->value(),
        ]);

        if($dbModel->save()) {
            return $dbModel->id;
        }

        throw new CommentPublicationException(
            sprintf("Comment of user %d could not be published to article ID: %d",
                $comment->visitor()->id()->value(),
                $comment->article()->id()->value()), 500);
    }
}
