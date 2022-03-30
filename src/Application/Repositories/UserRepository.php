<?php

namespace Src\Application\Repositories;

use Src\Domain\User;

interface UserRepository
{
    public function findById(int $userId): User;
}
