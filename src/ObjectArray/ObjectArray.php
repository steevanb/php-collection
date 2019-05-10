<?php

declare(strict_types=1);

namespace steevanb\PhpTypedArray\ObjectArray;

use steevanb\PhpTypedArray\{
    AbstractTypedArray,
    Exception\InvalidTypeException,
    Exception\PhpTypedArrayException
};

class ObjectArray extends AbstractTypedArray
{
    public const COMPARISON_STRING = 1;
    public const COMPARISON_OBJECT_HASH = 2;

    /** @var ?string */
    protected $className;

    /** @var int */
    protected $comparisonMode = self::COMPARISON_STRING;

    /** @var ?string */
    protected $instanceOf;

    public function __construct(iterable $values = [], string $className = null)
    {
        $this->setClassName($className);

        parent::__construct($values);
    }

    /** @return $this */
    public function setClassName(?string $className): self
    {
        $this->instanceOf = $className;

        return $this;
    }

    public function getClassName(): ?string
    {
        return $this->instanceOf;
    }

    /** @return $this */
    public function setComparisonMode(int $mode): self
    {
        $this->comparisonMode = $mode;

        return $this;
    }

    public function getComparisonMode(): int
    {
        return $this->comparisonMode;
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    protected function canAddValue($offset, $value): bool
    {
        if ($value !== null) {
            if (
                is_object($value) === false
                || (
                    is_string($this->instanceOf)
                    && $value instanceof $this->instanceOf === false
                )
            ) {
                throw new InvalidTypeException(
                    '$value should be '
                    . (is_string($this->instanceOf) ? 'instance of "' . $this->instanceOf . '"' : 'an object')
                    . '.'
                );
            }
        }

        return parent::canAddValue($offset, $value);
    }

    /**
     * @param mixed $firstValue
     * @param mixed $secondValue
     */
    protected function isSameValues($firstValue, $secondValue): bool
    {
        if ($this->getComparisonMode() === static::COMPARISON_STRING) {
            $return = parent::isSameValues(
                $this->castValueToString($firstValue),
                $this->castValueToString($secondValue)
            );
        } elseif ($this->getComparisonMode() === static::COMPARISON_OBJECT_HASH) {
            $return = parent::isSameValues(
                is_object($firstValue) ? spl_object_hash($firstValue) : null,
                is_object($secondValue) ? spl_object_hash($secondValue) : null
            );
        } else {
            throw new PhpTypedArrayException('Unknown comparison mode "' . $this->getComparisonMode() . '".');
        }

        return $return;
    }

    /** @param mixed $value */
    protected function castValueToString($value): string
    {
        try {
            $return = parent::castValueToString($value);
        } catch (\ErrorException $exception) {
            throw new PhpTypedArrayException('Error while converting object to string. Add __toString() to do it.');
        }

        return $return;
    }
}
