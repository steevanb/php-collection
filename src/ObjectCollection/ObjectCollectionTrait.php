<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

use Steevanb\PhpCollection\Exception\InvalidTypeException;

/** @template TValueType of object|null */
trait ObjectCollectionTrait
{
    /** @return class-string<TValueType> */
    abstract public static function getValueFqcn(): string;

    abstract protected function getAssertInstanceOfError(mixed $value): string;

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
}
