<?php

namespace Src\Infrastructure\Repositories;

use App\Models\Article as EloquentArticleModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Src\Application\Exceptions\ArticleNotFoundException;
use Src\Application\Repositories\ArticleRepository;
use Src\Domain\Article;
use Src\Domain\User;

class EloquentArticleRepository implements ArticleRepository
{
    public function __construct(private EloquentArticleModel $eloquentArticleModel)
    { }

    /**
     * @throws ArticleNotFoundException
     */
    public function findById(int $articleId): Article
    {
        try {
            $article = $this->eloquentArticleModel::query()->findOrFail($articleId);

            $author = User::make($article->author->id, $article->author->name, $article->author->email);

            return Article::make(
                $article->id,
                $article->title,
                $article->content,
                $author,
                $article->created_at,
                $article->published_at
            );
        } catch (ModelNotFoundException $exception) {
            throw new ArticleNotFoundException(
                sprintf("No articles found with %d ", $articleId), 404);
        }
    }

    public function save(Article $article): void
    {
        // TODO: Implement save() method.
    }
}
