<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\ScalarArray;

use Steevanb\PhpTypedArray\{
    AbstractTypedArray,
    Exception\InvalidTypeException,
    ValueAlreadyExistsModeEnum
};

class IntArray extends AbstractTypedArray implements ScalarArrayInterface
{
    /** @param iterable<int> $values */
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

    public function offsetGet(mixed $offset): int
    {
        return parent::offsetGet($offset);
    }

    public function merge(IntArray $typedArray): static
    {
        parent::doMerge($typedArray);

        return $this;
    }

    /** @return array<int> */
    public function toArray(): array
    {
        return parent::toArray();
    }

    protected function canAddValue(mixed $value): bool
    {
        if (is_int($value) === false) {
            throw new InvalidTypeException('$value should be of type int.');
        }

        return parent::canAddValue($value);
    }
}
