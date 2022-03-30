<?php

namespace Src\Infrastructure\Repositories;

use App\Models\User as EloquentUserModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Src\Application\Exceptions\UserNotFoundException;
use Src\Application\Repositories\UserRepository;
use Src\Domain\User;
use Src\Domain\ValueObjects\UserId;

class EloquentUserRepository implements UserRepository
{


    public function __construct(
        private EloquentUserModel $eloquentUserModel
    ) { }

    /**
     * @throws UserNotFoundException
     */
    public function findById(int $userId): User
    {
        try {
            $user = $this->eloquentUserModel::query()->findOrFail($userId);

            return User::make(
                $user->id,
                $user->name,
                $user->email
            );
        } catch (ModelNotFoundException) {
            throw new UserNotFoundException(
                sprintf("No user found with %d ", $userId), 404);
        }
    }
}
