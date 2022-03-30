<?php

namespace Src\Presentation\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Src\Application\CommentIntentService;
use Src\Application\Repositories\ArticleRepository;
use Src\Application\Repositories\CommentIntentionRepository;
use Src\Application\Repositories\UserRepository;
use Src\Application\ViewArticleService;
use Src\Application\ViewUserService;
use Src\Presentation\Exceptions\InvalidPayloadException;

class CommentIntendedController extends AbstractController
{
    public function __construct(
        private ArticleRepository $articleRepository,
        private CommentIntentionRepository $commentIntentionRepository,
        private UserRepository $userRepository
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $data = $request->all();
            $this->validateData($data);

            $articleService = new ViewArticleService($this->articleRepository);
            $article = $articleService->findArticleById($data['article_id']);

            $userService = new ViewUserService($this->userRepository);
            $user = $userService->findUserById($data['user_id']);

            $intendCommentService = new CommentIntentService($this->commentIntentionRepository);
            $intendCommentService->saveCommentIntent($user, $article);

            $response = Response::json([
                'message' => 'Comment Intention Tracked successfully',
            ]);
        } catch (InvalidPayloadException $e) {
            $response = Response::json([
                'error_message' => $e->getMessage(),
                'error_code' => 'bad_request',
            ], $e->getCode());
        } catch (Exception $e) {
            $response = Response::json([
                'error_message' => $e->getMessage(),
                'error_code' => $e->getCode(),
            ], 404);
        }

        return $response;
    }

    /**
     * @throws InvalidPayloadException
     */
    private function validateData(array $data): void
    {
        $validator = Validator::make($data, [
            'user_id' => 'required',
            'article_id' => 'required',
        ]);

        if ($validator->fails()) {
            throw new InvalidPayloadException($validator->errors(), 400);
        }
    }
}
