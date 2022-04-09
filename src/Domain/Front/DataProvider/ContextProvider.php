<?php
declare(strict_types=1);

namespace App\Domain\Front\DataProvider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Domain\Front\Dto\Context;

class ContextProvider implements  RestrictedDataProviderInterface, ItemDataProviderInterface, CollectionDataProviderInterface
{

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Context::class === $resourceClass;
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): Context
    {
        $context = new Context();
        $context->setHost('test');

        return $context;
    }

    public function getCollection(string $resourceClass, string $operationName = null)
    {
        $context = new Context();
        $context->setHost('test');

        return [$context];
    }
}