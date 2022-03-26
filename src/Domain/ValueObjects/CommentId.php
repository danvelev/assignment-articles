<?php

declare(strict_types=1);

namespace Src\Domain\ValueObjects;

final class CommentId implements NumericId
{
    public function __construct(private int $value)
    { }

    public function value(): int
    {
        return $this->value;
    }

    public function equals(int $id): bool
    {
        return $this->value === $id;
    }
}
