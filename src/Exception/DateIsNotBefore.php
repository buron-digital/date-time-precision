<?php

declare(strict_types=1);

namespace BuronDigital\DateTimePrecision\Exception;

/** @psalm-immutable */
final class DateIsNotBefore extends \InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct('The date is not before but must be.');
    }
}
