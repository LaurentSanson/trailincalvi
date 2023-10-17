<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(name: 'app:create-user', description: 'Create an admin user')]
class CreateUserCommand extends Command
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly UserPasswordHasherInterface $userPasswordHasher,
        string $name = null
    ) {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::REQUIRED, 'Enter the email of the user')
            ->addArgument('password', InputArgument::REQUIRED, 'Enter the password of the user')
        ;
    }

    protected function interact(InputInterface $input, OutputInterface $output): void
    {
        if (null === $input->getArgument('email')) {
            $argument = $this->getDefinition()->getArgument('email');

            $output->writeln([
                'User Creator',
                '============',
                '',
            ]);
            $question = new Question($argument->getDescription() . ' : ');
            /** @var QuestionHelper $helper */
            $helper = $this->getHelper('question');
            $value = $helper->ask($input, $output, $question);

            $input->setArgument('email', $value);
        }

        if (null === $input->getArgument('password')) {
            $argument = $this->getDefinition()->getArgument('password');
            $question = new Question($argument->getDescription() . ' : ');
            /** @var QuestionHelper $helper */
            $helper = $this->getHelper('question');
            $value = $helper->ask($input, $output, $question);

            $input->setArgument('password', $value);
        }
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        /** @var string $userEmail */
        $userEmail = $input->getArgument('email');
        /** @var string $userPassword */
        $userPassword = $input->getArgument('password');

        if ($userEmail && $userPassword) {
            try {
                $user = new User();
                $user->setEmail($userEmail);
                $user->setPassword(
                    $this->userPasswordHasher->hashPassword($user, $userPassword)
                );
                $user->setRoles(['ROLE_ADMIN']);
                $this->entityManager->persist($user);
                $this->entityManager->flush();

                $io->success('You have successfully created the user');

                return Command::SUCCESS;
            } catch (Exception $exception) {
                return Command::FAILURE;
            }
        } else {
            return Command::INVALID;
        }
    }
}
