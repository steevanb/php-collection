<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

use Steevanb\PhpCollection\{
    Exception\InvalidTypeException,
    Exception\PhpCollectionException
};

/** @template T */
trait ObjectCollectionTrait
{
    abstract protected function getAssertInstanceOfError(mixed $value): string;

    public function getComparisonMode(): ComparisonModeEnum
    {
        return $this->comparisonMode;
    }

    protected function assertInstanceOf(mixed $value): static
    {
        if (
            is_object($value) === false
            || $value instanceof ($this::getValueFqcn()) === false
        ) {
            throw new InvalidTypeException($this->getAssertInstanceOfError($value));
        }

        return $this;
    }

    /**
     * @param T $firstValue
     * @param T $secondValue
     */
    protected function isSameValues(mixed $firstValue, mixed $secondValue): bool
    {
        if ($this->getComparisonMode() === ComparisonModeEnum::STRING) {
            $return = $this->castValueToString($firstValue) === $this->castValueToString($secondValue);
        /**
         * He is right, this if is useless for now, but if one day we add a value I prefer throw the exception
         * @phpstan-ignore-next-line
         */
        } elseif ($this->getComparisonMode() === ComparisonModeEnum::HASH) {
            $return =
                (is_object($firstValue) ? spl_object_hash($firstValue) : null)
                === (is_object($secondValue) ? spl_object_hash($secondValue) : null);
        } else {
            throw new PhpCollectionException('Unknown comparison mode "' . $this->getComparisonMode()->value . '".');
        }

        return $return;
    }

    /** @param T $value */
    protected function castValueToString(mixed $value): string
    {
        if ($value instanceof \BackedEnum) {
            $return = (string) $value->value;
        } elseif ($value instanceof \UnitEnum) {
            $return = $value->name;
        } elseif (is_object($value) && $value instanceof \Stringable === false) {
            throw new PhpCollectionException(
                'Error while converting an instance of ' . $value::class . ' to string. Add __toString() to do it.'
            );
        } else {
            $return = parent::castValueToString($value);
        }

        return $return;
    }
}
