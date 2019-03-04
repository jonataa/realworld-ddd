<?php

declare(strict_types = 1);

namespace Test\RealWorld\Shared\Infrastructure\PHPUnit;

use PHPUnit\Framework\TestCase;
use RealWorld\Shared\Domain\Bus\Command\Command;
use RealWorld\Shared\Domain\Bus\Query\Query;

class UnitTestCase extends TestCase
{

  public function dispatch(Command $command, callable $handler): void
  {
    $handler($command);
  }

  public function ask(Query $query, callable $handler)
  {
    return $handler($query);
  }

}