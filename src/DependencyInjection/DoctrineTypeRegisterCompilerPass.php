<?php

declare(strict_types=1);

namespace BuronDigital\DateTimePrecision\DependencyInjection;

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
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final readonly class DoctrineTypeRegisterCompilerPass implements CompilerPassInterface
{
    public const string TYPE_DEFINITION_PARAMETER = 'doctrine.dbal.connection_factory.types';

    #[\Override]
    public function process(ContainerBuilder $container): void
    {
        /**
         * @var array<string, array{
         *     class: class-string,
         * }> $typeDefinitions
         */
        $typeDefinitions = $container->getParameter(self::TYPE_DEFINITION_PARAMETER);

        $typeDefinitions[Moment::class] = ['class' => StringNormalizableThroughLookupType::class];
        $typeDefinitions[Time::class] = ['class' => StringNormalizableThroughLookupType::class];
        $typeDefinitions[Weekday::class] = ['class' => StringNormalizableThroughLookupType::class];
        $typeDefinitions[Weekdays::class] = ['class' => ArrayNormalizableThroughLookupType::class];
        $typeDefinitions[Date::class] = ['class' => StringNormalizableThroughLookupType::class];
        $typeDefinitions[Month::class] = ['class' => StringNormalizableThroughLookupType::class];
        $typeDefinitions[Year::class] = ['class' => IntNormalizableThroughLookupType::class];
        $typeDefinitions[Day::class] = ['class' => IntNormalizableThroughLookupType::class];
        $typeDefinitions[Days::class] = ['class' => ArrayNormalizableThroughLookupType::class];
        $typeDefinitions[Duration::class] = ['class' => IntNormalizableThroughLookupType::class];
        $typeDefinitions[CalendarUnit::class] = ['class' => StringNormalizableThroughLookupType::class];
        $typeDefinitions[CalendarPeriod::class] = ['class' => ArrayNormalizableThroughLookupType::class];
        $typeDefinitions[DateRange::class] = ['class' => ArrayNormalizableThroughLookupType::class];
        $typeDefinitions[MomentRange::class] = ['class' => ArrayNormalizableThroughLookupType::class];
        $typeDefinitions[TimeRange::class] = ['class' => ArrayNormalizableThroughLookupType::class];
        $typeDefinitions[Moments::class] = ['class' => ArrayNormalizableThroughLookupType::class];
        $typeDefinitions[Dates::class] = ['class' => ArrayNormalizableThroughLookupType::class];
        $typeDefinitions[Times::class] = ['class' => ArrayNormalizableThroughLookupType::class];
        $typeDefinitions[Months::class] = ['class' => ArrayNormalizableThroughLookupType::class];
        $typeDefinitions[Years::class] = ['class' => ArrayNormalizableThroughLookupType::class];
        $typeDefinitions[Durations::class] = ['class' => ArrayNormalizableThroughLookupType::class];
        $typeDefinitions[CalendarUnits::class] = ['class' => ArrayNormalizableThroughLookupType::class];
        $typeDefinitions[CalendarPeriods::class] = ['class' => ArrayNormalizableThroughLookupType::class];
        $typeDefinitions[DateRanges::class] = ['class' => ArrayNormalizableThroughLookupType::class];
        $typeDefinitions[MomentRanges::class] = ['class' => ArrayNormalizableThroughLookupType::class];
        $typeDefinitions[TimeRanges::class] = ['class' => ArrayNormalizableThroughLookupType::class];
        $typeDefinitions[Week::class] = ['class' => StringNormalizableThroughLookupType::class];
        $typeDefinitions[Weeks::class] = ['class' => ArrayNormalizableThroughLookupType::class];
        $typeDefinitions[RecurrenceFrequency::class] = ['class' => StringNormalizableThroughLookupType::class];
        $typeDefinitions[Recurrence::class] = ['class' => ArrayNormalizableThroughLookupType::class];
        $typeDefinitions[Recurrences::class] = ['class' => ArrayNormalizableThroughLookupType::class];

        $container->setParameter(self::TYPE_DEFINITION_PARAMETER, $typeDefinitions);
    }
}
