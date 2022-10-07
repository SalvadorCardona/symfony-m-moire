<?php

declare(strict_types=1);

namespace App\Module\User\DataProvider;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Module\User\Dto\ResetPasswordRequest;
use App\Module\User\Service\UserService;
use Exception;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

final class ResetPasswordRequestPersister implements ContextAwareDataPersisterInterface
{
    public function __construct(private UserService $userService)
    {
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof ResetPasswordRequest;
    }

    /**
     * @param ResetPasswordRequest $data
     *
     * @throws Exception
     */
    public function persist($data, array $context = []): void
    {
        try {
            $this->userService->changePasswordRequest($data->getEmail());
        } catch (Exception $e) {
            throw new BadRequestException($e->getMessage());
        }
    }

    public function remove($data, array $context = [])
    {
        // TODO: Implement remove() method.
    }
}
