<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

use Steevanb\PhpCollection\AbstractCollection;

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
    public function __construct(iterable $values = [])
    {
        parent::__construct($values);
    }

    protected function getAssertInstanceOfError(mixed $value): string
    {
        return
            'Value should be an instance of ' . static::getValueFqcn() . ' or NULL, '
            . get_debug_type($value) . ' given.';
    }

    protected function assertValueType(mixed $value): static
    {
        if (is_null($value) === false) {
            $this->assertInstanceOf($value);
        }

        return $this;
    }
}
