<?php

namespace Src\Application\Commands;

class CommentPublishedCommand
{

    public function __construct(
        private int $visitorId,
        private int $articleId
    ) { }

    /**
     * @return int
     */
    public function getVisitorId(): int
    {
        return $this->visitorId;
    }

    /**
     * @return int
     */
    public function getArticleId(): int
    {
        return $this->articleId;
    }
}
