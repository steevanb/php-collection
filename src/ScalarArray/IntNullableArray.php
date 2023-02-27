<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\ScalarArray;

use Steevanb\PhpTypedArray\{
    AbstractTypedArray,
    Exception\InvalidTypeException,
    ValueAlreadyExistsModeEnum
};

class IntNullableArray extends AbstractTypedArray implements ScalarArrayInterface
{
    /** @param iterable<int|null> $values */
    public function __construct(
        iterable $values = [],
        ValueAlreadyExistsModeEnum $valueAlreadyExistsMode = ValueAlreadyExistsModeEnum::ADD
    ) {
        parent::__construct($values, $valueAlreadyExistsMode);
    }

    public function current(): ?int
    {
        return parent::current();
    }

    public function offsetGet(mixed $offset): ?int
    {
        return parent::offsetGet($offset);
    }

    public function merge(IntNullableArray|IntArray $typedArray): static
    {
        parent::doMerge($typedArray);

        return $this;
    }

    /** @return array<int|null> */
    public function toArray(): array
    {
        return parent::toArray();
    }

    protected function canAddValue(mixed $offset, mixed $value): bool
    {
        if (is_null($value) === false && is_int($value) === false) {
            throw new InvalidTypeException('$value should be of type int or null.');
        }

        return parent::canAddValue($offset, $value);
    }
}
