<?php

declare(strict_types = 1);

namespace RealWorld\Shared\Infrastructure\Bus\Event;

use RealWorld\Shared\Domain\Bus\Event\DomainEventBus;
use RealWorld\Shared\Domain\Bus\Event\DomainEvent;
use function Lambdish\Phunctional\each;
use function Lambdish\Phunctional\map;

final class SimpleSyncDomainEventBus implements DomainEventBus
{

    private $subscribers = [];

    private $subscribersByEvent = [];

    public function __construct(array $subscribers)
    {
        $this->subscribers = $subscribers;
        
        $this->setSubscribersByEvent($this->subscribers);
    }

    public function notify(DomainEvent ...$domainEvents): void
    { 
        each(function($event) {
            each($this->notifySubscriberOf($event), $this->getSubscribersByEvent($event));
        }, $domainEvents);
    }

    private function getSubscribersByEvent(DomainEvent $event): array
    {
        $eventName = $event->eventName();
        return $this->subscribersByEvent[$eventName] ?? [];
    }

    private function setSubscribersByEvent(array $subscribers): void
    {
        each($this->setSubscriberByEvent(), $subscribers);
    }

    private function setSubscriberByEvent(): callable
    {
        return function($subscriber) {
            $events = $subscriber->subscribedTo();            
            map($this->linkSubscribeToEvent($subscriber), $events);
        };
    }

    private function linkSubscribeToEvent($subscriber): callable
    {
        return function($event) use ($subscriber) {
            $eventName = $event::eventName();
            $this->subscribersByEvent[$eventName] = $this->subscribersByEvent[$eventName] ?? [];
            $this->subscribersByEvent[$eventName][] = $subscriber;
        };
    }

    private function notifySubscriberOf(DomainEvent $domainEvent): callable
    {
        return function(callable $subscriber) use ($domainEvent) {
            call_user_func($subscriber, $domainEvent);
        };
    }

}