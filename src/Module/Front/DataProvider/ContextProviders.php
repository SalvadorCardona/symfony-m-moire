<?php

declare(strict_types=1);

namespace App\Module\Front\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Module\Front\Dto\UserContext;

class ContextProviders implements  ItemDataProviderInterface, RestrictedDataProviderInterface
{
    public function __construct()
    {
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?UserContext
    {
        if ('me' !== $id) {
            return null;
        }
        $context = new UserContext();
        $context->setHost('aaa');
        $context->email = 'qsdsqdqsd';

        return $context;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return UserContext::class === $resourceClass;
    }
}
