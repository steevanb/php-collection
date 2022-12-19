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

    /** @param mixed $offset */
    public function offsetGet($offset): ?int
    {
        return parent::offsetGet($offset);
    }

    public function merge(IntArray $typedArray): static
    {
        parent::doMerge($typedArray);

        return $this;
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    protected function canAddValue($offset, $value): bool
    {
        if (is_null($value) === false && is_int($value) === false) {
            throw new InvalidTypeException('$value should be of type int or null.');
        }

        return parent::canAddValue($offset, $value);
    }

    /** @param mixed $value */
    protected function cast($value): ?int
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
