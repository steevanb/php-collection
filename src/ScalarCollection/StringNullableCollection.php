<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ScalarCollection;

use Steevanb\PhpCollection\{
    AbstractCollection,
    Exception\InvalidTypeException
};

/** @extends AbstractCollection<string|null> */
class StringNullableCollection extends AbstractCollection
{
    public function set(int|string $key, string|null $value): static
    {
        return $this->doSet($key, $value);
    }

    public function add(string|null $value): static
    {
        return $this->doAdd($value);
    }

    public function merge(StringCollection|StringNullableCollection $collection): static
    {
        return $this->doMerge($collection);
    }

    protected function canAddValue(mixed $value): bool
    {
        if (is_null($value) === false && is_string($value) === false) {
            throw new InvalidTypeException('$value should be of type string or null.');
        }

        return parent::canAddValue($value);
    }
}
