<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\ScalarArray;

use Steevanb\PhpTypedArray\Exception\InvalidTypeException;

class StringArray extends AbstractScalarArray
{
    public function current(): ?string
    {
        return parent::current();
    }

    /** @param mixed $offset */
    public function offsetGet($offset): ?string
    {
        return parent::offsetGet($offset);
    }

    public function merge(StringArray $typedArray): static
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
        if (is_null($value) === false && is_string($value) === false) {
            throw new InvalidTypeException('$value should be of type string or null.');
        }

        return parent::canAddValue($offset, $value);
    }

    /** @param mixed $value */
    protected function cast($value): ?string
    {
        return is_null($value) ? null : (string) $value;
    }
}
