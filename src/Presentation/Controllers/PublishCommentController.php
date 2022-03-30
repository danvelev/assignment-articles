<?php

namespace Src\Presentation\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Src\Application\Commands\CommentPublishedCommand;
use Src\Application\Exceptions\CommentPublicationException;
use Src\Application\PublishCommentService;
use Src\Application\Repositories\ArticleRepository;
use Src\Application\Repositories\CommentRepository;
use Src\Application\Repositories\UserRepository;
use Src\Application\ViewArticleService;
use Src\Application\ViewUserService;
use Src\Presentation\Exceptions\InvalidPayloadException;

class PublishCommentController extends AbstractController
{
    public function __construct(
        private ArticleRepository $articleRepository,
        private UserRepository $userRepository,
        private CommentRepository $commentRepository,
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

            $commentService = new PublishCommentService($this->commentRepository);
            $commentId = $commentService->publishComment($article, $user, $data['message']);

            Bus::dispatch(new CommentPublishedCommand(
                $user->id()->value(),
                $article->id()->value()
            ));

            $response = Response::json([
                'message' => 'Comment Inserted successfully',
                'comment_id' => $commentId,
            ], 201);
        } catch (InvalidPayloadException $e) {
            $response = Response::json([
                'error_message' => $e->getMessage(),
                'error_code' => 'bad_request',
            ], $e->getCode());
        } catch (CommentPublicationException $e) {
            $response = Response::json([
                'error_message' => $e->getMessage(),
                'error_code' => 'record_publication_failed',
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
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            throw new InvalidPayloadException($validator->errors(), 400);
        }
    }
}
