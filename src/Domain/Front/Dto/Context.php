<?php
declare(strict_types=1);


namespace App\Domain\Front\Dto;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;

#[ApiResource(
    itemOperations: ['get'],
    collectionOperations: []
)]
class Context
{
    #[ApiProperty(identifier: true)]
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