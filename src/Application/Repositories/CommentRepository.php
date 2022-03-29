<?php

namespace Src\Application\Repositories;

use Src\Domain\Comment;

interface CommentRepository
{
    public function save(Comment $comment): int;
}
