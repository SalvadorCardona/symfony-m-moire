<?php

declare(strict_types=1);

namespace App\Module\User\Handler;

use App\Module\User\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;

class ChangerUserPassword
{
    public function __construct(
        private UserRepository $userRepository,
        private UserPasswordHasherInterface $passwordHasher,
        private EntityManagerInterface $entityManager,
    ) {
    }

    /**
     * @throws \Exception
     */
    public function __invoke(string $email, string $password): void
    {
        $user = $this->userRepository->findOneBy(['email' => $email]);

        if (!$user) {
            throw new UserNotFoundException();
        }

        $user->setPassword($this->passwordHasher->hashPassword($user, $password));

        $this->entityManager->flush();
    }
}
