<?php

declare(strict_types=1);

namespace Steevanb\PhpTypedArray\ObjectArray;

use Steevanb\PhpTypedArray\{
    AbstractTypedArray,
    ValueAlreadyExistsModeEnum
};

abstract class AbstractObjectNullableArray extends AbstractTypedArray
{
    use ObjectArrayTrait;

    /** @param iterable<object|null> $values */
    public function __construct(
        private readonly string $className,
        iterable $values = [],
        private readonly ComparisonModeEnum $comparisonMode = ComparisonModeEnum::HASH,
        ValueAlreadyExistsModeEnum $valueAlreadyExistMode = ValueAlreadyExistsModeEnum::ADD
    ) {
        $this->assertClassName($this->className);

        parent::__construct($values, $valueAlreadyExistMode);
    }

    protected function getAssertInstanceOfError(): string
    {
        return '$value should be an instance of ' . $this->getClassName() . ' or null.';
    }

    protected function canAddValue(mixed $offset, mixed $value): bool
    {
        if (is_null($value) === false) {
            $this->assertInstanceOf($value);
        }

        return parent::canAddValue($offset, $value);
    }
}
