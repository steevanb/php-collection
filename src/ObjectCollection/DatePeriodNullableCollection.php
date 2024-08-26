<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectNullableCollection<\DatePeriod|null> */
class DatePeriodNullableCollection extends AbstractObjectNullableCollection
{
    public static function getValueFqcn(): string
    {
        return \DatePeriod::class;
    }
}
