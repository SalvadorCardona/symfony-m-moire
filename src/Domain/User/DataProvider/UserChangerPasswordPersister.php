<?php

declare(strict_types=1);

namespace App\Domain\User\DataProvider;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Domain\User\Dto\UserChangePassword;
use App\Domain\User\Repository\ResetPasswordRequestRepository;
use App\Domain\User\Service\UserService;
use Exception;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

final class UserChangerPasswordPersister implements ContextAwareDataPersisterInterface
{
    public function __construct(private UserService $userService, private ResetPasswordRequestRepository $resetPasswordRequestRepository)
    {
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof UserChangePassword;
    }

    /**
     * @param UserChangePassword $data
     *
     * @throws Exception
     */
    public function persist($data, array $context = []): void
    {
        $resetPasswordRequest = $this->resetPasswordRequestRepository->find($data->getResetPasswordRequestId());

        if (!$resetPasswordRequest) {
            throw new BadRequestException('Request Reset Password Not Found');
        }

        try {
            $this->userService->changePasswordByRequest($resetPasswordRequest, $data);
        } catch (Exception $e) {
            throw new BadRequestException($e->getMessage());
        }
    }

    public function remove($data, array $context = [])
    {
        // TODO: Implement remove() method.
    }
}
