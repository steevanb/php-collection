<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ScalarCollection;

use Steevanb\PhpCollection\{
    AbstractCollection,
    Exception\InvalidTypeException
};

/** @extends AbstractCollection<int> */
class IntegerCollection extends AbstractCollection
{
    protected function canAddValue(mixed $value): bool
    {
        if (is_int($value) === false) {
            throw new InvalidTypeException('$value should be of type int.');
        }

        return parent::canAddValue($value);
    }
}
