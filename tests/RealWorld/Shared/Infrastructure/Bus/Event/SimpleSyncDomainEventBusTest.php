<?php

declare(strict_types = 1);

namespace Test\RealWorld\Shared\Infrastructure\Bus\Event;

use Test\RealWorld\Shared\Infrastructure\PHPUnit\UnitTestCase;
use RealWorld\Shared\Domain\Bus\Event\DomainEvent;
use RealWorld\Shared\Infrastructure\Bus\Event\SimpleSyncDomainEventBus;
use RealWorld\Shared\Domain\Bus\Event\DomainEventSubscriber;

final class SimpleSyncDomainBusTest extends UnitTestCase
{
    public static $totalTimesCalled;
    
    /** @var SimpleSyncDomainEventBus */
    protected $bus;

    public function setUp()
    {
        parent::setUp();

        self::$totalTimesCalled = 0;

        $this->bus = new SimpleSyncDomainEventBus([
            $this->subscriber(),
            $this->subscriber(),
        ]);        
    }

    /** @test */
    public function it_should_publish_and_handle_one_event(): void
    {
        $this->bus->notify(new FakeDomainEvent('aggregate id'));

        $this->assertEquals(2, self::$totalTimesCalled);
    }

    /** @test */
    public function it_should_publish_and_handle_two_events(): void
    {
        $events = [
            new FakeDomainEvent('aggregate id'), 
            new FakeDomainEvent('aggregate id')
        ];

        $this->bus->notify(...$events);

        $this->assertEquals(4, self::$totalTimesCalled);
    }

    private function subscriber()
    {
        return new class() implements DomainEventSubscriber
        {        
            public function __invoke(DomainEvent $unused): void
            {
                SimpleSyncDomainBusTest::$totalTimesCalled++;
            }

            public static function subscribedTo(): array
            {
                return [FakeDomainEvent::class];
            }
        };
    }

}
