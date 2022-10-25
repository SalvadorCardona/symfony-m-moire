<?php

declare(strict_types=1);

namespace App\Module\Front\Dto;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;

#[ApiResource(
    collectionOperations: ['get'],
    itemOperations: [],
)]
class UserContext
{
    #[ApiProperty(identifier: true)]
    public ?string $email = null;

    public ?string $host = null;
}
