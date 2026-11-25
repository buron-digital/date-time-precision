<?php

declare(strict_types=1);

namespace BuronDigital\DateTimePrecision\Date;

use BuronDigital\DateTimePrecision\Date;
use BuronDigital\DateTimePrecision\Exception\DateIsBefore;
use BuronDigital\DateTimePrecision\Test\Exception\CustomDateIsBefore;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(Date::class)]
#[CoversClass(DateIsBefore::class)]
final class MustNotBeBeforeTest extends TestCase
{
    /**
     * @param ?class-string<\Throwable> $expectedResult
     */
    #[Test]
    #[DataProvider('dataProvider')]
    public function must_not_be_before_works(
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

        $date->mustNotBeBefore(
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
                Date::fromString('2022-10-09'),
                Date::fromString('2022-10-08'),
                null,
            ],
            'default exception' => [
                DateIsBefore::class,
                Date::fromString('2022-10-08'),
                Date::fromString('2022-10-09'),
                null,
            ],
            'custom exception' => [
                CustomDateIsBefore::class,
                Date::fromString('2022-10-08'),
                Date::fromString('2022-10-09'),
                static fn () => new CustomDateIsBefore(),
            ],
        ];
    }
}
