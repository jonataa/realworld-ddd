<?php

declare(strict_types = 1);

namespace RealWorld\Shared\Infrastructure\Bus\Event;

use RealWorld\Shared\Domain\Bus\Event\DomainEvent;
use function Lambdish\Phunctional\each;

final class SimpleSyncDomainEventPublisher
{

    private $events = [];
    private $publishedEvents = [];

    public function record(DomainEvent ...$domainEvents): void
    {
        $this->events = array_merge($this->events, array_values($domainEvents));
    }

    public function publish(DomainEvent ...$domainEvents): void
    {
        $this->record(...$domainEvents);

        $events = $this->events;
        
        $this->events = [];
        
        each(function(DomainEvent $event) {
            $this->publishedEvents[] = $event;
        }, $events);
    }

}