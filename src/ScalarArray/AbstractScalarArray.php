<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\ScalarArray;

use steevanb\PhpTypedArray\AbstractTypedArray;

abstract class AbstractScalarArray extends AbstractTypedArray
{
    /** @return mixed */
    abstract protected function cast($value);

    protected $castValues = false;

    public function __construct(iterable $values = [])
    {
        parent::__construct($values);
    }

    public function offsetSet($offset, $value): void
    {
        parent::offsetSet(
            $offset,
            ($this->isCastValues()) ? $this->cast($value) : $value
        );
    }

    public function setCastValues(bool $castValues): self
    {
        $this->castValues = $castValues;

        return $this;
    }

    public function isCastValues(): bool
    {
        return $this->castValues;
    }
}
