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
final class SortTest extends TestCase
{
    #[Test]
    public function sort_works_with_comparator(): void
    {
        // -- Arrange
        $collection = new Recurrences([
            Recurrence::weekly(new Weekdays([Weekday::MONDAY])),
            Recurrence::monthly(new Days([new Day(1)])),
            Recurrence::daily(),
        ]);

        // -- Act & Assert
        self::assertEquals(new Recurrences([
            Recurrence::daily(),
            Recurrence::monthly(new Days([new Day(1)])),
            Recurrence::weekly(new Weekdays([Weekday::MONDAY])),
        ]), $collection->sort(static fn (Recurrence $x, Recurrence $y): int => strcmp($x->frequency->value, $y->frequency->value)));
    }
}
