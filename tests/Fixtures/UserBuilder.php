<?php

namespace App\Tests\Fixtures;

use App\Entity\User;
use App\Tests\AbstractBuilder;

class UserBuilder extends AbstractBuilder
{
    private ?string $email;
    private ?string $password;
    private array $roles;

    public function withEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function withRoles(...$roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function build(bool $persist = true): User
    {
        $user = new User();

        $user->setEmail($this->email ?? str_shuffle('abcdefghijklmnopqrstuvwxyz').'@test.fr');
        $user->setPassword($this->password ?? 'password');
        $user->setRoles($this->roles ?? ['ROLE_USER']);

        if ($persist) {
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        }

        return $user;
    }

    public function clear(): self
    {
        $this->email = null;
        $this->password = null;
        $this->roles = [];

        return $this;
    }
}
