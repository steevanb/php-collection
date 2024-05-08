<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

use Steevanb\PhpCollection\ObjectCollection\DateTime\ContainsDateTimeNullableValueTrait;

/** @extends AbstractObjectNullableCollection<\DateTimeInterface|null> */
class DateTimeInterfaceNullableCollection extends AbstractObjectNullableCollection
{
    use ContainsDateTimeNullableValueTrait;

    /** @codeCoverageIgnore */
    public static function getValueFqcn(): string
    {
        return \DateTimeInterface::class;
    }
}
