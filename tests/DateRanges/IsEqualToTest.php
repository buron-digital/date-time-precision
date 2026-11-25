<?php

declare(strict_types=1);

namespace BuronDigital\DateTimePrecision\DateRanges;

use BuronDigital\DateTimePrecision\Date;
use BuronDigital\DateTimePrecision\DateRange;
use BuronDigital\DateTimePrecision\DateRanges;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(DateRanges::class)]
final class IsEqualToTest extends TestCase
{
    #[Test]
    public function is_equal_to_works(): void
    {
        // -- Arrange
        $collection = new DateRanges([
            new DateRange(Date::fromString('2026-01-01'), Date::fromString('2026-01-10')),
            new DateRange(Date::fromString('2026-01-01'), Date::fromString('2026-01-11')),
        ]);

        // -- Act & Assert
        self::assertTrue($collection->isEqualTo(new DateRanges([
            new DateRange(Date::fromString('2026-01-01'), Date::fromString('2026-01-10')),
            new DateRange(Date::fromString('2026-01-01'), Date::fromString('2026-01-11')),
        ])));
        self::assertTrue($collection->isEqualTo(new DateRanges([
            new DateRange(Date::fromString('2026-01-01'), Date::fromString('2026-01-11')),
            new DateRange(Date::fromString('2026-01-01'), Date::fromString('2026-01-10')),
        ])));
        self::assertFalse($collection->isEqualTo(new DateRanges([
            new DateRange(Date::fromString('2026-01-01'), Date::fromString('2026-01-10')),
        ])));
        self::assertFalse(new DateRanges([
            new DateRange(Date::fromString('2026-01-01'), Date::fromString('2026-01-10')),
        ])->isEqualTo($collection));
        self::assertFalse($collection->isEqualTo(new DateRanges([
            new DateRange(Date::fromString('2026-01-01'), Date::fromString('2026-01-10')),
            new DateRange(Date::fromString('2026-02-01'), Date::fromString('2026-02-10')),
        ])));
        self::assertTrue(new DateRanges([])->isEqualTo(new DateRanges([])));
    }

    #[Test]
    public function is_not_equal_to_works(): void
    {
        // -- Arrange
        $collection = new DateRanges([
            new DateRange(Date::fromString('2026-01-01'), Date::fromString('2026-01-10')),
            new DateRange(Date::fromString('2026-01-01'), Date::fromString('2026-01-11')),
        ]);

        // -- Act & Assert
        self::assertFalse($collection->isNotEqualTo(new DateRanges([
            new DateRange(Date::fromString('2026-01-01'), Date::fromString('2026-01-11')),
            new DateRange(Date::fromString('2026-01-01'), Date::fromString('2026-01-10')),
        ])));
        self::assertTrue($collection->isNotEqualTo(new DateRanges([
            new DateRange(Date::fromString('2026-01-01'), Date::fromString('2026-01-10')),
            new DateRange(Date::fromString('2026-02-01'), Date::fromString('2026-02-10')),
        ])));
    }
}
