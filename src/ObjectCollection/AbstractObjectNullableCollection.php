<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

use Steevanb\PhpCollection\{
    AbstractCollection,
    Exception\PhpCollectionException,
    ValueAlreadyExistsModeEnum
};

/**
 * @template TValueType of object|null
 * @extends AbstractCollection<TValueType>
 */
abstract class AbstractObjectNullableCollection extends AbstractCollection
{
    /** @use ObjectCollectionTrait<TValueType> */
    use ObjectCollectionTrait;

    /** @return class-string */
    abstract public static function getValueFqcn(): string;

    /** @param iterable<TValueType> $values */
    public function __construct(
        iterable $values = [],
        private readonly ComparisonModeEnum $comparisonMode = ComparisonModeEnum::HASH,
        ValueAlreadyExistsModeEnum $valueAlreadyExistsMode = ValueAlreadyExistsModeEnum::ADD
    ) {
        parent::__construct($values, $valueAlreadyExistsMode);
    }

    protected function getAssertInstanceOfError(mixed $value): string
    {
        return
            'Value should be an instance of ' . static::getValueFqcn() . ' or NULL, '
            . get_debug_type($value) . ' given.';
    }

    protected function canAddValue(mixed $value): bool
    {
        if (is_null($value) === false) {
            $this->assertInstanceOf($value);
        }

        return parent::canAddValue($value);
    }

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
