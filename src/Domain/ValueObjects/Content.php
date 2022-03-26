<?php

declare(strict_types=1);

namespace Src\Domain\ValueObjects;

final class Content
{

    public function __construct(private string $value)
    { }

    public function value(): string
    {
        return $this->value;
    }


}
