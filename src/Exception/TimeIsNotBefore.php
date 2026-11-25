<?php

declare(strict_types=1);

namespace BuronDigital\DateTimePrecision\Exception;

/** @psalm-immutable */
final class TimeIsNotBefore extends \InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct('The time is not before but must be.');
    }
}
