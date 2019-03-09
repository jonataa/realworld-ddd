<?php

declare(strict_types = 1);

namespace RealWorld\Shared\Infrastructure\Bus\Event;

use RealWorld\Shared\Domain\Bus\Event\DomainEventBus;
use RealWorld\Shared\Domain\Bus\Event\DomainEvent;
use RealWorld\Shared\Domain\Bus\Event\DomainEventSubscriber;
use function Lambdish\Phunctional\each;

final class SimpleSyncDomainEventBus implements DomainEventBus
{

    /** @var DomainEventSubscriber[] */
    private $subscribers = [];

    public function __construct(array $subscribers)
    {
        $this->subscribers = $subscribers;
    }

    public function notify(DomainEvent $domainEvent): void
    {
        each($this->notifySubscriber($domainEvent), $this->subscribers);
    }

    private function notifySubscriber(DomainEvent $domainEvent): callable
    {
        return function(callable $subscribe) use ($domainEvent) {
            call_user_func($subscribe, $domainEvent);
        };
    }

}