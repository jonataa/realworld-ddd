<?php

declare(strict_types = 1);

namespace RealWorld\Shared\Domain\Bus\Event;

interface DomainEventBus
{
    public function notify(DomainEvent ...$events): void;
}