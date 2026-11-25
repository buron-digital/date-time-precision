<?php

declare(strict_types=1);

namespace BuronDigital\DateTimePrecision\Exception;

/** @psalm-immutable */
final class MomentIsEqualTo extends \InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct('The moment is equal but must not be.');
    }
}
