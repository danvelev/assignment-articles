<?php

namespace Src\Application\Commands;

class CommentPublishedCommand
{
    public function __construct(
        private int $visitorId,
        private int $articleId
    ) {
    }

    public function getVisitorId(): int
    {
        return $this->visitorId;
    }

    public function getArticleId(): int
    {
        return $this->articleId;
    }
}
