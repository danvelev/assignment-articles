<?php

namespace Src\Application;

use Src\Application\Repositories\UserRepository;
use Src\Domain\User;

class ViewUserService
{
    public function __construct(private UserRepository $repository)
    {
    }

    public function findUserById(int $userId): User
    {
        return $this->repository->findById($userId);
    }
}
