<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

use Steevanb\PhpCollection\{
    Exception\InvalidTypeException,
    Exception\PhpCollectionException
};

/** @template TValueType of object|null */
trait ObjectCollectionTrait
{
    /** @return class-string<TValueType> */
    abstract public static function getValueFqcn(): string;

    abstract protected function getAssertInstanceOfError(mixed $value): string;

    public function getComparisonMode(): ComparisonModeEnum
    {
        return $this->comparisonMode;
    }

    protected function assertInstanceOf(mixed $value): static
    {
        if (
            is_object($value) === false
            // phpcs:ignore
            || $value instanceof (static::getValueFqcn()) === false
        ) {
            throw new InvalidTypeException($this->getAssertInstanceOfError($value));
        }

        return $this;
    }

    /**
     * @param TValueType $firstValue
     * @param TValueType $secondValue
     */
    protected function isSameValues(mixed $firstValue, mixed $secondValue): bool
    {
        if ($this->getComparisonMode() === ComparisonModeEnum::STRING) {
            $return = parent::isSameValues(
                // @phpstan-ignore-next-line This code will be removed in #142
                $this->castValueToString($firstValue),
                // @phpstan-ignore-next-line This code will be removed in #142
                $this->castValueToString($secondValue)
            );
        /**
         * He is right, this if is useless for now, but if one day we add a value I prefer throw the exception
         * @phpstan-ignore-next-line
         */
        } elseif ($this->getComparisonMode() === ComparisonModeEnum::HASH) {
            $return = parent::isSameValues(
                // @phpstan-ignore-next-line This code will be removed in #142
                is_object($firstValue) ? spl_object_hash($firstValue) : null,
                // @phpstan-ignore-next-line This code will be removed in #142
                is_object($secondValue) ? spl_object_hash($secondValue) : null
            );
        } else {
            throw new PhpCollectionException('Unknown comparison mode "' . $this->getComparisonMode()->value . '".');
        }

        return $return;
    }
}
