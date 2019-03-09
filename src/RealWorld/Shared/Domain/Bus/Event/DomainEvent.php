<?php

declare(strict_types = 1);

namespace RealWorld\Shared\Domain\Bus\Event;

use RealWorld\Shared\Domain\ValueObject\Uuid;
use function RealWorld\Utils\Shared\date_to_string;
use DateTimeImmutable;

abstract class DomainEvent
{
    
    /** @var string */
    private $eventId;
    
    /** @var string */
    private $aggregateId;
    
    /** @var array */
    private $data;

    /** @var string */
    private $occurredOn;

    public function __construct(
        string $aggregateId, 
        array $data = [], 
        string $eventId = null, 
        string $occurredOn = null)
    {
        $this->aggregateId = $aggregateId;
        $this->data = $data;
        $this->eventId = $eventId ?: Uuid::random()->value();
        $this->occurredOn = $occurredOn ?: date_to_string(new DateTimeImmutable);
    }
    
    abstract public static function eventName(): string;

}