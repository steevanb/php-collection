<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\ScalarArray;

use Steevanb\PhpTypedArray\AbstractTypedArray;

abstract class AbstractScalarArray extends AbstractTypedArray
{
    /**
     * @param mixed $value
     * @return mixed
     */
    abstract protected function cast($value);

    /** @var bool */
    protected $castValues = false;

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value): void
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
