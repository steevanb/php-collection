<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ScalarCollection;

use Steevanb\PhpCollection\{
    AbstractCollection,
    Exception\InvalidTypeException
};

/** @extends AbstractCollection<int|null> */
class IntegerNullableCollection extends AbstractCollection
{
    protected function assertValueType(mixed $value): static
    {
        if (is_null($value) === false && is_int($value) === false) {
            throw new InvalidTypeException('$value should be of type int or null.');
        }

        return $this;
    }
}
