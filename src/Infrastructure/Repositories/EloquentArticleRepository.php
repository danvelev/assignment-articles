<?php

namespace Src\Infrastructure\Repositories;

use App\Models\Article as EloquentArticleModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Src\Application\Exceptions\ArticleNotFoundException;
use Src\Application\Repositories\ArticleRepository;
use Src\Domain\Article;
use Src\Domain\User;
use Src\Domain\ValueObjects\ArticleId;
use Src\Domain\ValueObjects\Content;
use Src\Domain\ValueObjects\UserId;

class EloquentArticleRepository implements ArticleRepository
{
    public function __construct(private EloquentArticleModel $eloquentArticleModel)
    { }

    /**
     * @throws ArticleNotFoundException
     */
    public function findById(int $articleId): ?Article
    {
        try {
            $article = $this->eloquentArticleModel::query()->findOrFail($articleId);

            // TODO: Introduce DTO
            $author = new User(new UserId($article->author->id), $article->author->name, $article->author->email);

            return new Article(
                new ArticleId($article->id),
                $article->title,
                new Content($article->content),
                $author,
                $article->created_at,
                $article->published_at
            );
        } catch (ModelNotFoundException $exception) {
            throw new ArticleNotFoundException(
                sprintf("No articles found with %d ", $articleId), 404);
        }
    }

    public function findAll(): ?array
    {
        // TODO: Implement findAll() method.
        return null;
    }

    public function save(Article $article): void
    {
        // TODO: Implement save() method.
    }
}