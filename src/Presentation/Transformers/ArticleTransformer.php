<?php

namespace Src\Presentation\Transformers;

use Src\Domain\Article;

class ArticleTransformer
{
    public static function transform(Article $article): array
    {
        return [
            'id' => $article->id()->value(),
            'title' => $article->title(),
            'content' => $article->content()->value(),
            'author' => $article->author(),
            'dateCreated' => $article->dateCreated()->format('Y-m-d H:i:s'),
        ];
    }
}
