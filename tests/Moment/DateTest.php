<?php

declare(strict_types=1);

namespace BuronDigital\DateTimePrecision\Moment;

use BuronDigital\DateTimePrecision\Date;
use BuronDigital\DateTimePrecision\Moment;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(Moment::class)]
final class DateTest extends TestCase
{
    #[Test]
    #[DataProvider('dataProviderForDate')]
    public function date_works(
        Date $expectedResult,
        Moment $dateTime,
    ): void {
        // -- Act & Assert
        self::assertEquals($expectedResult, $dateTime->date());
    }

    /**
     * @return array<string, array{
     *   0: Date,
     *   1: Moment,
     * }>
     */
    public static function dataProviderForDate(): array
    {
        return [
            'same date in UTC' => [
                Date::fromString('2022-10-08'),
                Moment::fromString('2022-10-08 00:00:00'),
            ],
            'date in UTC for date time in other time zone' => [
                Date::fromString('2022-10-07'),
                Moment::fromDateTime(new \DateTimeImmutable('2022-10-08 01:00:00', new \DateTimeZone('Europe/Berlin'))),
            ],
        ];
    }
}
