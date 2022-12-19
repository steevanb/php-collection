<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\ScalarArray;

use Steevanb\PhpTypedArray\Exception\InvalidTypeException;

class FloatArray extends AbstractScalarArray
{
    public function current(): ?string
    {
        return parent::current();
    }

    public function offsetGet(mixed $offset): ?float
    {
        return parent::offsetGet($offset);
    }

    public function merge(FloatArray $typedArray): static
    {
        parent::doMerge($typedArray);

        return $this;
    }

    protected function canAddValue(mixed $offset, mixed $value): bool
    {
        if (is_null($value) === false && is_float($value) === false) {
            throw new InvalidTypeException('$value should be of type float or null.');
        }

        return parent::canAddValue($offset, $value);
    }

    protected function cast(mixed $value): ?float
    {
        return is_null($value) ? null : (float) $value;
    }
}
