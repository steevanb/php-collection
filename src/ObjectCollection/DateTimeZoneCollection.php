<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\DateTimeZone> */
class DateTimeZoneCollection extends AbstractObjectCollection
{
    public static function getValueFqcn(): string
    {
        return \DateTimeZone::class;
    }
}
