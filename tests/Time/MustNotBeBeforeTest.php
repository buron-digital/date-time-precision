<?php

declare(strict_types=1);

namespace BuronDigital\DateTimePrecision\Time;

use BuronDigital\DateTimePrecision\Exception\TimeIsBefore;
use BuronDigital\DateTimePrecision\Test\Exception\CustomTimeIsBefore;
use BuronDigital\DateTimePrecision\Time;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(Time::class)]
#[CoversClass(TimeIsBefore::class)]
final class MustNotBeBeforeTest extends TestCase
{
    /**
     * @param ?class-string<\Throwable> $expectedResult
     */
    #[Test]
    #[DataProvider('dataProvider')]
    public function must_not_be_before_works(
        ?string $expectedResult,
        Time $date,
        Time $comparator,
        ?callable $otherwiseThrow,
    ): void {
        // -- Act & Assert
        if ($expectedResult !== null) {
            $this->expectException($expectedResult);
        } else {
            $this->expectNotToPerformAssertions();
        }

        $date->mustNotBeBefore(
            $comparator,
            $otherwiseThrow,
        );
    }

    /**
     * @return array<string, array{
     *   0: ?string,
     *   1: Time,
     *   2: Time,
     *   3: ?callable(): \Throwable
     * }>
     */
    public static function dataProvider(): array
    {
        return [
            'without exception' => [
                null,
                Time::fromString('15:00:00'),
                Time::fromString('14:00:00'),
                null,
            ],
            'default exception' => [
                TimeIsBefore::class,
                Time::fromString('15:00:00'),
                Time::fromString('16:00:00'),
                null,
            ],
            'custom exception' => [
                CustomTimeIsBefore::class,
                Time::fromString('15:00:00'),
                Time::fromString('16:00:00'),
                static fn () => new CustomTimeIsBefore(),
            ],
        ];
    }
}
