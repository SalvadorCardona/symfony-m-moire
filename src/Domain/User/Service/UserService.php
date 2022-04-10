<?php

declare(strict_types=1);

namespace App\Domain\User\Service;

use App\Domain\Mail\MailerService;
use App\Domain\Mail\MailListTemplate;
use App\Domain\User\Dto\UserChangePassword;
use App\Domain\User\Entity\ResetPasswordRequest;
use App\Domain\User\Entity\User;
use App\Domain\User\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService
{
    private const URL_RESET_PASSWORD = '/reset-password/';
    private const MAX_DAYS_LIFE_REQUEST_PASSWORD = 2;

    public function __construct(
        private UserRepository $userRepository,
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $passwordHasher,
        private MailerService $mailerService,
        private RequestStack $requestStack
    ) {
    }

    public function addUser(string $email, string $password): void
    {
        $user = new User();
        $user->setEmail($email);
        $user->setPassword($this->passwordHasher->hashPassword($user, $password));

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    /**
     * @throws Exception
     */
    public function changePassword(string $email, string $password): void
    {
        $user = $this->userRepository->getUserByEmail($email);

        if (!$user) {
            throw new Exception('User not found');
        }

        $user->setPassword($this->passwordHasher->hashPassword($user, $password));

        $this->entityManager->flush();
    }

    /**
     * @throws Exception|TransportExceptionInterface
     */
    public function changePasswordRequest(string $email): void
    {
        $user = $this->userRepository->getUserByEmail($email);

        if (!$user) {
            throw new Exception('User not found');
        }

        $baseUrl = $this->requestStack->getCurrentRequest()->getSchemeAndHttpHost();
        $resetPasswordRequest = new ResetPasswordRequest();
        $resetPasswordRequest->setUser($user);

        $this->entityManager->persist($resetPasswordRequest);
        $this->entityManager->flush();

        $urlReset = $baseUrl.self::URL_RESET_PASSWORD.$resetPasswordRequest->getId();

        $this->mailerService->send(
            $user->getEmail(),
            'Votre changement de mot de passe',
            '',
            ['url' => $urlReset],
            MailListTemplate::RESET_PASSWORD_REQUEST
        );
    }

    /**
     * @throws Exception
     */
    public function changePasswordByRequest(ResetPasswordRequest $resetPasswordRequest, UserChangePassword $userChangePassword): void
    {
        $datTimeDiff = $resetPasswordRequest->getCreateAt()->diff(new DateTime());

        if ($resetPasswordRequest->getUsed() || $datTimeDiff->days > self::MAX_DAYS_LIFE_REQUEST_PASSWORD) {
            throw new BadRequestException('Bad Change Request Password');
        }

        $this->changePassword($resetPasswordRequest->getUser()->getEmail(), $userChangePassword->getPassword());

        $resetPasswordRequest->setUsed(true);

        $this->entityManager->flush();
    }
}
