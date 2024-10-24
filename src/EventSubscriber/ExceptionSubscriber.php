<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ExceptionSubscriber implements EventSubscriberInterface
{

    public function __construct (private UrlGeneratorInterface $url)
    {
        
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        if ($event->getThrowable() instanceof AccessDeniedHttpException) {
            $response = new Response();
            $response->setContent('<html><body><h2 style="font-weight:50;position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);text-align:center;">Accès non autorisé</h2></body></html>');
            $response->setStatusCode(Response::HTTP_UNAUTHORIZED);
            $event->setResponse($response);
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }
}
