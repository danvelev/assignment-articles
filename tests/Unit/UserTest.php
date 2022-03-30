<?php

namespace Tests\Unit;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Src\Domain\User;

class UserTest extends TestCase
{
    public function testUserMake(): void
    {
        $user = User::make(1, 'Fake Name', 'fake@email.com');

        Assert::assertNotEmpty($user);
        Assert::assertEquals(1, $user->id()->value());
        Assert::assertEquals('Fake Name', $user->name());
    }
}
