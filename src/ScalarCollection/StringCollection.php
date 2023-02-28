<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ScalarCollection;

use Steevanb\PhpCollection\{
    AbstractCollection,
    Exception\InvalidTypeException,
    ValueAlreadyExistsModeEnum
};

class StringCollection extends AbstractCollection implements StringCollectionInterface
{
    /** @param iterable<string|int, string> $values */
    public function __construct(
        iterable $values = [],
        ValueAlreadyExistsModeEnum $valueAlreadyExistsMode = ValueAlreadyExistsModeEnum::ADD
    ) {
        parent::__construct($values, $valueAlreadyExistsMode);
    }

    public function set(int|string $key, string $value): static
    {
        return $this->doSet($key, $value);
    }

    /** @param iterable<string|int, string> $values */
    public function replace(iterable $values): static
    {
        return $this->doReplace($values);
    }

    public function add(string $value): static
    {
        return $this->doAdd($value);
    }

    public function has(string $value): bool
    {
        return $this->doHas($value);
    }

    public function get(string|int $key): string
    {
        return $this->doGet($key);
    }

    public function merge(StringCollectionInterface $collection): static
    {
        return $this->doMerge($collection);
    }

    /** @return array<string|int, string> */
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
