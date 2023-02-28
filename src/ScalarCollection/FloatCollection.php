<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ScalarCollection;

use Steevanb\PhpCollection\{
    AbstractCollection,
    Exception\InvalidTypeException,
    ValueAlreadyExistsModeEnum
};

class FloatCollection extends AbstractCollection implements FloatCollectionInterface
{
    /** @param iterable<string|int, float> $values */
    public function __construct(
        iterable $values = [],
        ValueAlreadyExistsModeEnum $valueAlreadyExistsMode = ValueAlreadyExistsModeEnum::ADD
    ) {
        parent::__construct($values, $valueAlreadyExistsMode);
    }

    public function set(int|string $key, float $value): static
    {
        return $this->doSet($key, $value);
    }

    /** @param iterable<string|int, float> $values */
    public function replace(iterable $values): static
    {
        return $this->doReplace($values);
    }

    public function add(float $value): static
    {
        return $this->doAdd($value);
    }

    public function has(float $value): bool
    {
        return $this->doHas($value);
    }

    public function get(string|int $key): float
    {
        return $this->doGet($key);
    }

    public function merge(FloatCollectionInterface $collection): static
    {
        return $this->doMerge($collection);
    }

    /** @return array<string|int, float> */
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
