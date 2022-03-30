<?php

declare(strict_types=1);

namespace Src\Application;

use Src\Application\Repositories\ArticleRepository;
use Src\Domain\Article;

class ViewArticleService
{
    public function __construct(private ArticleRepository $repository)
    { }

    public function findArticleById(int $articleId): Article
    {
        return $this->repository->findById($articleId);
    }

}
