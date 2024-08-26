<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\DateInterval> */
class DateIntervalCollection extends AbstractObjectCollection
{
    public static function getValueFqcn(): string
    {
        return \DateInterval::class;
    }
}
