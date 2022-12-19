<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\ScalarArray;

use Steevanb\PhpTypedArray\{
    AbstractTypedArray,
    Exception\InvalidTypeException
};

class ScalarArray extends AbstractTypedArray
{
    protected bool $allowString = true;

    protected bool $allowInt = true;

    protected bool $allowFloat = true;

    protected bool $allowBool = true;

    public function current(): string|int|float|bool|null
    {
        return parent::current();
    }

    public function offsetGet(mixed $offset): string|int|float|bool|null
    {
        return parent::offsetGet($offset);
    }

    public function merge(ScalarArray $typedArray): static
    {
        parent::doMerge($typedArray);

        return $this;
    }

    public function setAllowString(bool $allowString): static
    {
        $this->allowString = $allowString;

        return $this;
    }

    public function isAllowString(): bool
    {
        return $this->allowString;
    }

    public function setAllowInt(bool $allowInt): static
    {
        $this->allowInt = $allowInt;

        return $this;
    }

    public function isAllowInt(): bool
    {
        return $this->allowInt;
    }

    public function setAllowFloat(bool $allowFloat): static
    {
        $this->allowFloat = $allowFloat;

        return $this;
    }

    public function isAllowFloat(): bool
    {
        return $this->allowFloat;
    }

    public function setAllowBool(bool $allowBool): static
    {
        $this->allowBool = $allowBool;

        return $this;
    }

    public function isAllowBool(): bool
    {
        return $this->allowBool;
    }

    protected function canAddValue(mixed $offset, mixed $value): bool
    {
        if (is_null($value) === false) {
            if (is_scalar($value) === false) {
                throw new InvalidTypeException('$value should be of type scalar or null.');
            }

            if ($this->isAllowString() === false && is_string($value)) {
                throw new InvalidTypeException('Type string for $value is not allowed by configuration.');
            }

            if ($this->isAllowInt() === false && is_int($value)) {
                throw new InvalidTypeException('Type int for $value is not allowed by configuration.');
            }

            if ($this->isAllowFloat() === false && is_float($value)) {
                throw new InvalidTypeException('Type float for $value is not allowed by configuration.');
            }

            if ($this->isAllowBool() === false && is_bool($value)) {
                throw new InvalidTypeException('Type float for $value is not allowed by configuration.');
            }
        }

        return parent::canAddValue($offset, $value);
    }
}
