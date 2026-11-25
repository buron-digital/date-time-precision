<?php

declare(strict_types=1);

namespace BuronDigital\DateTimePrecision\Moment;

use BuronDigital\DateTimePrecision\Date;
use BuronDigital\DateTimePrecision\Exception\MomentIsNotEqualTo;
use BuronDigital\DateTimePrecision\Moment;
use BuronDigital\DateTimePrecision\Month;
use BuronDigital\DateTimePrecision\Test\Exception\CustomMomentIsNotEqualTo;
use BuronDigital\DateTimePrecision\Time;
use BuronDigital\DateTimePrecision\Weekday;
use BuronDigital\DateTimePrecision\Year;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(Moment::class)]
#[CoversClass(MomentIsNotEqualTo::class)]
final class MustBeEqualToInTimeZoneTest extends TestCase
{
    /**
     * @param ?class-string<\Throwable> $expectedResult
     */
    #[Test]
    #[DataProvider('dataProvider')]
    public function must_be_equal_to_in_time_zone_works(
        ?string $expectedResult,
        Moment $moment,
        Time | Weekday | Date | Month | Year $comparator,
        \DateTimeZone $timeZone,
        ?callable $otherwiseThrow,
    ): void {
        // -- Act & Assert
        if ($expectedResult !== null) {
            $this->expectException($expectedResult);
        } else {
            $this->expectNotToPerformAssertions();
        }

        $moment->mustBeEqualToInTimeZone(
            $comparator,
            $timeZone,
            $otherwiseThrow,
        );
    }

    /**
     * @return array<string, array{
     *   0: ?string,
     *   1: Moment,
     *   2: Time | Weekday | Date | Month | Year,
     *   3: \DateTimeZone,
     *   4: ?callable(): \Throwable
     * }>
     */
    public static function dataProvider(): array
    {
        return [
            'without exception' => [
                null,
                Moment::fromStringInTimeZone('2022-10-08 15:00:00', new \DateTimeZone('Europe/Berlin')),
                Time::fromString('15:00:00'),
                new \DateTimeZone('Europe/Berlin'),
                null,
            ],
            'default exception' => [
                MomentIsNotEqualTo::class,
                Moment::fromStringInTimeZone('2022-10-08 15:00:00', new \DateTimeZone('Europe/Berlin')),
                Time::fromString('16:00:00'),
                new \DateTimeZone('Europe/Berlin'),
                null,
            ],
            'custom exception' => [
                CustomMomentIsNotEqualTo::class,
                Moment::fromStringInTimeZone('2022-10-08 15:00:00', new \DateTimeZone('Europe/Berlin')),
                Time::fromString('16:00:00'),
                new \DateTimeZone('Europe/Berlin'),
                static fn () => new CustomMomentIsNotEqualTo(),
            ],
        ];
    }
}
