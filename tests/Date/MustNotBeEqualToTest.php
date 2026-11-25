<?php

declare(strict_types=1);

namespace BuronDigital\DateTimePrecision\Date;

use BuronDigital\DateTimePrecision\Date;
use BuronDigital\DateTimePrecision\Exception\DateIsEqualTo;
use BuronDigital\DateTimePrecision\Test\Exception\CustomDateIsEqualTo;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(Date::class)]
#[CoversClass(DateIsEqualTo::class)]
final class MustNotBeEqualToTest extends TestCase
{
    /**
     * @param ?class-string<\Throwable> $expectedResult
     */
    #[Test]
    #[DataProvider('dataProvider')]
    public function must_not_be_equal_to_works(
        ?string $expectedResult,
        Date $date,
        Date $comparator,
        ?callable $otherwiseThrow,
    ): void {
        // -- Act & Assert
        if ($expectedResult !== null) {
            $this->expectException($expectedResult);
        } else {
            $this->expectNotToPerformAssertions();
        }

        $date->mustNotBeEqualTo(
            $comparator,
            $otherwiseThrow,
        );
    }

    /**
     * @return array<string, array{
     *   0: ?string,
     *   1: Date,
     *   2: Date,
     *   3: ?callable(): \Throwable
     * }>
     */
    public static function dataProvider(): array
    {
        return [
            'without exception' => [
                null,
                Date::fromString('2022-10-08'),
                Date::fromString('2022-10-09'),
                null,
            ],
            'default exception' => [
                DateIsEqualTo::class,
                Date::fromString('2022-10-08'),
                Date::fromString('2022-10-08'),
                null,
            ],
            'custom exception' => [
                CustomDateIsEqualTo::class,
                Date::fromString('2022-10-08'),
                Date::fromString('2022-10-08'),
                static fn () => new CustomDateIsEqualTo(),
            ],
        ];
    }
}
