<?php

declare(strict_types=1);

namespace BuronDigital\DateTimePrecision;

use BuronDigital\SelfAwareNormalizers\Doctrine\StringNormalizableTypeWithMaxLength;
use BuronDigital\SelfAwareNormalizers\Serializer\NullableStringDenormalizable;
use BuronDigital\SelfAwareNormalizers\Serializer\NullableStringDenormalizableTrait;
use BuronDigital\SelfAwareNormalizers\Serializer\StringNormalizable;
use BuronDigital\SelfAwareNormalizers\Serializer\StringNormalizableEnumTrait;

enum CalendarUnit: string implements StringNormalizable, StringNormalizableTypeWithMaxLength, NullableStringDenormalizable
{
    use StringNormalizableEnumTrait;
    use NullableStringDenormalizableTrait;

    case DAY = 'DAY';
    case WEEK = 'WEEK';
    case MONTH = 'MONTH';
    case QUARTER = 'QUARTER';
    case YEAR = 'YEAR';

    /**
     * @codeCoverageIgnore
     */
    #[\Override]
    public static function maxLength(): int
    {
        return 7;
    }
}
