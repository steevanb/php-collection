<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\DateTime> */
class DateTimeCollection extends AbstractObjectCollection
{
    public static function getValueFqcn(): string
    {
        return \DateTime::class;
    }
}
