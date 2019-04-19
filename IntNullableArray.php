<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray;

class IntNullableArray extends AbstractTypedArray
{
    public function current(): ?int
    {
        return parent::current();
    }

    public function offsetGet($offset): ?int
    {
        return parent::offsetGet($offset);
    }

    protected function assertValue($value): AbstractTypedArray
    {
        if (is_int($value) === false && $value !== null) {
            throw new \Exception('$value should be of type int or null.');
        }

        return $this;
    }

    protected function cast($value)
    {
        if ($value !== null && is_numeric($value) === false) {
            throw new \Exception('"' . $value . '" is not numeric or null.');
        }

        return ($value === null) ? null : (int) $value;
    }
}
