<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ScalarCollection;

use Steevanb\PhpCollection\{
    AbstractCollection,
    Exception\InvalidTypeException
};

/** @extends AbstractCollection<int|null> */
class IntegerNullableCollection extends AbstractCollection
{
    public function set(int|string $key, int|null $value): static
    {
        return $this->doSet($key, $value);
    }

    public function add(int|null $value): static
    {
        return $this->doAdd($value);
    }

    public function merge(IntegerCollection|IntegerNullableCollection $collection): static
    {
        return $this->doMerge($collection);
    }

    protected function canAddValue(mixed $value): bool
    {
        if (is_null($value) === false && is_int($value) === false) {
            throw new InvalidTypeException('$value should be of type int or null.');
        }

        return parent::canAddValue($value);
    }
}
