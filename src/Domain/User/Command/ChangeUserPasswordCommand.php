<?php

namespace App\Domain\User\Command;

use App\Domain\User\Service\UserService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'user:change:password',
    description: 'Add a short description for your command',
)]
class ChangeUserPasswordCommand extends Command
{
    public function __construct(private UserService $userService)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('login', InputArgument::OPTIONAL, 'login')
            ->addArgument('password', InputArgument::OPTIONAL, 'password')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $login = $input->getArgument('login');
        $password = $input->getArgument('password');

        if ($login && $password) {
            $this->userService->changePassword($login, $password);
            $io->success('Le mot de passe est bien changé');

            return Command::SUCCESS;
        }

        return Command::FAILURE;
    }
}
