<?php

declare(strict_types=1);

namespace BuronDigital\DateTimePrecision\Day;

use BuronDigital\DateTimePrecision\Day;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(Day::class)]
final class NormalizationTest extends TestCase
{
    #[Test]
    public function normalize_works(): void
    {
        // -- Arrange
        $day = new Day(15);

        // -- Act
        $normalizedDay = $day->normalize();
        $denormalizedDay = Day::denormalize($normalizedDay);

        // -- Assert
        self::assertEquals($day, $denormalizedDay);
    }
}
