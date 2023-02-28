<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

use Steevanb\PhpCollection\{
    AbstractCollection,
    ValueAlreadyExistsModeEnum
};

abstract class AbstractObjectCollection extends AbstractCollection
{
    use ObjectCollectionTrait;

    /** @param iterable<object> $values */
    public function __construct(
        private readonly string $className,
        iterable $values = [],
        private readonly ComparisonModeEnum $comparisonMode = ComparisonModeEnum::HASH,
        ValueAlreadyExistsModeEnum $valueAlreadyExistsMode = ValueAlreadyExistsModeEnum::ADD
    ) {
        $this->assertClassName($this->className);

        parent::__construct($values, $valueAlreadyExistsMode);
    }

    protected function getAssertInstanceOfError(): string
    {
        return '$value should be an instance of ' . $this->getClassName() . '.';
    }

    protected function canAddValue(mixed $offset, mixed $value): bool
    {
        $this->assertInstanceOf($value);

        return parent::canAddValue($offset, $value);
    }
}
