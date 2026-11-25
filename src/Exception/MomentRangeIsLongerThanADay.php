<?php

declare(strict_types=1);

namespace BuronDigital\DateTimePrecision\Exception;

/** @psalm-immutable */
final class MomentRangeIsLongerThanADay extends \InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct('The moment range is longer than a day and therefore cannot be converted into a time range.');
    }
}
