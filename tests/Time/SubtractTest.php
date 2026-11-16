<?php

declare(strict_types=1);

namespace DigitalCraftsman\DateTimePrecision\Time;

use DigitalCraftsman\DateTimePrecision\Duration;
use DigitalCraftsman\DateTimePrecision\Time;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(Time::class)]
final class SubtractTest extends TestCase
{
    #[Test]
    #[DataProvider('dataProvider')]
    public function subtract_works(
        Time $expectedResult,
        Time $time,
        Duration $duration,
    ): void {
        // -- Act & Assert
        self::assertEquals($expectedResult, $time->subtract($duration));
    }

    /**
     * @return array<string, array{
     *   0: Time,
     *   1: Time,
     *   2: Duration,
     * }>
     */
    public static function dataProvider(): array
    {
        return [
            'subtract minutes' => [
                new Time(10, 0, 0),
                new Time(11, 30, 0),
                Duration::fromMinutes(90),
            ],
            'subtract small microseconds' => [
                new Time(12, 0, 0),
                new Time(12, 0, 0, 5),
                Duration::fromMicroseconds(5),
            ],
            'wraps around midnight' => [
                new Time(23, 0, 0),
                new Time(1, 0, 0),
                Duration::fromHours(2),
            ],
            'duration with 14 digits of microseconds' => [
                new Time(16, 13, 20),
                new Time(10, 0, 0),
                Duration::fromMicroseconds(10_000_000_000_000),
            ],
            'duration of 10002 hours' => [
                new Time(16, 0, 0),
                new Time(10, 0, 0),
                Duration::fromHours(10_002),
            ],
            'long duration with microseconds borrowing from seconds' => [
                new Time(18, 13, 19, 999_999),
                new Time(12, 0, 0, 1),
                Duration::fromMicroseconds(10_000_000_000_002),
            ],
        ];
    }
}
