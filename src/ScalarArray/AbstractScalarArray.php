<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\ScalarArray;

use Steevanb\PhpTypedArray\AbstractTypedArray;

abstract class AbstractScalarArray extends AbstractTypedArray
{
    abstract protected function cast(mixed $value): mixed;

    protected bool $castValues = false;

    public function offsetSet(mixed $offset, mixed $value): void
    {
        parent::offsetSet(
            $offset,
            ($this->isCastValues()) ? $this->cast($value) : $value
        );
    }

    public function setCastValues(bool $castValues): static
    {
        $this->castValues = $castValues;

        return $this;
    }

    public function isCastValues(): bool
    {
        return $this->castValues;
    }
}
