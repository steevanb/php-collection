<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ScalarCollection;

use Steevanb\PhpCollection\{
    AbstractCollection,
    Exception\InvalidTypeException
};

/** @extends AbstractCollection<string> */
class StringCollection extends AbstractCollection
{
    protected function canAddValue(mixed $value): bool
    {
        if (is_string($value) === false) {
            throw new InvalidTypeException('$value should be of type string.');
        }

        return parent::canAddValue($value);
    }
}
