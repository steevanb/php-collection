<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

use Steevanb\PhpCollection\ObjectCollection\DateTime\ContainsDateTimeValueTrait;

/** @extends AbstractObjectCollection<\DateTimeInterface> */
class DateTimeInterfaceCollection extends AbstractObjectCollection
{
    use ContainsDateTimeValueTrait;

    public static function getValueFqcn(): string
    {
        return \DateTimeInterface::class;
    }
}
