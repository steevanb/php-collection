<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ScalarCollection;

use Steevanb\PhpCollection\{
    AbstractCollection,
    Exception\InvalidTypeException,
    ValueAlreadyExistsModeEnum
};

class IntegerNullableCollection extends AbstractCollection implements IntegerNullableCollectionInterface
{
    /** @param iterable<string|int, int|null> $values */
    public function __construct(
        iterable $values = [],
        ValueAlreadyExistsModeEnum $valueAlreadyExistsMode = ValueAlreadyExistsModeEnum::ADD
    ) {
        parent::__construct($values, $valueAlreadyExistsMode);
    }

    public function set(int|string $key, int|null $value): static
    {
        return $this->doSet($key, $value);
    }

    /** @param iterable<string|int, int|null> $values */
    public function replace(iterable $values): static
    {
        return $this->doReplace($values);
    }

    public function add(int|null $value): static
    {
        return $this->doAdd($value);
    }

    public function has(int|null $value): bool
    {
        return $this->doHas($value);
    }

    public function get(string|int $key): int|null
    {
        return $this->doGet($key);
    }

    public function merge(IntegerCollectionInterface|IntegerNullableCollectionInterface $collection): static
    {
        return $this->doMerge($collection);
    }

    /** @return array<string|int, int|null> */
    public function toArray(): array
    {
        return parent::toArray();
    }

    protected function canAddValue(mixed $value): bool
    {
        if (is_null($value) === false && is_int($value) === false) {
            throw new InvalidTypeException('$value should be of type int or null.');
        }

        return parent::canAddValue($value);
    }
}
