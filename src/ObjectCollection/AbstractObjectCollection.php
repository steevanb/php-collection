<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

use Steevanb\PhpCollection\AbstractCollection;

/**
 * @template TValueType of object
 * @extends AbstractCollection<TValueType>
 */
abstract class AbstractObjectCollection extends AbstractCollection
{
    /** @use ObjectCollectionTrait<TValueType> */
    use ObjectCollectionTrait;

    /** @return class-string<TValueType> */
    abstract public static function getValueFqcn(): string;

    /** @param iterable<TValueType> $values */
    public function __construct(iterable $values = [])
    {
        parent::__construct($values);
    }

    protected function getAssertInstanceOfError(mixed $value): string
    {
        return 'Value should be an instance of ' . static::getValueFqcn() . ', ' . get_debug_type($value) . ' given.';
    }

    protected function assertValueType(mixed $value): static
    {
        $this->assertInstanceOf($value);

        return $this;
    }
}
