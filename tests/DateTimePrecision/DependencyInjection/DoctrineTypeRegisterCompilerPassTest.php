<?php

declare(strict_types=1);

namespace BuronDigital\DateTimePrecision\DateTimePrecision\DependencyInjection;

use BuronDigital\DateTimePrecision\CalendarPeriod;
use BuronDigital\DateTimePrecision\CalendarPeriods;
use BuronDigital\DateTimePrecision\CalendarUnit;
use BuronDigital\DateTimePrecision\CalendarUnits;
use BuronDigital\DateTimePrecision\Date;
use BuronDigital\DateTimePrecision\DateRange;
use BuronDigital\DateTimePrecision\DateRanges;
use BuronDigital\DateTimePrecision\Dates;
use BuronDigital\DateTimePrecision\Day;
use BuronDigital\DateTimePrecision\Days;
use BuronDigital\DateTimePrecision\DependencyInjection\DoctrineTypeRegisterCompilerPass;
use BuronDigital\DateTimePrecision\Duration;
use BuronDigital\DateTimePrecision\Durations;
use BuronDigital\DateTimePrecision\Moment;
use BuronDigital\DateTimePrecision\MomentRange;
use BuronDigital\DateTimePrecision\MomentRanges;
use BuronDigital\DateTimePrecision\Moments;
use BuronDigital\DateTimePrecision\Month;
use BuronDigital\DateTimePrecision\Months;
use BuronDigital\DateTimePrecision\Recurrence;
use BuronDigital\DateTimePrecision\RecurrenceFrequency;
use BuronDigital\DateTimePrecision\Recurrences;
use BuronDigital\DateTimePrecision\Time;
use BuronDigital\DateTimePrecision\TimeRange;
use BuronDigital\DateTimePrecision\TimeRanges;
use BuronDigital\DateTimePrecision\Times;
use BuronDigital\DateTimePrecision\Week;
use BuronDigital\DateTimePrecision\Weekday;
use BuronDigital\DateTimePrecision\Weekdays;
use BuronDigital\DateTimePrecision\Weeks;
use BuronDigital\DateTimePrecision\Year;
use BuronDigital\DateTimePrecision\Years;
use BuronDigital\SelfAwareNormalizers\Doctrine\ArrayNormalizableThroughLookupType;
use BuronDigital\SelfAwareNormalizers\Doctrine\IntNormalizableThroughLookupType;
use BuronDigital\SelfAwareNormalizers\Doctrine\StringNormalizableThroughLookupType;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

