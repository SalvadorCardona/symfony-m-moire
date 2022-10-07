<?php

namespace App\Module\User\Handler;

use App\Module\User\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ChangerUserPassword
{
    public function __construct(
        private UserRepository $userRepository,
        private UserPasswordHasherInterface $passwordHasher,
        private EntityManagerInterface $entityManager,
    )
    {
    }

    public function __invoke(string $email, string $password): void
    {
        $user = $this->userRepository->findOneBy(['email' => $email]);

        if (!$user) {
            throw new Exception('User not found');
        }

        $user->setPassword($this->passwordHasher->hashPassword($user, $password));

        $this->entityManager->flush();
    }
}