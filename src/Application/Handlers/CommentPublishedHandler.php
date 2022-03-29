<?php

namespace Src\Application\Handlers;

use Src\Application\Commands\CommentPublishedCommand;
use Src\Application\Repositories\CommentIntentionRepository;
use Src\Domain\CommentIntention;

class CommentPublishedHandler
{
    public function __construct(
        private CommentIntentionRepository $commentIntentionRepository
    ) { }

    public function handle(CommentPublishedCommand $command): void
    {
        $this->commentIntentionRepository->deleteAllWith($command->getVisitorId(), $command->getArticleId());
    }
}
