<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\ScalarArray;

use Steevanb\PhpTypedArray\Exception\InvalidTypeException;

class IntArray extends AbstractScalarArray
{
    public function current(): ?int
    {
        return parent::current();
    }

    public function offsetGet(mixed $offset): ?int
    {
        return parent::offsetGet($offset);
    }

    public function merge(IntArray $typedArray): static
    {
        parent::doMerge($typedArray);

        return $this;
    }

    protected function canAddValue(mixed $offset, mixed $value): bool
    {
        if (is_null($value) === false && is_int($value) === false) {
            throw new InvalidTypeException('$value should be of type int or null.');
        }

        return parent::canAddValue($offset, $value);
    }

    protected function cast(mixed $value): ?int
    {
        if (
            is_numeric($value) === false
            && is_bool($value) === false
            && is_null($value) === false
        ) {
            throw new InvalidTypeException('"' . $value . '" is not numeric.');
        }

        return is_null($value) ? null : (int) $value;
    }
}
