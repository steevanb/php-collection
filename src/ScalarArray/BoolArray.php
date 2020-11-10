<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\ScalarArray;

use steevanb\PhpTypedArray\Exception\InvalidTypeException;

class BoolArray extends AbstractScalarArray
{
    public function current(): ?string
    {
        return parent::current();
    }

    /** @param mixed $offset */
    public function offsetGet($offset): ?bool
    {
        return parent::offsetGet($offset);
    }

    public function merge(BoolArray $typedArray): self
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
        if (is_null($value) === false && is_bool($value) === false) {
            throw new InvalidTypeException('$value should be of type bool or null.');
        }

        return parent::canAddValue($offset, $value);
    }

    /** @param mixed $value */
    protected function cast($value): ?bool
    {
        return is_null($value) ? null : (bool) $value;
    }
}
