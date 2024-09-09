<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection\DateTime;

trait ContainsDateTimeValueTrait
{
    public function containsDateTimeValue(\DateTimeInterface $dateTime): bool
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

    /** @return array<\DateTimeInterface> */
    abstract protected function toArray(): array;
}
