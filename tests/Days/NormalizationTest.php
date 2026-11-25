<?php

declare(strict_types=1);

namespace BuronDigital\DateTimePrecision\Days;

use BuronDigital\DateTimePrecision\Day;
use BuronDigital\DateTimePrecision\Days;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(Days::class)]
final class NormalizationTest extends TestCase
{
    #[Test]
    public function normalize_works(): void
    {
        // -- Arrange
        $days = new Days([
            new Day(1),
            new Day(15),
        ]);

        // -- Act
        $normalizedDays = $days->normalize();
        $denormalizedDays = Days::denormalize($normalizedDays);

        // -- Assert
        self::assertEquals($days, $denormalizedDays);
    }
}
