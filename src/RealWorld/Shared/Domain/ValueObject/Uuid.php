<?php

declare(strict_types = 1);

namespace RealWorld\Shared\Domain\ValueObject;

use Ramsey\Uuid\Uuid as RamseyUuid;
use InvalidArgumentException;

class Uuid
{
    
    /** @var string */
    protected $value;
    
    public function __construct(string $value)
    {
        $this->ensureIsValidUuid($value);

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

    public function ensureIsValidUuid($id): void
    {
        if (false === RamseyUuid::isValid($id)) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.', static::class, $id)
            );
        }
    }
    
    public function __toString()
    {
        return $this->value();
    }
    
}