<?php

declare(strict_types=1);

namespace BuronDigital\DateTimePrecision\Clock;

use BuronDigital\DateTimePrecision\Moment;

final class FrozenClock implements Clock
{
    private Moment $moment;

    public function __construct(?Moment $moment = null)
    {
        $this->moment = $moment ?? Moment::fromString('now');
    }

    public function freeze(Moment $moment): void
    {
        $this->moment = $moment;
    }

    #[\Override]
    public function now(): Moment
    {
        return $this->moment;
    }
}
