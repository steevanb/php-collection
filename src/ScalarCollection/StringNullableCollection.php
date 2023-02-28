<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ScalarCollection;

use Steevanb\PhpCollection\{
    AbstractCollection,
    Exception\InvalidTypeException,
    ValueAlreadyExistsModeEnum
};

class StringNullableCollection extends AbstractCollection implements ScalarCollectionInterface
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

    public function merge(StringNullableCollection|StringCollection $collection): static
    {
        parent::doMerge($collection);

        return $this;
    }

    /** @return array<string|null> */
    public function toArray(): array
    {
        return parent::toArray();
    }

    protected function canAddValue(mixed $offset, mixed $value): bool
    {
        if (is_null($value) === false && is_string($value) === false) {
            throw new InvalidTypeException('$value should be of type string or null.');
        }

        return parent::canAddValue($offset, $value);
    }
}
