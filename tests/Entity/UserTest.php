<?php

namespace App\Tests\Entity;

use App\Entity\User;
use App\Tests\AppTestCase;
use App\Tests\Fixtures\UserBuilder;

class UserTest extends AppTestCase
{
    public function testItCreatesUser(): void
    {
        /** @var User $user */
        $user = UserBuilder::for($this)->any();

        self::assertNotNull($user->getId());
        self::assertNotNull($user->getEmail());
        self::assertNotNull($user->getUserIdentifier());
        self::assertNotNull($user->getPassword());
        self::assertContains('ROLE_USER', $user->getRoles());
    }
}
