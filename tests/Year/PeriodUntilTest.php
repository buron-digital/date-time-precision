<?php

declare(strict_types=1);

namespace BuronDigital\DateTimePrecision\Year;

use BuronDigital\DateTimePrecision\CalendarPeriod;
use BuronDigital\DateTimePrecision\Exception\YearIsBefore;
use BuronDigital\DateTimePrecision\Year;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(Year::class)]
#[CoversClass(CalendarPeriod::class)]
#[CoversClass(YearIsBefore::class)]
final class PeriodUntilTest extends TestCase
{
    #[Test]
    public function period_until_works(): void
    {
        // -- Act & Assert
        self::assertEquals(CalendarPeriod::years(6), new Year(2020)->periodUntil(new Year(2026)));
        self::assertEquals(CalendarPeriod::years(0), new Year(2026)->periodUntil(new Year(2026)));
    }

    #[Test]
    public function period_until_fails_when_year_is_before(): void
    {
        // -- Assert
        $this->expectException(YearIsBefore::class);

        // -- Act
        new Year(2026)->periodUntil(new Year(2025));
    }
}
