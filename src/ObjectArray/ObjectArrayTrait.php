<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\ObjectArray;

use Steevanb\PhpTypedArray\{
    EnumArray\AbstractEnumArray,
    Exception\InvalidTypeException,
    Exception\PhpTypedArrayException
};

trait ObjectArrayTrait
{
    abstract protected function getAssertInstanceOfError(): string;

    public function getClassName(): string
    {
        return $this->className;
    }

    public function getComparisonMode(): ComparisonModeEnum
    {
        return $this->comparisonMode;
    }

    protected function assertClassName(string $className): static
    {
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

        return $this;
    }

    protected function assertInstanceOf(mixed $value): static
    {
        if (
            is_object($value) === false
            || $value instanceof ($this->getClassName()) === false
        ) {
            throw new InvalidTypeException($this->getAssertInstanceOfError());
        }

        return $this;
    }

    protected function isSameValues(mixed $firstValue, mixed $secondValue): bool
    {
        if ($this->getComparisonMode() === ComparisonModeEnum::STRING) {
            $return = parent::isSameValues(
                $this->castValueToString($firstValue),
                $this->castValueToString($secondValue)
            );
        } elseif ($this->getComparisonMode() === ComparisonModeEnum::HASH) {
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
