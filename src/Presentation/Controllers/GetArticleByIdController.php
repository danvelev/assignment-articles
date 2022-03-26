<?php

namespace Src\Presentation\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Src\Application\Exceptions\ArticleNotFoundException;
use Src\Application\Repositories\ArticleRepository;
use Src\Application\ViewArticleService;
use Src\Presentation\Transformers\ArticleTransformer;

class GetArticleByIdController extends AbstractController
{

    public function __construct(private ArticleRepository $articleRepository)
    { }

    public function __invoke(int $articleId): JsonResponse
    {
        try {
            $viewArticle = new ViewArticleService($this->articleRepository);
            $article = $viewArticle->findArticleById($articleId);

            $response = Response::json(ArticleTransformer::transform($article));

        } catch(ArticleNotFoundException $exception) {
            $response = Response::json([
                'error_message' => $exception->getMessage(),
                'error_code' => 'no_article_found',
            ], $exception->getCode());
        } catch (Exception $exception) {
            $response = Response::json([
                'error_message' => $exception->getMessage(),
                'error_code' => $exception->getCode(),
            ], 400);
        }

        return $response;
    }
}
