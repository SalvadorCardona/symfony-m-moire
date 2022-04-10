<?php

declare(strict_types=1);

namespace App\Domain\User\Dto;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Uid\Uuid;

#[ApiResource(
    collectionOperations: ['post' => [
        'output' => false,
    ]],
    itemOperations: []
)]
class UserChangePassword
{
    private Uuid $resetPasswordRequestId;
    private string $password;

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getResetPasswordRequestId(): Uuid
    {
        return $this->resetPasswordRequestId;
    }

    public function setResetPasswordRequestId(Uuid $resetPasswordRequestId): void
    {
        $this->resetPasswordRequestId = $resetPasswordRequestId;
    }
}
