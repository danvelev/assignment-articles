<?php

declare(strict_types=1);

namespace Src\Domain\ValueObjects;

final class CommentId extends NumericId
{
    public function equals(int $id): bool
    {
        return $this->value === $id;
    }
}
