<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray;

class StringNullableArray extends AbstractTypedArray
{
    public function current(): ?string
    {
        return parent::current();
    }

    public function offsetGet($offset): ?string
    {
        return parent::offsetGet($offset);
    }

    protected function assertValue($value): AbstractTypedArray
    {
        if (is_string($value) === false && $value !== null) {
            throw new \Exception('$value should be of type string or null.');
        }

        return $this;
    }

    protected function cast($value)
    {
        return $value === null ? null : (string) $value;
    }
}
