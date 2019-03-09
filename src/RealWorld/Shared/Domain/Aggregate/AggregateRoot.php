<?php

declare(strict_types = 1);

namespace RealWorld\Shared\Domain\Aggregate;

use RealWorld\Shared\Domain\Bus\Event\DomainEvent;

abstract class AggregateRoot
{

    /** @var DomainEvent[] */
    private $domainEvents = [];

    /**
     * @return DomainEvent[]
     */
    final public function pullDomainEvents(): array
    {
        $domainEvents = $this->domainEvents;
        $this->domainEvents = [];
        return $domainEvents;
    }

    /**
     * @param DomainEvent $domainEvent
     * @return void
     */
    final protected function record(DomainEvent $domainEvent): void
    {
        $this->domainEvents[] = $domainEvent;
    }

}