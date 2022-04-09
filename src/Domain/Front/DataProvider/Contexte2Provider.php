<?php
declare(strict_types=1);


namespace App\Domain\Front\DataProvider;


use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Domain\Front\Dto\Context;

class Contexte2Provider  implements ItemDataProviderInterface, RestrictedDataProviderInterface
{

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = [])
    {
        $context = new Context();
        $context->setHost('test');

        return $context;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Context::class === $resourceClass;
    }
}