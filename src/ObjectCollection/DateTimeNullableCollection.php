<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

use Steevanb\PhpCollection\ObjectCollection\DateTime\ContainsDateTimeNullableValueTrait;

/** @extends AbstractObjectNullableCollection<\DateTime|null> */
class DateTimeNullableCollection extends AbstractObjectNullableCollection
{
    use ContainsDateTimeNullableValueTrait;

    /** @codeCoverageIgnore */
    public static function getValueFqcn(): string
    {
        return \DateTime::class;
    }
}
