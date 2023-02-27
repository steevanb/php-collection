<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\ScalarArray;

use Steevanb\PhpTypedArray\{
    AbstractTypedArray,
    Exception\InvalidTypeException,
    ValueAlreadyExistsModeEnum
};

class StringNullableArray extends AbstractTypedArray implements ScalarArrayInterface
{
    /** @param iterable<string|null> $values */
    public function __construct(
        iterable $values = [],
        ValueAlreadyExistsModeEnum $valueAlreadyExistsMode = ValueAlreadyExistsModeEnum::ADD
    ) {
        parent::__construct($values, $valueAlreadyExistsMode);
    }

    public function current(): ?string
    {
        return parent::current();
    }

    public function offsetGet(mixed $offset): ?string
    {
        return parent::offsetGet($offset);
    }

    public function merge(StringNullableArray|StringArray $typedArray): static
    {
        parent::doMerge($typedArray);

        return $this;
    }

    /** @return array<string|null> */
    public function toArray(): array
    {
        return parent::toArray();
    }

    protected function canAddValue(mixed $value): bool
    {
        if (is_null($value) === false && is_string($value) === false) {
            throw new InvalidTypeException('$value should be of type string or null.');
        }

        return parent::canAddValue($value);
    }
}
