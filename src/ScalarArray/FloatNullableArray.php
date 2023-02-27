<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\ScalarArray;

use Steevanb\PhpTypedArray\{
    AbstractTypedArray,
    Exception\InvalidTypeException,
    ValueAlreadyExistsModeEnum
};

class FloatNullableArray extends AbstractTypedArray implements ScalarArrayInterface
{
    /** @param iterable<float|null> $values */
    public function __construct(
        iterable $values = [],
        ValueAlreadyExistsModeEnum $valueAlreadyExistsMode = ValueAlreadyExistsModeEnum::ADD
    ) {
        parent::__construct($values, $valueAlreadyExistsMode);
    }

    public function current(): ?float
    {
        return parent::current();
    }

    public function offsetGet(mixed $offset): ?float
    {
        return parent::offsetGet($offset);
    }

    public function merge(FloatNullableArray|FloatArray $typedArray): static
    {
        parent::doMerge($typedArray);

        return $this;
    }

    /** @return array<float|null> */
    public function toArray(): array
    {
        return parent::toArray();
    }

    protected function canAddValue(mixed $value): bool
    {
        if (is_null($value) === false && is_float($value) === false) {
            throw new InvalidTypeException('$value should be of type float or null.');
        }

        return parent::canAddValue($value);
    }
}
