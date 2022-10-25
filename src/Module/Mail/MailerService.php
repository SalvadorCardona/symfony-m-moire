<?php

declare(strict_types=1);

namespace App\Module\Mail;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

class MailerService
{
    private const FROM_EMAIL = 'noreply@qantis.co';

    public function __construct(
        private MailerInterface $mailer
    ) {
    }

    /**
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function send(
        string $to,
        string $subject,
        string $body = '',
        ?array $data = null,
        string $template = MailListTemplate::BASE_MAIL
    ): void {
        $email = (new TemplatedEmail())
            ->from(self::FROM_EMAIL)
            ->to(new Address($to))
            ->subject($subject)
            ->htmlTemplate("mail/{$template}");

        $context = [
            'body' => $body,
        ];

        if ($data) {
            $context += $data;
        }

        $email->context($context);

        $this->mailer->send($email);
    }
}
