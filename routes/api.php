<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Src\Presentation\Controllers\GetArticleByIdController;
use Src\Presentation\Controllers\CommentIntendedController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('article/{articleId}', GetArticleByIdController::class)
    ->name('get.article.by.id');

Route::post('comment/intended', CommentIntendedController::class)
    ->name('comment.intended');
