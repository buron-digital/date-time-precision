<?php

declare(strict_types=1);

namespace BuronDigital\DateTimePrecision\Exception;

/** @psalm-immutable */
final class WeekIsBefore extends \InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct('The week is before but must not be.');
    }
}
