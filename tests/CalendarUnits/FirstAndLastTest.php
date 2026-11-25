<?php

declare(strict_types=1);

namespace BuronDigital\DateTimePrecision\CalendarUnits;

use BuronDigital\DateTimePrecision\CalendarUnit;
use BuronDigital\DateTimePrecision\CalendarUnits;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(CalendarUnits::class)]
final class FirstAndLastTest extends TestCase
{
    #[Test]
    public function first_and_last_works(): void
    {
        // -- Arrange
        $collection = new CalendarUnits([
            CalendarUnit::DAY,
            CalendarUnit::WEEK,
            CalendarUnit::MONTH,
        ]);

        // -- Act & Assert
        self::assertEquals(CalendarUnit::DAY, $collection->first());
        self::assertEquals(CalendarUnit::MONTH, $collection->last());
    }

    #[Test]
    public function first_and_last_works_without_elements(): void
    {
        // -- Arrange
        $collection = new CalendarUnits([]);

        // -- Act & Assert
        self::assertNull($collection->first());
        self::assertNull($collection->last());
    }
}
