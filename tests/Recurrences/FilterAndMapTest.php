<?php

declare(strict_types=1);

namespace BuronDigital\DateTimePrecision\Recurrences;

use BuronDigital\DateTimePrecision\Day;
use BuronDigital\DateTimePrecision\Days;
use BuronDigital\DateTimePrecision\Recurrence;
use BuronDigital\DateTimePrecision\Recurrences;
use BuronDigital\DateTimePrecision\Weekday;
use BuronDigital\DateTimePrecision\Weekdays;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(Recurrences::class)]
final class FilterAndMapTest extends TestCase
{
    #[Test]
    public function filter_works(): void
    {
        // -- Arrange
        $collection = new Recurrences([
            Recurrence::daily(),
            Recurrence::weekly(new Weekdays([Weekday::MONDAY])),
            Recurrence::monthly(new Days([new Day(1)])),
        ]);
        $excluded = Recurrence::weekly(new Weekdays([Weekday::MONDAY]));

        // -- Act
        $filteredCollection = $collection->filter(static fn (Recurrence $value): bool => $value->normalize() !== $excluded->normalize());

        // -- Assert
        self::assertEquals(new Recurrences([
            Recurrence::daily(),
            Recurrence::monthly(new Days([new Day(1)])),
        ]), $filteredCollection);
    }

    #[Test]
    public function map_works(): void
    {
        // -- Arrange
        $collection = new Recurrences([
            Recurrence::daily(),
            Recurrence::weekly(new Weekdays([Weekday::MONDAY])),
        ]);

        // -- Act & Assert
        self::assertSame(
            $collection->normalize(),
            $collection->map(static fn (Recurrence $value): mixed => $value->normalize()),
        );
        self::assertSame([], new Recurrences([])->map(static fn (Recurrence $value): mixed => $value->normalize()));
    }
}
