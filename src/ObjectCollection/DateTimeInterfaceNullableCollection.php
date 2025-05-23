<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

/** @extends AbstractObjectNullableCollection<\DateTimeInterface|null> */
class DateTimeInterfaceNullableCollection extends AbstractObjectNullableCollection
{
    /** @codeCoverageIgnore */
    public static function getValueFqcn(): string
    {
        return \DateTimeInterface::class;
    }
}
