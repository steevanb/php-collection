<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ScalarCollection;

use Steevanb\PhpCollection\{
    AbstractCollection,
    Exception\InvalidTypeException,
    ValueAlreadyExistsModeEnum
};

class FloatNullableCollection extends AbstractCollection implements ScalarCollectionInterface
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

    public function merge(FloatNullableCollection|FloatCollection $collection): static
    {
        parent::doMerge($collection);

        return $this;
    }

    /** @return array<float|null> */
    public function toArray(): array
    {
        return parent::toArray();
    }

    protected function canAddValue(mixed $offset, mixed $value): bool
    {
        if (is_null($value) === false && is_float($value) === false) {
            throw new InvalidTypeException('$value should be of type float or null.');
        }

        return parent::canAddValue($offset, $value);
    }
}
