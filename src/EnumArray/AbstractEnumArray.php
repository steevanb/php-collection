<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\EnumArray;

use Steevanb\PhpTypedArray\{
    AbstractTypedArray,
    Exception\InvalidTypeException,
    ObjectArray\AbstractObjectArray,
    ObjectArray\AbstractObjectNullableArray,
    ValueAlreadyExistsModeEnum
};

abstract class AbstractEnumArray extends AbstractTypedArray
{
    /** @param iterable<\UnitEnum> $values */
    public function __construct(
        private readonly string $className,
        iterable $values = [],
        ValueAlreadyExistsModeEnum $valueAlreadyExistMode = ValueAlreadyExistsModeEnum::ADD
    ) {
        $this->assertClassName($this->className);

        parent::__construct($values, $valueAlreadyExistMode);
    }

    public function getClassName(): string
    {
        return $this->className;
    }

    protected function assertClassName(string $className): static
    {
        $implements = class_implements($className);
        if ($implements === false) {
            $implements = [];
        }

        if (in_array(\UnitEnum::class, $implements, true) === false) {
            throw new InvalidTypeException(
                __CLASS__
                    . ' can store only ' . \UnitEnum::class
                    . ' or ' . \BackedEnum::class . '. Use '
                    . AbstractObjectArray::class . ' or ' . AbstractObjectNullableArray::class
                    . ' if you want to store objects.'
            );
        }

        return $this;
    }

    protected function isSameValues(mixed $firstValue, mixed $secondValue): bool
    {
        return $firstValue === $secondValue;
    }

    protected function canAddValue(mixed $offset, mixed $value): bool
    {
        if (
            is_object($value) === false
            || $value instanceof ($this->getClassName()) === false
        ) {
            throw new InvalidTypeException('$value should be an instance of ' . $this->getClassName() . '.');
        }

        return parent::canAddValue($offset, $value);
    }

    protected function castValueToString(mixed $value): string
    {
        if ($value instanceof \BackedEnum) {
            $return = (string) $value->value;
        } elseif ($value instanceof \UnitEnum) {
            $return = $value->name;
        } else {
            throw new InvalidTypeException(
                '$value should be an instance of ' . \UnitEnum::class . ' or ' . \BackedEnum::class . '.'
            );
        }

        return $return;
    }
}
