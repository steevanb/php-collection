<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection\DateTime;

use Steevanb\PhpCollection\ObjectCollection\AbstractObjectCollection;

/** @extends AbstractObjectCollection<\DateTime> */
class DateTimeCollection extends AbstractObjectCollection
{
    public static function getValueFqcn(): string
    {
        return \DateTime::class;
    }

    public function containsDateTimeValue(\DateTime $dateTime): bool
    {
        foreach ($this->toArray() as $value) {
            if (
                ($dateTime->getTimestamp() + $dateTime->getOffset())
                !== ($value->getTimestamp() + $value->getOffset())
            ) {
                continue;
            }

            return true;
        }

        return false;
    }
}
