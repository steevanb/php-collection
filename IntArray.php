<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray;

class IntArray extends AbstractTypedArray
{
    public function current(): ?int
    {
        return parent::current();
    }

    public function offsetGet($offset): int
    {
        if ($this->offsetExists($offset)) {
            throw new \Exception('Unknown key "' . $offset . '".');
        }

        return $this->values[$offset];
    }

    protected function assertValue($value): AbstractTypedArray
    {
        if (is_int($value) === false) {
            throw new \Exception('$value should be of type int.');
        }

        return $this;
    }

    protected function cast($value)
    {
        if ($value === null || is_numeric($value) === false) {
            throw new \Exception('"' . $value . '" is not numeric.');
        }

        return (int) $value;
    }
}
