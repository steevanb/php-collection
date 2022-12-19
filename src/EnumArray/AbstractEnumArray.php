<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\EnumArray;

use Steevanb\PhpTypedArray\{
    Exception\InvalidTypeException,
    ObjectArray\ObjectArray
};

abstract class AbstractEnumArray extends ObjectArray
{
    /** @param iterable<\UnitEnum> $values */
    public function __construct(iterable $values = [], string $className = null)
    {
        parent::__construct($values, $className);
    }

    public function setClassName(?string $className): static
    {
        if (is_string($className)) {
            $implements = class_implements($className);
            if ($implements === false) {
                $implements = [];
            }

            if (in_array(\UnitEnum::class, $implements, true) === false) {
                throw new InvalidTypeException(
                    __CLASS__
                        . ' can store only '
                        . \UnitEnum::class
                        . '. Use '
                        . ObjectArray::class
                        . ' if you want to store objects.'
                );
            }
        }

        $this->className = $className;

        return $this;
    }

    protected function castValueToString(mixed $value): string
    {
        if ($value instanceof \BackedEnum) {
            $return = (string) $value->value;
        } elseif ($value instanceof \UnitEnum) {
            $return = $value->name;
        } else {
            throw new InvalidTypeException('$value should be an instance of ' . \UnitEnum::class . '.');
        }

        return $return;
    }
}
