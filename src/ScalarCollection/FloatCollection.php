<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ScalarCollection;

use Steevanb\PhpCollection\{
    AbstractCollection,
    Exception\InvalidTypeException
};

/** @extends AbstractCollection<float> */
class FloatCollection extends AbstractCollection
{
    protected function assertValueType(mixed $value): static
    {
        if (is_float($value) === false) {
            throw new InvalidTypeException('$value should be of type float.');
        }

        return $this;
    }
}
