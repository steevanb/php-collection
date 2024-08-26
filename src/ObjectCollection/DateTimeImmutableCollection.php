<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\DateTimeImmutable> */
class DateTimeImmutableCollection extends AbstractObjectCollection
{
    public static function getValueFqcn(): string
    {
        return \DateTimeImmutable::class;
    }
}
