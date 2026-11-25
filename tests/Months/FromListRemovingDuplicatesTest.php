<?php

declare(strict_types=1);

namespace BuronDigital\DateTimePrecision\Months;

use BuronDigital\DateTimePrecision\Exception\CollectionContainsDuplicates;
use BuronDigital\DateTimePrecision\Month;
use BuronDigital\DateTimePrecision\Months;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(Months::class)]
#[CoversClass(CollectionContainsDuplicates::class)]
final class FromListRemovingDuplicatesTest extends TestCase
{
    #[Test]
    public function from_list_removing_duplicates_works(): void
    {
        // -- Act
        $collection = Months::fromListRemovingDuplicates([
            Month::fromString('2026-01'),
            Month::fromString('2026-02'),
            Month::fromString('2026-01'),
            Month::fromString('2026-03'),
            Month::fromString('2026-02'),
        ]);

        // -- Assert
        self::assertEquals(new Months([
            Month::fromString('2026-01'),
            Month::fromString('2026-02'),
            Month::fromString('2026-03'),
        ]), $collection);
    }

    #[Test]
    public function construction_fails_with_duplicates(): void
    {
        // -- Assert
        $this->expectException(CollectionContainsDuplicates::class);

        // -- Act
        new Months([
            Month::fromString('2026-01'),
            Month::fromString('2026-02'),
            Month::fromString('2026-01'),
        ]);
    }
}
