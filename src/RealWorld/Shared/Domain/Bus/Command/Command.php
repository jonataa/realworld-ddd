<?php

namespace RealWorld\Shared\Domain\Bus\Command;

use RealWorld\Shared\Domain\ValueObject\Uuid;

abstract class Command
{

  /** @var Uuid */
  private $commandId;

  public function __construct(Uuid $commandId)
  {
    $this->commandId = $commandId;
  }

  public function commandId(): Uuid
  {
    return $this->commandId;
  }

}