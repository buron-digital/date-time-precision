<?php

declare(strict_types=1);

namespace BuronDigital\DateTimePrecision;

use BuronDigital\SelfAwareNormalizers\Doctrine\StringNormalizableTypeWithMaxLength;
use BuronDigital\SelfAwareNormalizers\Serializer\NullableStringDenormalizable;
use BuronDigital\SelfAwareNormalizers\Serializer\NullableStringDenormalizableTrait;
use BuronDigital\SelfAwareNormalizers\Serializer\StringNormalizable;
use BuronDigital\SelfAwareNormalizers\Serializer\StringNormalizableEnumTrait;

enum RecurrenceFrequency: string implements StringNormalizable, StringNormalizableTypeWithMaxLength, NullableStringDenormalizable
{
    use StringNormalizableEnumTrait;
    use NullableStringDenormalizableTrait;

    case DAILY = 'DAILY';
    case WEEKLY = 'WEEKLY';
    case MONTHLY = 'MONTHLY';

    /**
     * @codeCoverageIgnore
     */
    #[\Override]
    public static function maxLength(): int
    {
        return 7;
    }
}
