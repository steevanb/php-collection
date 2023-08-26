<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ScalarCollection;

use Steevanb\PhpCollection\{
    AbstractCollection,
    Exception\InvalidTypeException
};

/** @extends AbstractCollection<string> */
class StringCollection extends AbstractCollection
{
    public function set(int|string $key, string $value): static
    {
        return $this->doSet($key, $value);
    }

    public function add(string $value): static
    {
        return $this->doAdd($value);
    }

    public function merge(StringCollection|StringNullableCollection $collection): static
    {
        return $this->doMerge($collection);
    }

    protected function canAddValue(mixed $value): bool
    {
        if (is_string($value) === false) {
            throw new InvalidTypeException('$value should be of type string.');
        }

        return parent::canAddValue($value);
    }
}
