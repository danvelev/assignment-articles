<?php

namespace Src\Domain\ValueObjects;

class ArticleId implements NumericId
{
    public function __construct(private int $value)
    { }

    public function value(): int
    {
        return $this->value;
    }
}
