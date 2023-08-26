<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ScalarCollection;

use Steevanb\PhpCollection\{
    AbstractCollection,
    Exception\InvalidTypeException
};

/** @extends AbstractCollection<float|null> */
class FloatNullableCollection extends AbstractCollection
{
    public function set(int|string $key, float|null $value): static
    {
        return $this->doSet($key, $value);
    }

    public function add(float|null $value): static
    {
        return $this->doAdd($value);
    }

    public function merge(FloatCollection|FloatNullableCollection $collection): static
    {
        return $this->doMerge($collection);
    }

    protected function canAddValue(mixed $value): bool
    {
        if (is_null($value) === false && is_float($value) === false) {
            throw new InvalidTypeException('$value should be of type float or null.');
        }

        return parent::canAddValue($value);
    }
}
