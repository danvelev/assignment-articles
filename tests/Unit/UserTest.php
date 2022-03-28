<?php

namespace Tests\Unit;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Src\Domain\User;

class UserTest extends TestCase
{
    public function testUserMake()
    {
        $user = User::make(1, 'Fake Name', 'fake@email.com');

        Assert::assertNotEmpty($user);
        Assert::assertEquals(1, $user->id()->value());
        Assert::assertEquals('Fake Name', $user->name());
    }

    public function testUserMakeWithStringId()
    {
        $user = User::make('1', 'Fake Name', 'fake@email.com');

        Assert::assertNotEmpty($user);
        Assert::assertEquals(1, $user->id()->value());
        Assert::assertEquals('Fake Name', $user->name());
    }
}
