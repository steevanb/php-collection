<?php

declare(strict_types=1);

namespace Steevanb\PhpCollection\Tests\Unit\ObjectCollection;

use Steevanb\PhpCollection\{
    ObjectCollection\AbstractObjectCollection,
    ObjectCollection\ComparisonModeEnum,
    ValueAlreadyExistsModeEnum
};

class ObjectCollection extends AbstractObjectCollection
{
    public function __construct(
        iterable $values = [],
        ComparisonModeEnum $comparisonMode = ComparisonModeEnum::HASH,
        ValueAlreadyExistsModeEnum $valueAlreadyExistsMode = ValueAlreadyExistsModeEnum::ADD,
        string $className = TestObject::class
    ) {
        parent::__construct($className, $values, $comparisonMode, $valueAlreadyExistsMode);
    }
}
