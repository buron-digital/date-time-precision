<?php

declare(strict_types=1);

namespace BuronDigital\DateTimePrecision\Time;

use BuronDigital\DateTimePrecision\Exception\TimeIsAfterOrEqualTo;
use BuronDigital\DateTimePrecision\Test\Exception\CustomTimeIsAfterOrEqualTo;
use BuronDigital\DateTimePrecision\Time;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(Time::class)]
#[CoversClass(TimeIsAfterOrEqualTo::class)]
final class MustNotBeAfterOrEqualToTest extends TestCase
{
    /**
     * @param ?class-string<\Throwable> $expectedResult
     */
    #[Test]
    #[DataProvider('dataProvider')]
    public function must_not_be_after_or_equal_to_works(
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

        $date->mustNotBeAfterOrEqualTo(
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
                Time::fromString('14:00:00'),
                Time::fromString('15:00:00'),
                null,
            ],
            'default exception' => [
                TimeIsAfterOrEqualTo::class,
                Time::fromString('16:00:00'),
                Time::fromString('15:00:00'),
                null,
            ],
            'custom exception' => [
                CustomTimeIsAfterOrEqualTo::class,
                Time::fromString('16:00:00'),
                Time::fromString('15:00:00'),
                static fn () => new CustomTimeIsAfterOrEqualTo(),
            ],
        ];
    }
}
