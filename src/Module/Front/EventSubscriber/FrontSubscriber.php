<?php

namespace App\Module\Front\EventSubscriber;

use App\Module\Front\Controller\FrontController;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class FrontSubscriber implements EventSubscriberInterface
{

    public function __construct(private FrontController $frontController)
    {
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        if (str_contains($event->getRequest()->getUri(), 'front') ) {
            $event->setResponse($this->frontController->index());
        }
    }

    #[ArrayShape(['kernel.request' => "string"])]
    public static function getSubscribedEvents(): array
    {
        return [
            'kernel.request' => 'onKernelRequest',
        ];
    }
}
