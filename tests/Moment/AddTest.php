<?php

declare(strict_types=1);

namespace DigitalCraftsman\DateTimePrecision\Moment;

use DigitalCraftsman\DateTimePrecision\Duration;
use DigitalCraftsman\DateTimePrecision\Moment;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(Moment::class)]
final class AddTest extends TestCase
{
    #[Test]
    #[DataProvider('dataProvider')]
    public function add_works(
        Moment $expectedResult,
        Moment $moment,
        Duration $duration,
    ): void {
        // -- Act
        $result = $moment->add($duration);

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
            'add zero' => [
                Moment::fromString('2026-06-01 10:00:00'),
                Moment::fromString('2026-06-01 10:00:00'),
                Duration::zero(),
            ],
            'add microseconds' => [
                Moment::fromString('2026-06-01 10:00:01.000001'),
                Moment::fromString('2026-06-01 10:00:00.999999'),
                Duration::fromMicroseconds(2),
            ],
            'add hours across days' => [
                Moment::fromString('2026-06-02 01:00:00'),
                Moment::fromString('2026-06-01 22:00:00'),
                Duration::fromHours(3),
            ],
            'across change to winter time is elapsed time' => [
                Moment::fromString('2026-10-25 02:30:00'),
                Moment::fromString('2026-10-25 00:30:00'),
                Duration::fromHours(2),
            ],
            'across change to summer time is elapsed time' => [
                Moment::fromString('2026-03-29 02:30:00'),
                Moment::fromString('2026-03-29 00:30:00'),
                Duration::fromHours(2),
            ],
            'moment in other time zone than UTC is still elapsed time' => [
                Moment::fromString('2026-10-25 01:30:00'),
                Moment::fromDateTime(new \DateTimeImmutable('2026-10-25 01:30:00', new \DateTimeZone('Europe/Berlin'))),
                Duration::fromHours(2),
            ],
            'duration just below 13 digits of microseconds' => [
                Moment::fromString('2026-04-26 17:46:39.999999'),
                Moment::fromString('2026-01-01 00:00:00'),
                Duration::fromMicroseconds(9_999_999_999_999),
            ],
            'duration with 14 digits of microseconds' => [
                Moment::fromString('2026-04-26 17:46:40'),
                Moment::fromString('2026-01-01 00:00:00'),
                Duration::fromMicroseconds(10_000_000_000_000),
            ],
            'duration of 365 days' => [
                Moment::fromString('2027-01-01 00:00:00'),
                Moment::fromString('2026-01-01 00:00:00'),
                Duration::fromHours(8_760),
            ],
            'duration of 10002 hours' => [
                Moment::fromString('2027-02-21 18:00:00'),
                Moment::fromString('2026-01-01 00:00:00'),
                Duration::fromHours(10_002),
            ],
            'long duration with microseconds carrying into seconds' => [
                Moment::fromString('2026-04-26 17:46:41.000001'),
                Moment::fromString('2026-01-01 00:00:00.999999'),
                Duration::fromMicroseconds(10_000_000_000_002),
            ],
            'long duration before 1970 with microseconds carrying into seconds' => [
                Moment::fromString('1960-04-25 17:46:41.000001'),
                Moment::fromString('1960-01-01 00:00:00.999999'),
                Duration::fromMicroseconds(10_000_000_000_002),
            ],
        ];
    }
}
