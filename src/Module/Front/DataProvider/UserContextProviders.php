<?php

declare(strict_types=1);

namespace App\Module\Front\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use App\Module\Front\Dto\UserContext;

class UserContextProviders implements ContextAwareCollectionDataProviderInterface, ItemDataProviderInterface
{
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?UserContext
    {
        $context = new UserContext();
        $context->host = 'localhost';

        if ('me' !== $id) {
            $context->host = 'localhost-x';
        }

        return $context;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return UserContext::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        $context = new UserContext();

        $context->host = 'localhost';
        $context->email = 'test';

        return [$context];
    }
}
