<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

use Steevanb\PhpCollection\ObjectCollection\DateTime\ContainsDateTimeValueTrait;

/** @extends AbstractObjectCollection<\DateTime> */
class DateTimeCollection extends AbstractObjectCollection
{
    use ContainsDateTimeValueTrait;

    /** @codeCoverageIgnore */
    public static function getValueFqcn(): string
    {
        return \DateTime::class;
    }
}
