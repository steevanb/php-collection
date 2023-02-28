<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

use Steevanb\PhpCollection\{
    EnumCollection\AbstractEnumCollection,
    Exception\InvalidTypeException,
    Exception\PhpCollectionException
};

trait ObjectCollectionTrait
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
                . '. Use ' . AbstractEnumCollection::class . ' instead.'
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
        /**
         * He is right, this is if useless for now, but if one day we add a value I prefer throw the exception
         * @phpstan-ignore-next-line
         */
        } elseif ($this->getComparisonMode() === ComparisonModeEnum::HASH) {
            $return = parent::isSameValues(
                is_object($firstValue) ? spl_object_hash($firstValue) : null,
                is_object($secondValue) ? spl_object_hash($secondValue) : null
            );
        } else {
            throw new PhpCollectionException('Unknown comparison mode "' . $this->getComparisonMode()->value . '".');
        }

        return $return;
    }

    protected function castValueToString(mixed $value): string
    {
        if (is_object($value) && $value instanceof \Stringable === false) {
            throw new PhpCollectionException(
                'Error while converting an instance of ' . $value::class . ' to string. Add __toString() to do it.'
            );
        }

        return parent::castValueToString($value);
    }
}
