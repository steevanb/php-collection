<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\ObjectCollection;

use Steevanb\PhpCollection\{
    AbstractCollection,
    ValueAlreadyExistsModeEnum
};

abstract class AbstractObjectNullableCollection extends AbstractCollection
{
    use ObjectCollectionTrait;

    /** @param iterable<object|null> $values */
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
        return '$value should be an instance of ' . $this->getClassName() . ' or null.';
    }

    protected function canAddValue(mixed $value): bool
    {
        if (is_null($value) === false) {
            $this->assertInstanceOf($value);
        }

        return parent::canAddValue($value);
    }
}
