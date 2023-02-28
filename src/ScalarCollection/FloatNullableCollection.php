<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ScalarCollection;

use Steevanb\PhpCollection\{
    AbstractCollection,
    Exception\InvalidTypeException,
    ValueAlreadyExistsModeEnum
};

class FloatNullableCollection extends AbstractCollection implements FloatNullableCollectionInterface
{
    /** @param iterable<string|int, float|null> $values */
    public function __construct(
        iterable $values = [],
        ValueAlreadyExistsModeEnum $valueAlreadyExistsMode = ValueAlreadyExistsModeEnum::ADD
    ) {
        parent::__construct($values, $valueAlreadyExistsMode);
    }

    public function set(int|string $key, float|null $value): static
    {
        return $this->doSet($key, $value);
    }

    /** @param iterable<string|int, float|null> $values */
    public function replace(iterable $values): static
    {
        return $this->doReplace($values);
    }

    public function add(float|null $value): static
    {
        return $this->doAdd($value);
    }

    public function has(float|null $value): bool
    {
        return $this->doHas($value);
    }

    public function get(string|int $key): float|null
    {
        return $this->doGet($key);
    }

    public function merge(FloatCollectionInterface|FloatNullableCollectionInterface $collection): static
    {
        return $this->doMerge($collection);
    }

    /** @return array<string|int, float|null> */
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
