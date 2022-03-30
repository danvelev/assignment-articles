<?php

declare(strict_types=1);

namespace Src\Application\Repositories;

use Src\Domain\CommentIntention;

interface CommentIntentionRepository
{
    public function save(CommentIntention $commentIntention): void;

    public function deleteAllWith(int $visitorId, int $articleId): void;
}
