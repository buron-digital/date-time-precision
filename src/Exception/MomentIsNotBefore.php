<?php

declare(strict_types=1);

namespace BuronDigital\DateTimePrecision\Exception;

/** @psalm-immutable */
final class MomentIsNotBefore extends \InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct('The moment is not before but must be.');
    }
}
