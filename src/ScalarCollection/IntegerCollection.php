<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ScalarCollection;

use Steevanb\PhpCollection\{
    AbstractCollection,
    Exception\InvalidTypeException
};

/** @extends AbstractCollection<int> */
class IntegerCollection extends AbstractCollection
{
    public function set(int|string $key, int $value): static
    {
        return $this->doSet($key, $value);
    }

    public function add(int $value): static
    {
        return $this->doAdd($value);
    }

    public function merge(IntegerCollection $collection): static
    {
        return $this->doMerge($collection);
    }

    protected function canAddValue(mixed $value): bool
    {
        if (is_int($value) === false) {
            throw new InvalidTypeException('$value should be of type int.');
        }

        return parent::canAddValue($value);
    }
}
