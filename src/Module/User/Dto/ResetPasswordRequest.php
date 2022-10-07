<?php

declare(strict_types=1);

namespace App\Module\User\Dto;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;

#[ApiResource(
    collectionOperations: ['post' => [
        'output' => false,
    ]],
    itemOperations: []
)]
class ResetPasswordRequest
{
    #[ApiProperty(identifier: true)]
    private string $email;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
}
