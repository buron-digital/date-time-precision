<?php

declare(strict_types=1);

namespace BuronDigital\DateTimePrecision\TimeRanges;

use BuronDigital\DateTimePrecision\Time;
use BuronDigital\DateTimePrecision\TimeRange;
use BuronDigital\DateTimePrecision\TimeRanges;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(TimeRanges::class)]
final class SortTest extends TestCase
{
    #[Test]
    public function sort_works_with_comparator(): void
    {
        // -- Arrange
        $collection = new TimeRanges([
            new TimeRange(Time::fromString('10:00:00'), Time::fromString('12:00:00')),
            new TimeRange(Time::fromString('21:00:00'), Time::fromString('03:00:00')),
            new TimeRange(Time::fromString('00:00:00'), Time::fromString('00:00:00')),
        ]);

        // -- Act & Assert
        self::assertEquals(new TimeRanges([
            new TimeRange(Time::fromString('00:00:00'), Time::fromString('00:00:00')),
            new TimeRange(Time::fromString('10:00:00'), Time::fromString('12:00:00')),
            new TimeRange(Time::fromString('21:00:00'), Time::fromString('03:00:00')),
        ]), $collection->sort(static fn (TimeRange $x, TimeRange $y): int => $x->start->compareTo($y->start)));
    }
}
