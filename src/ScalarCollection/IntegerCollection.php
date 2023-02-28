<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ScalarCollection;

use Steevanb\PhpCollection\{
    AbstractCollection,
    Exception\InvalidTypeException,
    ValueAlreadyExistsModeEnum
};

class IntegerCollection extends AbstractCollection implements IntegerCollectionInterface
{
    /** @param iterable<string|int, int> $values */
    public function __construct(
        iterable $values = [],
        ValueAlreadyExistsModeEnum $valueAlreadyExistsMode = ValueAlreadyExistsModeEnum::ADD
    ) {
        parent::__construct($values, $valueAlreadyExistsMode);
    }

    public function set(int|string $key, int $value): static
    {
        return $this->doSet($key, $value);
    }

    /** @param iterable<string|int, int> $values */
    public function replace(iterable $values): static
    {
        return $this->doReplace($values);
    }

    public function add(int $value): static
    {
        return $this->doAdd($value);
    }

    public function has(int $value): bool
    {
        return $this->doHas($value);
    }

    public function get(string|int $key): int
    {
        return $this->doGet($key);
    }

    public function merge(IntegerCollectionInterface $collection): static
    {
        return $this->doMerge($collection);
    }

    /** @return array<string|int, int> */
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
