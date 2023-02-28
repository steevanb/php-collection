<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ScalarCollection;

use Steevanb\PhpCollection\{
    AbstractCollection,
    Exception\InvalidTypeException,
    ValueAlreadyExistsModeEnum
};

class FloatCollection extends AbstractCollection implements ScalarCollectionInterface
{
    /** @param iterable<float> $values */
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

    public function offsetGet(mixed $offset): float
    {
        return parent::offsetGet($offset);
    }

    public function merge(FloatCollection $collection): static
    {
        parent::doMerge($collection);

        return $this;
    }

    /** @return array<float> */
    public function toArray(): array
    {
        return parent::toArray();
    }

    protected function canAddValue(mixed $value): bool
    {
        if (is_float($value) === false) {
            throw new InvalidTypeException('$value should be of type float.');
        }

        return parent::canAddValue($value);
    }
}
