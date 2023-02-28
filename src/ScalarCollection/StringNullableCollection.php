<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ScalarCollection;

use Steevanb\PhpCollection\{
    AbstractCollection,
    Exception\InvalidTypeException,
    ValueAlreadyExistsModeEnum
};

class StringNullableCollection extends AbstractCollection implements StringNullableCollectionInterface
{
    /** @param iterable<string|int, string|null> $values */
    public function __construct(
        iterable $values = [],
        ValueAlreadyExistsModeEnum $valueAlreadyExistsMode = ValueAlreadyExistsModeEnum::ADD
    ) {
        parent::__construct($values, $valueAlreadyExistsMode);
    }

    public function set(int|string $key, string|null $value): static
    {
        return $this->doSet($key, $value);
    }

    /** @param iterable<string|int, string|null> $values */
    public function replace(iterable $values): static
    {
        return $this->doReplace($values);
    }

    public function add(string|null $value): static
    {
        return $this->doAdd($value);
    }

    public function has(string|null $value): bool
    {
        return $this->doHas($value);
    }

    public function get(string|int $key): string|null
    {
        return $this->doGet($key);
    }

    public function merge(StringCollectionInterface|StringNullableCollectionInterface $collection): static
    {
        return $this->doMerge($collection);
    }

    /** @return array<string|int, string|null> */
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
