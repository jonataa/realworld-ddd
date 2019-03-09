<?php

declare(strict_types = 1);

namespace RealWorld\Shared\Domain\ValueObject;

class StringValueObject
{
    
    /** @var string */
    private $value;
    
    public function __construct(string $value)
    {
        $this->value = $value;
    }
    
    public function value(): string
    {
        return $this->value;
    }
    
    public function __toString(): string
    {
        return $this->value();
    }
    
}