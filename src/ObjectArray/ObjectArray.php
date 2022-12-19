<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\ObjectArray;

use Steevanb\PhpTypedArray\{
    AbstractTypedArray,
    EnumArray\AbstractEnumArray,
    Exception\InvalidTypeException,
    Exception\PhpTypedArrayException,
    ObjectComparisonModeEnum
};

class ObjectArray extends AbstractTypedArray
{
    protected ObjectComparisonModeEnum $comparisonMode = ObjectComparisonModeEnum::STRING;

    protected ?string $className;

    /** @param iterable<object> $values */
    public function __construct(iterable $values = [], string $className = null)
    {
        $this->setClassName($className);

        parent::__construct($values);
    }

    public function setClassName(?string $className): static
    {
        if (is_string($className)) {
            $implements = class_implements($className);
            if ($implements === false) {
                $implements = [];
            }

            if (
                $className === \UnitEnum::class
                || $className === \BackedEnum::class
                || in_array(\UnitEnum::class, $implements, true)
            ) {
                throw new InvalidTypeException(
                    __CLASS__ . ' can not store ' . \UnitEnum::class . ' or ' . \BackedEnum::class
                        . '. Use ' . AbstractEnumArray::class . ' instead.'
                );
            }
        }

        $this->className = $className;

        return $this;
    }

    public function getClassName(): ?string
    {
        return $this->className;
    }

    public function setComparisonMode(ObjectComparisonModeEnum $mode): static
    {
        $this->comparisonMode = $mode;

        return $this;
    }

    public function getComparisonMode(): ObjectComparisonModeEnum
    {
        return $this->comparisonMode;
    }

    protected function canAddValue(mixed $offset, mixed $value): bool
    {
        if (is_null($value) === false) {
            if (
                is_object($value) === false
                || (
                    is_string($this->className)
                    && $value instanceof $this->className === false
                )
            ) {
                throw new InvalidTypeException(
                    '$value should be '
                    . (is_string($this->className) ? 'instance of "' . $this->className . '"' : 'an object')
                    . '.'
                );
            }
        }

        return parent::canAddValue($offset, $value);
    }

    protected function isSameValues(mixed $firstValue, mixed $secondValue): bool
    {
        if ($this->getComparisonMode() === ObjectComparisonModeEnum::STRING) {
            $return = parent::isSameValues(
                $this->castValueToString($firstValue),
                $this->castValueToString($secondValue)
            );
        } elseif ($this->getComparisonMode() === ObjectComparisonModeEnum::HASH) {
            $return = parent::isSameValues(
                is_object($firstValue) ? spl_object_hash($firstValue) : null,
                is_object($secondValue) ? spl_object_hash($secondValue) : null
            );
        } else {
            throw new PhpTypedArrayException('Unknown comparison mode "' . $this->getComparisonMode()->value . '".');
        }

        return $return;
    }

    protected function castValueToString(mixed $value): string
    {
        try {
            $return = parent::castValueToString($value);
        } catch (\Throwable) {
            throw new PhpTypedArrayException('Error while converting object to string. Add __toString() to do it.');
        }

        return $return;
    }
}
