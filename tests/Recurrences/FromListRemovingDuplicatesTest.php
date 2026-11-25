<?php

declare(strict_types=1);

namespace BuronDigital\DateTimePrecision\Recurrences;

use BuronDigital\DateTimePrecision\Day;
use BuronDigital\DateTimePrecision\Days;
use BuronDigital\DateTimePrecision\Exception\CollectionContainsDuplicates;
use BuronDigital\DateTimePrecision\Recurrence;
use BuronDigital\DateTimePrecision\Recurrences;
use BuronDigital\DateTimePrecision\Weekday;
use BuronDigital\DateTimePrecision\Weekdays;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(Recurrences::class)]
#[CoversClass(CollectionContainsDuplicates::class)]
final class FromListRemovingDuplicatesTest extends TestCase
{
    #[Test]
    public function from_list_removing_duplicates_works(): void
    {
        // -- Act
        $collection = Recurrences::fromListRemovingDuplicates([
            Recurrence::daily(),
            Recurrence::weekly(new Weekdays([Weekday::MONDAY])),
            Recurrence::daily(),
            Recurrence::monthly(new Days([new Day(1)])),
            Recurrence::weekly(new Weekdays([Weekday::MONDAY])),
        ]);

        // -- Assert
        self::assertEquals(new Recurrences([
            Recurrence::daily(),
            Recurrence::weekly(new Weekdays([Weekday::MONDAY])),
            Recurrence::monthly(new Days([new Day(1)])),
        ]), $collection);
    }

    #[Test]
    public function construction_fails_with_duplicates(): void
    {
        // -- Assert
        $this->expectException(CollectionContainsDuplicates::class);

        // -- Act
        new Recurrences([
            Recurrence::daily(),
            Recurrence::weekly(new Weekdays([Weekday::MONDAY])),
            Recurrence::daily(),
        ]);
    }
}
