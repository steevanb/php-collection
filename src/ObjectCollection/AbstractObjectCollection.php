<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

use Steevanb\PhpCollection\{
    AbstractCollection,
    ValueAlreadyExistsModeEnum
};

/**
 * @template T
 * @extends AbstractCollection<T>
 */
abstract class AbstractObjectCollection extends AbstractCollection
{
    /** @use ObjectCollectionTrait<T> */
    use ObjectCollectionTrait;

    /** @return class-string<T> */
    abstract public static function getValueFqcn(): string;

    /** @param iterable<T> $values */
    public function __construct(
        iterable $values = [],
        ValueAlreadyExistsModeEnum $valueAlreadyExistsMode = ValueAlreadyExistsModeEnum::ADD,
        private readonly ComparisonModeEnum $comparisonMode = ComparisonModeEnum::HASH
    ) {
        parent::__construct($values, $valueAlreadyExistsMode);
    }

    protected function getAssertInstanceOfError(mixed $value): string
    {
        return 'Value should be an instance of ' . static::getValueFqcn() . ', ' . get_debug_type($value) . ' given.';
    }

    protected function canAddValue(mixed $value): bool
    {
        $this->assertInstanceOf($value);

        return parent::canAddValue($value);
    }
}
