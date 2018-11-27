<?php

namespace AppBundle;

use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class AuthListener implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_COMPLETED => 'registration',
            FOSUserEvents::REGISTRATION_CONFIRMED => 'registration'
        );
    }

    public function registration(FilterUserResponseEvent $event, $eventName = null, EventDispatcherInterface $eventDispatcher = null)
    {
//SI QUIERES PUEDES HACER MÁS COSAS AQUÍ
        $event->stopPropagation();
    }
}
 ?>
