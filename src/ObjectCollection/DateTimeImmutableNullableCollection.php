<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

use Steevanb\PhpCollection\ObjectCollection\DateTime\ContainsDateTimeNullableValueTrait;

/** @extends AbstractObjectNullableCollection<\DateTimeImmutable|null> */
class DateTimeImmutableNullableCollection extends AbstractObjectNullableCollection
{
    use ContainsDateTimeNullableValueTrait;

    /** @codeCoverageIgnore */
    public static function getValueFqcn(): string
    {
        return \DateTimeImmutable::class;
    }
}
