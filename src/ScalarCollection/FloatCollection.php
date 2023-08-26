<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ScalarCollection;

use Steevanb\PhpCollection\{
    AbstractCollection,
    Exception\InvalidTypeException
};

/** @extends AbstractCollection<float> */
class FloatCollection extends AbstractCollection
{
    public function set(int|string $key, float $value): static
    {
        return $this->doSet($key, $value);
    }

    public function add(float $value): static
    {
        return $this->doAdd($value);
    }

    public function merge(FloatCollection $collection): static
    {
        return $this->doMerge($collection);
    }

    protected function canAddValue(mixed $value): bool
    {
        if (is_float($value) === false) {
            throw new InvalidTypeException('$value should be of type float.');
        }

        return parent::canAddValue($value);
    }
}
