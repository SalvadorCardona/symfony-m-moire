<?php

declare(strict_types=1);

namespace App\Module\User\Factory;

use App\Module\User\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFactory
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
    ) {
    }

    /**
     * @param array<string> $role
     */
    public function createNew(
        string $email,
        string $password,
        array $role
    ): User {
        $user = new User();
        $user->setEmail($email);
        $user->setRoles($role);
        $user->setPassword($this->passwordHasher->hashPassword($user, $password));

        return $user;
    }
}
