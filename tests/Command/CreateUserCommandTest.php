<?php

namespace App\Tests\Command;

use App\Command\CreateUserCommand;
use App\Tests\AppTestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreateUserCommandTest extends AppTestCase
{
    private CommandTester $commandTester;
    private UserPasswordHasherInterface $userPasswordHasher;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userPasswordHasher = $this->container()->get(UserPasswordHasherInterface::class);
        $application = new Application();
        $application->add(new CreateUserCommand($this->em, $this->userPasswordHasher));

        $command = $application->find('app:create-user');
        $this->commandTester = new CommandTester($command);
    }

    public function testCommandCreatesCategoryWithParameter(): void
    {
        $this->commandTester->execute([
            'email' => 'toto@test.com',
            'password' => 'password',
        ]);

        $this->commandTester->assertCommandIsSuccessful();
        $output = $this->commandTester->getDisplay();

        $this->assertStringContainsString('You have successfully created the user', $output);
    }
}
