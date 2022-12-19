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

    public function offsetGet(mixed $offset): ?string
    {
        return parent::offsetGet($offset);
    }

    public function merge(StringArray $typedArray): static
    {
        parent::doMerge($typedArray);

        return $this;
    }

    protected function canAddValue(mixed $offset, mixed $value): bool
    {
        if (is_null($value) === false && is_string($value) === false) {
            throw new InvalidTypeException('$value should be of type string or null.');
        }

        return parent::canAddValue($offset, $value);
    }

    protected function cast(mixed $value): ?string
    {
        return is_null($value) ? null : (string) $value;
    }
}
