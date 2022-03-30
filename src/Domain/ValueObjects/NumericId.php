<?php

namespace Src\Domain\ValueObjects;

abstract class NumericId
{
    public function __construct(protected int $value)
    { }

    public function value(): int
    {
        return $this->value;
    }
}
