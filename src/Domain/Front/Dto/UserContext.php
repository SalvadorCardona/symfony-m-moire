<?php
declare(strict_types=1);


namespace App\Domain\Front\Dto;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;

#[ApiResource(
    collectionOperations: ['get'],
    itemOperations: ['get'],
)]
class UserContext
{
    #[ApiProperty(identifier: true)]
    public ?string $email;

    private string $host;

    public function getHost(): string
    {
        return $this->host;
    }

    public function setHost(string $host): void
    {
        $this->host = $host;
    }
}