#[CoversClass(DoctrineTypeRegisterCompilerPass::class)]
final class DoctrineTypeRegisterCompilerPassTest extends TestCase
{
    #[Test]
    public function process_works(): void
    {
        // -- Arrange
        $compilerPass = new DoctrineTypeRegisterCompilerPass();
        $container = new ContainerBuilder(new ParameterBag([
            DoctrineTypeRegisterCompilerPass::TYPE_DEFINITION_PARAMETER => [],
        ]));

        // -- Act
        $compilerPass->process($container);

        // -- Assert
        /** @var array $updatedParameters */
        $updatedParameters = $container->getParameter(DoctrineTypeRegisterCompilerPass::TYPE_DEFINITION_PARAMETER);
        self::assertArrayHasKey(Moment::class, $updatedParameters);
        self::assertSame(['class' => StringNormalizableThroughLookupType::class], $updatedParameters[Moment::class]);

        self::assertArrayHasKey(Time::class, $updatedParameters);
        self::assertSame(['class' => StringNormalizableThroughLookupType::class], $updatedParameters[Time::class]);

        self::assertArrayHasKey(Weekday::class, $updatedParameters);
        self::assertSame(['class' => StringNormalizableThroughLookupType::class], $updatedParameters[Weekday::class]);

        self::assertArrayHasKey(Weekdays::class, $updatedParameters);
        self::assertSame(['class' => ArrayNormalizableThroughLookupType::class], $updatedParameters[Weekdays::class]);

        self::assertArrayHasKey(Date::class, $updatedParameters);
        self::assertSame(['class' => StringNormalizableThroughLookupType::class], $updatedParameters[Date::class]);

        self::assertArrayHasKey(Month::class, $updatedParameters);
        self::assertSame(['class' => StringNormalizableThroughLookupType::class], $updatedParameters[Month::class]);

        self::assertArrayHasKey(Year::class, $updatedParameters);
        self::assertSame(['class' => IntNormalizableThroughLookupType::class], $updatedParameters[Year::class]);

        self::assertArrayHasKey(Day::class, $updatedParameters);
        self::assertSame(['class' => IntNormalizableThroughLookupType::class], $updatedParameters[Day::class]);

        self::assertArrayHasKey(Days::class, $updatedParameters);
        self::assertSame(['class' => ArrayNormalizableThroughLookupType::class], $updatedParameters[Days::class]);

        self::assertArrayHasKey(Duration::class, $updatedParameters);
        self::assertSame(['class' => IntNormalizableThroughLookupType::class], $updatedParameters[Duration::class]);

        self::assertArrayHasKey(CalendarUnit::class, $updatedParameters);
        self::assertSame(['class' => StringNormalizableThroughLookupType::class], $updatedParameters[CalendarUnit::class]);

        self::assertArrayHasKey(CalendarPeriod::class, $updatedParameters);
        self::assertSame(['class' => ArrayNormalizableThroughLookupType::class], $updatedParameters[CalendarPeriod::class]);

        self::assertArrayHasKey(DateRange::class, $updatedParameters);
        self::assertSame(['class' => ArrayNormalizableThroughLookupType::class], $updatedParameters[DateRange::class]);

        self::assertArrayHasKey(MomentRange::class, $updatedParameters);
        self::assertSame(['class' => ArrayNormalizableThroughLookupType::class], $updatedParameters[MomentRange::class]);

        self::assertArrayHasKey(TimeRange::class, $updatedParameters);
        self::assertSame(['class' => ArrayNormalizableThroughLookupType::class], $updatedParameters[TimeRange::class]);

        self::assertArrayHasKey(Moments::class, $updatedParameters);
        self::assertSame(['class' => ArrayNormalizableThroughLookupType::class], $updatedParameters[Moments::class]);

        self::assertArrayHasKey(Dates::class, $updatedParameters);
        self::assertSame(['class' => ArrayNormalizableThroughLookupType::class], $updatedParameters[Dates::class]);

        self::assertArrayHasKey(Times::class, $updatedParameters);
        self::assertSame(['class' => ArrayNormalizableThroughLookupType::class], $updatedParameters[Times::class]);

        self::assertArrayHasKey(Months::class, $updatedParameters);
        self::assertSame(['class' => ArrayNormalizableThroughLookupType::class], $updatedParameters[Months::class]);

        self::assertArrayHasKey(Years::class, $updatedParameters);
        self::assertSame(['class' => ArrayNormalizableThroughLookupType::class], $updatedParameters[Years::class]);

        self::assertArrayHasKey(Durations::class, $updatedParameters);
        self::assertSame(['class' => ArrayNormalizableThroughLookupType::class], $updatedParameters[Durations::class]);

        self::assertArrayHasKey(CalendarUnits::class, $updatedParameters);
        self::assertSame(['class' => ArrayNormalizableThroughLookupType::class], $updatedParameters[CalendarUnits::class]);

        self::assertArrayHasKey(CalendarPeriods::class, $updatedParameters);
        self::assertSame(['class' => ArrayNormalizableThroughLookupType::class], $updatedParameters[CalendarPeriods::class]);

        self::assertArrayHasKey(DateRanges::class, $updatedParameters);
        self::assertSame(['class' => ArrayNormalizableThroughLookupType::class], $updatedParameters[DateRanges::class]);

        self::assertArrayHasKey(MomentRanges::class, $updatedParameters);
        self::assertSame(['class' => ArrayNormalizableThroughLookupType::class], $updatedParameters[MomentRanges::class]);

        self::assertArrayHasKey(TimeRanges::class, $updatedParameters);
        self::assertSame(['class' => ArrayNormalizableThroughLookupType::class], $updatedParameters[TimeRanges::class]);

        self::assertArrayHasKey(Week::class, $updatedParameters);
        self::assertSame(['class' => StringNormalizableThroughLookupType::class], $updatedParameters[Week::class]);

        self::assertArrayHasKey(Weeks::class, $updatedParameters);
        self::assertSame(['class' => ArrayNormalizableThroughLookupType::class], $updatedParameters[Weeks::class]);

        self::assertArrayHasKey(RecurrenceFrequency::class, $updatedParameters);
        self::assertSame(['class' => StringNormalizableThroughLookupType::class], $updatedParameters[RecurrenceFrequency::class]);

        self::assertArrayHasKey(Recurrence::class, $updatedParameters);
        self::assertSame(['class' => ArrayNormalizableThroughLookupType::class], $updatedParameters[Recurrence::class]);

        self::assertArrayHasKey(Recurrences::class, $updatedParameters);
        self::assertSame(['class' => ArrayNormalizableThroughLookupType::class], $updatedParameters[Recurrences::class]);
    }
}
