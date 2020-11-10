<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\ScalarArray;

use steevanb\PhpTypedArray\Exception\InvalidTypeException;

class FloatArray extends AbstractScalarArray
{
    public function current(): ?string
    {
        return parent::current();
    }

    /** @param mixed $offset */
    public function offsetGet($offset): ?float
    {
        return parent::offsetGet($offset);
    }

    public function merge(FloatArray $typedArray): self
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
        if (is_null($value) === false && is_float($value) === false) {
            throw new InvalidTypeException('$value should be of type float or null.');
        }

        return parent::canAddValue($offset, $value);
    }

    /** @param mixed $value */
    protected function cast($value): ?float
    {
        return is_null($value) ? null : (float) $value;
    }
}
