<?php

declare(strict_types = 1);

namespace RealWorld\Shared\Domain\ValueObject;

use Ramsey\Uuid\Uuid as RamseyUuid;

class Uuid
{

  /** @var string */
  protected $value;

  public function __construct(string $value)
  {
    // TODO: ensurance uuid value
    $this->value = $value;
  }

  public static function random(): self
  {
    return new self(RamseyUuid::uuid4()->toString());
  }

  public function value(): string
  {
    return $this->value;
  }

  public function __toString()
  {
    return $this->value();
  }

}