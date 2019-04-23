<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\ScalarArray;

class StringArray extends AbstractScalarArray
{
    public function current(): ?string
    {
        return parent::current();
    }

    /** @param mixed $offset */
    public function offsetGet($offset): string
    {
        return parent::offsetGet($offset);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    protected function canAddValue($offset, $value): bool
    {
        if (is_string($value) === false && $value !== null) {
            throw new \Exception('$value should be of type string or null.');
        }

        return parent::canAddValue($offset, $value);
    }

    /** @param mixed $value */
    protected function cast($value): ?string
    {
        return ($value === null) ? null : (string) $value;
    }
}
