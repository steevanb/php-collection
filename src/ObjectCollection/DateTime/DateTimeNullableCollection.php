<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection\DateTime;

use Steevanb\PhpCollection\ObjectCollection\AbstractObjectNullableCollection;

/** @extends AbstractObjectNullableCollection<?\DateTime> */
class DateTimeNullableCollection extends AbstractObjectNullableCollection
{
    public static function getValueFqcn(): string
    {
        return \DateTime::class;
    }

    public function containsDateTimeValue(\DateTime $dateTime): bool
    {
        foreach ($this->toArray() as $value) {
            if (
                $value === null
                || ($dateTime->getTimestamp() + $dateTime->getOffset())
                !== ($value->getTimestamp() + $value->getOffset())
            ) {
                continue;
            }

            return true;
        }

        return false;
    }
}
