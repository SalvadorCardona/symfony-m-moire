<?php

declare(strict_types=1);

namespace App\Domain\Front\DataProvider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Domain\Front\Dto\Context;

class ContextProviders implements CollectionDataProviderInterface, RestrictedDataProviderInterface
{
    public function __construct()
    {
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = [])
    {
        if ('me' !== $id) {
            return;
        }

        return $this->contextService->getContext();
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Context::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null)
    {
        $context = new Context();
        $context->email = 'test@gmail.com';
        $context->setHost('test');

        return (array) $context;
    }
}
