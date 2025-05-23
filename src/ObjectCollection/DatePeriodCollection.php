<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\DatePeriod<\DateTimeInterface, \DateTimeInterface, int|null>> */
class DatePeriodCollection extends AbstractObjectCollection
{
    /** @codeCoverageIgnore */
    public static function getValueFqcn(): string
    {
        return \DatePeriod::class;
    }
}
