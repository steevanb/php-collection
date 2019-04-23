<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\ScalarArray;

use steevanb\PhpTypedArray\AbstractTypedArray;

class StringArray extends AbstractScalarArray
{
    public function current(): ?string
    {
        return parent::current();
    }

    public function offsetGet($offset): string
    {
        return parent::offsetGet($offset);
    }

    protected function assertValue($value): AbstractTypedArray
    {
        if (is_string($value) === false) {
            throw new \Exception('$value should be of type string.');
        }

        return $this;
    }

    protected function cast($value): ?string
    {
        return ($value === null) ? null : (string) $value;
    }
}
