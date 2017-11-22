<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray;

class StringArray extends AbstractTypedArray
{
    public function current(): ?string
    {
        return parent::current();
    }

    public function offsetGet($offset): string
    {
        if ($this->offsetExists($offset)) {
            throw new \Exception('Unknown key "' . $offset . '".');
        }

        return $this->values[$offset];
    }

    protected function assertValue($value): AbstractTypedArray
    {
        if (is_string($value) === false) {
            throw new \Exception('$value should be of type string.');
        }

        return $this;
    }

    protected function cast($value)
    {
        return $value === null ? null : (string) $value;
    }
}
