<?php

declare(strict_types=1);

namespace BuronDigital\DateTimePrecision\Moment;

use BuronDigital\DateTimePrecision\Duration;
use BuronDigital\DateTimePrecision\Moment;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(Moment::class)]
final class SubtractTest extends TestCase
{
    #[Test]
    #[DataProvider('dataProvider')]
    public function subtract_works(
        Moment $expectedResult,
        Moment $moment,
        Duration $duration,
    ): void {
        // -- Act
        $result = $moment->subtract($duration);

        // -- Assert
        self::assertTrue($expectedResult->isEqualTo($result));
        self::assertSame('UTC', $result->dateTime->getTimezone()->getName());
    }

    /**
     * @return array<string, array{
     *   0: Moment,
     *   1: Moment,
     *   2: Duration,
     * }>
     */
    public static function dataProvider(): array
    {
        return [
            'subtract microseconds' => [
                Moment::fromString('2026-06-01 10:00:00.999999'),
                Moment::fromString('2026-06-01 10:00:01.000001'),
                Duration::fromMicroseconds(2),
            ],
            'across change to winter time is elapsed time' => [
                Moment::fromString('2026-10-25 00:30:00'),
                Moment::fromString('2026-10-25 02:30:00'),
                Duration::fromHours(2),
            ],
            'moment in other time zone than UTC is still elapsed time' => [
                Moment::fromString('2026-10-25 00:30:00'),
                Moment::fromDateTime(new \DateTimeImmutable('2026-10-25 03:30:00', new \DateTimeZone('Europe/Berlin'))),
                Duration::fromHours(2),
            ],
            'duration just below 13 digits of microseconds' => [
                Moment::fromString('2025-09-07 06:13:20.000001'),
                Moment::fromString('2026-01-01 00:00:00'),
                Duration::fromMicroseconds(9_999_999_999_999),
            ],
            'duration with 14 digits of microseconds' => [
                Moment::fromString('2025-09-07 06:13:20'),
                Moment::fromString('2026-01-01 00:00:00'),
                Duration::fromMicroseconds(10_000_000_000_000),
            ],
            'duration of 365 days' => [
                Moment::fromString('2025-01-01 00:00:00'),
                Moment::fromString('2026-01-01 00:00:00'),
                Duration::fromHours(8_760),
            ],
            'duration of 10002 hours' => [
                Moment::fromString('2024-11-10 06:00:00'),
                Moment::fromString('2026-01-01 00:00:00'),
                Duration::fromHours(10_002),
            ],
            'long duration with microseconds borrowing from seconds' => [
                Moment::fromString('2025-09-07 06:13:19.999999'),
                Moment::fromString('2026-01-01 00:00:00.000001'),
                Duration::fromMicroseconds(10_000_000_000_002),
            ],
            'long duration before 1970 with microseconds borrowing from seconds' => [
                Moment::fromString('1959-09-07 06:13:19.999999'),
                Moment::fromString('1960-01-01 00:00:00.000001'),
                Duration::fromMicroseconds(10_000_000_000_002),
            ],
        ];
    }
}
