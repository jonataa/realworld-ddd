<?php

declare(strict_types = 1);

namespace RealWorld\Utils\Shared;

use DateTimeImmutable;

function date_to_string(DateTimeImmutable $date): string
{
    return serialize($date);
}

function string_to_date(string $date): DateTimeImmutable
{
    return unserialize($date);
}