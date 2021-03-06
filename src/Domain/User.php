<?php

namespace Src\Domain;

use Src\Domain\ValueObjects\UserId;

class User
{
    public function __construct(
        private UserId $id,
        private string $name,
        private string $email
    ) {
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }

    public static function make(int $userId, string $name, string $email): self
    {
        return new self(
            new UserId($userId),
            $name,
            $email
        );
    }
}
