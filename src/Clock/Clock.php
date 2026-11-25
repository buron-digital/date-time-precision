<?php

declare(strict_types=1);

namespace BuronDigital\DateTimePrecision\Clock;

use BuronDigital\DateTimePrecision\Moment;

interface Clock
{
    public function now(): Moment;
}
