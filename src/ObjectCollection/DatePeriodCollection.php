<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\DatePeriod> */
class DatePeriodCollection extends AbstractObjectCollection
{
    public static function getValueFqcn(): string
    {
        return \DatePeriod::class;
    }
}
