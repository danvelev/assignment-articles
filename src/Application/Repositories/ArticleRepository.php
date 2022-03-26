<?php

declare(strict_types=1);

namespace Src\Application\Repositories;

use Src\Domain\Article;

interface ArticleRepository
{
    public function findById(int $articleId): ?Article;

    public function findAll(): ?array;

    public function save(Article $article): void;
}
