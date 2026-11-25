<?php

declare(strict_types=1);

namespace BuronDigital\DateTimePrecision\Exception;

/** @psalm-immutable */
final class DateRangeStartIsAfterEnd extends \InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct('The start of the date range is after the end but must not be.');
    }
}
