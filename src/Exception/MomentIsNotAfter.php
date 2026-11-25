<?php

declare(strict_types=1);

namespace BuronDigital\DateTimePrecision\Exception;

/** @psalm-immutable */
final class MomentIsNotAfter extends \InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct('The moment is not after but must be.');
    }
}
