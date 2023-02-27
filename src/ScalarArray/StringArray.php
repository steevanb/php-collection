<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\ScalarArray;

use Steevanb\PhpTypedArray\{
    AbstractTypedArray,
    Exception\InvalidTypeException,
    ValueAlreadyExistsModeEnum
};

class StringArray extends AbstractTypedArray implements ScalarArrayInterface
{
    /** @param iterable<string> $values */
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

    public function offsetGet(mixed $offset): string
    {
        return parent::offsetGet($offset);
    }

    public function merge(StringArray $typedArray): static
    {
        parent::doMerge($typedArray);

        return $this;
    }

    /** @return array<string> */
    public function toArray(): array
    {
        return parent::toArray();
    }

    protected function canAddValue(mixed $value): bool
    {
        if (is_string($value) === false) {
            throw new InvalidTypeException('$value should be of type string.');
        }

        return parent::canAddValue($value);
    }
}
