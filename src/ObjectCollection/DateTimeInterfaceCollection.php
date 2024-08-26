<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectCollection<\DateTimeInterface> */
class DateTimeInterfaceCollection extends AbstractObjectCollection
{
    public static function getValueFqcn(): string
    {
        return \DateTimeInterface::class;
    }
}
