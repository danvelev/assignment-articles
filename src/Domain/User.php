<?php

namespace Src\Domain;

use Src\Domain\ValueObjects\UserId;

class User
{
    public function __construct(
        private UserId $id,
        private string $name,
        private string $email
    ) { }

    /**
     * @return UserId
     */
    public function id(): UserId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function email(): string
    {
        return $this->email;
    }
}
